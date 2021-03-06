<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $users = User::orderBy('id', 'asc')->paginate(config('blog.users.user_limit'));

        return view('admin/index', compact('users'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->tags()->detach();
            $user->delete();

            return redirect()->back()->with('message', 'Delete user successfuly');
        } catch (Exception $e) {
            Log::error($e);
            
            return redirect()->back()->with('error', 'Delete user failure');
        }
    }
}
