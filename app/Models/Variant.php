<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Variant extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'section_id',
        'theme_id',
        'layout_config',
        'is_active',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'layout_config' => 'array',
        'is_active' => 'boolean',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }
}
