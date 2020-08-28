<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function authorize($method, $model)
    {
        if (!Auth::check()) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        if (!$user->can($method, $model)) {
            abort(Response::HTTP_FORBIDDEN);
        }
    }
}
