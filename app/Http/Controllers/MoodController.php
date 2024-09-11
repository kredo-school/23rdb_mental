<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use App\Models\Feedback;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class MoodController extends Controller
{
    private $mood;
    private $feedback;

    public function __construct(Mood $mood, Feedback $feedback)
    {
        $this->mood = $mood;
        $this->feedback = $feedback;
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
        $all_moods = $this->mood->where('user_id', Auth::user()->id)->paginate(20);

        return view('mood.index')
            ->with('all_moods', $all_moods);
    }

    public function getMoodData($date)
    {
        $utcDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
        // Fetch mood data for the given date
        $moods = Mood::whereDate('created_at', $utcDate->format('Y-m-d'))
            ->where('user_id', Auth::user()->id)->get();
        // Return the data as JSON
        return response()->json($moods);
    }

    public function moodGraph()
    {
        // Get the logged-in user
        $userId = Auth::id();

        // Fetch scores for the logged-in user for the last 7 days
        $scores = Mood::where('user_id', $userId)
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at')
            ->get(['created_at', 'score']);

        return response()->json($scores);
    }

    public function moodCalendar()
    {
        try {
            // Get the start and end of the current month
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();

            $userId = Auth::id();

            // Fetch mood records for the current month
            $records = Mood::where('user_id', $userId)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->get();

            // Calculate average score per day
            $dailyAverages = $records->groupBy(function ($date) {
                return $date->created_at->toDateString(); // Group by date
            })->map(function ($day) {
                return $day->avg('score'); // Calculate average score for each day
            });

            // Format data for FullCalendar
            $events = $dailyAverages->map(function ($score, $date) {
                return [
                    'title' => number_format($score, 1), // Display the average score
                    'start' => $date,
                    'allDay' => true,
                    'score' => $score
                ];
            })->values();

            return response()->json($events);
        } catch (\Exception $e) {
            Log::error('Failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed']);
        }
    }

    public function storeFeedback(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
        ]);

        // Store feedback
        Feedback::updateOrCreate(
            ['user_id' => $request->user()->id, 'month' => $request->month, 'year' => $request->year],
            ['feedback' => $request->feedback]
        );

        return response()->json(['message' => 'Feedback saved successfully']);
    }

    public function getFeedbacks(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $feedbacks = Feedback::where('month', $month)
                             ->where('year', $year)
                             ->where('user_id', Auth::user()->id)
                             ->get();

        return response()->json($feedbacks);
    }

}
