<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'email' => 'required|email|max:255',
            'role' => 'nullable',
            'position' => 'required',
            'nik' => 'required|min:16|max:16',
            'phone_number' => 'required|max:20',
            'gender' => 'required|in:Laki-Laki,Perempuan',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama tidak boleh lebih dari 255 huruf',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Isi dengan email',
            'email.max' => 'Email tidak boleh lebih dari 255 angka dan huruf',
            'nik.required' => 'NIK harus diisi',
            'nik.min' => 'NIK tidak boleh kurang dari 16 angka',
            'nik.max' => 'NIK tidak boleh lebih dari 16 angka',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 20 angka',
            'gender.required' => 'Jenis kelamin harus diisi',
            'gender.in' => 'Jenis kelamin harus diisi dengan Laki-Laki atau Perempuan',
            'position.required' => 'Position Harus Diisi'
        ];
    }
}
