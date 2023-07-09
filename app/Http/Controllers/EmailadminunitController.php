<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegisAdminUnitMailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailadminunitController extends Controller
{
    
    public function index($id){

        $user = DB::table('reqadminunit')->join('unit', 'reqadminunit.id_unit', 'unit.id')->where('reqadminunit.id', $id)->select('reqadminunit.email', 'reqadminunit.name', 'unit.nama as unit_name')->first();

        Mail::to($user->email)->send(new RegisAdminUnitMailable($user->name, $user->unit_name));

        return redirect('admin/reqadminunit');
    }
    
    //
}
