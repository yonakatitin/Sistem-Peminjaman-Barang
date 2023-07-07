<?php

namespace App\Http\Controllers;

use App\Models\Requestpeminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class RequestpeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan ID pengguna yang terautentikasi
        $userId = Auth::id();

        // Mengambil data peminjaman sesuai dengan user_id yang sedang login
        $peminjamans = Requestpeminjaman::select('requestpeminjaman.*', 'barang.nama_barang AS nama_barang', 'unit.nama AS nama_unit')
            ->join('barang', 'requestpeminjaman.barang_id', '=', 'barang.id')
            ->join('unit', 'barang.unit_id', '=', 'unit.id')
            ->where('requestpeminjaman.user_id', $userId)
            ->get();

        // Tampilkan halaman daftar peminjaman dengan data yang telah diambil
        return view('pinjam.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Barang $barang)
    {
        return view('pinjam.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validasi input jika diperlukan

    //     $barangId = $request->input('barang_id');

    //     $userId = Auth::id();

    //     // Lakukan proses penyimpanan peminjaman ke database
    //     $peminjaman = Requestpeminjaman::create([
    //         'user_id' => $userId,
    //         'barang_id' => $barangId,
    //         'tgl_pinjam' => Carbon::now(),
    //         'tgl_kembali' => Carbon::now(),
    //         'tgl_reservasi' => Carbon::now(),
    //         'status_pinjam'=> 'requested',
            
    //         // Informasi-informasi peminjaman lainnya
    //     ]);

    //     // Ambil ID peminjaman yang baru saja dibuat
    //     $peminjamanId = $peminjaman->id;

    //     // Redirect ke halaman detail peminjaman
    //     return redirect()->route('pinjam.show', $peminjamanId);
    // }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $peminjaman = new Requestpeminjaman();
        $peminjaman->user_id = $userId;
        $peminjaman->barang_id = $request->input('barang_id');
        $peminjaman->tgl_pinjam = $request->input('tgl_pinjam');
        $peminjaman->tgl_kembali = $request->input('tgl_kembali');
        $peminjaman->tgl_reservasi = Carbon::now();
        $peminjaman->status_pinjam = 'requested';
        // Simpan data peminjaman ke database
        $peminjaman->save();

        // Mengupdate status barang menjadi 'in use'
        $barang = Barang::find($request->input('barang_id'));
        $barang->status_barang = 'in use';
        $barang->save();

        return redirect()->route('pinjam.index')->with('success', 'Peminjaman berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $peminjaman = Requestpeminjaman::findOrFail($id);
        return view('pinjam.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requestpeminjaman $requestpeminjaman)
    {
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

    // public function tambah()
    // {
    //     return view('pinjam.tambah');
    // }

    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'tgl_pinjam' => 'required',
    //         'tgl_kembali' => 'required'
    //     ]);
 
    //     Requestpeminjaman::create([
    //         'tgl_pinjam' => $request->tgl_pinjam,
    //         'tgl_kembali' => $request->tgl_kembali
    //     ]);
 
    //     return redirect('units.show');
    // }
}
