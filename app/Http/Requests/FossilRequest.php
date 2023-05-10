<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FossilRequest extends FormRequest
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
            'name' => 'required|max:255',
            'income' => 'required',
            'religion' => 'required',
            'education' => 'required|in:SD,SMP,SMA,S1,S2,S3',
            'work' => 'required|max:255',
            'phone_number' => 'required|max:20|min:1'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama tidak boleh lebih dari 255 huruf',
            'income.required' => 'Penghasilan harus diisi',
            'religion.required' => 'Agama harus diisi',
            'education.required' => 'Pendidikan terakhir harus diisi',
            'education.in' => 'Pendidikan terakhir harus diisi dengan SD, SMP, SMA, S1, S2 atau S3',
            'work.required' => 'Pekerjaan harus diisi',
            'work.max' => 'Pekerjaan tidak boleh lebih dari 255 huruf',
            'phone_number.required' => 'Nomor telepon wajib diisi',
            'phone_number.min' => 'Nomor telepon minimal 1',
            'phone_number.max' => 'Nomor telepon maximal 20',
        ];
    }
}
