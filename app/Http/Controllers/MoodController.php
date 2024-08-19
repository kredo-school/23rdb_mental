<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use Illuminate\Support\Facades\Log;


class MoodController extends Controller
{
    private $mood;

    public function __construct(Mood $mood)
    {
        $this->mood = $mood;
    }

    public function create1()
    {
        return view('mood.login-first');
    }

    public function create()
    {
        return view('mood.login');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'score' => 'required|integer|between:-2,2',
            ]);

            $this->mood->user_id = Auth::user()->id;
            $this->mood->score = $request->score;

            $this->mood->save();

            return redirect()->route('home');
            
        } catch (\Exception $e) {
            Log::error('Failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed']);
        }
    }

    public function index()
    {
        return view('mood.index');
    }
}
