<?php

namespace App\Http\Requests;

class VariantRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'section_id' => [
                'required',
                'string',
                'exists:sections,id',
            ],

            'theme_id' => [
                'required',
                'string',
                'exists:themes,id',
            ],

            'layout_config' => [
                'nullable',
                'array',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama variant wajib diisi.',
            'name.string' => 'Nama variant harus berupa teks.',
            'name.max' => 'Nama variant maksimal 255 karakter.',

            'section_id.required' => 'Section wajib dipilih.',
            'section_id.exists' => 'Section tidak ditemukan.',

            'theme_id.required' => 'Theme wajib dipilih.',
            'theme_id.exists' => 'Theme tidak ditemukan.',

            'layout_config.array' => 'Layout config harus berupa array.',
            'is_active.boolean' => 'Status aktif harus berupa boolean.',
        ];
    }
}
