<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Teacher extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstLogin', 'active', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function values()
    {
        return $this->hasMany(\App\Value::class);
    }

    public static function generateTeacher(string $name, string $pw){
        return Teacher::create([
            'name' => $name,
            'email' => strtolower($name) . '@gymgmunden.at',
            'password' => Hash::make($pw),
            'firstLogin' => true,
            'active' => true,
        ]);
    }

}
