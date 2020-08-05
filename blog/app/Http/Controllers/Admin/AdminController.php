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
        $users = User::orderBy('id', 'asc')->paginate(config('blog.tags.user_limit'));

        return view('admin/index', compact('users'));
    }

    public function destroy($id)
    {
        try {
            $result = User::where('id', $id)->delete();
            if ($result) {
                return redirect()->back()->with('message', 'Delete user successfuly');
            }

            return redirect()->back()->with('error', 'Delete user failure');
        } catch (Exception $e) {
            Log::error($e);
            
            return redirect()->back()->with('error', 'Delete user failure');
        }
    }
}
