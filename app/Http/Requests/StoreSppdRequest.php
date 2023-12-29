<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pegawai' => 'required',
            'jenis_tugas_id' => 'required',
            'total_biaya' => 'required|numeric'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'total_biaya' => str_replace('.', '', $this->input('total_biaya')),
        ]);
    }
}
