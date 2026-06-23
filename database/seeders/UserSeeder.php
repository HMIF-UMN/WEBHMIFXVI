<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::create([
            'name'     => 'admin',
            'email'    => 'admin@hmif.umn.ac.id',
            'password' => Hash::make('hmifJAYA123@'),
            'role'     => 'admin',
        ]);

        // HR account
        User::create([
            'name'     => 'hr',
            'email'    => 'hr@hmif.umn.ac.id',
            'password' => Hash::make('HRjaya123@'),
            'role'     => 'hr',
        ]);

        // Master account
        User::create([
            'name'     => 'master',
            'email'    => 'master@hmif.umn.ac.id',
            'password' => Hash::make('Masterjaya123@'),
            'role'     => 'master',
        ]);
    }
}
