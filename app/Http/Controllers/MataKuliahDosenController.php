<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\MataKuliahDosen;

class MataKuliahDosenController extends Controller
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
      try {
        $validatedData = $request->validate([
          'id_matakuliah' => 'required',
          'id_dosen' => 'required',
        ]);

      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/matakuliah')->with('failed', $e->getMessage());
      }
      MataKuliahDosen::create($validatedData);

      return redirect('/dashboard/data-master/matakuliah')->with('success', 'Mata Kuliah Dosen berhasil dibuat!');
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
    public function update(Request $request, MataKuliahDosen $matakuliah_dosen)
    {
      try {
        $validatedData = $request->validate([
          'id_matakuliah' => 'required',
          'id_dosen' => 'required',
        ]);

      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/matakuliah')->with('failed', $e->getMessage());
      }
      MataKuliahDosen::where('id', $matakuliah_dosen->id)->update($validatedData);

      return redirect('/dashboard/data-master/matakuliah')->with('success', 'Mata Kuliah Dosen berhasil dibuat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliahDosen $matakuliah_dosen)
    {
      try {
        MataKuliahDosen::destroy($matakuliah_dosen->id);
        return redirect('/dashboard/data-master/matakuliah')->with('success', "Mata Kuliah Dosen $matakuliah_dosen->name berhasil dihapus!");
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/dashboard/data-master/matakuliah')->with('failed', "Mata Kuliah Dosen $matakuliah_dosen->name tidak bisa dihapus karena sedang digunakan!");
      }
    }
}
