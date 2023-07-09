<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile', ['user' => $user]);
        //
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
    public function show(Administrator $administrator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrator $administrator)
    {
        $user = Auth::user();
        return view('admin.editprofile', ['user' => $user]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrator $administrator)
    {
        $user = Auth::user();
        
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'no_hp' => 'required|max:255',
            'alamat' => 'required'
        ]);

        DB::table('users')->where('id', $user->id)->update([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'no_hp' => $validateData['no_hp'],
            'alamat' => $validateData['alamat']
        ]);

        return redirect(route('admin.profile'));
        //
    }

    public function change_password(){
        return view('admin.change-password');
    }

    public function update_password(Request $request){
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrator $administrator)
    {
        //
    }
}
