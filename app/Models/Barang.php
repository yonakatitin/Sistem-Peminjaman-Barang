<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';

    protected $fillable = [
        'id_unit',
        'id_kategori',
        'nama_barang',
        'merk',
        'serial_number',
        'deskripsi',
        'status_barang',
    ];

    public function unit(){
        return $this->belongsTo('App\Models\Unit');
    }

    public function kategori(){
        return $this->belongsTo('App\Models\Kategori');
    }

    public function detailbarang(){
        return $this->hasOne('App\Models\Detailbarang');
    }

    public function peminjaman(){
        return $this->hasOne('App\Models\Peminjaman');
    }
}
