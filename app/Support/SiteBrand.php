<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SiteBrand
{
    public function logoUrl(): string
    {
        $path = Cache::rememberForever('site.brand.logo_path', fn (): string => (string) SiteSetting::query()->where('key', 'logo_path')->value('value')
        );

        $disk = Storage::disk('public');

        return $path !== '' && $disk->exists($path) ? $disk->url($path) : asset('images/nit-logo.svg');
    }
}
