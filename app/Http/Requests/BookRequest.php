<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'kategori_id' => 'required|numeric',
            'judul' => 'required|string|min:4|',
            'pengarang' => 'required|string|min:4',
            'penerbit' => 'required|string|min:4',
            'tahun_terbit' => 'required|numeric',
            'sampul' => 'required',
            'sinopsis' => 'required|string|min:6',
        ];
    }
}
