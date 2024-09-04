<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Inquiry; 
use App\Models\User;



class InquiryController extends Controller
{
    private $inquiry;

    public function __construct(Inquiry $inquiry, User $user){
        $this->inquiry = $inquiry;
        $this->user = $user;
    }

   


    //  store the inquiry data
    public function store(Request $request){
        #validate
        $request->validate([
            'inquiry' => ['required', 'min:1'],
        ]);

        #save the inquiry data
        $this->inquiry->user_id = Auth::user()->id; // the owner of the inquiry
        $this->inquiry->body = $request->inquiry;
        $this->inquiry->save();

        // return redirect()->back();

        return response()->json(['success' => true]);
}



}