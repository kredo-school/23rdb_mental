<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\User;


class InquiriesController extends Controller
{
    private $inquiry;
    private $users;


    public function __construct(Inquiry $inquiry, User $user){
        $this->inquiry = $inquiry;
        $this->user = $user;

    }

    public function index(){
        $all_inquiries = $this->inquiry->latest()->paginate(10);
        $inquiries_count = $this->inquiry;

        return view('admin.contactus.index')
            ->with('all_inquiries', $all_inquiries)
            ->with('inquiries_count', $inquiries_count);
    }

}
