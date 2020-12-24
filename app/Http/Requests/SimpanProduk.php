<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanProduk extends FormRequest
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
            'produk_nama' => ['required', 'string'],
            'produk_stok' => ['required', 'integer', 'min:0'],
            'produk_diskon' => ['required', 'integer', 'min:0'],
            'produk_deskripsi' => ['nullable', 'string'],
            'produk_gambar' => ['nullable', 'image']
        ];
    }
}
