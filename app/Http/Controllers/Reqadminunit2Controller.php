<?php

namespace App\Http\Controllers;

use App\Models\Reqadminunit;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Reqadminunit2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('reqadminunit')->join('unit', 'reqadminunit.id_unit', '=', 'unit.id')->select('reqadminunit.*', 'unit.nama')->get();
        return view('admin.reqadminunit.index', ['users' => $users]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit = DB::table('unit')->leftJoin('adminunit', 'unit.id', '=', 'adminunit.id_unit')->whereNull('adminunit.id_unit')->select('unit.*')->get();;
        return view('admin.reqadminunit.create', ['unit' => $unit]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_hp' => ['required', 'string', 'min:10', 'max:13', 'unique:users'],
            'alamat' => ['required', 'string', 'min:10', 'max:255'],
            'id_unit' => ['required']
        ]);

        DB::table('reqadminunit')->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'id_unit' => $data['id_unit'],
            'status' => 1,
        ]);    

        return redirect('admin/reqadminunit');
        //
    }

    public function getData()
    {
        
        $data = DB::table('reqadminunit')->select('reqadminunit.status')->get(); // Retrieve data from the 'data' table

        $requested = 0;
        $approved = 0;
        $declined = 0;

        foreach ($data as $item) {
            if ($item->status === 'requested') {
                $requested++;
            }else if ($item->status === 'approved') {
                $approved++;
            }else if ($item->status === 'declined') {
                $declined++;
            }
        }

        $status = [
            'requested' => $requested,
            'approved' => $approved,
            'declined' => $declined,
        ];

        return response()->json($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reqadminunit $reqadminunit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reqadminunit $reqadminunit)
    {
        //
    }

    public function approve($id){

        DB::table('reqadminunit')->where('id', $id)->update([
            'status' => 2,
        ]);

        $admin = DB::table('reqadminunit')->where('id', $id)->first();

        User::create([
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => $admin->password,
            'alamat' => $admin->alamat,
            'no_hp' => $admin->no_hp,
            'role' => 2,
        ]);        

        $id_user = DB::table('users')->where('email', $admin->email)->select('users.id')->first();

        DB::table('adminunit')->insert([
            'id_unit' => $admin->id_unit,
            'id_user' => $id_user->id,
        ]);

        return redirect('admin/reqadminunit/sendemail/'. $id);
    }

    public function decline($id){

        DB::table('reqadminunit')->where('id', $id)->update([
            'status' => 3,
        ]);

        return redirect('admin/reqadminunit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reqadminunit $reqadminunit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reqadminunit $reqadminunit)
    {
        //
    }
}
