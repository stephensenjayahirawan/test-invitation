<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::insert([
            [
                'name' => 'Stephen Senjaya',
                'email' => 'stphn2909@gmail.com',
                'password' => Hash::make('asdf1234'),
                'role' => 'admin'
            ], [
                'name' => 'Manager 1',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('asdf1234'),
                'role' => 'manager'
            ]
        ]);

    }
}
