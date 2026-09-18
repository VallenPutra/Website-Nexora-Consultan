<?php

namespace App\Models;

use Database\Factories\InsightFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insight extends Model
{
    /** @use HasFactory<InsightFactory> */
    use HasFactory;

    protected $fillable = ['slug', 'category', 'title', 'excerpt', 'author', 'published_at', 'body', 'cover_image', 'is_published'];

    protected function casts(): array
    {
        return ['published_at' => 'date', 'is_published' => 'boolean'];
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }
}
