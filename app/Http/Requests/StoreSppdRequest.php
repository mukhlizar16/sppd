<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSppdRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomor_sp2d' => 'required',
            'jenis_tugas_id' => 'required',
            'kegiatan' => 'required|max:250',
            'total_biaya' => 'required|numeric',
            'pegawai' => 'required|array',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'total_biaya' => str_replace('.', '', $this->input('total_biaya')),
        ]);
    }
}
