<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamGroupPhoto extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'sort_order' => 'integer'];
    }
}
