<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class CreateKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
               'nama'=>'Router',
            ],
            [
               'nama'=>'Switch',
            ],
            [
               'nama'=>'Proyektor',
            ],
            [
               'nama'=>'Laptop',
            ],
            
        ];
    
        foreach ($kategori as $key => $kategori) {
            Kategori::create($kategori);
        }
    }
}
