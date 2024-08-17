<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoodController extends Controller
{
    public function create1() {
        return view('mood.login-first');
    }

    public function create() {
        return view('mood.login');
    }

    public function index() {
        return view('mood.index');
    }
}
