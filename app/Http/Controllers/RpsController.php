<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Rps;
use Dompdf\Options;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRpsRequest;
use App\Models\Capaian;
use App\Models\CapaianPertemuan;
use App\Models\Cpl;
use App\Models\Cpmk;
use App\Models\DaftarReferensi;

class RpsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $kelases = Kelas::all();
    $matakuliahs = MataKuliah::all();
    $prodis = Prodi::all();
    $fakultases = Fakultas::all();
    if (!auth()->user()->isAdmin) {
      $dosens = Dosen::where('id_user', auth()->user()->id)->first();
      $rpses = Rps::where('id_dosen', $dosens->id)->get();
    } else {
      $rpses = Rps::all();
      $dosens = Dosen::all();
    }
    return view('rps.index')->with(compact('rpses', 'kelases', 'dosens', 'matakuliahs', 'prodis', 'fakultases'));
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
        'tahun_ajaran' => 'required',
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/dashboard/data-rps/rps')->with('failed', $e->getMessage());
    }

    $rps = Rps::create($validatedData);

    return redirect()->route('cpl.index', ['id' => $rps->id])->with('success', 'Rencana Perkuliahan Semester baru berhasil dibuat!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Rps $rps)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Rps $rps)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Rps $rp)
  {
    try {
      $validatedData = $request->validate([
        'id_kelas' => 'required',
        'id_dosen' => 'required',
        'id_matakuliah' => 'required',
        'id_prodi' => 'required',
        'id_fakultas' => 'required',
        'semester' => 'required',
        'tahun_ajaran' => 'required',
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/dashboard/data-rps/rps')->with('failed', $e->getMessage());
    }

    Rps::where('id', $rp->id)->update($validatedData);
    $rps = Rps::find($rp->id);
    return redirect()->route('cpl.show', ['rps' => $rps->id])->with('success', 'Rencana Perkuliahan Semester baru berhasil dibuat!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Rps $rp)
  {
    $rps = Rps::whereId($rp->id)->first();

    $rps->capaian->each(function ($capaian) {
      $capaian->cpl->each(function ($cpl) {
        $cpl->delete();
      });
      $capaian->cpmk->each(function ($cpmk) {
        $cpmk->delete();
      });
      $capaian->delete();
    });

    $rps->daftarReferensi->each(function ($daftarReferensi) {
      $daftarReferensi->delete();
    });
    $rps->capaianPertemuan->each(function ($capaianPertemuan) {
      $capaianPertemuan->delete();
    });

    Rps::destroy($rp->id);
    return redirect('/dashboard/data-rps/rps')->with('success', "Rps" . $rp->kelas->name . "berhasil dihapus!");
  }

  public function generatePDF($id)
  {
    $rps = Rps::find($id);
    $rpses = $rps->first();
    $capaians = Capaian::where('id_rps', $rps->id)->first();
    $cpls = Cpl::where('id_capaian', $capaians->id)->get();
    $cpmks = Cpmk::where('id_capaian', $capaians->id)->get();
    $daftars = DaftarReferensi::where('id_rps', $rps->id)->get();
    $tables = CapaianPertemuan::where('id_rps', $rps->id)->get();

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $pdf = new Dompdf();
    $pdf->getOptions()->setDefaultFont('Times New Roman');

    $htmlContent = view('template.rps', compact('rpses', 'capaians', 'cpls', 'cpmks', 'daftars', 'tables'))->render();
    $htmlContent = str_replace('&le;', '&#x2264;', $htmlContent);
    $pdf->loadHtml($htmlContent);
    $pdf->setPaper('legal', 'landscape');

    $pdf->render();

    return $pdf->stream('rps.pdf'); // Menggunakan metode stream untuk menampilkan PDF dalam browser
  }
}
