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

     private $unit_id;

     public function __construct()
     {
         if (auth()->check()) {
             echo '<script>console.log(authenticated!)</script>';
             $usr = auth()->user();
             $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
             $this->unit_id = $unit_id->unit_id;
         }
     }

    public function index()
    {
             $usr = auth()->user();
             $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
             $unit_id = $unit_id->unit_id;
             $where1 = [
                'barang.unit_id' => $unit_id,
                'peminjaman.status_pinjam' => 'requested'
            ];
            
            $where2 = [
                'barang.unit_id' => $unit_id,
                'peminjaman.status_pinjam' => 'declined'
            ];
            
            $list_req = DB::table('peminjaman')
                ->join('users', 'peminjaman.user_id', '=', 'users.id')
                ->join('barang', 'barang.id', '=', 'peminjaman.barang_id')
                ->leftJoin('detailbarang', 'detailbarang.barang_id', '=', 'barang.id')
                ->where(function ($query) use ($where1, $where2) {
                    $query->where($where1)
                        ->orWhere(function ($query) use ($where2) {
                            $query->where($where2);
                        });
                })
                ->select('peminjaman.*', 'users.name', 'users.email', 'users.no_hp', 'barang.nama_barang', 'barang.merk', 'barang.serial_number', 'detailbarang.gambar')
                ->get();
            
        return view('adminunit.reqpeminjaman.index', ['reqpeminjaman' => $list_req, 'unit_id' => $unit_id]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;
        $whereClause = ['status_barang'=> 1, 'unit_id' => $unit_id];
        $barang = DB::table('barang')->where($whereClause)->get();
        $users = DB::table('users')->where('role', 1)->get();
        return view('adminunit.reqpeminjaman.create', ['barang' => $barang, 'users' => $users, 'unit_id' => $unit_id]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        $reservasi = strtotime(date('Y-m-d', strtotime($req->tgl_reservasi)));
        $pinjam = strtotime(date('Y-m-d', strtotime($req->tgl_pinjam)));
        $kembali = strtotime(date('Y-m-d', strtotime($req->tgl_kembali)));
        if($pinjam <= $reservasi || $kembali <= $pinjam){
            echo "<script>alert('Tanggal yang Anda masukkan salah!')</script>";
            exit;
        }else{
            DB::table('requestpeminjaman')->insert([
                'user_id' => $req->user_id,
                'barang_id' => $req->barang_id,
                'tgl_pinjam' => $req->tgl_pinjam,
                'tgl_kembali' => $req->tgl_kembali,
                'tgl_reservasi' => $req->tgl_reservasi,
                'status_pinjam' => 'requested'
            ]);

            DB::table('barang')->where('id', $req->barang_id)->update([
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
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        DB::table('requestpeminjaman')->where('id',$id_reqpeminjaman)->update([
            'status_pinjam' => 'approved'
        ]);

        $req = DB::table('requestpeminjaman')->where('id',$id_reqpeminjaman)->first();

        DB::table('peminjaman')->insert([
            'user_id' => $req->user_id,
            'barang_id' => $req->barang_id,
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
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

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
