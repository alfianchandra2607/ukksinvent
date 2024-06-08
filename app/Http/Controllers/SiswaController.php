<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsetSiswa = Siswa::latest()->paginate(10);        
        return view('siswa.index', compact('rsetSiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required',
            'nis'     => 'required|max:5',
            'gender'  => 'required',
            'kelas'   => 'required|not_in:blank',
            'rombel'  => 'required',
            'foto'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        Siswa::create([
            'nama'     => $request->nama,
            'nis'      => $request->nis,
            'gender'   => $request->gender,
            'kelas'    => $request->kelas,
            'rombel'   => $request->rombel,
            'foto'     => $foto->hashName()
        ]);

        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetSiswa = Siswa::find($id);
        return view('siswa.show', compact('rsetSiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rsetSiswa = Siswa::find($id);
        return view('siswa.edit', compact('rsetSiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'    => 'required',
            'nis'     => 'required',
            'gender'  => 'required',
            'kelas'   => 'required|not_in:blank',
            'rombel'  => 'required',
            'foto'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $rsetSiswa = Siswa::find($id);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());
            Storage::delete('public/foto/'.$rsetSiswa->foto);

            $rsetSiswa->update([
                'nama'    => $request->nama,
                'nis'     => $request->nis,
                'gender'  => $request->gender,
                'kelas'   => $request->kelas,
                'rombel'  => $request->rombel,
                'foto'    => $foto->hashName()
            ]);

        } else {

            $rsetSiswa->update([
                'nama'    => $request->nama,
                'nis'     => $request->nis,
                'gender'  => $request->gender,
                'kelas'   => $request->kelas,
                'rombel'  => $request->rombel
            ]);
        }

        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rsetSiswa = Siswa::find($id);
        Storage::delete('public/foto/'. $rsetSiswa->foto);
        $rsetSiswa->delete();
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
