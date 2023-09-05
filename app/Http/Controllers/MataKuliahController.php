<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use App\Models\Dosen;
use App\Models\MataKuliahDosen;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $matkuls = MataKuliah::with('prodi')->get();
      $dosens = Dosen::all();
      $matkulDosens = MataKuliahDosen::with(['mataKuliah', 'dosen'])->get();
      $prodis = Prodi::all();
      return view('data_master.matakuliah.index')->with(compact('matkuls', 'matkulDosens', 'prodis', 'dosens'));
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
          'kode_matakuliah' => 'required',
          'sks' => 'required|max:4',
          'id_prodi' => 'required',
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/matakuliah')->with('failed', $e->getMessage());
      }
      MataKuliah::create($validatedData);

      return redirect('/dashboard/data-master/matakuliah')->with('success', 'Mata Kuliah baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {

      try {
        $validatedData = $request->validate([
          'name' => 'required|max:255',
          'kode_matakuliah' => 'required',
          'sks' => 'required|max:4',
          'id_prodi' => 'required',
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/matakuliah')->with('failed', $e->getMessage());
      }
      MataKuliah::where('id', $matakuliah->id)->update($validatedData);
      return redirect('/dashboard/data-master/matakuliah')->with('success', 'Mata Kuliah baru berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $matakuliah)
    {
      try {
        MataKuliah::destroy($matakuliah->id);
        return redirect('/dashboard/data-master/matakuliah')->with('success', "Mata Kuliah $matakuliah->name berhasil dihapus!");
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/dashboard/data-master/matakuliah')->with('failed', "Mata Kuliah $matakuliah->name tidak bisa dihapus karena sedang digunakan!");
      }
    }
}
