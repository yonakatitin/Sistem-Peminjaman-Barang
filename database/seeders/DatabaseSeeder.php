<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use AutoFill;
use Illuminate\Database\Seeder;
use Database\Seeders\AutoFill;
use Illuminate\Support\Facades\DB;
use Seeder1;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(AutoFill::class);
        $this->call(CreateUsersSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
