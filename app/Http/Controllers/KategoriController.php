<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();

        return view('admin.kategori.index',['kategori' => $kategori]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|string|unique:kategori'
        ]);
        DB::table('kategori')->insert([
        'nama' => $validateData['nama'],
        ]);
        return redirect('/admin/kategori');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = DB::table('kategori')->where('id', $id)->get();
        return view('admin.kategori.edit', ['kategori' => $kategori]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required'
        ]);
        
        DB::table('kategori')->where('id', $request->id)->update([
            'nama' => $validateData['nama'],
        ]);

        return redirect('admin/kategori');
        //
    }

    public function hapus($id)
    {
    DB::table('kategori')->where('id',$id)->delete();
    return redirect('/admin/kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
