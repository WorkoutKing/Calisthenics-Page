<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Make sure the User model is imported (or your own model)

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('email', operator: 'madstars4ever@gmail.com')->doesntExist()) {
            User::create([
                'name' => 'Madstars',
                'email' => 'madstars4ever@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => '2',
            ]);
        }
    }
}
