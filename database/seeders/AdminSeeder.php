<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'bababooks29@gmail.com'], // Check if a user with this email already exists
            [
                'name' => 'Abdul Waheed',
                'email' => 'bababooks29@gmail.com',
                'password' => Hash::make('admin@12'), // Hash the password
            ]
        );


    }
}
