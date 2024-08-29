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

    public function index(Request $request)
    {
        $deletion_reason = $this->deletion_reason;

        // $deletion_reason = $this->deletion_reason;

        // $sort = $request->input('sort', 'latest');


        // $query = DeletionReason::query();

        // if ($sort === 'latest') {
        //     $query->orderBy('created_at', 'desc');
        // } elseif ($sort === 'oldest') {
        //     $query->orderBy('created_at', 'asc');
        // }

        // $all_deletion_reasons = $query->paginate(10);

        // return view('admin.deletion-reasons.index')
        //     ->with('all_deletion_reasons', $all_deletion_reasons)
        //     ->with('deletion_reason', $deletion_reason);
        if ($request->search) {
            //search results
                $all_deletion_reasons = $this->deletion_reason->where('reason', 'LIKE', '%' . $request->search . '%')->latest()->paginate(10);
              //SELECT * FROM deletion_reasons WHERE reason LIKE '%keyword%'

             } else {
            // $all_deletion_reasons = $this->deletion_reason->latest()->paginate(10);


            // Get the sort option from the request, default to 'latest'
            $sort = $request->input('sort', 'latest');

            // Build the query
            $query = DeletionReason::query();

            if ($sort === 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort === 'oldest') {
                $query->orderBy('created_at', 'asc');
            }

            $all_deletion_reasons = $query->paginate(10);

             }

             return view('admin.deletion-reasons.index')
                 ->with('all_deletion_reasons', $all_deletion_reasons)
                 ->with('deletion_reason', $deletion_reason)
                 ->with('search', $request->search);
    }

}
