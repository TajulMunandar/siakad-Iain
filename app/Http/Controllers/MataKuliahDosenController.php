<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\MataKuliahDosen;
use App\Models\Prodi;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahDosenController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = MataKuliahDosen::all();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $btn = '<a class="btn btn-warning me-1" href="' . route('matakuliah-dosen.edit', $row->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>';
          $btn .= '<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModalMKDosen' . $row->id . '"><i class="fa-solid fa-trash"></i></button>';
          return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    $matkuls = MataKuliah::with('prodi')->get();
    $dosens = Dosen::all();
    $matkulDosens = MataKuliahDosen::with(['mataKuliah', 'dosen'])->get();


    return view('data_master.matakuliah.tabs.matakuliah-dosen')->with(compact('matkuls', 'matkulDosens', 'dosens'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $matkuls = MataKuliah::with('prodi')->get();
    $dosens = Dosen::all();
    $matkulDosens = MataKuliahDosen::with(['mataKuliah', 'dosen'])->get();
    $prodis = Prodi::all();
    return view('data_master.matakuliah.tabs.matakuliah-dosen.tambah')->with(compact('matkuls', 'matkulDosens', 'prodis', 'dosens'));
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
      return redirect('/dashboard/data-master/matakuliah-dosen')->with('failed', $e->getMessage());
    }
    MataKuliahDosen::create($validatedData);

    return redirect('/dashboard/data-master/matakuliah-dosen')->with('success', 'Mata Kuliah Dosen berhasil dibuat!');
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
  public function edit(MataKuliahDosen $matakuliah_dosen)
  {
    $matkuls = MataKuliah::with('prodi')->get();
    $dosens = Dosen::all();
    $matkulDosens = MataKuliahDosen::with(['mataKuliah', 'dosen'])->get();
    $prodis = Prodi::all();
    return view('data_master.matakuliah.tabs.matakuliah-dosen.edit')->with(compact('matkuls', 'matkulDosens', 'prodis', 'dosens', 'matakuliah_dosen'));
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
      return redirect('/dashboard/data-master/matakuliah-dosen')->with('failed', $e->getMessage());
    }
    MataKuliahDosen::where('id', $matakuliah_dosen->id)->update($validatedData);

    return redirect('/dashboard/data-master/matakuliah-dosen')->with('success', 'Mata Kuliah Dosen berhasil dibuat!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(MataKuliahDosen $matakuliah_dosen)
  {
    try {
      MataKuliahDosen::destroy($matakuliah_dosen->id);
      return redirect('/dashboard/data-master/matakuliah-dosen')->with('success', "Mata Kuliah Dosen $matakuliah_dosen->name berhasil dihapus!");
    } catch (\Illuminate\Database\QueryException $e) {
      return redirect('/dashboard/data-master/matakuliah-dosen')->with('failed', "Mata Kuliah Dosen $matakuliah_dosen->name tidak bisa dihapus karena sedang digunakan!");
    }
  }
}
