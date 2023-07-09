<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')->where('role', 1)->get();
        return view('admin.user.index', ['users' => $users]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
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
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'role' => 1,
        ]);   

        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        Mail::send('admin.mail.confirmUser', $data, function($message) use($request){
            $message->to($request->email);
            $message->subject('Sistem Peminjaman Barang : Akun Baru Anda Berhasil Dibuat!');
        });

        return redirect(route('admin.user'));
        //
    }

    public function getData()
    {
        
        $data = DB::table('users')->select('role')->get();

        $user = 0;
        $adminunit = 0;
        $administrator = 0;

        foreach ($data as $item) {
            if ($item->role === 'user') {
                $user++;
            }else if ($item->role === 'adminunit') {
                $adminunit++;
            }else if ($item->role === 'administrator') {
                $administrator++;
            }
        }

        $status = [
            'user' => $user,
            'adminunit' => $adminunit,
            'administrator' => $administrator,
        ];

        return response()->json($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.user.edit', ['user' => $user]);
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
            'alamat' => 'required'
        ]);

        DB::table('users')->where('id', $request->id)->update([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'no_hp' => $validateData['no_hp'],
            'alamat' => $validateData['alamat']
        ]);

        return redirect('/admin/user');
        //
    }

    public function hapus($id)
    {
    DB::table('users')->where('id',$id)->delete();
    return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
