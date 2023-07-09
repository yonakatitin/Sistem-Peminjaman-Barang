<?php

namespace App\Http\Controllers;

use App\Models\Adminunit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminunitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')->join('adminunit', 'users.id', '=', 'adminunit.id_user')->join('unit', 'unit.id', 'adminunit.id_unit')->select('users.*','unit.nama')->get();
        return view('admin.adminunit.index', ['users' => $users]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit = DB::table('unit')->leftJoin('adminunit', 'unit.id', '=', 'adminunit.id_unit')->whereNull('adminunit.id_unit')->select('unit.*')->get();;
        return view('admin.adminunit.create', ['unit' => $unit]);
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

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'role' => 2,
        ]);        

        $unit = DB::table('unit')->where('id', $data['id_unit'])->select('nama')->first();

        $id_user = DB::table('users')->where('email', $data['email'])->select('users.id')->first();

        DB::table('adminunit')->insert([
            'id_unit' => $data['id_unit'],
            'id_user' => $id_user->id,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nama_unit' => $unit->nama,
        ];

        Mail::send('admin.mail.confirmAdminUnit', $data, function($message) use($request){
            $message->to($request->email);
            $message->subject('Sistem Peminjaman Barang : Akun Admin Unit Anda Berhasil Dibuat!');
        });

        return redirect('admin/adminunit');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Adminunit $adminunit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $users = DB::table('users')->join('adminunit', 'users.id', '=', 'adminunit.id_user')->join('unit', 'unit.id', 'adminunit.id_unit')->where('users.id', $id)->select('users.*','unit.id as id_unit','unit.nama')->first();
        $unit = DB::table('unit')->get();
        return view('admin.adminunit.edit', ['user' => $users, 'unit' => $unit]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'no_hp' => 'required|max:255',
            'alamat' => 'required',
            'id_unit' => 'required'
        ]);

        DB::table('users')->where('id', $request->id)->update([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'no_hp' => $validateData['no_hp'],
            'alamat' => $validateData['alamat']
        ]);

        DB::table('adminunit')->where('id_user', $request->id)->update([
            'id_unit' => $validateData['id_unit']
        ]);

        return redirect('/admin/adminunit');
        //
    }

    public function hapus($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('/admin/adminunit');
    }

    public function show_profile(){
        $user = Auth::user();
        return view('adminunit.profile', ['user' => $user]);
        //
    }

    public function edit_profile(){
        $user = Auth::user();
        return view('adminunit.editprofile', ['user' => $user]);
        //
    }

    public function update_profile(Request $request){
        $user = Auth::user();
        
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'no_hp' => 'required|max:255',
            'alamat' => 'required'
        ]);

        DB::table('users')->where('id', $user->id)->update([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'no_hp' => $validateData['no_hp'],
            'alamat' => $validateData['alamat']
        ]);

        return redirect(route('adminunit.profile'));
    }

    public function change_password(){
        return view('adminunit.change-password');
    }

    public function update_password(Request $request){
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adminunit $adminunit)
    {
        //
    }
}
