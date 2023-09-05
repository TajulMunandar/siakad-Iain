<?php

namespace App\Http\Controllers;

use App\Models\SoalSurvei;
use Illuminate\Http\Request;
use App\Models\IndikatorSurvei;
use App\Http\Requests\StoreSoalSurveiRequest;
use App\Http\Requests\UpdateSoalSurveiRequest;

class SoalSurveiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $indikators = IndikatorSurvei::all();
      $soals = SoalSurvei::all();
        return view('survei.data_soal.index')->with(compact('soals', 'indikators'));
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
          'id_indikator' => 'required',
          'soal' => 'required'
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-survei/soal')->with('failed', $e->getMessage());
      }

      SoalSurvei::create($validatedData);

      return redirect('/dashboard/data-survei/soal')->with('success', 'Soal baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SoalSurvei $soalSurvei)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoalSurvei $soalSurvei)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SoalSurvei $soal)
    {
      try {
        $validatedData = $request->validate([
          'id_indikator' => 'required',
          'soal' => 'required'
        ]);
      } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect('/dashboard/data-survei/soal')->with('failed', $e->getMessage());
      }

      SoalSurvei::where('id', $soal->id)->update($validatedData);

      return redirect('/dashboard/data-survei/soal')->with('success', 'Soal baru berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoalSurvei $soal)
    {
      try {
        SoalSurvei::destroy($soal->id);
        return redirect('/dashboard/data-survei/soal')->with('success', "Soal $soal->soal berhasil dihapus!");
      } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/dashboard/data-survei/soal')->with('failed', "Soal $soal->soal tidak bisa dihapus karena sedang digunakan!");
      }
    }
}
