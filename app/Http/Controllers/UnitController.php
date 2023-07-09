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
    public function index()
    {
        $unit = Unit::all();

        return view('admin.unit.index',['unit' => $unit]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unit.create');
        
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|string',
            'lokasi' => 'required|string',
        ]);
        
        DB::table('unit')->insert([
        'nama' => $validateData['nama'],
        'lokasi' => $validateData['lokasi']
        ]);

        return redirect('/admin/unit');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit = DB::table('unit')->where('id', $id)->get();
        return view('admin.unit.edit', ['unit' => $unit]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|string',
            'lokasi' => 'required|string',
        ]);
        
        DB::table('unit')->where('id', $request->id)->update([
            'nama' => $validateData['nama'],
            'lokasi' => $validateData['lokasi']
        ]);

        return redirect('admin/unit');
        //
    }

    public function hapus($id)
    {
    DB::table('unit')->where('id',$id)->delete();
    return redirect('/admin/unit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }
    
}
