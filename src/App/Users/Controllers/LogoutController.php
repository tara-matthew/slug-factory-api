<?php

namespace App\Users\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Support\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke(): Response
    {
        Auth::guard('web')->logout();

        return response()->noContent();
    }
}
