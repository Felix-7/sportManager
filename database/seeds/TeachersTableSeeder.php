<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Teacher;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'name' => 'ADMIN',
            'email' => 'f.kainz@gymgmunden.at',
            'password' => Hash::make('VWA_Sport@2019'),
            'firstLogin' => false,
        ]);
    }
}
