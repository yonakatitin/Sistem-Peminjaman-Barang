<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
               'role'=>2,
               'password'=> bcrypt('123456'),
               'alamat'=>'Surakarta',
               'no_hp'=>'0895363727036',
            ],
            [
                'name'=>'Admin Unit 2',
                'email'=>'adminunit2@gmail.com',
                'role'=>2,
                'password'=> bcrypt('123456'),
                'alamat'=>'Jakarta',
                'no_hp'=>'0895363727036',
            ],
            [
               'name'=>'Administrator',
               'email'=>'administrator@gmail.com',
               'role'=> 3,
               'password'=> bcrypt('123456'),
               'alamat'=>'Surakarta',
               'no_hp'=>'0895363727037',
            ],
            [
               'name'=>'User',
               'email'=>'user@gmail.com',
               'role'=>1,
               'password'=> bcrypt('123456'),
               'alamat'=>'Surakarta',
               'no_hp'=>'0895363727038',
            ],
            [
                'name'=>'User2',
                'email'=>'user2@gmail.com',
                'role'=>1,
                'password'=> bcrypt('123456'),
                'alamat'=>'Busan',
                'no_hp'=>'0895363727038',
             ],
             [
                'name'=>'User3',
                'email'=>'user3@gmail.com',
                'role'=>1,
                'password'=> bcrypt('123456'),
                'alamat'=>'Napoli',
                'no_hp'=>'0895363727038',
             ]
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }

        $adminunit = [
            [
                'id_user' => 1,
                'id_unit' => 1
            ],
            [
                'id_user' => 2,
                'id_unit' => 2
            ]
        ];

        foreach ($adminunit as $adm) {
            DB::table('adminunit')->insert($adm);
        }

        $administrator = [
                'id_user' => 3
        ];

        DB::table('administrator')->insert($administrator);
    }
}
