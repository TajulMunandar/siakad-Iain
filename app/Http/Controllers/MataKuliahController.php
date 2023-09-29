<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\MataKuliahDosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = MataKuliah::with('prodi')->orderBy('id', 'asc')->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $btn = '<a class="btn btn-warning me-1" href="' . route('matakuliah.edit', $row->id) . '"><i class="fa-solid fa-pen-to-square"></i></a>';
          $btn .= '<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal' . $row->id . '"><i class="fa-solid fa-trash"></i></button>';
          return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    $matkuls = MataKuliah::with('prodi')->get();
    $dosens = Dosen::all();
    $matkulDosens = MataKuliahDosen::with(['mataKuliah', 'dosen'])->get();
    $prodis = Prodi::all();
    return view('data_master.matakuliah.tabs.matakuliah')->with(compact('matkuls', 'matkulDosens', 'prodis', 'dosens'));
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
    return view('data_master.matakuliah.tabs.matakuliah.tambah')->with(compact('matkuls', 'matkulDosens', 'prodis', 'dosens'));
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

  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(MataKuliah $matakuliah)
  {
    $matkuls = MataKuliah::with('prodi')->get();
    $dosens = Dosen::all();
    $matkulDosens = MataKuliahDosen::with(['mataKuliah', 'dosen'])->get();
    $prodis = Prodi::all();
    return view('data_master.matakuliah.tabs.matakuliah.edit')->with(compact('matkuls', 'matkulDosens', 'prodis', 'dosens', 'matakuliah'));
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
