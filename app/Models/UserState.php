<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserState extends Model {
    use HasFactory;

    protected $table = 'user_states';
    public const ACTIVE = 1;
    public const INACTIVE = 2;
    public const SUSPENDED = 3;
    public const BANNED = 4;

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
}
