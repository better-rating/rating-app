<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        //account info
        $user = auth()->user();

        //my modules
//        $modules =
//        dump($user);
        return view('user.dashboard', compact('user'));
    }
}
