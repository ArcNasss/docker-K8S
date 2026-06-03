<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Theme extends Model
{
    use HasUuids;
    protected $fillable = [
        'name',
        'style_config',
        'is_active',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'style_config' => 'array',
        'is_active' => 'boolean',
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function tenantThemes(): HasMany
    {
        return $this->hasMany(TenantTheme::class);
    }
}
