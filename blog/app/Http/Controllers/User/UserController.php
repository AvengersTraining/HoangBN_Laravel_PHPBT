<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        // Do something
    }

    /**
     * Display profile ui
     */
    public function profile()
    {
        $user = auth()->user();

        return view('user/profile', compact('user'));
    }

    /**
     * Display edit ui
     */
    public function edit()
    {
        $user = auth()->user();

        return view('user/edit', compact('user'));
    }

    /**
     * Update user information
     */
    public function update(UpdateUserRequest $request)
    {
        User::where('id', Auth::user()->id)->update(
            [
                'full_name' => $request->input('full_name'),
                'display_name' => $request->input('display_name'),
                'birthday' => $request->input('birthday'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
            ]
        );

        return redirect()->route('profile')->with('message', 'Update user information successfully');
    }
}
