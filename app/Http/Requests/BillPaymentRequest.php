<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required',
            'proof' => 'required|file|mimes:png,jpg,jpeg,',
            'student_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Besaran bayar harus diisi',
            'proof.required' => 'Bukti harus diisi',
            'proof.file' => 'Bukti harus berupa file',
            'proof.mimes' => 'Bukti harus berisi png, jpg atau jpeg',
            'student_id.required' => 'Siswa harus diisi',
        ];
    }
}
