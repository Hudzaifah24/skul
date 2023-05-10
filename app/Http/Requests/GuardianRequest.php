<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardianRequest extends FormRequest
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
           'name' => 'required|max:225',
           'relationship' => 'required',
           'work' => 'required|max:255',
           'phone_number' => 'required|max:20',
           'religion' => 'required',
           'education' => 'required|in:SD,SMP,SMA,S1,S2,S3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama tidak boleh lebih dari 255 huruf',
            'relationship.required' => 'Hubungan harus diisi',
            'work.required' => 'Pekerjaan harus diisi',
            'phone_number.required' => 'Nomor Hp harus diisi',
            'phone_number.max' => 'Nomor Hp tidak boleh lebih dari 20 angka',
            'religion.required' => 'Agama harus diisi',
            'education.required' => 'Pendidikan terakhir harus diisi',
            'education.in' => 'Pendidikan terakhir harus diisi dengan SD, SMP, SMA, S1, S2, S3',
            'work.required' => 'Pekerjaan harus diisi',
            'work.max' => 'Pekerjaan tidak boleh lebih dari 255 huruf',
        ];
    }
}
