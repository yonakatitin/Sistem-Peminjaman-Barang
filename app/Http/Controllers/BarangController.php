<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Detailbarang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
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
        // $unit_id = DB::table('adminunit')->where('user_id', $id)->select('adminunit.unit_id');
        // $usr = auth()->user();
        // $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        // $this->unit_id = $unit_id->unit_id;
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $this->unit_id = $unit_id->unit_id;
        $barang = DB::table('barang')->join('kategori', 'barang.kategori_id', '=', 'kategori.id')->leftJoin('detailbarang', 'detailbarang.barang_id', '=', 'barang.id')->where('barang.unit_id', $this->unit_id)->select('barang.*', 'kategori.nama', 'detailbarang.id as id_detail', 'detailbarang.detail', 'detailbarang.gambar')->get();
        return view('adminunit.barang.index', ['barang' => $barang]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('adminunit.barang.create', ['kategori' => $kategori, 'unit_id' => $this->unit_id]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;
        $validateData = $request->validate([
            'nama_barang' => 'required|max:255',
            'merk' => 'required|max:255',
            'serial_number' => 'required|max:255|unique:barang',
            'deskripsi' => 'required|max:255',
            'detail' => 'max:255',
            'gambar' => 'image',
            'kategori' => 'required',
            'status_barang' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            // Store the uploaded image file
            $gambar = $request->file('gambar')->store('gambar-barang');
        }

        DB::table('barang')->insert([
            'nama_barang' => $validateData['nama_barang'],
            'merk' => $validateData['merk'],
            'serial_number' => $validateData['serial_number'],
            'deskripsi' => $validateData['deskripsi'],
            'status_barang' => $validateData['status_barang'],
            'unit_id' => $unit_id,
            'kategori_id' => $validateData['kategori']
        ]);

        $kategori_id = $request->kategori;

        $conditions = ['nama_barang' => $validateData['nama_barang'], 'serial_number' => $validateData['serial_number'], 'unit_id' => $unit_id, 'kategori_id' => $kategori_id];

        $data = DB::table('barang')->where($conditions)->first();
        // DB::enableQueryLog();
        // $queries = DB::getQueryLog();
        // $que = end($queries);
        // ddd($queries);
        // ddd($data);
        $id = $data->id;

        if($validateData['detail'] || $request->hasFile('gambar')){
            $detail = ['barang_id' => $id];

            if (isset($gambar)) {
                $detail['gambar'] = $gambar;
            }

            if ($validateData['detail'] ) {
                $detail['detail'] = $validateData['detail'] ;
            }

            DB::table('detailbarang')
            ->insert($detail);
        }
        // elseif(!$validateData['detail'] && $validateData['gambar']){
        //     DB::table('detailbarang')->insert([
        //         'gambar' => $validateData['gambar'],
        //         'barang_id' => $id
        //     ]);
        // }elseif($validateData['detail'] && !$validateData['gambar']){
        //     DB::table('detailbarang')->insert([
        //         'detail' => $validateData['detail'],
        //         'barang_id' => $id
        //     ]);
        // }
        
        return redirect('/adminunit/barang');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Detailbarang $detailbarang)
    {
        return view('barang.show', compact('detailbarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($barang_id)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $this->unit_id = $unit_id->unit_id;
        $whereClause = ['barang.unit_id' => $this->unit_id, 'barang.id' => $barang_id];
        $barang = DB::table('barang')->join('kategori', 'barang.kategori_id', '=', 'kategori.id')->leftJoin('detailbarang', 'barang.id', '=', 'detailbarang.barang_id')->where($whereClause)->select('barang.*', 'kategori.nama', 'detailbarang.id as id_detail', 'detailbarang.detail', 'detailbarang.gambar')->first();
        $kategori = Kategori::all();
        return view('adminunit.barang.edit', ['barang' => $barang, 'kategori' => $kategori, 'unit_id' => $this->unit_id]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;
        
        // Validate the request data
        $validateData = $request->validate([
            'nama_barang' => 'required|max:255',
            'merk' => 'required|max:255',
            'serial_number' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'detail' => 'max:255',
            'kategori' => 'required',
            'status_barang' => 'required',
        ]);
    
        if ($request->hasFile('gambar')) {
            // Store the uploaded image file
            $gambar = $request->file('gambar')->store('gambar-barang');
        }
    
        // Update the 'barang' table using the validated data
        DB::table('barang')
            ->where('id', $request->barang_id)
            ->update([
                'nama_barang' => $validateData['nama_barang'],
                'merk' => $validateData['merk'],
                'serial_number' => $validateData['serial_number'],
                'deskripsi' => $validateData['deskripsi'],
                'status_barang' => $validateData['status_barang'],
                'unit_id' => $unit_id,
                'kategori_id' => $validateData['kategori']
            ]);
    
        // Update the 'detailbarang' table if 'id_detail' is available
        if ($request->id_detail) {
            $detail = [];
            if($validateData['detail']){
                $detail['detail'] = $validateData['detail'];
            }
    
            // Update the 'gambar' field if it's available
            if (isset($gambar)) {
                $detail['gambar'] = $gambar;
            }
    
            if(isset($detail['detail']) || isset($detail['gambar'])){
                DB::table('detailbarang')
                ->where('id', $request->id_detail)
                ->update($detail);
            }
        }else{
            $detail = [];
            $detail['barang_id'] = $request->id_barang;
            if($validateData['detail']){
                $detail['detail'] = $validateData['detail'];
            }
    
            // Update the 'gambar' field if it's available
            if (isset($gambar)) {
                $detail['gambar'] = $gambar;
            }
    
            if(isset($detail['detail']) || isset($detail['gambar'])){
                DB::table('detailbarang')
                ->insert($detail);
            }
        }
        
        return redirect('/adminunit/barang');
    }
    public function hapus($barang_id)
    {
    DB::table('barang')->where('id',$barang_id)->delete();
    return redirect('/adminunit/barang');
    }

    public function getData()
    {
        $usr = auth()->user();
        $unit_id = DB::table('adminunit')->where('adminunit.user_id', $usr->id)->select('adminunit.unit_id')->first();
        $unit_id = $unit_id->unit_id;
        
        $data = DB::table('barang')->where('unit_id', $unit_id)->select('barang.status_barang')->get(); // Retrieve data from the 'data' table

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

        $status = [
            'available' => $available,
            'in_use' => $in_use,
            'broken' => $broken,
        ];

        return response()->json($status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
