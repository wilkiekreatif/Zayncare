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
            'name'          => 'Wildan Auliana',
            'username'      => 'wildan',
            'email'         => 'wildanauliana7@gmail.com',
            'password'      => Hash::make('Wildanauliana11'),
            'role'          => 'admin',
            'sysadmin'      => 'on',
            'gudangfarmasi' => 'on',
            'register'      => 'on',
            'poliklinik'    => 'on',
            'apotek'        => 'on',
            'kasir'         => 'on',
            'is_active'     => '1',
        ]);
        User::create([
            'name'          => 'User',
            'username'      => 'user',
            'email'         => '',
            'password'      => Hash::make('user'),
            'role'          => 'user',
            'sysadmin'      => 'off',
            'gudangfarmasi' => 'on',
            'register'      => 'on',
            'poliklinik'    => 'on',
            'apotek'        => 'off',
            'kasir'         => 'off',
            'is_active'     => '1',
        ]);
    }
}
