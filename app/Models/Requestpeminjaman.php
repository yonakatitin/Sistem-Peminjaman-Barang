<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestpeminjaman extends Model
{
    use HasFactory;
    protected $table = 'requestpeminjaman';

    protected $fillable = [
        'id_user',
        'barang_id',
        'tgl_pinjam',
        'tgl_kembali',
        'tgl_reservasi',
        'status_pinjam',
    ];

    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    public function barang(){
        return $this->belongsTo('App\Models\Barang');
    }
}
