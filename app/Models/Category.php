<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value; // Air Jordan Flying
        $this->attributes['slug'] = Str::slug($value); // air-jordan-flying (auto)
    }

    // Relasi: satu kategori bisa punya banyak sepatu
    public function shoes(): HasMany
    {
        return $this->hasMany(Shoe::class);
    }
}
