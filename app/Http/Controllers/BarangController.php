<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Detailbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $detail = DB::table('detailbarang')
    //             ->join('barang', 'detailbarang.id_barang', '=', 'barang.id')
    //             ->where('detailbarang.id_barang', $id)
    //             ->get();
 
    //     // mengirim data pegawai ke view index
    //     return view('barang.index',['detail' => $detail]);
    // }

    public function show(Detailbarang $detailbarang)
    {
        return view('barang.show', compact('detailbarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }

    // public function detail($id)
    // {
    //     $post = Unit::findOrFail($id);
    //     mengambil data dari table pegawai
    //     $detail = DB::table('detailbarang')
    //             ->join('barang', 'detailbarang.id_barang', '=', 'barang.id')
    //             ->where('detailbarang.id_barang', $id)
    //             ->get();
 
    //     // mengirim data pegawai ke view index
    //     return view('barang.index',['detail' => $detail]);
    // }
}
