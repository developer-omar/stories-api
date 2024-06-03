<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Chapter extends Model {
    use HasFactory;

    protected $table = 'chapters';

    public function story(): BelongsTo {
        return $this->belongsTo(Story::class, "story_id");
    }

    public function slug(): Attribute {
        return Attribute::make(
            set: fn(?string $value) => is_null($value) ? Str::slug($this->title) : $value
        );
    }
}
