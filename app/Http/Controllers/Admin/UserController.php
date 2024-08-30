<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $user = $this->user;

        if ($request->search) {
            //search results
            $all_users = $this->user->where('name', 'LIKE', '%' . $request->search . '%')->orderBy('name')->withTrashed()->paginate(10);
            //SELECT * FROM users WHERE username LIKE '%keyword%'

        } else {
            $sort = $request->input('sort', 'name');

            // Build the query
            $query = User::query();

            if ($sort === 'name') {
                $query->orderBy('name');
            } elseif ($sort === 'id') {
                $query->orderBy('id');
            }

            $all_users = $query->withTrashed()->paginate(10);
        }

        return view('admin.users.index')
            ->with('all_users', $all_users)
            ->with('user', $user)
            ->with('search', $request->search);
    }

    public function toggleStatus(Request $request, $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            // Restore the user if they are currently soft-deleted
            $user->restore();
        } else {
            // Soft delete the user if they are currently active
            $user->delete();
        }

        return redirect()->back();
    }
}
