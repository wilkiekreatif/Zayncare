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
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Wildan Auliana',
            'username'  => 'wildan',
            'email'     => 'wildanauliana7@gmail.com',
            'password'  => Hash::make('Wildanauliana11'),
            'role'      => 'admin',
        ]);
    }
}
