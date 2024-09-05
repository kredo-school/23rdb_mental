<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TestController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index() {
        return view('test.index');
    }

    public function graphIndex() {
        return view('test.graph');
    }

    public function moodGraph()
    {
        // Fetch scores for the last 7 days
        $scores = Mood::where('created_at', '>=', now()->subDays(7))
                        ->orderBy('created_at')
                        ->get(['created_at', 'score']);

        return response()->json($scores);
    }
}
