<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'name' => 'required|max:100',
            'sum' => 'required',
            'deadline' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama penagihan harus jelas',
            'name.max' => 'Nama penagihan tidak boleh lebih dari 100 huruf',
            'sum.required' => 'Jumlah besaran harus diisi',
            'deadline.required' => 'Tenggat waktu harus diisi',
            'deadline.date' => 'Tenggat waktu harus diisi dengan waktu',
        ];
    }
}
