<?php

namespace App\Support;

use App\Models\Insight;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class SiteContent
{
    /**
     * "Solutions" mega menu + /solutions/{slug} pages.
     */
    public static function solutions(): array
    {
        return __('content.solutions');
    }

    /**
     * "Services" mega menu + /services/{slug} pages.
     */
    public static function services(): array
    {
        $content = __('content.services');

        if (! Schema::hasTable('services')) {
            return $content;
        }

        $services = Service::active()->orderBy('sort_order')->orderBy('title')->get()->keyBy('slug');

        return collect($content)
            ->filter(fn (array $item, string $slug): bool => $services->has($slug))
            ->map(function (array $item, string $slug) use ($services): array {
                $service = $services->get($slug);

                if (app()->getLocale() !== 'en') {
                    return $item;
                }

                return [...$item, 'title' => $service->title, 'short' => $service->short ?: $item['short']];
            })
            ->all();
    }

    /**
     * "Industries" mega menu + /industries/{slug} pages.
     */
    public static function industries(): array
    {
        return __('content.industries');
    }

    /**
     * Insights / blog articles.
     */
    public static function insights(): array
    {
        $content = __('content.insights');

        if (! Schema::hasTable('insights')) {
            return $content;
        }

        $insights = Insight::published()->orderByDesc('published_at')->orderByDesc('id')->get()->keyBy('slug');

        return collect($content)
            ->filter(fn (array $item, string $slug): bool => $insights->has($slug))
            ->map(function (array $item, string $slug) use ($insights): array {
                $insight = $insights->get($slug);
                $image = $insight->cover_image ? Storage::disk('public')->url($insight->cover_image) : null;

                if (app()->getLocale() !== 'en') {
                    return [...$item, 'image' => $image];
                }

                return [...$item, 'category' => $insight->category, 'title' => $insight->title, 'excerpt' => $insight->excerpt, 'author' => $insight->author, 'date' => $insight->published_at?->format('Y-m-d') ?? $item['date'], 'body' => $insight->body ? [['type' => 'p', 'text' => $insight->body]] : $item['body'], 'image' => $image];
            })
            ->all();
    }

    public static function team(): array
    {
        $content = __('content.team');

        if (! Schema::hasTable('team_members')) {
            return $content;
        }

        $members = TeamMember::active()->orderBy('sort_order')->orderBy('name')->get();
        $translatedMembers = collect($content)->keyBy('name');

        return $members->map(function (TeamMember $member) use ($translatedMembers): array {
            if (app()->getLocale() !== 'en' && $translatedMembers->has($member->name)) {
                return $translatedMembers->get($member->name);
            }

            return [
                'name' => $member->name,
                'role' => $member->role,
                'expertise' => $member->expertise,
                'bio' => $member->bio,
            ];
        })->all();
    }

    public static function careers(): array
    {
        return __('content.careers');
    }

    public static function partners(): array
    {
        return __('content.partners');
    }
}
