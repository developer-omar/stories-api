<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model {
    use HasFactory;

    protected $table = 'categories';

    public function stories(): HasMany {
        return $this->hasMany(Story::class);
    }

    public function slug(): Attribute {
        return Attribute::make(
            set: fn(?string $value) => is_null($value) ? Str::slug($this->name) : $value
        );
    }
}
