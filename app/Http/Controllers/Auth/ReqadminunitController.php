<?php

namespace App\Http\Controllers\Auth;

use App\Models\Reqadminunit;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReqadminunitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $units = DB::table('unit')->leftJoin('adminunit', 'unit.id', '=', 'adminunit.id_unit')->whereNull('adminunit.id_unit')->select('unit.*')->get();
        return view('auth.register-adminunit', compact('units'));
        //
    }

    public function admin()
    {
        $users = Reqadminunit::all();
        return view('admin.reqadminunit.index', compact('users'));
        //
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'no_hp' => ['required', 'string', 'min:10', 'max:13', 'unique:users'],
    //         'alamat' => ['required', 'string', 'min:10', 'max:13'],
    //         'id_unit' => ['required']
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
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
            'status' => 1
        ]);

        $unit = DB::table('unit')->where('id', $data['id_unit'])->select('nama')->first();

        $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'nama_unit' => $unit->nama,
        ];

        Mail::send('admin.mail.registerAdminUnit', $data, function($message) use($request){
            $message->to($request->email);
            $message->subject('Sistem Peminjaman Barang : Registrasi Akun Admin Unit Anda Berhasil!');
        });

        $url = route('home');

        return redirect($url);

        //
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
