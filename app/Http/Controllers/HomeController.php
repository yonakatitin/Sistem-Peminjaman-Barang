<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;


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
        return view('adminunitHome');
    }
  
    public function administratorHome()
    {
        return view('administratorHome');
    }

    public function searchBarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'nullable|string',
            'tgl_pinjam' => 'nullable|date',
            'tgl_kembali' => 'nullable|date|after_or_equal:tgl_pinjam',
        ]);

        $namaBarang = $request->nama_barang;
        $tanggalPinjam = $request->tgl_pinjam;
        $tanggalKembali = $request->tgl_kembali;

        $query = Barang::query();

        if ($namaBarang) {
            $query->where('nama_barang', 'like', '%' . $namaBarang . '%');
        }

        if ($tanggalPinjam && $tanggalKembali) {
            $query->whereDoesntHave('peminjamans', function ($query) use ($tanggalPinjam, $tanggalKembali) {
                $query->where(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                    $query->where(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                        $query->where('tgl_pinjam', '>=', $tanggalPinjam)
                            ->where('tgl_pinjam', '<=', $tanggalKembali);
                    })
                    ->orWhere(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                        $query->where('tgl_kembali', '>=', $tanggalPinjam)
                            ->where('tgl_kembali', '<=', $tanggalKembali);
                    })
                    ->orWhere(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                        $query->where('tgl_pinjam', '<=', $tanggalPinjam)
                            ->where('tgl_kembali', '>=', $tanggalKembali);
                    });
                })
                ->orWhere(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                    $query->where(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                        $query->where('tgl_pinjam', '>=', $tanggalPinjam)
                            ->where('tgl_pinjam', '<=', $tanggalKembali);
                    })
                    ->orWhere(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                        $query->where('tgl_kembali', '>=', $tanggalPinjam)
                            ->where('tgl_kembali', '<=', $tanggalKembali);
                    })
                    ->orWhere(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                        $query->where('tgl_pinjam', '<=', $tanggalPinjam)
                            ->where('tgl_kembali', '>=', $tanggalKembali);
                    });
                });
            });
        }

        $barangs = $query->with('unit')->get();

        return view('home', compact('barangs', 'namaBarang', 'tanggalPinjam', 'tanggalKembali'));
    }

    public function showBarangDetail($barangId)
    {
        $barang = Barang::with('detailbarang')->findOrFail($barangId);

        return view('barang.detail', compact('barang'));
    }

}
