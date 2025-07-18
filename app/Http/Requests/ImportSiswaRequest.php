<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:xlsx,xls|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'File Excel harus diupload',
            'file.mimes' => 'File harus berformat Excel (xlsx, xls)',
            'file.max' => 'Ukuran file maksimal 2MB'
        ];
    }
}
