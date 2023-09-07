<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\BeritaAcara;
use App\Models\MataKuliahDosen;
use App\Http\Requests\StoreBeritaAcaraRequest;
use App\Http\Requests\UpdateBeritaAcaraRequest;
use App\Models\BeritaAcaraDetail;

class BeritaAcaraController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $classes = Kelas::with('mahasiswa')->get();
    if (!auth()->user()->isAdmin) {
      $beritas = BeritaAcara::where('id_dosen', auth()->user()->dosen->first()->id)->get();
      $dosens = Dosen::where('id_user', auth()->user()->id)->first();
      $matakuliahs = MataKuliahDosen::where('id_dosen', $dosens->id)->get();
    } else {
      $dosens = Dosen::all();
      $beritas = BeritaAcara::all();
      $matakuliahs = MataKuliahDosen::with('matakuliah')->get();
    }
    return view('berita_acara.index', compact('beritas', 'classes', 'matakuliahs', 'dosens'));
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
  public function store(StoreBeritaAcaraRequest $request)
  {
    $validatedData = $request->validated();

    BeritaAcara::create($validatedData);

    return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil ditambahkan');
  }

  /**
   * Display the specified resource.
   */
  public function show(BeritaAcara $berita_acara)
  {
    $details = BeritaAcaraDetail::where('id_berita_acara', $berita_acara->id)->get();
    $detail = BeritaAcaraDetail::where('id_berita_acara', $berita_acara->id)->first();

    return view('berita_acara.show')->with(compact('berita_acara', 'details', 'detail'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(BeritaAcara $beritaAcara)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateBeritaAcaraRequest $request, BeritaAcara $beritaAcara)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(BeritaAcara $beritaAcara)
  {
    //
  }
}
