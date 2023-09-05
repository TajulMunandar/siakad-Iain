<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $kelas = Kelas::with('prodi')->get();
      $prodis = Prodi::all();
      $mahasiswas = Mahasiswa::all();
      return view('data_master.kelas.index')->with(compact('kelas', 'prodis', 'mahasiswas'));
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
      try {
        $validatedData = $request->validate([
          'name' => 'required|max:255',
          'id_prodi' => 'required',
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/kelas')->with('failed', $e->getMessage());
      }

      Kelas::create($validatedData);

      return redirect('/dashboard/data-master/kelas')->with('success', 'Kelas baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
      try {
        $validatedData = $request->validate([
          'name' => 'required|max:255',
          'id_prodi' => 'required',
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/kelas')->with('failed', $e->getMessage());
      }
      Kelas::where('id', $kela->id)->update($validatedData);

      return redirect('/dashboard/data-master/kelas')->with('success', 'Data Kelas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
      try {
        Kelas::destroy($kela->id);
        return redirect('/dashboard/data-master/kelas')->with('success', "Kelas $kela->name berhasil dihapus!");
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/dashboard/data-master/kelas')->with('failed', "Kelas $kela->name tidak bisa dihapus karena sedang digunakan!");
      }
    }

    public function addKomisaris(Request $request)
    {
      try {
        $validatedData = $request->validate([
          'komisaris' => 'required'
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/kelas')->with('failed', $e->getMessage());
      }

      Kelas::where('id', $request->id)->update($validatedData);

      return redirect('/dashboard/data-master/kelas')->with('success', 'Komisaris baru berhasil dibuat!');
    }
}
