<?php

namespace App\Models;

use App\Enums\ImageTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Story extends Model {
    use HasFactory;

    protected $table = 'stories';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    protected $fillable = [
        'cover_image',
        'title',
        'slug',
        'description',
        'tags',
        'raiting',
        'story_status',
        'category_id',
        'audience_type_id',
        'copyright_type_id',
        'user_id',
        'deleted_state',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function audienceType(): BelongsTo {
        return$this->belongsTo(AudienceType::class);
    }

    public function copyrightType(): BelongsTo {
        return $this->belongsTo(CopyrightType::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function chapters(): HasMany {
        return $this->hasMany(Chapter::class);
    }

    //Accessors
    public function coverImage(): Attribute {
        return Attribute::make(
            get: fn($value) => config('app.url') . Storage::url('images/' . ImageTypeEnum::STORY->value . '/' . $value)
        );
    }

    public function slug(): Attribute {
        return Attribute::make(
            set: fn(?string $value ) => is_null($value) ? Str::slug($this->title) : $value
        );
    }
}
