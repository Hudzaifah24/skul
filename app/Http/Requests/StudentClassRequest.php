<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentClassRequest extends FormRequest
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
            'student_id' => 'required',
            'class_id' => 'required',
            'period_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Murid harus diisi',
            'class_id.required' => 'Kelas harus diisi',
            'period_id.required' => 'Priode harus diisi',
        ];
    }
}
