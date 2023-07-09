<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Reqadminunit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminunitHome()
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;
        
        $data = DB::table('barang')->where('id_unit', $id_unit)->select('barang.status_barang')->get(); // Retrieve data from the 'data' table
        $jml_barang = count($data);
        $jml_barang = $jml_barang <= 0 ? '1' : $jml_barang;

        $available = 0;
        $in_use = 0;
        $broken = 0;

        foreach ($data as $item) {
            if ($item->status_barang === 'available') {
                $available++;
            }else if ($item->status_barang === 'in use') {
                $in_use++;
            }else if ($item->status_barang === 'broken') {
                $broken++;
            }
        }

        $available_p = ($available/$jml_barang)*100;

        $barang = [
            'jumlah' => $jml_barang,
            'available' => round($available_p, 2),
        ];

        $data = DB::table('peminjaman')->join('barang', 'peminjaman.id_barang', '=', 'barang.id')->where('barang.id_unit', $id_unit)->select('peminjaman.status_pinjam')->get(); // Retrieve data from the 'data' table

        $requested = 0;
        $approved = 0;
        $returned = 0;
        $borrowed = 0;
        $declined = 0;

        foreach ($data as $item) {
            if ($item->status_pinjam === 'requested') {
                $requested++;
            }else if ($item->status_pinjam === 'approved') {
                $approved++;
            }else if ($item->status_pinjam === 'borrowed') {
                $borrowed++;
            }else if ($item->status_pinjam === 'returned') {
                $returned++;
            }else if ($item->status_pinjam === 'declined') {
                $declined++;
            }
        }

        $jml_peminjaman = $approved + $borrowed + $returned;
        $jml_req = $requested + $declined;
        $jml_peminjaman = $jml_peminjaman <= 0 ? '1' : $jml_peminjaman;
        $jml_req = $jml_req <= 0 ? '1' : $jml_req;

        $berlangsung = (($borrowed + $approved)/$jml_peminjaman) * 100;
        $requested = ($requested/$jml_req) * 100;

        $peminjaman = [
            'jml_peminjaman' => $jml_peminjaman,
            'berlangsung' => $berlangsung,
            'jml_req' => $jml_req,
            'requested' => $requested,
        ];

        return view('adminunitHome', ['barang' => $barang, 'peminjaman' => $peminjaman]);
    }
  
    public function administratorHome()
    {

        $data = DB::table('users')->select('role')->get();
        $total = count(User::all());
        $total= $total <= 0 ? '1' : $total;

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

        $user_p = ($user/$total)*100;
        $adminunit_p = ($adminunit/$total)*100;
        $administrator_p = ($administrator/$total)*100;

        $jumlah = [
            'user' => $user,
            'adminunit' => $adminunit,
            'administrator' => $administrator,
            'total' => $total,
        ];

        $percentage = [
            'user' => round($user_p, 2),
            'adminunit' => round($adminunit_p, 2),
            'administrator' => round($administrator_p, 2),
        ];

        $data2 = DB::table('reqadminunit')->select('status')->get();
        $reqadminunit = count(Reqadminunit::all());
        $reqadminunit = $reqadminunit <= 0 ? '1' : $reqadminunit;

        $requested = 0;
        $approved = 0;
        $declined = 0;

        foreach ($data2 as $item) {
            if ($item->status === 'requested') {
                $requested++;
            }else if ($item->status === 'approved') {
                $approved++;
            }else if ($item->status === 'declined') {
                $declined++;
            }
        }

        $requested_p = ($requested/$reqadminunit)*100;

        $reqadminunit_all = [
            'total' => $reqadminunit,
            'requested' => $requested_p
        ];

        return view('administratorHome', ['users' => $jumlah,'users_p' => $percentage, 'reqadminunit' => $reqadminunit_all]);
    }
}
