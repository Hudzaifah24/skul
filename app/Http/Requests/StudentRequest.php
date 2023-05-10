<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'nik' => 'required|min:16|max:16',
            'nisn' => 'required|min:10|max:10',
            'name' => 'required|max:255|string',
            'born' => 'required|date',
            'place_of_birth' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'gender' => 'required|in:Laki-Laki,Perempuan',
        ];
    }

    function messages()
    {
        return [
            'nik.required' => "NIK harus diisi",
            'nik.min' => "NIK harus 16 Karakter",
            'nik.max' => "NIK harus 16 Karakter",
            'nisn.required' => "NISN harus diisi",
            'nisn.min' => "NISN harus 10 Karakter",
            'nisn.max' => "NISN harus 10 Karakter",
            'name.required' => "Nama harus diisi",
            'name.max' => "Nama Maksimal 255 Huruf",
            'name.string' => "Nama Harus Abjad",
            'gender.required' => "Jenis Kelamin harus diisi",
            'gender.in' => "Harus Diisi Laki-Laki & Perempuan",
            'born.required' => "Tanggal Lahir harus diisi",
            'born.date' => "Tanggal Lahir Harus diisi dengan tanggal",
            'place_of_birth.required' => "Tempat Lahir Harus diisi",
            'religion.required' => "Agama Harus diisi",
            'address.required' => 'Alamat Harus Diisi',
        ];
    }
}
