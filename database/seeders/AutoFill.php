<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutoFill extends Seeder
{
    public function run()
    {
        $units = [
            [
               'nama'=>'FATISDA',
               'lokasi'=>'Fakultas Teknologi Informasi dan Sains Data',
            ],
            [
               'nama'=>'FIB',
               'lokasi'=>'Fakultas Ilmu Budaya',
            ],
            [
               'nama'=>'FH',
               'lokasi'=>'Fakultas Hukum',
            ],
            [
               'nama'=>'FEB',
               'lokasi'=>'Fakultas Ekonomi dan Bisnis',
            ],
            [
               'nama'=>'FISIP',
               'lokasi'=>'Fakultas Ilmu Sosial dan Politik',
            ],
            [
               'nama'=>'FK',
               'lokasi'=>'Fakultas Kedokteran',
            ],
            [
               'nama'=>'FP',
               'lokasi'=>'Fakultas Pertanian',
            ],
            [
               'nama'=>'FT',
               'lokasi'=>'Fakultas Teknik',
            ],
            [
               'nama'=>'FKIP',
               'lokasi'=>'Fakultas Keguruan dan Ilmu Pendidikan',
            ],
            [
               'nama'=>'FMIPA',
               'lokasi'=>'Fakultas Matematika dan Ilmu Pengetahuan Alam',
            ],
            [
               'nama'=>'FSRD',
               'lokasi'=>'Fakultas Seni Rupa dan Desain',
            ],
            [
               'nama'=>'FKOR',
               'lokasi'=>'Fakultas Keolahragaan',
            ],
            [
               'nama'=>'FAPSI',
               'lokasi'=>'Fakultas Psikologi',
            ],
            [
               'nama'=>'SV',
               'lokasi'=>'Sekolah Vokasi',
            ],
            [
               'nama'=>'Pascasarjana',
               'lokasi'=>'',
            ],
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
                'unit_id' => 1,
                'kategori_id' => 6,
                'merk'=> 'Cisco',
                'serial_number' => 'sehuiwey72y3',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Monitor 1',
                'unit_id' => 1,
                'kategori_id' => 1,
                'merk'=> 'Dell',
                'serial_number' => 'kwedkwedw819',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Switch 1',
                'unit_id' => 1,
                'kategori_id' => 7,
                'merk'=> 'Cisco',
                'serial_number' => 'aosjadkjwndhwh89',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Monitor A',
                'unit_id' => 2,
                'kategori_id' => 1,
                'merk'=> 'Lenovo',
                'serial_number' => 'aksandw82893h2',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Keyboard 1',
                'unit_id' => 2,
                'kategori_id' => 2,
                'merk'=> 'Rexus',
                'serial_number' => 'dnkcjnweue28382d',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'LCD A',
                'unit_id' => 2,
                'kategori_id' => 5,
                'merk'=> 'Canon',
                'serial_number' => '012i2ihndj32',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'LCD 1',
                'unit_id' => 3,
                'kategori_id' => 5,
                'merk'=> 'Dell',
                'serial_number' => '102i0e2ekjd',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Monitor 1',
                'unit_id' => 3,
                'kategori_id' => 1,
                'merk'=> 'Cisco',
                'serial_number' => '192ioej2jdb',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Router A',
                'unit_id' => 3,
                'kategori_id' => 6,
                'merk'=> 'Cisco',
                'serial_number' => 'sdbdewjh902u3',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Switch 1',
                'unit_id' => 4,
                'kategori_id' => 7,
                'merk'=> 'Cisco',
                'serial_number' => '10ow2e2jne',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'Keyboard 1',
                'unit_id' => 4,
                'kategori_id' => 7,
                'merk'=> 'Logitech',
                'serial_number' => '1ie32ej1b32',
                'status_barang' => '1',
                'deskripsi' => '-'
            ],
            [
                'nama_barang' => 'LCD A',
                'unit_id' => 4,
                'kategori_id' => 5,
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
