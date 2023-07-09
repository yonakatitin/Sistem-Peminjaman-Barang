<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailbarang extends Model
{
    use HasFactory;
    protected $table = 'detailbarang';

    protected $fillable = [
        'barang_id',
        'detail',
        'gambar',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
