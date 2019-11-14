<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PersonalPasswordController extends Controller
{
    public function newPassword()
    {
        if(Auth::user()->firstLogin == false) return redirect('/'); //DOUBLE CHECK TO AVOID ABUSE OF THIS PAGE
        //PASSWORD REGISTRATION STARTS HERE
        return view('auth.firstPassword');
    }

    public function savePassword()
    {
        $newPass = $this->validatePassword();
        $user = Teacher::where('email', '=', Auth::user()->email)->first();
        $user->password = Hash::make($newPass['password']);
        $user->firstLogin = false;
        $user->save();

        $data="Herzlich Willkommen, ";
        return view('welcome', compact('data'));
    }

    private function validatePassword(){
        return request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
