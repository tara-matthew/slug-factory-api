<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(): Response
    {
        Auth::guard('web')->logout();

        return response()->noContent();
    }
}
