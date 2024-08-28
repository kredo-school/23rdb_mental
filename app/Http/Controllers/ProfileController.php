<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\DeletionReason;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display the user's profile form.
     */
    public function setting($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('profile.setting')
            ->with('user', $user_a);
    }

    public function show($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('profile.show')
            ->with('user', $user_a);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'avatar'          => 'mimes:jpeg,jpg,png.gif',
                // 'name'            => 'required|max:50',
                // 'email'           => 'required|max:50|email|unique:users,email,' . Auth::user()->id,
                //Adding: unique:<table>, <column>
                //Updating: unique:<table>, <column>, <id>
                // 'username'        => 'max:50',
                'theme_color'     => 'required|digits_between :1, 6',
                // 'location'        => 'max:50',
                // 'birthday'        => 'date_format:Y-m-d'
            ]);

            $user_a = $this->user->findOrFail(Auth::user()->id);

            // $user_a->name         = $request->name;
            // $user_a->email        = $request->email;
            // $user_a->username     = $request->username;
            $user_a->theme_color  = $request->theme_color;
            // $user_a->location     = $request->location;
            // $user_a->birthday     = $request->birthday;

            if ($request->avatar) {
                $user_a->avatar   = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
            }

            $user_a->save();
            Log::info('Success!');
            return redirect()->route('mood.save1');
        } catch (\Exception $e) {
            Log::error('Failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed']);
        }
    }

    public function update2(Request $request)
    {
        try {

            $request->validate([
                'avatar'          => 'mimes:jpeg,jpg,png.gif',
                'name'            => 'required|max:50',
                'email'           => 'required|max:50|email|unique:users,email,' . Auth::user()->id,
                // Adding: unique:<table>, <column>
                //Updating: unique:<table>, <column>, <id>
                'username'        => 'max:50',
                'theme_color'     => 'required|digits_between :1, 6',
                'location'        => 'max:50',
                'birthday'        => 'nullable',
                'date_format:Y-m-d'

            ]);

            $user_a = $this->user->findOrFail(Auth::user()->id);

            $user_a->name         = $request->name;
            $user_a->email        = $request->email;
            $user_a->username     = $request->username;
            $user_a->theme_color  = $request->theme_color;
            $user_a->location     = $request->location;
            $user_a->birthday     = $request->birthday;

            if ($request->avatar) {
                $user_a->avatar   = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
            }

            $user_a->save();
            return redirect()->back();

        } catch (\Exception $e) {
            Log::error('Failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed']);
        };
    }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->forceDelete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/login');
    // }

    public function deletionReason(Request $request)
    {
        try {
            $request->validate([
                'reason' => 'required|max:200'
            ]);

            $user = $request->user();
            $reason = $request->input('reason');

            // user_id is irrelevant, we just need the feedback from the users for application/service improvement, removal of the user_id in this function does not hinder the functionality, user_id may be replaced by 'name' or 'email' for future projects and the functionality should remain the same as long as the data type is consistent in the db and in the blade file (Form)

            DB::table('deletion_reasons')->insert([
                'user_id' => $user->id,
                'reason' => $reason,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')->where('id', $user->id)->delete();


            return redirect('/login')->with('status', 'Your account has been deleted successfully.');

            // $this->user->deletion_reasons->reason = $request->reason;

            // $this->user->deletion_reason->save();

        } catch (\Exception $e) {
            Log::error('Failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed'])
            ;
        };
    }



    // public function destroy($id)
    // {
    //     $user_a = $this->user->findOrFail($id);
    //     $user_a->forceDelete();
    //     Auth::logout();
    //     return redirect()->route('login');
    // }
}
