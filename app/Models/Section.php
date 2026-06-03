<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Section extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'slug',
        'field_schema',
        'is_active',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'field_schema' => 'array',
        'is_active' => 'boolean',
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }
}
