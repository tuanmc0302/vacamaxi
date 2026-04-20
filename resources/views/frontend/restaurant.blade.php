@extends('frontend.master')

@php
    $pageTitle = 'Dịch vụ - Nhà hàng - VACAMAXI';
    $metaDescription = 'Không gian steak & grill cao cấp của VACAMAXI';
    $active = 'restaurant';

    $splitLines = function (?string $text) {
        return collect(preg_split('/\s*\|\s*/u', (string) $text))
            ->map(fn ($line) => trim((string) $line))
            ->filter()
            ->values();
    };

    $widgetImages = function ($widget, array $fallback = []) {
        return collect(data_get($widget, 'settings.images', $fallback))
            ->map(fn ($image) => trim((string) $image))
            ->filter()
            ->values();
    };

    $imageUrl = function (?string $image, string $fallback = '/image/banner.png') {
        $image = trim((string) ($image ?: $fallback));

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        return asset(ltrim($image, '/'));
    };

    $restaurantPartials = [
        'restaurant_page_hero' => 'frontend.restaurant.widgets.hero',
        'restaurant_page_intro' => 'frontend.restaurant.widgets.intro',
        'restaurant_page_banner' => 'frontend.restaurant.widgets.banner',
        'restaurant_page_gallery' => 'frontend.restaurant.widgets.gallery',
        'restaurant_product_one' => 'frontend.restaurant.widgets.products',
        'restaurant_product_two' => 'frontend.restaurant.widgets.products',
    ];
@endphp

@push('styles')
    @include('frontend.products._styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/restaurant.css') }}">
@endpush

@section('content')
    @foreach ($widgets as $widget)
        @php($partial = $restaurantPartials[$widget->key] ?? null)
        @if ($partial)
            @include($partial, [
                'widget' => $widget,
                'splitLines' => $splitLines,
                'widgetImages' => $widgetImages,
                'imageUrl' => $imageUrl,
                'productResolver' => $productResolver,
            ])
        @endif
    @endforeach
@endsection
