<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;
    protected $table = 'administrator';

    protected $fillable = [
        'id_user',
        'id_admin_unit',
    ];

    public function adminunit(){
        return $this->belongsTo('App\Models\Adminunit');
    }

    public function users(){
        return $this->belongsTo('App\Models\User');
    }
}
