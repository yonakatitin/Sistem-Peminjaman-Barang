<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class CreateBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = [
            [
               'unit_id'=>1,
               'kategori_id'=>1,
               'nama_barang'=>'Router A',
               'merk'=>'Cisco',
               'serial_number'=>'123456',
               'deskripsi'=>'router cisco',
               'status_barang'=>'available',
            ],
            [
               'unit_id'=>1,
               'kategori_id'=>1,
               'nama_barang'=>'Router B',
               'merk'=>'Cisco',
               'serial_number'=>'123457',
               'deskripsi'=>'router cisco',
               'status_barang'=>'available',
            ],
            [
               'unit_id'=>1,
               'kategori_id'=>2,
               'nama_barang'=>'Switch',
               'merk'=>'Cisco',
               'serial_number'=>'123458',
               'deskripsi'=>'switch cisco',
               'status_barang'=>'available',
            ],
            [
               'unit_id'=>2,
               'kategori_id'=>3,
               'nama_barang'=>'Proyektor',
               'merk'=>'Epson',
               'serial_number'=>'123459',
               'deskripsi'=>'proyektor epson',
               'status_barang'=>'available',
            ],
            [
               'unit_id'=>2,
               'kategori_id'=>4,
               'nama_barang'=>'Laptop A',
               'merk'=>'Acer',
               'serial_number'=>'123451',
               'deskripsi'=>'laptop acer',
               'status_barang'=>'available',
            ],
            [
               'unit_id'=>2,
               'kategori_id'=>4,
               'nama_barang'=>'Laptop B',
               'merk'=>'Asus',
               'serial_number'=>'123453',
               'deskripsi'=>'laptop asus',
               'status_barang'=>'available',
            ],
            [
               'unit_id'=>3,
               'kategori_id'=>3,
               'nama_barang'=>'Proyektor',
               'merk'=>'Epson',
               'serial_number'=>'123452',
               'deskripsi'=>'proyektor epson',
               'status_barang'=>'available',
            ],
        ];
    
        foreach ($barang as $key => $barang) {
            Barang::create($barang);
        }
    }
}
