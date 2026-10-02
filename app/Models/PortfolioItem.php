<?php

namespace App\Models;

use Database\Factories\PortfolioItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    /** @use HasFactory<PortfolioItemFactory> */
    use HasFactory;

    public const CATEGORIES = [
        'website' => 'Website',
        'application' => 'Application',
        'consulting' => 'Consulting',
        'multimedia' => 'Multimedia',
    ];

    protected $fillable = [
        'name_id',
        'name_en',
        'work_id',
        'work_en',
        'category',
        'image_path',
        'sort_order',
    ];

    protected function casts(): array
    {
        return ['sort_order' => 'integer'];
    }

    public function localizedName(): string
    {
        return app()->getLocale() === 'en' ? $this->name_en : $this->name_id;
    }

    public function localizedWork(): string
    {
        return app()->getLocale() === 'en' ? $this->work_en : $this->work_id;
    }
}
