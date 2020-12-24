<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbahPengguna extends FormRequest
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
        $email = ['required', 'email'];
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'peran' => ['required', 'in:admin,staff,customer'],
            'kontak' => ['required_if:peran,customer'],
            'alamat' => ['required_if:peran,customer'],
        ];
    }
}
