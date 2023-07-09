<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PeminjamanController extends Controller
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
        $where1 = ['barang.id_unit' => $id_unit, 'status_pinjam' => 'approved'];
        $where2 = ['barang.id_unit' => $id_unit, 'status_pinjam' => 'borrowed'];
        $where3 = ['barang.id_unit' => $id_unit, 'status_pinjam' => 'returned'];
        // $id_unit = DB::table('adminunit')->where('id_user', $id)->select('adminunit.id_unit');
        $peminjaman = DB::table('peminjaman')
        ->join('users', 'peminjaman.id_user', '=', 'users.id')
        ->join('barang', 'barang.id', '=', 'peminjaman.id_barang')
        ->leftJoin('detailbarang', 'detailbarang.id_barang', '=', 'barang.id')
        ->where(function ($query) use ($where1, $where2, $where3) {
            $query->where($where1)
                ->orWhere(function ($query) use ($where2, $where3) {
                    $query->where($where2)
                        ->orWhere(function ($query) use ($where3){
                            $query->where($where3);
                        });
                });
        })
        ->select('peminjaman.*', 'users.name', 'users.email', 'users.no_hp', 'barang.nama_barang', 'barang.merk', 'barang.serial_number', 'detailbarang.gambar')
        ->get();
        return view('adminunit.peminjaman.index', ['peminjaman' => $peminjaman, 'id_unit' => $id_unit]);
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

        $validateData = $req->validate([
            'id_user' => 'required|numeric',
            'id_barang' => 'required|numeric',
            'tgl_reservasi' => 'required|date',
            'tgl_pinjam' => 'required|date|after:tgl_reservasi',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
        ]);
        
        // $reservasi = strtotime(date('Y-m-d', strtotime($req->tgl_reservasi)));
        // $pinjam = strtotime(date('Y-m-d', strtotime($req->tgl_pinjam)));
        // $kembali = strtotime(date('Y-m-d', strtotime($req->tgl_kembali)));

            DB::table('peminjaman')->insert([
                'id_user' => $validateData['id_user'],
                'id_barang' => $validateData['id_barang'],
                'tgl_pinjam' => $validateData['tgl_pinjam'],
                'tgl_kembali' => $validateData['tgl_kembali'],
                'tgl_reservasi' => $validateData['tgl_reservasi'],
                'status_pinjam' => 'requested'
            ]);

            DB::table('barang')->where('id', $req->id_barang)->update([
                'status_barang' => 2
            ]);

        $whereClause = ['id_user' => $req->id_user,
        'id_barang' => $req->id_barang,
        'tgl_pinjam' => $req->tgl_pinjam,
        'tgl_kembali' => $req->tgl_kembali,
        'tgl_reservasi' => $req->tgl_reservasi,
        'status_pinjam' => 'requested'];

        $peminjaman = DB::table('peminjaman')->join('users', 'peminjaman.id_user', '=', 'users.id')->join('barang', 'peminjaman.id_barang', '=', 'barang.id')->where($whereClause)->select('peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'users.name', 'users.email', 'barang.nama_barang', 'barang.merk', 'barang.serial_number')->first();

        $unit = DB::table('unit')->where('id', $id_unit)->select('nama')->first();

        $data = [
            'name' => $peminjaman->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $peminjaman->nama_barang,
            'merk' => $peminjaman->merk,
            'serial_number' => $peminjaman->serial_number,
        ];

        Mail::send('admin.mail.addPeminjaman', $data, function($message) use($peminjaman){
            $message->to($peminjaman->email);
            $message->subject('Sistem Peminjaman Barang : Permintaan Peminjaman Anda Berhasil Dibuat!');
        });

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    public function approve($id_reqpeminjaman)
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;

        DB::table('peminjaman')->where('id',$id_reqpeminjaman)->update([
            'status_pinjam' => 'approved'
        ]);

        $peminjaman = DB::table('peminjaman')->join('users', 'peminjaman.id_user', '=', 'users.id')->join('barang', 'peminjaman.id_barang', '=', 'barang.id')->where('peminjaman.id',$id_reqpeminjaman)->select('peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'users.name', 'users.email', 'barang.nama_barang', 'barang.merk', 'barang.serial_number')->first();

        $unit = DB::table('unit')->where('id', $id_unit)->select('nama')->first();

        $data = [
            'name' => $peminjaman->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $peminjaman->nama_barang,
            'merk' => $peminjaman->merk,
            'serial_number' => $peminjaman->serial_number,
        ];

        Mail::send('admin.mail.approvePeminjaman', $data, function($message) use($peminjaman){
            $message->to($peminjaman->email);
            $message->subject('Sistem Peminjaman Barang : Permintaan Peminjaman Anda Telah Disetujui!');
        });

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    public function decline($id_reqpeminjaman)
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;

        DB::table('peminjaman')->where('id',$id_reqpeminjaman)->update([
            'status_pinjam' => 'declined'
        ]);

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    public function borrowed($id_peminjaman)
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;
        
        DB::table('peminjaman')->where('id',$id_peminjaman)->update([
            'status_pinjam' => 'borrowed'
        ]);

        $peminjaman = DB::table('peminjaman')->join('users', 'peminjaman.id_user', '=', 'users.id')->join('barang', 'peminjaman.id_barang', '=', 'barang.id')->where('peminjaman.id',$id_peminjaman)->select('peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'users.name', 'users.email', 'barang.nama_barang', 'barang.merk', 'barang.serial_number')->first();

        $unit = DB::table('unit')->where('id', $id_unit)->select('nama')->first();

        $data = [
            'name' => $peminjaman->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $peminjaman->nama_barang,
            'merk' => $peminjaman->merk,
            'serial_number' => $peminjaman->serial_number,
        ];

        Mail::send('admin.mail.borrowedPeminjaman', $data, function($message) use($peminjaman){
            $message->to($peminjaman->email);
            $message->subject('Sistem Peminjaman Barang : Barang yang Anda Pinjam Telah Diberikan Kepada Anda!');
        });

        return redirect('/adminunit/peminjaman');
        //
    }
    
    public function returned($id_peminjaman)
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;
        
        DB::table('peminjaman')->where('id',$id_peminjaman)->update([
            'status_pinjam' => 'returned'
        ]);

        $req = DB::table('peminjaman')->where('id',$id_peminjaman)->first();

        DB::table('barang')->where('id', $req->id_barang)->update([
            'status_barang' => 1
        ]);

        $peminjaman = DB::table('peminjaman')->join('users', 'peminjaman.id_user', '=', 'users.id')->join('barang', 'peminjaman.id_barang', '=', 'barang.id')->where('peminjaman.id',$id_peminjaman)->select('peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'users.name', 'users.email', 'barang.nama_barang', 'barang.merk', 'barang.serial_number')->first();

        $unit = DB::table('unit')->where('id', $id_unit)->select('nama')->first();

        $data = [
            'name' => $peminjaman->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $peminjaman->nama_barang,
            'merk' => $peminjaman->merk,
            'serial_number' => $peminjaman->serial_number,
        ];

        Mail::send('admin.mail.returnedPeminjaman', $data, function($message) use($peminjaman){
            $message->to($peminjaman->email);
            $message->subject('Sistem Peminjaman Barang : Barang yang Anda Pinjam Telah Dikembalikan Kepada Admin Unit!');
        });

        return redirect('/adminunit/peminjaman');
        //
    }

    public function getData()
    {
        $usr = auth()->user();
        $id_unit = DB::table('adminunit')->where('adminunit.id_user', $usr->id)->select('adminunit.id_unit')->first();
        $id_unit = $id_unit->id_unit;

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

        $status = [
            'requested' => $requested,
            'approved' => $approved,
            'borrowed' => $borrowed,
            'returned' => $returned,
            'declined' => $declined,
        ];

        return response()->json($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
