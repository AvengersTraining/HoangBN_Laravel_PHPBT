<?php

namespace App\Http\Controllers\User;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        // Do something
    }

    /**
     * Display profile ui
     */
    public function show(Request $request, $id)
    {
        $user = auth()->user();

        return view('user/show', compact('user'));
    }

    /**
     * Display edit ui
     */
    public function edit($id)
    {
        $user = auth()->user();

        return view('user/edit', compact('user'));
    }

    /**
     * Update user information
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $data = [
                'full_name' => $request->input('full_name'),
                'display_name' => $request->input('display_name'),
                'birthday' => $request->input('birthday'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
            ];
            if (User::where('id', $id)->update($data)) {
                return redirect()->route('users.show', $id)->with('message', 'Update user information successfully');
            }

            return redirect()->back()->with('error', 'Update user information failure');
        } catch (Exception $e) {
            Log::error($e);

            return redirect()->back()->with('error', 'Update user information failure');
        }
    }
}
