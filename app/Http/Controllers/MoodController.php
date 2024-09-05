<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



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
        $userId = Auth::id();
        $startDate = Carbon::now()->subDays(5);
        $moods = Mood::where('user_id', $userId)
            ->where('created_at', '>=', $startDate)
            ->select('created_at', 'score')
            ->orderBy('created_at')
            ->get();
        $moodsData = $moods->map(function ($mood) {
            return [
                $mood->created_at->format('Y-m-d H:i:s'),
                $mood->score
            ];
        });

        $moodsData->prepend(['Date', 'Mood']);

        return view('mood.index', ['moodsData' => $moodsData]);
        // return view('mood.index');
    }

    public function getMoods()
    {
        $userId = Auth::id();
        $startDate = Carbon::now()->subDays(5);
        $moods = Mood::where('user_id', $userId)
            ->where('created_at', '>=', $startDate)
            ->select('created_at', 'score')
            ->orderBy('created_at')
            ->get();
        return response()->json($moods);
    }

    public function moodGraph()
    {
        // Fetch scores for the last 7 days
        // Get the logged-in user
        $userId = Auth::id();

        // Fetch scores for the logged-in user for the last 7 days
        $scores = Mood::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at')
            ->get(['created_at', 'score']);

        return response()->json($scores);
    }

    // public function getMoods()
    // {
    //     $userId = Auth::id();
    //     $moods = Mood::select(DB::raw('DATE(created_at) as date'), DB::raw('AVG(score) as avg_score'))
    //         ->where('user_id', $userId)
    //         ->groupBy(DB::raw('DATE(created_at)'))
    //         ->orderBy(DB::raw('DATE(created_at)'))
    //         ->get();
    //     return response()->json($moods);
    // }
}
