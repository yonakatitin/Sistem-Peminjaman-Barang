<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use PDF;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mendapatkan ID pengguna yang terautentikasi
        $userId = Auth::id();

        // Ambil status dari input form
        $status = $request->input('status');

        // Mengambil data peminjaman sesuai dengan user_id yang sedang login
        $query = Peminjaman::select('peminjaman.*', 'barang.nama_barang AS nama_barang', 'unit.nama AS nama_unit')
            ->join('barang', 'peminjaman.barang_id', '=', 'barang.id')
            ->join('unit', 'barang.unit_id', '=', 'unit.id')
            ->where('peminjaman.user_id', $userId);

        if ($status) {
            $query->where('status_pinjam', $status);
        }

        // Ambil data peminjaman sesuai query
        $peminjamans = $query->get();

        // Tampilkan halaman daftar peminjaman dengan data yang telah diambil
        return view('pinjam.index', compact('peminjamans', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Barang $barang)
    {
        $barang->load('unit');
        
        return view('pinjam.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $peminjaman = new Peminjaman();
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
        $peminjaman = Peminjaman::findOrFail($id);
        return view('pinjam.show', compact('peminjaman'));
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

    public function cetak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        return view('pinjam.cetak', compact('peminjaman'));
    }

    
    public function print(Request $request)
    {
        $selectedPeminjaman = $request->input('selected_peminjaman');

        // Query untuk mengambil data peminjaman yang dipilih
        $peminjamans = Peminjaman::whereIn('peminjaman.id', explode(',', $selectedPeminjaman))
                    ->select('peminjaman.*', 'barang.nama_barang AS nama_barang', 'unit.nama AS nama_unit')
                    ->join('barang', 'peminjaman.barang_id', '=', 'barang.id')
                    ->join('unit', 'barang.unit_id', '=', 'unit.id')
                    ->get();

        // Mendapatkan nama pengguna yang sedang login
        $userName = Auth::user()->name;

        // Generate PDF
        $pdf = PDF::loadView('pinjam.bukti', compact('peminjamans', 'userName'));

        // Kode untuk mengatur nama file PDF yang dihasilkan
        $filename = 'bukti_peminjaman_' . date('YmdHis') . '.pdf';

        // Mengirimkan file PDF untuk di-download oleh pengguna
        return $pdf->download($filename);
    }
}
