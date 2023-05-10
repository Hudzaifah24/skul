<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'book' => 'required|max:255',
            'author' => 'required|max:255',
            'publiser' => 'required|max:255',
            'loan_date' => 'required|date',
            'return_date' => 'required|date',
            'status' => 'required|in:already,not yet',
        ];
    }

    public function messages()
    {
        return [
            'book.required' => 'Buku harus diisi',
            'book.max' => 'Buku tidak boleh lebih dari 255 huruf',
            'author.required' => 'Penulis harus diisi',
            'author.max' => 'Penulis tidak boleh lebih dari 255 huruf',
            'publiser.required' => 'Penerbit harus diisi',
            'publiser.max' => 'Penerbit tidak boleh lebih dari 255 huruf',
            'loan_date.required' => 'Waktu peminjaman harus diisi',
            'loan_date.date' => 'Waktu peminjaman harus diisi dengan waktu',
            'return_date.required' => 'Waktu kembali harus diisi',
            'return_date.date' => 'Waktu kembali harus diisi dengan waktu',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status harus diisi dengan already atau not yet',
        ];
    }
}
