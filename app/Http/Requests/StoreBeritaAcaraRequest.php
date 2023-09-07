<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaAcaraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
      return [
        'id_kelas' => 'required|exists:kelas,id',
        'id_dosen' => 'required|exists:dosens,id',
        'id_matakuliah' => 'required|exists:mata_kuliahs,id',
        'tahun_akademik' => 'required',
        'semester' => 'required',
    ];
    }
}
