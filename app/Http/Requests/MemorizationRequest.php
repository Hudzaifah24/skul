<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemorizationRequest extends FormRequest
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
            'surah' => 'required|max:255',
            'juz' => 'required|max:30',
            'ayat_from' => 'required|max:600',
            'ayat_to' => 'required|max:600',
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'surah.required' => 'Surah harus diisi',
            'juz.required' => 'Juz harus diisi',
            'juz.max' => 'Tidak boleh lebih dari 30 juz',
            'ayat_from.required' => 'Mulai dari ayat?',
            'ayat_from.max' => 'Tidak boleh lebih dari 600 ayat',
            'ayat_to.required' => 'Sampai Ayat ?',
            'ayat_to.max' => 'Tidak boleh lebih dari 600 ayat',
            'date.required' => 'Waktu harus ditetapkan',
            'date.date' => 'harus diisi dengan waktu'
        ];
    }
}
