<?php

namespace App\Http\Controllers;

use App\Models\Cpl;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCplRequest;
use App\Http\Requests\UpdateCplRequest;
use App\Models\Capaian;
use App\Models\CapaianPertemuan;
use App\Models\Cpmk;
use App\Models\DaftarReferensi;

class CplController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    return view('rps.cpl.index');
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
        'id_rps' => 'required',
        'utama' => 'required',
        'penelitian' => 'required',
        'pengabdian' => 'required',
      ]);

      $utamas = $request->input('utama');
      $penelitian = $request->input('penelitian');
      $pengabdian = $request->input('pengabdian');

      $ArraysRef = [$utamas, $penelitian, $pengabdian];

      $maxArrayRef = 0; // Panjang array terbanyak

      // Iterasi melalui semua empat array
      foreach ($ArraysRef as $ref) {
        $arrayLenngt = count($ref);

        // Jika panjang array ini lebih besar dari panjang yang sebelumnya terbanyak
        if ($arrayLenngt > $maxArrayRef) {
          $maxArrayRef = $arrayLenngt; // Simpan panjangnya sebagai panjang terbanyak
        }
      }

      for ($i = 0; $i < $maxArrayRef; $i++) {
        DaftarReferensi::create([
          'id_rps' => $validatedData['id_rps'],
          'utama' => $utamas[$i] ?? "",
          'penelitian' => $penelitian[$i] ?? "",
          'pengabdian' => $pengabdian[$i] ?? "",
        ]);
      }

      $validatedData2 = $request->validate([
        'id_rps' => 'required',
        'desc' => 'required',
        'uas' => 'required',
        'uts' => 'required',
        'tugas' => 'required',
        'kuis' => 'required',
      ]);

      $capaian = Capaian::create($validatedData2);

      $sikaps = $request->input('cpl_sikap');
      $umum = $request->input('cpl_k_umum');
      $khusus = $request->input('cpl_k_khusus');
      $pengetahuan = $request->input('cpl_pengetahuan');

      // Buat array berisi semua empat array
      $allArrays = [$sikaps, $umum, $khusus, $pengetahuan];

      $maxArrayLength = 0; // Panjang array terbanyak

      // Iterasi melalui semua empat array
      foreach ($allArrays as $array) {
        $arrayLength = count($array);

        // Jika panjang array ini lebih besar dari panjang yang sebelumnya terbanyak
        if ($arrayLength > $maxArrayLength) {
          $maxArrayLength = $arrayLength; // Simpan panjangnya sebagai panjang terbanyak
        }
      }
      for ($i = 0; $i < $maxArrayLength; $i++) {
        Cpl::create([
          'id_capaian' => $capaian->id,
          'cpl_sikap' => $sikaps[$i] ?? "",
          'cpl_k_umum' => $umum[$i] ?? "",
          'cpl_k_khusus' => $khusus[$i] ?? "",
          'cpl_pengetahuan' => $pengetahuan[$i] ?? "",
        ]);
      }



      $sikaps2 = $request->input('cpmk_sikap');
      $umum2 = $request->input('cpmk_k_umum');
      $khusus2 = $request->input('cpmk_k_khusus');
      $pengetahuan2 = $request->input('cpmk_pengetahuan');

      // Buat array berisi semua empat array
      $allArrays2 = [$sikaps2, $umum2, $khusus2, $pengetahuan2];

      $maxArrayLength2 = 0; // Panjang array terbanyak

      // Iterasi melalui semua empat array
      foreach ($allArrays2 as $array2) {
        $arrayLength2 = count($array2);

        // Jika panjang array ini lebih besar dari panjang yang sebelumnya terbanyak
        if ($arrayLength2 > $maxArrayLength2) {
          $maxArrayLength2 = $arrayLength2; // Simpan panjangnya sebagai panjang terbanyak
        }
      }

      for ($i = 0; $i < $maxArrayLength2; $i++) {
        Cpmk::create([
          'id_capaian' => $capaian->id,
          'cpmk_sikap' => $sikaps2[$i] ?? "",
          'cpmk_k_umum' => $umum2[$i] ?? "",
          'cpmk_k_khusus' => $khusus2[$i] ?? "",
          'cpmk_pengetahuan' => $pengetahuan2[$i] ?? "",
        ]);
      }

      $sub_cpmks = $request->input('sub_cpmk');
      $materi = $request->input('materi');
      $metode = $request->input('metode');
      $waktu = $request->input('waktu');
      $pengalaman = $request->input('pengalaman');
      $indikator = $request->input('indikator');
      $nilai = $request->input('nilai');
      foreach ($sub_cpmks as $index4 => $sub_cpmk) {
        CapaianPertemuan::create([
          'id_rps' => $request->id_rps,
          'sub_cpmk' => $sub_cpmk,
          'materi' => $materi[$index4],
          'metode' => $metode[$index4],
          'waktu' => $waktu[$index4],
          'pengalaman' => $pengalaman[$index4],
          'indikator' => $indikator[$index4],
          'nilai' => $nilai[$index4],
        ]);
      }
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect()->route('cpl.index', ['id' => $request->id])->with('failed', $e->getMessage());
    }

    return redirect('/dashboard/data-rps/rps')->with('success', 'Rencana Perkuliahan Semester baru berhasil dibuat!');
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request)
  {
    $id = request('rps');
    $capaians = Capaian::where('id_rps', $id)->first();
    // cpl
    $id_cpl = Cpl::whereNotNull('id')->where('id_capaian', $capaians->id)->get();
    $sikap_cpl = Cpl::whereNotNull('cpl_sikap')->where('id_capaian', $capaians->id)->get();
    $k_umum_cpl = Cpl::whereNotNull('cpl_k_umum')->where('id_capaian', $capaians->id)->get();
    $k_khusus_cpl = Cpl::whereNotNull('cpl_k_khusus')->where('id_capaian', $capaians->id)->get();
    $pengetahuan_cpl = Cpl::whereNotNull('cpl_pengetahuan')->where('id_capaian', $capaians->id)->get();
    // cpmk
    $id_cpmk = Cpmk::whereNotNull('id')->where('id_capaian', $capaians->id)->get();
    $pengetahuan_cpmk = Cpmk::whereNotNull('cpmk_pengetahuan')->where('id_capaian', $capaians->id)->get();
    $k_umum_cpmk = Cpmk::whereNotNull('cpmk_k_umum')->where('id_capaian', $capaians->id)->get();
    $k_khusus_cpmk = Cpmk::whereNotNull('cpmk_k_khusus')->where('id_capaian', $capaians->id)->get();
    $sikap_cpmk = Cpmk::whereNotNull('cpmk_sikap')->where('id_capaian', $capaians->id)->get();

    $daftarId = DaftarReferensi::whereNotNull('id')->where('id_rps', $id)->get();
    $daftarUtama = DaftarReferensi::whereNotNull('utama')->where('id_rps', $id)->get();
    $daftarPenelitian = DaftarReferensi::whereNotNull('penelitian')->where('id_rps', $id)->get();
    $daftarPengabdian = DaftarReferensi::whereNotNull('pengabdian')->where('id_rps', $id)->get();

    $pertemuans = CapaianPertemuan::where('id_rps', $id)->get();
    return view('rps.cpl.update')->with(compact(
      'id',
      'capaians',
      'daftarId',
      'daftarUtama',
      'daftarPenelitian',
      'daftarPengabdian',
      'pertemuans',
      'id_cpl',
      'sikap_cpl',
      'k_umum_cpl',
      'k_khusus_cpl',
      'pengetahuan_cpl',
      'id_cpmk',
      'pengetahuan_cpmk',
      'k_umum_cpmk',
      'k_khusus_cpmk',
      'sikap_cpmk'
    ));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Cpl $cpl)
  {
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    try {
      $utamas = $request->input('utama');
      $penelitian = $request->input('penelitian');
      $pengabdian = $request->input('pengabdian');
      $daftarId = $request->input('daftarId');

      $ArraysRef = [$utamas, $penelitian, $pengabdian];

      $maxArrayRef = 0; // Panjang array terbanyak

      // Iterasi melalui semua empat array
      foreach ($ArraysRef as $ref) {
        $arrayLenngt = count($ref);

        // Jika panjang array ini lebih besar dari panjang yang sebelumnya terbanyak
        if ($arrayLenngt > $maxArrayRef) {
          $maxArrayRef = $arrayLenngt; // Simpan panjangnya sebagai panjang terbanyak
        }
      }

      for ($i = 0; $i < $maxArrayRef; $i++) {
        // Mencari entri dengan kriteria tertentu
        $existingEntry = DaftarReferensi::where('id', $daftarId[$i])->first();

        if ($existingEntry) {
          // Jika entri sudah ada, lakukan update pada kolom yang sesuai
          $existingEntry->update([
            'utama' => $utamas[$i] ?? $existingEntry->utama,
            'penelitian' => $penelitian[$i] ?? $existingEntry->penelitian,
            'pengabdian' => $pengabdian[$i] ?? $existingEntry->pengabdian,
          ]);
        } else {
          // Jika entri tidak ada, buat entri baru
          DaftarReferensi::create([
            'id_rps' => $request->id_rps,
            'utama' => $utamas[$i] ?? "",
            'penelitian' => $penelitian[$i] ?? "",
            'pengabdian' => $pengabdian[$i] ?? "",
          ]);
        }
      }

      // dd($request);

      // for ($i = 0; $i < $maxArrayRef; $i++) {
      //   DaftarReferensi::where('id_rps', $request->id_rps)->update([
      //     'id_rps' => $validatedData['id_rps'],
      //     'utama' => $utamas[$i] ?? "",
      //     'penelitian' => $penelitian[$i] ?? "",
      //     'pengabdian' => $pengabdian[$i] ?? "",
      //   ]);
      // }

      $validatedData2 = $request->validate([
        'id_rps' => 'required',
        'desc' => 'required',
        'uas' => 'required',
        'uts' => 'required',
        'tugas' => 'required',
        'kuis' => 'required',
      ]);

      $capaian = Capaian::where('id_rps', $request->id_rps)->update($validatedData2);
      $sikaps = $request->input('cpl_sikap');
      $umum = $request->input('cpl_k_umum');
      $khusus = $request->input('cpl_k_khusus');
      $pengetahuan = $request->input('cpl_pengetahuan');
      $ids = $request->input('cpl_id');
      // Buat array berisi semua empat array
      $allArrays = [$sikaps, $umum, $khusus, $pengetahuan, $ids];

      $maxArrayLength = 0; // Panjang array terbanyak

      // Iterasi melalui semua empat array
      foreach ($allArrays as $array) {
        $arrayLength = count($array);

        // Jika panjang array ini lebih besar dari panjang yang sebelumnya terbanyak
        if ($arrayLength > $maxArrayLength) {
          $maxArrayLength = $arrayLength; // Simpan panjangnya sebagai panjang terbanyak
        }
      }

      for ($i = 0; $i < $maxArrayLength; $i++) {
        Cpl::where('id', $ids[$i])->update([
          'id_capaian' => $capaian,
          'cpl_sikap' => $sikaps[$i] ?? "",
          'cpl_k_umum' => $umum[$i] ?? "",
          'cpl_k_khusus' => $khusus[$i] ?? "",
          'cpl_pengetahuan' => $pengetahuan[$i] ?? "",
        ]);
      }      

      $sikaps2 = $request->input('cpmk_sikap');
      $umum2 = $request->input('cpmk_k_umum');
      $khusus2 = $request->input('cpmk_k_khusus');
      $pengetahuan2 = $request->input('cpmk_pengetahuan');
      $ids2 = $request->input('cpmk_id');

      // Buat array berisi semua empat array
      $allArrays2 = [$sikaps2, $umum2, $khusus2, $pengetahuan2, $ids2];

      $maxArrayLength2 = 0; // Panjang array terbanyak

      // Iterasi melalui semua empat array
      foreach ($allArrays2 as $array2) {
        $arrayLength2 = count($array2);

        // Jika panjang array ini lebih besar dari panjang yang sebelumnya terbanyak
        if ($arrayLength2 > $maxArrayLength2) {
          $maxArrayLength2 = $arrayLength2; // Simpan panjangnya sebagai panjang terbanyak
        }
      }

      for ($i = 0; $i < $maxArrayLength2; $i++) {
        Cpmk::where('id', $ids2[$i])->update([
          'id_capaian' => $capaian,
          'cpmk_sikap' => $sikaps2[$i] ?? "",
          'cpmk_k_umum' => $umum2[$i] ?? "",
          'cpmk_k_khusus' => $khusus2[$i] ?? "",
          'cpmk_pengetahuan' => $pengetahuan2[$i] ?? "",
        ]);
      }

      $sub_cpmks = $request->input('sub_cpmk');
      $materi = $request->input('materi');
      $metode = $request->input('metode');
      $waktu = $request->input('waktu');
      $pengalaman = $request->input('pengalaman');
      $indikator = $request->input('indikator');
      $nilai = $request->input('nilai');
      foreach ($sub_cpmks as $index4 => $sub_cpmk) {
        CapaianPertemuan::where('id_rps', $request->id_rps)->update([
          'id_rps' => $request->id_rps,
          'sub_cpmk' => $sub_cpmk,
          'materi' => $materi[$index4],
          'metode' => $metode[$index4],
          'waktu' => $waktu[$index4],
          'pengalaman' => $pengalaman[$index4],
          'indikator' => $indikator[$index4],
          'nilai' => $nilai[$index4],
        ]);
      }
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect()->route('cpl.index', ['id' => $request->id])->with('failed', $e->getMessage());
    }

    return redirect('/dashboard/data-rps/rps')->with('success', 'Rencana Perkuliahan Semester baru berhasil dibuat!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Cpl $cpl)
  {
    //
  }
}
