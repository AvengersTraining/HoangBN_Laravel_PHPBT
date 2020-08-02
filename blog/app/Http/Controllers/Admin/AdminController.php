<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __contruct()
    {
        // Do something
    }

    /**
     * Display a listing of the user.
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(12);

        return view('admin/index', compact('users'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('message', 'Delete user successfuly');
    }
}
