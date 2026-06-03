<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            'theme' => $this->whenLoaded('theme', function () {
                return [
                    'id' => $this->theme->id,
                    'name' => $this->theme->name,
                ];
            }),

            'section' => $this->whenLoaded('section', function () {
                return [
                    'id' => $this->section->id,
                    'name' => $this->section->name,
                    'slug' => $this->section->slug,
                ];
            }),

            'theme_id' => $this->theme_id,
            'section_id' => $this->section_id,
            'layout_config' => $this->layout_config,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
