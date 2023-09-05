<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Http\Requests\StoreFakultasRequest;
use App\Http\Requests\UpdateFakultasRequest;

class FakultasController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $fakultas = Fakultas::all();
    return view('data_master.fakultas.index')->with(compact('fakultas'));
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
  public function store(StoreFakultasRequest $request)
  {
    $validatedData = $request->validated();

    Fakultas::create($validatedData);

    return redirect('/dashboard/data-master/fakultas')->with('success', 'fakultas baru berhasil dibuat!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Fakultas $fakultas)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Fakultas $fakultas)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateFakultasRequest $request, Fakultas $fakulta)
  {

    $validatedData = $request->validated();

    Fakultas::where('id', $fakulta->id)->update($validatedData);

    return redirect('/dashboard/data-master/fakultas')->with('success', 'Fakultas berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Fakultas $fakulta)
  {
    try {
      Fakultas::destroy($fakulta->id);
      return redirect('/dashboard/data-master/fakultas')->with('success', "Fakultas $fakulta->name berhasil dihapus!");
    } catch (\Illuminate\Database\QueryException $e) {
      return redirect('/dashboard/data-master/fakultas')->with('failed', "Fakultas $fakulta->name tidak bisa dihapus karena sedang digunakan!");
    }
  }
}
