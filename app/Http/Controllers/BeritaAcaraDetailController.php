<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BeritaAcaraDetail;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\StoreBeritaAcaraDetailRequest;
use App\Http\Requests\UpdateBeritaAcaraDetailRequest;
use App\Models\BeritaAcara;
use Carbon\Carbon;

class BeritaAcaraDetailController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {

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
    dd($request);
    $validatedData = $request->validate([
      'id_berita_acara' => 'required',
      'tanggal' => 'required',
      'pertemuan' => 'required',
      'materi' => 'required',
      'jumlah_mahasiswa' => 'required|max:2',
      'bukti_pelaksanaan' => 'nullable'
    ]);

    if ($request->file('bukti_pelaksanaan')) {
      $image = $request->file('bukti_pelaksanaan');

      $image = Image::make($image);

      $image->fit(800, 800, function ($constraint) {
        $constraint->upsize();
      })->encode('webp');

      $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
      $image->save(storage_path('app/public/data-berita/' . $imageName));

      $validatedData['bukti_pelaksanaan'] = 'data-berita/' . $imageName;
    }

    BeritaAcaraDetail::create($validatedData);

    return redirect()->route('berita-acara.show', $request->id_berita_acara)->with('success', 'Berita Acara berhasil ditambahkan');
  }

  /**
   * Display the specified resource.
   */
  public function show(BeritaAcaraDetail $beritaAcaraDetail)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(BeritaAcaraDetail $beritaAcaraDetail)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, BeritaAcaraDetail $beritaAcaraDetail)
  {
    $validatedData = $request->validate([
      'id_berita_acara' => 'required',
      'tanggal' => 'required',
      'pertemuan' => 'required|max:2',
      'materi' => 'required',
      'jumlah_mahasiswa' => 'required|max:2',
      'bukti_pelaksanaan' => 'nullable'
    ]);

    if ($request->file('bukti_pelaksanaan')) {
      if ($request->oldImage) {
        unlink(storage_path('app/public/' . $request->oldImage));
      }
      $image = $request->file('bukti_pelaksanaan');

      // Load the image using Intervention Image
      $image = Image::make($image);

      // Compress and resize the image
      $image->fit(800, 800, function ($constraint) {
        $constraint->upsize();
      })->encode('webp', 80); // Menggunakan format WebP untuk kompresi yang lebih efisien

      // Simpan gambar yang telah dikompres ke direktori image-modul
      $imageName = time() . '-' . Str::random(10) . '.' . 'webp';
      $image->save(storage_path('app/public/data-berita/' . $imageName));

      $validatedData['bukti_pelaksanaan'] = 'data-berita/' . $imageName;
    }

    BeritaAcaraDetail::where('id', $beritaAcaraDetail->id)->update($validatedData);

    return redirect()->route('berita-acara.show', $beritaAcaraDetail->id_berita_acara)->with('success', 'Data Berita berhasil diubah!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(BeritaAcaraDetail $beritaAcaraDetail)
  {
    try {
      $detail = BeritaAcaraDetail::whereId($beritaAcaraDetail->id)->first();
      if ($detail->bukti_pelaksanaan) {
        unlink(storage_path('app/public/' . $detail->bukti_pelaksanaan));
      }
      BeritaAcaraDetail::destroy($beritaAcaraDetail->id);
      return redirect()->route('berita-acara.show', $beritaAcaraDetail->id_berita_acara)->with('success', "Berita $detail->materi berhasil dihapus!");
    } catch (\Illuminate\Database\QueryException $e) {
      return redirect()->route('berita-acara.show', $beritaAcaraDetail->id_berita_acara)->with('failed', "Berita $detail->materi tidak bisa dihapus karena sedang digunakan!");
    }
  }

  public function generatePDF($id)
  {
    $berita = BeritaAcaraDetail::find($id);
    $beritas = $berita->get();
    $tanggal = Carbon::parse($berita->tanggal)->format('l, d-m-Y');
    $beritaAcara = BeritaAcara::where('id', $berita->id_berita_acara)->first();

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $pdf = new Dompdf();

    $htmlContent = view('template.berita-acara', compact('beritas', 'beritaAcara', 'tanggal'))->render();
    $pdf->loadHtml($htmlContent);
    $pdf->setPaper('legal', 'landscape');

    $pdf->render();

    return $pdf->stream('berita-acara.pdf'); // Menggunakan metode stream untuk menampilkan PDF dalam browser
  }
}
