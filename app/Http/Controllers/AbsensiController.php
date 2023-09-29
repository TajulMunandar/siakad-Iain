<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\MataKuliah;
use App\Models\AbsensiDetail;
use App\Models\StatusAbsensi;
use App\Models\MataKuliahDosen;
use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $search = $request->input('search');
    $classes = Kelas::with('mahasiswa')->get();
    $mahasiswas = Mahasiswa::with('kelas')->get();

    if (!auth()->user()->isAdmin) {
      $absensis = Absensi::where('id_dosen', auth()->user()->dosen->first()->id)->WhereHas('matakuliah', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })->orWhereHas('kelas', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })->orWhereHas('dosen', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })
        ->orderBy('created_at', 'desc')
        ->paginate(9);
      $dosens = Dosen::where('id_user', auth()->user()->id)->first();
      $matakuliahs = MataKuliahDosen::where('id_dosen', $dosens->id)->get();
    } else {
      $dosens = Dosen::all();
      $absensis = Absensi::orWhereHas('matakuliah', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })->orWhereHas('kelas', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })->orWhereHas('dosen', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })
        ->orderBy('created_at', 'desc')
        ->paginate(9);
      $matakuliahs = MataKuliahDosen::with('matakuliah')->get();
    }

    return view('absensi.index', compact('absensis', 'dosens', 'classes', 'matakuliahs', 'mahasiswas', 'search'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreAbsensiRequest $request)
  {
    $validatedData = $request->validated();

    Absensi::create($validatedData);

    $class = Kelas::find($validatedData['id_kelas']);
    $matakuliah = MataKuliah::find($validatedData['id_matakuliah']);
    $matakuliahDosen = $matakuliah->sks;
    $sks = $matakuliahDosen * 8;

    for ($i = 1; $i <= $sks; $i++) {
      foreach ($class->mahasiswa as $mahasiswa) {
        AbsensiDetail::create([
          'pertemuan' => $i,
          'id_absensi' => Absensi::latest()->first()->id,
          'id_mahasiswa' => $mahasiswa->id,
          'id_status' => 5,
          'status_absensi' => 0,
        ]);
      }
    }

    return redirect()->route('absensi.index')->with('success', 'Absensi berhasil ditambahkan');
  }

  public function storeMahasiswa(Absensi $absensi, Request $request)
  {
    $validatedData = $request->validate([
      'id_mahasiswa' => 'required',
    ]);

    $absensiDetail = AbsensiDetail::where('id_mahasiswa', $validatedData['id_mahasiswa'])
      ->where('id_absensi', $absensi->id)
      ->first();

    $matakuliahDosen = $absensi->mataKuliah->sks;
    $sks = $matakuliahDosen * 8;

    if (!$absensiDetail) {
      // Tambahkan mahasiswa ke absensi detail
      for ($i = 1; $i <= $sks; $i++) {
        AbsensiDetail::create([
          'pertemuan' => $i, // Anda perlu membuat method getPertemuanSelanjutnya() di model Absensi
          'id_absensi' => $absensi->id,
          'id_mahasiswa' => $validatedData['id_mahasiswa'],
          'id_status' => 5,
          'status_absensi' => 0,
        ]);
      }

      return redirect()->route('absensi.index')->with('success', 'Mahasiswa berhasil ditambahkan ke absensi');
    }

    return redirect()->back()->with('failed', 'Mahasiswa sudah ada di dalam absensi');
  }

  /**
   * Display the specified resource.
   */
  public function show(Absensi $absensi, $pertemuan)
  {
    $absensiDetail = AbsensiDetail::where('id_absensi', $absensi->id);
    $statusAbsensis = StatusAbsensi::all();
    $pertemuan = (int) $pertemuan;
    if ($pertemuan > 64) {
      return redirect()->route('absensi.index')->with('failed', 'Tidak ada pertemuan ke-' . $pertemuan);
    }
    return view('absensi.show')->with(compact('absensi', 'statusAbsensis', 'pertemuan', 'absensiDetail'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Absensi $absensi)
  {
    $mahasiswas = Mahasiswa::with('kelas')->get();
    return view('absensi.tambah', compact('absensi', 'mahasiswas'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateAbsensiRequest $request, Absensi $absensi)
  {
    $pertemuan = (int) $request->input('pertemuan');
    $statusRadios = $request->input('statusRadio', []);

    foreach ($statusRadios as $mahasiswaId => $statusId) {
      AbsensiDetail::where('id_mahasiswa', $mahasiswaId)
        ->where('id_absensi', $absensi->id)
        ->where('pertemuan', $pertemuan)
        ->update([
          'id_status' => $statusId,
          'keterangan' => $request->input('keterangan')[$mahasiswaId] ?? null,
          'status_absensi' => 1
        ]);
    }

    return redirect()->back()->with('success', 'Attendance updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Absensi $absensi)
  {
    AbsensiDetail::where('id_absensi', $absensi->id)->delete();
    $absensi->delete();

    return redirect()->route('absensi.index')->with('success', 'Daftar Hadir berhasil dihapus');
  }

  public function showRekap()
  {
    $dosens = Dosen::all();
    $classes = Kelas::with('mahasiswa')->get();

    if (!auth()->user()->isAdmin) {
      $absensis = Absensi::where('id_dosen', auth()->user()->dosen->first()->id)->get();
      $dosen = Dosen::where('id_user', auth()->user()->id)->first();
      $matakuliahs = MataKuliahDosen::where('id_dosen', $dosen->id)->get();
    } else {
      $absensis = Absensi::all();
      $matakuliahs = MataKuliahDosen::with('matakuliah')->get();
    }

    return view('rekap-absensi.index', compact('absensis', 'dosens', 'classes', 'matakuliahs'));
  }

  public function showRekapPerKelas(Absensi $absensi)
  {
    $matakuliahDosen = $absensi->mataKuliah->sks;
    $sks = $matakuliahDosen * 8;
    $idAbsensi = $absensi->id;
    $statusAbsensis = StatusAbsensi::all();

    $kelas = $absensi->kelas->name;
    $rekapAbsensi = $absensi->absensiDetail->groupBy('mahasiswa.npm');

    return view('rekap-absensi.show')->with(compact('idAbsensi', 'kelas', 'rekapAbsensi', 'statusAbsensis', 'sks'));
  }

  public function generatePDF(Absensi $absensi)
  {
    $matakuliahDosen = $absensi->mataKuliah->sks;
    $sks = $matakuliahDosen * 8;
    $idAbsensi = $absensi->id;
    $dosen = Dosen::where('id_user', auth()->user()->id)->first();

    // $matakuliahDosen = MataKuliahDosen::where('id_dosen', $dosen->id)->all();
    $matakuliahDosen = MataKuliahDosen::where('id_matakuliah', $absensi->id_matakuliah)
      ->where('id_dosen', $absensi->id_dosen)
      ->get();

    $matakuliahDosen = $matakuliahDosen->first();
    $rekapAbsensi = $absensi->absensiDetail->groupBy('mahasiswa.npm');

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $pdf = new Dompdf();

    // return view('template.absensi', compact('absensi', 'matakuliahDosen', 'rekapAbsensi'));die;
    $htmlContent = view('template.absensi', compact('absensi', 'matakuliahDosen', 'rekapAbsensi', 'sks'))->render();
    $pdf->loadHtml($htmlContent);
    $pdf->setPaper('legal', 'landscape');

    $pdf->render();

    return $pdf->stream('absensi.pdf'); // Menggunakan metode stream untuk menampilkan PDF dalam browser
  }
}
