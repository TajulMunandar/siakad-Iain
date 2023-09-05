<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Survei;
use App\Models\MataKuliah;
use App\Models\SoalSurvei;
use App\Models\SurveiDetail;
use Illuminate\Http\Request;
use App\Exports\SurveiExport;
use App\Models\IndikatorSurvei;
use Maatwebsite\Excel\Facades\Excel;

class SurveiGuestController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $dosens = Dosen::all();
    $matakuliahs = MataKuliah::all();
    $soals = SoalSurvei::all();
    $surveis = $soals->groupBy('id_indikator');
    return view('survei.index')->with(compact('surveis', 'dosens', 'matakuliahs'));
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
        'id_dosen' => 'required',
        'id_matakuliah' => 'required',
        'semester' => 'required',
        'tahun_akademik' => 'required',
        'kendala' => 'required|max:255',
        'saran' => 'required|max:255',
      ]);
      $survei = Survei::create($validatedData);
      $soal = $request->input('id_soal');
      $skala = $request->input('skala_jawaban');


      foreach ($soal as $soa => $index) {
        $validatedData2 = [
          'id_survei' => $survei->id,
          'id_soal' => $soal[$soa],
          'skala_jawaban' => $skala[$index],
        ];

        SurveiDetail::create($validatedData2);
      }
    } catch (\Illuminate\Validation\ValidationException $e) {
      return redirect('/survei-skm')->with('failed', $e->getMessage());
    }


    return redirect('/survei-skm')->with('success', 'Survei baru berhasil dibuat!');
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
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function export2()
  {
    $indikators = IndikatorSurvei::all();
    $surveis = Survei::all();
    $soalsurveis = SoalSurvei::all();

    $jumlahSoalPerIndikator = [];

    $total = [];
    $soals = [];
    $jumlahSoalPerIndikator = [];
    $skala_jawaban = [];


    $skala_jawaban = [];

    foreach ($indikators as $indikator) {
        $jumlahSoalPerIndikator[$indikator->id] = SoalSurvei::where('id_indikator', $indikator->id)->count();

        // Inisialisasi array untuk nilai skala_jawaban per indikator
        $skala_jawaban_per_indikator = [];

        foreach ($surveis as $survei) {
            foreach ($survei->surveiDetail as $detail) {
                // Cari soal_survei yang sesuai dengan id_soal pada tabel soal
              if ($detail->id_survei == $survei->id) {
                $soal_survei = SoalSurvei::where('id', $detail->id_soal)->first();

                // Jika ditemukan soal_survei dengan id_indikator yang sesuai, tambahkan nilai skala_jawaban ke array
                if ($soal_survei && $soal_survei->id_indikator == $indikator->id) {
                    if (!isset($skala_jawaban_per_indikator[$survei->id])) {
                        $skala_jawaban_per_indikator[$survei->id] = 0;
                    }
                    $skala_jawaban_per_indikator[$survei->id] += $detail->skala_jawaban;
                }
              }
            }
        }

      // Simpan hasil per indikator ke dalam array utama
      $skala_jawaban[$indikator->id] = $skala_jawaban_per_indikator;
    }

    // Inisialisasi array hasil
    $resultArray = [];
    // Loop through array A
    foreach ($skala_jawaban as $rowKey => $row) {
      $resultArray[$rowKey] = [];

      // Loop through columns of array A and divide by array B
      foreach ($row as $colKey => $valueA) {
          $valueB = $jumlahSoalPerIndikator[$rowKey];
          $resultArray[$rowKey][$colKey] = $valueA / $valueB;
      }
    }

    $newArray = [];

    foreach ($resultArray as $values) {
        $row = [];
        foreach ($values as $value) {
            $row[] = $value;
        }
        $newArray[] = $row;
    }

    $abjad = range('A', 'Z'); // Array of alphabets


    return view('template.survei', compact('indikators', 'soalsurveis', 'jumlahSoalPerIndikator', 'abjad', 'surveis', 'newArray'));
  }
}
