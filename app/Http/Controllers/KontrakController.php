<?php

namespace App\Http\Controllers;


use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Kontrak;
use App\Models\Fakultas;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class KontrakController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $prodis = Prodi::all();
    $kelases = Kelas::all();
    $matakuliahs = MataKuliah::all();
    $fakultases = Fakultas::all();
    if (!auth()->user()->isAdmin) {
      $dosens = Dosen::where('id_user', auth()->user()->id)->first();
      $kontraks = Kontrak::where('id_dosen', $dosens->id)->get();
    } else {
      $dosens = Dosen::all();
      $kontraks = Kontrak::with('prodi', 'kelas', 'fakultas', 'mataKuliah', 'dosen')->get();
    }
    return view('kontrak.index')->with(compact('kontraks', 'prodis', 'kelases', 'dosens', 'matakuliahs', 'fakultases', 'kontraks'));
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
        'id_kelas' => 'required',
        'id_dosen' => 'required',
        'id_matakuliah' => 'required',
        'id_prodi' => 'required',
        'id_fakultas' => 'required',
        'semester' => 'required',
        'tahun_akademik' => 'required',
        'uas' => 'required|max:2',
        'uts' => 'required|max:2',
        'tugas' => 'required|max:2',
        'kuis' => 'required|max:2',
        'ket' => 'required',
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/dashboard/kontrak')->with('failed', $e->getMessage());
    }

    Kontrak::create($validatedData);

    return redirect('/dashboard/kontrak')->with('success', 'Kontrak baru berhasil dibuat!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Kontrak $kontrak)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Kontrak $kontrak)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Kontrak $kontrak)
  {
    try {
      $validatedData = $request->validate([
        'id_kelas' => 'required',
        'id_dosen' => 'required',
        'id_matakuliah' => 'required',
        'id_prodi' => 'required',
        'id_fakultas' => 'required',
        'semester' => 'required',
        'tahun_akademik' => 'required',
        'uas' => 'required|max:2',
        'uts' => 'required|max:2',
        'tugas' => 'required|max:2',
        'kuis' => 'required|max:2',
        'ket' => 'required',
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/dashboard/kontrak')->with('failed', $e->getMessage());
    }

    Kontrak::where('id', $kontrak->id)->update($validatedData);

    return redirect('/dashboard/kontrak')->with('success', 'Kontrak baru berhasil dibuat!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Kontrak $kontrak)
  {
    try {
      Kontrak::destroy($kontrak->id);
      return redirect('/dashboard/kontrak')->with('success', "Kontrak $kontrak->name berhasil dihapus!");
    } catch (\Illuminate\Database\QueryException $e) {
      return redirect('/dashboard/kontrak')->with('failed', "Kontrak $kontrak->name tidak bisa dihapus karena sedang digunakan!");
    }
  }

  public function generatePDF($id)
  {
    $kontrak = Kontrak::find($id);
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $pdf = new Dompdf();

    $htmlContent = view('template.kontrak', compact('kontrak'))->render();
    $pdf->loadHtml($htmlContent);
    $pdf->setPaper('legal', 'portrait');

    $pdf->render();

    return $pdf->stream('kontrak.pdf'); // Menggunakan metode stream untuk menampilkan PDF dalam browser
  }

}
