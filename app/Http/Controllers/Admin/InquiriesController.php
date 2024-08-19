<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiriesController extends Controller
{
    private $inquiry;

    public function __construct(Inquiry $inquiry){
        $this->inquiry = $inquiry;
    }

    public function index(){
        $all_inquiries = $this->inquiry->latest()->paginate(10);
        $inquiries_count = $this->inquiry;

        return view('admin.contactus.index')
            ->with('all_inquiries', $all_inquiries)
            ->with('inquiries_count', $inquiries_count);
    }

}
