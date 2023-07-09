<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    
    //     // mengambil data dari table pegawai
    //     $unit = DB::table('unit')->get();
 
    //     // mengirim data pegawai ke view index
    //     return view('unit.index',['unit' => $unit]);
    // }

    public function index()
    {
        $units = Unit::all();

        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        DB::table('unit')->insert([
        'nama' => $request->nama,
        'lokasi' => $request->lokasi
        ]);
        return redirect('/unit');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        $barang = $unit->barang()->get();


        return view('units.show', compact('unit', 'barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
        $unit = Unit::find($unit->id);
        return view('unit.edit', ['unit' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }

    public function hapus($id)
    {
        DB::table('unit')->where('id',$id)->delete();
        return redirect('/unit');
    }

    // public function barang($id)
    // {
    //     // $post = Unit::findOrFail($id);
    //     // mengambil data dari table pegawai
    //     $barang = DB::table('barang')
    //             ->join('unit', 'barang.id_unit', '=', 'unit.id')
    //             ->where('barang.id_unit', $id)
    //             ->get();
 
    //     // mengirim data pegawai ke view index
    //     return view('unit.barang',['barang' => $barang]);
    // }
    
}
