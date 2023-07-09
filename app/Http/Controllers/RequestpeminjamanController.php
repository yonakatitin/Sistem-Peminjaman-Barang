<?php

namespace App\Http\Controllers;

use App\Models\Requestpeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RequestpeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private $id_unit;

     public function __construct()
     {
         if (auth()->check()) {
             echo '<script>console.log(authenticated!)</script>';
             $usr = auth()->user();
             $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
             $this->id_unit = $id_unit->id_unit;
         }
     }

    public function index()
    {
             $usr = auth()->user();
             $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
             $id_unit = $id_unit->id_unit;
             $where1 = [
                'barang.id_unit' => $id_unit,
                'peminjaman.status_pinjam' => 'requested'
            ];
            
            $where2 = [
                'barang.id_unit' => $id_unit,
                'peminjaman.status_pinjam' => 'declined'
            ];
            
            $list_req = DB::table('peminjaman')
                ->join('users', 'peminjaman.id_user', '=', 'users.id')
                ->join('barang', 'barang.id', '=', 'peminjaman.id_barang')
                ->leftJoin('detailbarang', 'detailbarang.id_barang', '=', 'barang.id')
                ->where(function ($query) use ($where1, $where2) {
                    $query->where($where1)
                        ->orWhere(function ($query) use ($where2) {
                            $query->where($where2);
                        });
                })
                ->select('peminjaman.*', 'users.name', 'users.email', 'users.no_hp', 'barang.nama_barang', 'barang.merk', 'barang.serial_number', 'detailbarang.gambar')
                ->get();
            
        return view('adminunit.reqpeminjaman.index', ['reqpeminjaman' => $list_req, 'id_unit' => $id_unit]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;
        $whereClause = ['status_barang'=> 1, 'id_unit' => $id_unit];
        $barang = DB::table('barang')->where($whereClause)->get();
        $users = DB::table('users')->where('role', 1)->get();
        return view('adminunit.reqpeminjaman.create', ['barang' => $barang, 'users' => $users, 'id_unit' => $id_unit]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;

        $reservasi = strtotime(date('Y-m-d', strtotime($req->tgl_reservasi)));
        $pinjam = strtotime(date('Y-m-d', strtotime($req->tgl_pinjam)));
        $kembali = strtotime(date('Y-m-d', strtotime($req->tgl_kembali)));
        if($pinjam <= $reservasi || $kembali <= $pinjam){
            echo "<script>alert('Tanggal yang Anda masukkan salah!')</script>";
            exit;
        }else{
            DB::table('requestpeminjaman')->insert([
                'id_user' => $req->id_user,
                'id_barang' => $req->id_barang,
                'tgl_pinjam' => $req->tgl_pinjam,
                'tgl_kembali' => $req->tgl_kembali,
                'tgl_reservasi' => $req->tgl_reservasi,
                'status_pinjam' => 'requested'
            ]);

            DB::table('barang')->where('id', $req->id_barang)->update([
                'status_barang' => 2
            ]);
        }

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Requestpeminjaman $requestpeminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requestpeminjaman $requestpeminjaman)
    {
        //
    }

    public function approve($id_reqpeminjaman)
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;

        DB::table('requestpeminjaman')->where('id',$id_reqpeminjaman)->update([
            'status_pinjam' => 'approved'
        ]);

        $req = DB::table('requestpeminjaman')->where('id',$id_reqpeminjaman)->first();

        DB::table('peminjaman')->insert([
            'id_user' => $req->id_user,
            'id_barang' => $req->id_barang,
            'tgl_pinjam' => $req->tgl_pinjam,
            'tgl_kembali' => $req->tgl_kembali,
            'tgl_reservasi' => $req->tgl_reservasi,
            'status_pinjam' => 'borrowed'
        ]);

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    public function decline($id_reqpeminjaman)
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;

        DB::table('requestpeminjaman')->where('id',$id_reqpeminjaman)->update([
            'status_pinjam' => 'declined'
        ]);

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requestpeminjaman $requestpeminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requestpeminjaman $requestpeminjaman)
    {
        //
    }
}
