<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateDosenRequest;
use Intervention\Image\ImageManagerStatic as Image;

class DosenController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $dosens = Dosen::with('user')->get();
    $users = User::all();
    return view('data_master.dosen.index')->with(compact('dosens', 'users'));
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
        'nip' => 'required|max:255',
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'nohp' => 'required|max:14',
        'foto' => 'mimes:jpeg,jpg,png',
      ]);

      // Cek apakah NIP sudah ada dalam database
      $existingUser = User::where('username', $validatedData['nip'])->first();
      if ($existingUser) {
        throw new \Exception('NIP sudah digunakan.');
      }

      if ($request->file('foto')) {
        $image = $request->file('foto');

        $image = Image::make($image);

        $image->fit(800, 800, function ($constraint) {
          $constraint->upsize();
        })->encode('webp');

        $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
        $image->save(storage_path('app/public/data-dosen/' . $imageName));

        $validatedData['foto'] = 'data-dosen/' . $imageName;
      }

      $userData = [
        'name' => $validatedData['name'],
        'username' => $validatedData['nip'],
        'password' => Hash::make($validatedData['nip']),
        'isAdmin' => 0,
      ];

      User::create($userData);

      $validatedData['id_user'] = User::where('username', $validatedData['nip'])->first(['id'])->id;
      Dosen::create($validatedData);

      return redirect('/dashboard/data-master/dosen')->with('success', 'Dosen baru berhasil dibuat!');
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/dashboard/data-master/dosen')->with('failed', $e->getMessage());
    } catch (\Exception $e) {
      return redirect('/dashboard/data-master/dosen')->with('failed', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Dosen $dosen)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Dosen $dosen)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Dosen $dosen)
  {
    try {
      $validatedData = $request->validate([
        'nip' => 'required|max:255',
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'nohp' => 'required|max:14',
        'id_user' => 'required',
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/dashboard/data-master/dosen')->with('failed', $e->getMessage());
    }

    if ($request->file('foto')) {
      if ($request->oldImage) {
        unlink(storage_path('app/public/' . $request->oldImage));
      }
      $image = $request->file('foto');

      // Load the image using Intervention Image
      $image = Image::make($image);

      // Compress and resize the image
      $image->fit(800, 800, function ($constraint) {
        $constraint->upsize();
      })->encode('webp', 80); // Menggunakan format WebP untuk kompresi yang lebih efisien

      // Simpan gambar yang telah dikompres ke direktori image-modul
      $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
      $image->save(storage_path('app/public/data-dosen/' . $imageName));

      $validatedData['foto'] = 'data-dosen/' . $imageName;
    }

    Dosen::where('id', $dosen->id)->update($validatedData);

    return redirect('/dashboard/data-master/dosen')->with('success', 'Data dosen berhasil diubah!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      $dosens = Dosen::whereId($id)->first();
      if ($dosens->foto) {
        unlink(storage_path('app/public/' . $dosens->foto));
      }
      Dosen::destroy($id);
      return redirect('/dashboard/data-master/dosen')->with('success', "Dosen $dosens->name berhasil dihapus!");
    } catch (\Illuminate\Database\QueryException $e) {
      return redirect('/dashboard/data-master/dosen')->with('failed', "Dosen $dosens->name tidak bisa dihapus karena sedang digunakan!");
    }
  }
}
