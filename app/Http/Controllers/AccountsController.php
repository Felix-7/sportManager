<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountsController extends Controller
{
    public function resetPasswords()
    {
        $teacherList = Teacher::all();
        return view('admin.accounts', compact('teacherList'));
    }

    public function resetThisAccount(int $id)
    {
        $teacher = Teacher::where('id', '=', $id)->first();
        $teacher->firstLogin = true;
        $newPass = Str::random(8);
        $teacher->password = Hash::make($newPass);
        $teacher->save();

        return view('admin.newpass', compact('teacher', 'newPass'));
    }
}
