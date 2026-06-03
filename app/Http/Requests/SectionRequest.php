<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class SectionRequest extends ApiRequest
{
    public function rules(): array
    {
        $sectionId = $this->route('section');

        return [
            'name' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('sections', 'slug')->ignore($sectionId),
            ],

            'field_schema' => ['nullable', 'array'],

            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama section wajib diisi.',
            'name.string' => 'Nama section harus berupa teks.',
            'name.max' => 'Nama section maksimal 255 karakter.',

            'slug.string' => 'Slug harus berupa teks.',
            'slug.max' => 'Slug maksimal 255 karakter.',
            'slug.unique' => 'Slug section sudah digunakan.',

            'field_schema.array' => 'Field schema harus berupa array.',
            'is_active.boolean' => 'Status aktif harus berupa boolean.',
        ];
    }
}
