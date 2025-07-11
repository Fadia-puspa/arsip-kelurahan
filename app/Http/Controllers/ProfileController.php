<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        // Validasi input
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $user->id,
            'password'          => 'nullable|min:6',
            'confim_password'   => 'nullable|same:password',
            'kota'              => 'nullable|string|max:100',
            'alamat'            => 'nullable|string|max:255',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        // Update basic data
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->kota   = $request->kota;
        $user->alamat = $request->alamat;

        // Update password jika diisi
        if ($request->filled('password') && $request->filled('confim_password')) {
            $user->password = Hash::make($request->password);
        }

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && file_exists(public_path('foto/' . $user->foto))) {
                unlink(public_path('foto/' . $user->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan ke folder public/foto
            $file->move(public_path('foto'), $filename);

            $user->foto = $filename;
        }

        $user->save();

        return redirect()->back()->with('profile', 'Profil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
