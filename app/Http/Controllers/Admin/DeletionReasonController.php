<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DeletionReason;

class DeletionReasonController extends Controller
{
    private $deletion_reason;

    public function __construct(DeletionReason $deletion_reason)
    {
        $this->deletion_reason = $deletion_reason;
    }

    public function index(){

            $all_deletion_reasons = $this->deletion_reason->latest()->paginate(10);
            $deletion_reason = $this->deletion_reason;

        return view('admin.deletion-reasons.index')
            ->with('all_deletion_reasons', $all_deletion_reasons)
            ->with('deletion_reason', $deletion_reason);
    }


}
