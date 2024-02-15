<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAkomodasiRequest extends FormRequest
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
            'name_hotel' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'nomor_invoice' => 'required',
            'nomor_kamar' => 'required',
            'lama_inap' => 'required',
            'nama_kwitansi' => 'required',
            'harga' => 'required',
            'harga_diskon' => 'required',
            'bbm' => 'required',
            'dari' => 'required',
            'ke' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_hotel' => 'Nama hotel'
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'harga' => str_replace('.', '', $this->input('harga')),
            'harga_diskon' => str_replace('.', '', $this->input('harga_diskon')),
            'bbm' => str_replace('.', '', $this->input('bbm')),
        ]);
    }
}
