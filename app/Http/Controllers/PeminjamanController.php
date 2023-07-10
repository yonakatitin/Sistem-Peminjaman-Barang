<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $unit_id;


    public function admin_index()
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;
        $where1 = ['barang.unit_id' => $unit_id, 'status_pinjam' => 'approved'];
        $where2 = ['barang.unit_id' => $unit_id, 'status_pinjam' => 'borrowed'];
        $where3 = ['barang.unit_id' => $unit_id, 'status_pinjam' => 'returned'];
        // $unit_id = DB::table('adminunit')->where('user_id', $id)->select('adminunit.unit_id');
        $peminjaman = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('barang', 'barang.id', '=', 'peminjaman.barang_id')
            ->leftJoin('detailbarang', 'detailbarang.barang_id', '=', 'barang.id')
            ->where(function ($query) use ($where1, $where2, $where3) {
                $query->where($where1)
                    ->orWhere(function ($query) use ($where2, $where3) {
                        $query->where($where2)
                            ->orWhere(function ($query) use ($where3) {
                                $query->where($where3);
                            });
                    });
            })
            ->select('peminjaman.*', 'users.name', 'users.email', 'users.no_hp', 'barang.nama_barang', 'barang.merk', 'barang.serial_number', 'detailbarang.gambar')
            ->get();
        return view('adminunit.peminjaman.index', ['peminjaman' => $peminjaman, 'unit_id' => $unit_id]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function admin_create()
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        $whereClause = ['status_barang' => 1, 'unit_id' => $unit_id];
        $barang = DB::table('barang')->where($whereClause)->get();
        $users = DB::table('users')->where('role', 1)->get();
        return view('adminunit.reqpeminjaman.create', ['barang' => $barang, 'users' => $users, 'unit_id' => $unit_id]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function admin_store(Request $req)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        $validateData = $req->validate([
            'user_id' => 'required|numeric',
            'barang_id' => 'required|numeric',
            'tgl_reservasi' => 'required|date',
            'tgl_pinjam' => 'required|date|after:tgl_reservasi',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
        ]);

        // $reservasi = strtotime(date('Y-m-d', strtotime($req->tgl_reservasi)));
        // $pinjam = strtotime(date('Y-m-d', strtotime($req->tgl_pinjam)));
        // $kembali = strtotime(date('Y-m-d', strtotime($req->tgl_kembali)));

        DB::table('peminjaman')->insert([
            'user_id' => $validateData['user_id'],
            'barang_id' => $validateData['barang_id'],
            'tgl_pinjam' => $validateData['tgl_pinjam'],
            'tgl_kembali' => $validateData['tgl_kembali'],
            'tgl_reservasi' => $validateData['tgl_reservasi'],
            'status_pinjam' => 'requested'
        ]);

        DB::table('barang')->where('id', $req->barang_id)->update([
            'status_barang' => 2
        ]);

        $whereClause = [
            'user_id' => $req->user_id,
            'barang_id' => $req->barang_id,
            'tgl_pinjam' => $req->tgl_pinjam,
            'tgl_kembali' => $req->tgl_kembali,
            'tgl_reservasi' => $req->tgl_reservasi,
            'status_pinjam' => 'requested'
        ];

        $peminjaman = DB::table('peminjaman')->join('users', 'peminjaman.user_id', '=', 'users.id')->join('barang', 'peminjaman.barang_id', '=', 'barang.id')->where($whereClause)->select('peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'users.name', 'users.email', 'barang.nama_barang', 'barang.merk', 'barang.serial_number')->first();

        $unit = DB::table('unit')->where('id', $unit_id)->select('nama')->first();

        $data = [
            'name' => $peminjaman->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $peminjaman->nama_barang,
            'merk' => $peminjaman->merk,
            'serial_number' => $peminjaman->serial_number,
        ];

        Mail::send('admin.mail.addPeminjaman', $data, function ($message) use ($peminjaman) {
            $message->to($peminjaman->email);
            $message->subject('Sistem Peminjaman Barang : Permintaan Peminjaman Anda Berhasil Dibuat!');
        });

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    public function approve($id_reqpeminjaman)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        DB::table('peminjaman')->where('id', $id_reqpeminjaman)->update([
            'status_pinjam' => 'approved'
        ]);

        $peminjaman = DB::table('peminjaman')->join('users', 'peminjaman.user_id', '=', 'users.id')->join('barang', 'peminjaman.barang_id', '=', 'barang.id')->where('peminjaman.id', $id_reqpeminjaman)->select('peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'users.name', 'users.email', 'barang.nama_barang', 'barang.merk', 'barang.serial_number')->first();

        $unit = DB::table('unit')->where('id', $unit_id)->select('nama')->first();

        $data = [
            'name' => $peminjaman->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $peminjaman->nama_barang,
            'merk' => $peminjaman->merk,
            'serial_number' => $peminjaman->serial_number,
        ];

        Mail::send('admin.mail.approvePeminjaman', $data, function ($message) use ($peminjaman) {
            $message->to($peminjaman->email);
            $message->subject('Sistem Peminjaman Barang : Permintaan Peminjaman Anda Telah Disetujui!');
        });

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    public function decline($id_reqpeminjaman)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        DB::table('peminjaman')->where('id', $id_reqpeminjaman)->update([
            'status_pinjam' => 'declined'
        ]);

        return redirect('/adminunit/reqpeminjaman');
        //
    }

    public function borrowed($id_peminjaman)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        DB::table('peminjaman')->where('id', $id_peminjaman)->update([
            'status_pinjam' => 'borrowed'
        ]);

        $peminjaman = DB::table('peminjaman')->join('users', 'peminjaman.user_id', '=', 'users.id')->join('barang', 'peminjaman.barang_id', '=', 'barang.id')->where('peminjaman.id', $id_peminjaman)->select('peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'users.name', 'users.email', 'barang.nama_barang', 'barang.merk', 'barang.serial_number')->first();

        $unit = DB::table('unit')->where('id', $unit_id)->select('nama')->first();

        $data = [
            'name' => $peminjaman->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $peminjaman->nama_barang,
            'merk' => $peminjaman->merk,
            'serial_number' => $peminjaman->serial_number,
        ];

        Mail::send('admin.mail.borrowedPeminjaman', $data, function ($message) use ($peminjaman) {
            $message->to($peminjaman->email);
            $message->subject('Sistem Peminjaman Barang : Barang yang Anda Pinjam Telah Diberikan Kepada Anda!');
        });

        return redirect('/adminunit/peminjaman');
        //
    }

    public function returned($id_peminjaman)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        DB::table('peminjaman')->where('id', $id_peminjaman)->update([
            'status_pinjam' => 'returned'
        ]);

        $req = DB::table('peminjaman')->where('id', $id_peminjaman)->first();

        DB::table('barang')->where('id', $req->barang_id)->update([
            'status_barang' => 1
        ]);

        $peminjaman = DB::table('peminjaman')->join('users', 'peminjaman.user_id', '=', 'users.id')->join('barang', 'peminjaman.barang_id', '=', 'barang.id')->where('peminjaman.id', $id_peminjaman)->select('peminjaman.tgl_pinjam', 'peminjaman.tgl_kembali', 'users.name', 'users.email', 'barang.nama_barang', 'barang.merk', 'barang.serial_number')->first();

        $unit = DB::table('unit')->where('id', $unit_id)->select('nama')->first();

        $data = [
            'name' => $peminjaman->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $peminjaman->nama_barang,
            'merk' => $peminjaman->merk,
            'serial_number' => $peminjaman->serial_number,
        ];

        Mail::send('admin.mail.returnedPeminjaman', $data, function ($message) use ($peminjaman) {
            $message->to($peminjaman->email);
            $message->subject('Sistem Peminjaman Barang : Barang yang Anda Pinjam Telah Dikembalikan Kepada Admin Unit!');
        });

        return redirect('/adminunit/peminjaman');
        //
    }

    public function getData()
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;

        $data = DB::table('peminjaman')->join('barang', 'peminjaman.barang_id', '=', 'barang.id')->where('barang.unit_id', $unit_id)->select('peminjaman.status_pinjam')->get(); // Retrieve data from the 'data' table

        $requested = 0;
        $approved = 0;
        $returned = 0;
        $borrowed = 0;
        $declined = 0;

        foreach ($data as $item) {
            if ($item->status_pinjam === 'requested') {
                $requested++;
            } else if ($item->status_pinjam === 'approved') {
                $approved++;
            } else if ($item->status_pinjam === 'borrowed') {
                $borrowed++;
            } else if ($item->status_pinjam === 'returned') {
                $returned++;
            } else if ($item->status_pinjam === 'declined') {
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
    public function index(Request $request)
    {
        // Mendapatkan ID pengguna yang terautentikasi
        $userId = Auth::id();

        // Ambil status dari input form
        $status = $request->input('status');

        // Mengambil data peminjaman sesuai dengan user_id yang sedang login
        $query = Peminjaman::select('peminjaman.*', 'barang.nama_barang AS nama_barang', 'barang.serial_number AS serial_number', 'unit.nama AS nama_unit')
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
        $request->validate([
            'barang_id' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $tanggalPinjam = Carbon::parse($request->tgl_pinjam);
        $tanggalKembali = Carbon::parse($request->tgl_kembali);

        // Validasi bahwa barang tidak sedang dipinjam oleh pengguna lain dalam rentang tanggal yang sama
        $barangId = $request->barang_id;
        $barangDipinjam = Peminjaman::where('barang_id', $barangId)
            ->where(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                $query->whereBetween('tgl_pinjam', [$tanggalPinjam, $tanggalKembali])
                    ->orWhereBetween('tgl_kembali', [$tanggalPinjam, $tanggalKembali])
                    ->orWhere(function ($query) use ($tanggalPinjam, $tanggalKembali) {
                        $query->where('tgl_pinjam', '<=', $tanggalPinjam)
                            ->where('tgl_kembali', '>=', $tanggalKembali);
                    });
            })
            ->exists();

        if ($barangDipinjam) {
            return back()->with('error', 'Barang sedang dipinjam dalam rentang tanggal yang sama.');
        }

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

        $user = User::find($userId); // Retrieve the User model instance
        $user_name = $user->name; // Access the "name" property of the User model        

        $unit = DB::table('unit')->join('barang', 'barang.unit_id', '=', 'unit.id')->where('barang.id', $request->input('barang_id'))->select('nama')->first();

        $data = [
            'name' => $user->name,
            'nama_unit' => $unit->nama,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'tgl_kembali' => $peminjaman->tgl_kembali,
            'nama_barang' => $barang->nama_barang,
            'merk' => $barang->merk,
            'serial_number' => $barang->serial_number,
        ];

        Mail::send('admin.mail.addPeminjaman', $data, function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Sistem Peminjaman Barang : Permintaan Peminjaman Anda Berhasil Dibuat!');
        });

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
                    ->select('peminjaman.*', 'barang.nama_barang AS nama_barang', 'barang.serial_number AS serial_number', 'unit.nama AS nama_unit')
                    ->join('barang', 'peminjaman.barang_id', '=', 'barang.id')
                    ->join('unit', 'barang.unit_id', '=', 'unit.id')
                    ->get();

        // Mendapatkan nama pengguna yang sedang login
        $userName = Auth::user()->name;

        // Generate PDF
        $pdf_n = App::make('dompdf.wrapper');
        $pdf = $pdf_n->setPaper('A4', 'landscape')->loadView('pinjam.bukti', compact('peminjamans', 'userName'));

        // Kode untuk mengatur nama file PDF yang dihasilkan
        $filename = 'bukti_peminjaman_' . date('YmdHis') . '.pdf';

        // Mengirimkan file PDF untuk di-download oleh pengguna
        return $pdf->download($filename);
    }
}
