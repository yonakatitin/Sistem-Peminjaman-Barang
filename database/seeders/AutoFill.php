<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutoFill extends Seeder
{
    public function run()
    {
        $units = [ [
            'nama' => 'Peminjaman 1',
            'lokasi' => 'FMIPA'
        ],
        [
            'nama' => 'Peminjaman 2',
            'lokasi' => 'FK'
        ],
        [
            'nama' => 'Peminjaman 3',
            'lokasi' => 'FEB'
        ],
        [
            'nama' => 'Peminjaman 4',
            'lokasi' => 'FT'
        ]
        ];

        foreach ($units as $unit) {
            DB::table('unit')->insert($unit);
        }

        $kategori = [[
            'nama' => 'Monitor'
        ],
        [
            'nama' => 'Keyboard'
        ],
        [
            'nama' => 'Meja'
        ],
        [
            'nama' => 'Kursi'
        ],
        [
            'nama' => 'LCD'
        ],
        [
            'nama' => 'Router'
        ],
        [
            'nama' => 'Switch'
        ]
        ];

        foreach ($kategori as $k) {
            DB::table('kategori')->insert($k);
        }

        $barang = [
            [
                'nama_barang' => 'Router 1',
                'id_unit' => 1,
                'id_kategori' => 6,
                'merk'=> 'Cisco',
                'serial_number' => 'sehuiwey72y3',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Monitor 1',
                'id_unit' => 1,
                'id_kategori' => 1,
                'merk'=> 'Dell',
                'serial_number' => 'kwedkwedw819',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Switch 1',
                'id_unit' => 1,
                'id_kategori' => 7,
                'merk'=> 'Cisco',
                'serial_number' => 'aosjadkjwndhwh89',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Monitor A',
                'id_unit' => 2,
                'id_kategori' => 1,
                'merk'=> 'Lenovo',
                'serial_number' => 'aksandw82893h2',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Keyboard 1',
                'id_unit' => 2,
                'id_kategori' => 2,
                'merk'=> 'Rexus',
                'serial_number' => 'dnkcjnweue28382d',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'LCD A',
                'id_unit' => 2,
                'id_kategori' => 5,
                'merk'=> 'Canon',
                'serial_number' => '012i2ihndj32',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'LCD 1',
                'id_unit' => 3,
                'id_kategori' => 5,
                'merk'=> 'Dell',
                'serial_number' => '102i0e2ekjd',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Monitor 1',
                'id_unit' => 3,
                'id_kategori' => 1,
                'merk'=> 'Cisco',
                'serial_number' => '192ioej2jdb',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Router A',
                'id_unit' => 3,
                'id_kategori' => 6,
                'merk'=> 'Cisco',
                'serial_number' => 'sdbdewjh902u3',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Switch 1',
                'id_unit' => 4,
                'id_kategori' => 7,
                'merk'=> 'Cisco',
                'serial_number' => '10ow2e2jne',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Keyboard 1',
                'id_unit' => 4,
                'id_kategori' => 7,
                'merk'=> 'Logitech',
                'serial_number' => '1ie32ej1b32',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'LCD A',
                'id_unit' => 4,
                'id_kategori' => 5,
                'merk'=> 'Samsung',
                'serial_number' => '12i9uw823hed2qh3',
                'status_barang' => '1',
                'deskripsi' => '-'
            ]
        ];

        foreach ($barang as $b) {
            DB::table('barang')->insert($b);
        }
    }
}
