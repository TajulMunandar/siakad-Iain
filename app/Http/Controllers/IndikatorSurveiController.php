<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndikatorSurvei;
use App\Http\Requests\StoreIndikatorSurveiRequest;
use App\Http\Requests\UpdateIndikatorSurveiRequest;

class IndikatorSurveiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $indikators = IndikatorSurvei::all();
        return view('survei.data_indikator.index')->with(compact('indikators'));
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
          'indikator' => 'required',
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-survei/indikator')->with('failed', $e->getMessage());
      }

      IndikatorSurvei::create($validatedData);

      return redirect('/dashboard/data-survei/indikator')->with('success', 'Indikator baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(IndikatorSurvei $indikatorSurvei)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IndikatorSurvei $indikatorSurvei)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IndikatorSurvei $indikator)
    {

      try {
        $validatedData = $request->validate([
          'indikator' => 'required',
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-survei/indikator')->with('failed', $e->getMessage());
      }

      IndikatorSurvei::where('id', $indikator->id)->update($validatedData);

      return redirect('/dashboard/data-survei/indikator')->with('success', 'Indikator baru berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndikatorSurvei $indikator)
    {
      try {
        IndikatorSurvei::destroy($indikator->id);
        return redirect('/dashboard/data-survei/indikator')->with('success', "Indikator $indikator->indikator berhasil dihapus!");
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/dashboard/data-survei/indikator')->with('failed', "Indikator $indikator->indikator tidak bisa dihapus karena sedang digunakan!");
      }
    }
}
