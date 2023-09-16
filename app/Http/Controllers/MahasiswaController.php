<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Mahasiswa::with('kelas')->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $btn = '<button class="btn btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editModal' . $row->id . '"><i class="fa-solid fa-pen-to-square"></i></button>';
          $btn .= '<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal' . $row->id . '"><i class="fa-solid fa-trash"></i></button>';
          return $btn;
        })
        ->addColumn('foto', function ($row) {
          $btn2 = '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#foto' . $row->id . '"><i class="fa-solid fa-eye"></i></button>';
          return $btn2;
        })
        ->rawColumns(['action', 'foto'])
        ->make(true);
    }

    $mahasiswas = Mahasiswa::with('kelas')->get();
    $kelas = Kelas::all();
    return view('data_master.mahasiswa.index')->with(compact('mahasiswas', 'kelas'));
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
        'npm' => 'required|max:255',
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'nohp' => 'required|max:14',
        'isKomisaris' => 'required',
        'foto' => 'nullable|mimes:jpeg,jpg,png',
        'id_kelas' => 'required',
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/dashboard/data-master/mahasiswa')->with('failed', $e->getMessage());
    }

    if ($request->file('foto')) {
      $image = $request->file('foto');

      $image = Image::make($image);

      $image->fit(800, 800, function ($constraint) {
        $constraint->upsize();
      })->encode('webp');

      $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
      $image->save(storage_path('app/public/data-mahasiswa/' . $imageName));

      $validatedData['foto'] = 'data-mahasiswa/' . $imageName;
    }

    Mahasiswa::create($validatedData);

    return redirect('/dashboard/data-master/mahasiswa')->with('success', 'Mahasiswa baru berhasil dibuat!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Mahasiswa $mahasiswa)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Mahasiswa $mahasiswa)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Mahasiswa $mahasiswa)
  {
    try {
      $validatedData = $request->validate([
        'npm' => 'required|max:255',
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'nohp' => 'required|max:14',
        'isKomisaris' => 'required',
        'id_kelas' => 'required',
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/dashboard/data-master/mahasiswa')->with('failed', $e->getMessage());
    }

    if ($request->file('foto')) {
      if ($request->oldImage) {
        unlink(storage_path('app/public/' . $request->oldImage));
      }
      $image = $request->file('foto');

      $image = Image::make($image);

      $image->fit(800, 800, function ($constraint) {
        $constraint->upsize();
      })->encode('webp');

      $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
      $image->save(storage_path('app/public/data-mahasiswa/' . $imageName));

      $validatedData['foto'] = 'data-mahasiswa/' . $imageName;
    }

    Mahasiswa::where('id', $mahasiswa->id)->update($validatedData);

    return redirect('/dashboard/data-master/mahasiswa')->with('success', 'Mahasiswa baru berhasil dibuat!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      $mahasiswa = Mahasiswa::whereId($id)->first();
      if ($mahasiswa->foto) {
        unlink(storage_path('app/public/' . $mahasiswa->foto));
      }
      Mahasiswa::destroy($id);
      return redirect('/dashboard/data-master/mahasiswa')->with('success', "Mahasiswa $mahasiswa->name berhasil dihapus!");
    } catch (\Illuminate\Database\QueryException $e) {
      return redirect('/dashboard/data-master/mahasiswa')->with('failed', "mahasiswa $mahasiswa->name tidak bisa dihapus karena sedang digunakan!");
    }
  }
}
