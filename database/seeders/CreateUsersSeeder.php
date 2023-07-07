<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Admin Unit',
               'email'=>'adminunit@gmail.com',
               'role'=>'adminunit',
               'password'=> bcrypt('123456'),
               'alamat'=>'Surakarta',
               'no_hp'=>'0895363727036',
            ],
            [
               'name'=>'Administrator',
               'email'=>'administrator@gmail.com',
               'role'=>'administrator',
               'password'=> bcrypt('123456'),
               'alamat'=>'Surakarta',
               'no_hp'=>'0895363727037',
            ],
            [
               'name'=>'User',
               'email'=>'user@gmail.com',
               'role'=>'user',
               'password'=> bcrypt('123456'),
               'alamat'=>'Surakarta',
               'no_hp'=>'0895363727038',
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
