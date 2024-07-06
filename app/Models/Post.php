<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Mews\Purifier\Facades\Purifier;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'content',
    ];

    protected $casts = [
        'content' => 'string',
    ];

    public function searchableAs(): string {
        return 'post_index';
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function getExcerptAttribute(): string {
        return Str::limit(Purifier::clean($this->content), 150);
    }
}
