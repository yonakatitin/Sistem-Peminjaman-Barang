<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class CreateUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit = [
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
    
        foreach ($unit as $key => $unit) {
            Unit::create($unit);
        }
    }
}
