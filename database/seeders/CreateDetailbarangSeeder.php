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
               'gambar'=>'',
            ],
            [
               'barang_id'=>2,
               'detail'=>'Router B',
               'gambar'=>'',
            ],
            [
               'barang_id'=>3,
               'detail'=>'Switch',
               'gambar'=>'',
            ],
            [
               'barang_id'=>4,
               'detail'=>'Proyektor',
               'gambar'=>'',
            ],
            [
               'barang_id'=>5,
               'detail'=>'Laptop A',
               'gambar'=>'',
            ],
            [
               'barang_id'=>6,
               'detail'=>'Laptop B',
               'gambar'=>'',
            ],
            [
               'barang_id'=>7,
               'detail'=>'Proyektor',
               'gambar'=>'',
            ],
        ];
    
        foreach ($detailbarang as $key => $detailbarang) {
            Detailbarang::create($detailbarang);
        }
    }
}
