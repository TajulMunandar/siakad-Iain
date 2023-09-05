<?php

namespace App\Exports;

use App\Models\Survei;
use App\Models\SoalSurvei;
use App\Models\IndikatorSurvei;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class SurveiExport implements FromView
{
  use Exportable;

  protected $indikators;
    protected $soalsurveis;
    protected $jumlahSoalPerIndikator;
    protected $abjad;

    public function __construct()
    {
        $this->indikators = IndikatorSurvei::all();
        $this->soalsurveis = SoalSurvei::all();

        $this->jumlahSoalPerIndikator = [];
        foreach ($this->indikators as $indikator) {
            $this->jumlahSoalPerIndikator[$indikator->id] = $this->soalsurveis
                ->where('id_indikator', $indikator->id)->count();
        }

        $this->abjad = range('A', 'Z'); // Array of alphabets
    }

    public function view(): View
    {
        return view('template.survei', [
            'indikators' => $this->indikators,
            'jumlahSoalPerIndikator' => $this->jumlahSoalPerIndikator,
            'abjad' => $this->abjad,
        ]);
    }
}
