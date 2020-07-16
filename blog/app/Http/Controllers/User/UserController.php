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
        return view('user/profile');
    }

    /**
     * Display edit ui
     */
    public function edit()
    {
        return view('user/edit');
    }

    /**
     * Update user information
     */
    public function update(UpdateUserRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $info = [
            'full_name' => $request->input('name'),
            'display_name' => $request->input('dpname'),
            'birthday' => $request->input('birthday'),
            'phone_number' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ];
        $user->update($info);

        return redirect()->route('profile', ['id' => $user->id]);
    }
}
