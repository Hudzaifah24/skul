<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LearningRequest extends FormRequest
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
            'name' => 'required|max:50',
            'order' => 'required|integer',
            'hour_from' => 'required|max:50',
            'hour_to' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama pelajaran harus diisi',
            'name.max' => 'Nama pelajaran tidak boleh lebih dari 50 kata',
            'order.required' => 'Urutan pelajaran harus diisi',
            'order.integer' => 'Urutan pelajaran harus diisi dengan angka',
            'hour_from.required' => 'Jam mulai harus diisi',
            'hour_from.max' => 'Jam tidak boleh lebih dari 50 angka',
            'hour_to.required' => 'Jam selesai harus diisi',
            'hour_to.max' => 'Jam tidak boleh lebih dari 50 angka',
        ];
    }
}
