<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'account_number' => 'required|min:16|max:16|integer',
            'name_bank' => 'required|min:3|max:10|string',
            'nasabah' => 'required|min:5|max:12|string',
            'student_id' => 'required'
        ];
    }

    function messages()
    {
        return [
            'account_number.required' => "Account Number Harus Diisi",
            'account_number.min' => "Harus 16 Karakter",
            'account_number.max' => "Harus 16 Karakter",
            'account_number.integer' => "Harus Angka",
            'name_bank.required' => "Name_bank Harus Diisi",
            'name_bank.min' => "Minimal 3 Karakter",
            'name_bank.max' => "Maksimal 16 Karakter",
            'name_bank.string' => "Harus Abjad", 
            'nasabah.required' => "Nasabah Harus Diisi",
            'nasabah.min' => "Minimal 5 Karakter",
            'nasabah.max' => "Maksimal 12 Karakter",
            'nasabah.string' => "Harus Abjad", 
            'student_id.required' => "Student_Id Harus Diisi",
        ];
    }
}
