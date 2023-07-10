<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Detailbarang;

class CreateDetailbarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detailbarang = [
            [
               'barang_id'=>1,
               'detail'=>'Router Cisco A',
               'gambar'=>'rc.jpg',
            ],
            [
               'barang_id'=>2,
               'detail'=>'Router B',
               'gambar'=>'rc.jpg',
            ],
            [
               'barang_id'=>3,
               'detail'=>'Switch',
               'gambar'=>'sc.jpg',
            ],
            [
               'barang_id'=>4,
               'detail'=>'Proyektor',
               'gambar'=>'pe.png',
            ],
            [
               'barang_id'=>5,
               'detail'=>'Laptop A',
               'gambar'=>'acer.jpg',
            ],
            [
               'barang_id'=>6,
               'detail'=>'Laptop B',
               'gambar'=>'asus.jpg',
            ],
            [
               'barang_id'=>7,
               'detail'=>'Proyektor',
               'gambar'=>'pe.png',
            ],
        ];
    
        foreach ($detailbarang as $key => $detailbarang) {
            Detailbarang::create($detailbarang);
        }
    }
}
