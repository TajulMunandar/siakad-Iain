<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProdiRequest;


class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $prodis = Prodi::with('fakultas', 'dosen')->get();
      $fakultas = Fakultas::all();
      $dosens = Dosen::all();
      return view('data_master.prodi.index')->with(compact('prodis', 'fakultas', 'dosens'));
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
          'kaprodi' => 'required',
          'id_fakultas' => 'required',
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/prodi')->with('failed', $e->getMessage());
      }

      Prodi::create($validatedData);

      return redirect('/dashboard/data-master/prodi')->with('success', 'Program studi baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
      try {
        $validatedData = $request->validate([
          'name' => 'required|max:255',
          'kaprodi' => 'required',
          'id_fakultas' => 'required',
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-master/prodi')->with('failed', $e->getMessage());
      }

      Prodi::where('id', $prodi->id)->update($validatedData);

      return redirect('/dashboard/data-master/prodi')->with('success', 'Data prodi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
      try {
        Prodi::destroy($prodi->id);
        return redirect('/dashboard/data-master/prodi')->with('success', "Prodi $prodi->name berhasil dihapus!");
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/dashboard/data-master/prodi')->with('failed', "Prodi $prodi->name tidak bisa dihapus karena sedang digunakan!");
      }
    }
}
