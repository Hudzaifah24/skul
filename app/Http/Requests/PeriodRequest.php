<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodRequest extends FormRequest
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
            'year_start' => 'required|integer|max:5000',
            'year_end' => 'required|integer|max:5000',
            'status' => 'required|in:Active,Not active'
        ];
    }

    public function messages()
    {
        return [
            'year_start.required' => 'Tahun mulai ajaran harus diisi',
            'year_start.integer' => 'Tahun ajaran harus diisi dengan angka',
            'year_start.max' => 'Tahun ajaran tidak boleh lebih dari 5000 tahun',
            'year_end.required' => 'Tahun penutup ajaran harus diisi',
            'year_end.integer' => 'Tahun ajaran harus diisi dengan angka',
            'year_end.max' => 'Tahun ajaran tidak boleh lebih dari 5000 tahun',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status harus diisi Aktif atau Tidak Aktif',
        ];
    }
}
