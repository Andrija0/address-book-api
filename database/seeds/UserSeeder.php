<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    const PASSWORD = '1234';
    const USERS = [
        [
            'name' => 'Andrija',
            'email' => 'andrijagligorijevic@gmail.com',
            'role' => 'contact',
        ],
        [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::USERS as $userData) {
            $user = User::make(['name' => $userData['name'],  'email' => $userData['email'], 'role' => $userData['role']]);
            $user->password = Hash::make(self::PASSWORD);
            $user->api_token = \Illuminate\Support\Str::random(60);
            $user->save();
        }
    }
}
