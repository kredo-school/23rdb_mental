<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class InquiriesController extends Controller
{
    private $inquiry;
    private $users;


    public function __construct(Inquiry $inquiry, User $user){
        $this->inquiry = $inquiry;
        $this->user = $user;

    }



public function index(Request $request){
    $all_inquiries = $this->inquiry->latest()->paginate(10);
    $inquiries_count = $this->inquiry;

    $keyword = $request->input('keyword');
    if (!empty($request)){
        $all_inquiries = Inquiry::query()
            ->whereHas('user', function($user) use ($keyword){
                $user->where('name', 'like', '%' . $keyword . '%');
            })
            ->orWhere('body', 'like', '%' . $keyword . '%')->latest()->paginate(10);

            $inquiries_count = $all_inquiries;
            };
    

    return view('admin.contactus.index') 
        ->with('all_inquiries', $all_inquiries)
        ->with('inquiries_count', $inquiries_count)
        ->with('keyword', $keyword);  
}

}
