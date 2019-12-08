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
        $newPass = $this->resetPassword($teacher);
        return view('admin.newpass', compact('teacher', 'newPass'));
    }

    public function suspendThisAccount(int $id)
    {
        $teacher = Teacher::where('id', '=', $id)->first();
        $this->changeActive($teacher);
        return view('admin.suspend', compact('teacher'));
    }

    public function activateThisAccount(int $id)
    {
        $teacher = Teacher::where('id', '=', $id)->first();
        $this->changeActive($teacher);
        $newPass = $this->resetPassword($teacher);
        return view('admin.activate', compact('teacher', 'newPass'));
    }

    private function changeActive($teacher){
        $teacher->active == false ? $teacher->active = true : $teacher->active = false;
        $teacher->save();
        return;
    }

    private function resetPassword($teacher){
        $teacher->firstLogin = true;
        $newPass = Str::random(8);
        $teacher->password = Hash::make($newPass);
        $teacher->save();
        return $newPass;
    }
}
