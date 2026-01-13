<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NavbarItem;
use App\Models\FooterItem;
use App\Models\SiteBranding;
use App\Models\MarqueeText;
use Illuminate\Support\Facades\Storage;

class NavigationController extends Controller
{
    public function header()
    {
        $items = NavbarItem::query()
            ->active()->topLevel()->ordered()
            ->with(['children' => function ($q) { $q->active()->ordered(); }])
            ->get()
            ->map(function (NavbarItem $item) {
                return [
                    'name' => $item->name,
                    'href' => $item->href,
                    'target' => $item->target,
                    'dropdown' => $item->children->map(function (NavbarItem $child) {
                        return [
                            'name' => $child->name,
                            'href' => $child->href,
                            'target' => $child->target,
                        ];
                    })->values(),
                ];
            })->values();

        $branding = SiteBranding::first();
        
        $marqueeTexts = MarqueeText::query()
            ->active()
            ->ordered()
            ->get()
            ->map(function (MarqueeText $marquee) {
                return [
                    'text' => $marquee->text,
                    'color' => $marquee->color,
                    'speed' => $marquee->speed,
                ];
            })->values();

        return response()->json([
            'menu' => $items,
            'branding' => [
                'header_logo' => $branding?->header_logo ? Storage::disk('public')->url($branding->header_logo) : null,
            ],
            'marquee' => $marqueeTexts,
        ]);
    }

    public function footer()
    {
        $categories = ['menu-utama', 'informasi-akademik', 'sosial', 'lainnya'];

        $data = [];
        foreach ($categories as $cat) {
            $data[$cat] = FooterItem::query()->active()->byCategory($cat)->ordered()->get()->map(function (FooterItem $item) {
                return [
                    'name' => $item->name,
                    'href' => $item->href,
                    'target' => $item->target,
                ];
            })->values();
        }

        $branding = SiteBranding::first();

        return response()->json([
            'links' => $data,
            'branding' => [
                'footer_brand_type' => $branding?->footer_brand_type ?? 'text',
                'footer_brand_text' => $branding?->footer_brand_text,
                'footer_brand_image' => $branding?->footer_brand_image ? Storage::disk('public')->url($branding->footer_brand_image) : null,
            ],
        ]);
    }
} 