<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __invoke()
    {
        return view('users.profile', ['user' => Auth::user()]);
    }
}
