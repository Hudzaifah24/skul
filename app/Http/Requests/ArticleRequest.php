<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required|max:20|string',
            'content' => 'required|max:1000',
        ];
    }

    function messages()
    {
        return [
            'user_id.required' => "Pengolah Harus Diisi",
            'category_id.required' => "Kategori Harus Diisi",
            'title.required' => "Judul Harus Diisi",
            'title.max' => "Judul Harus Diisi Maksimal 20 Character",
            'title.string' => 'Judul Harus Diisi Dengan Abjad',
            'content.required' => 'Konten Harus Diisi',
            'content.max' => "Konten Harus Diisi Maksimal 1000 Character",
        ];
    }
}
