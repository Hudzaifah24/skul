<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasRequest extends FormRequest
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
            'name' => 'required|max:200'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kelas harus diisi',
            'name.max' => 'Nama kelas tidak boleh lebih dari 200 huruf'
        ];
    }
}
