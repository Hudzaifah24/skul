<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SppRequest extends FormRequest
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
            'class_id' => 'required',
            'amount' => 'required',
            'deadline' => 'required|date',
            'period' => 'required',
            'month' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Jumlah besaran harus diisi',
            'deadline.required' => 'Tenggat waktu harus diisi',
            'deadline.date' => 'Tenggat waktu harus diisi dengan waktu',
            'month.required' => 'Bulan harus diisi',
            'period.required' => 'Priode harus diisi',
            'class_id.required' => 'Kelas harus diisi',
        ];
    }
}
