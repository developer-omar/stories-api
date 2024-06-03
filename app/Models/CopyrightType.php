<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CopyrightType extends Model {
    use HasFactory;

    protected $table = 'copyright_types';

    public function stories(): HasMany {
        return $this->hasMany(Story::class);
    }
}
