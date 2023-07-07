<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminunit extends Model
{
    use HasFactory;
    protected $table = 'adminunit';

    protected $fillable = [
        'id_user',
        'id_unit',
    ];

    public function unit(){
        return $this->belongsTo('App\Models\Unit');
    }

    public function users(){
        return $this->belongsTo('App\Models\User');
    }
}
