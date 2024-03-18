<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTotalPulangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'asal' => 'required',
            'tujuan' => 'required',
            'tgl_penerbangan' => 'required',
            'maskapai' => 'required',
            'booking_reference' => 'required',
            'no_eticket' => 'required',
            'no_penerbangan' => 'required',
            'total_harga' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'total_harga' => str_replace('.', '', $this->input('total_harga'))
        ]);
    }
}
