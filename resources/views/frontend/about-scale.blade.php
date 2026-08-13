@extends('frontend.master')

@php
    $pageTitle = __('Quy mô - Công nghệ') . ' - VACAMAXI';
    $metaDescription = __('Quy mô vận hành và công nghệ của VACAMAXI');
    $active = 'about-scale';

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
            ->map(function (string $image): string {
                if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, '/')) {
                    return $image;
                }

                return str_starts_with($image, 'image/') ? asset($image) : asset('storage/' . $image);
            })
            ->values();
    };

    $aboutScaleWidgetPartials = [
        'about_scale_page_hero' => 'frontend.about-scale.widgets.hero',
        'about_scale_page_farm' => 'frontend.about-scale.widgets.farm',
        'about_scale_page_experts' => 'frontend.about-scale.widgets.experts',
        'about_scale_page_care' => 'frontend.about-scale.widgets.care',
        'about_scale_page_biotech' => 'frontend.about-scale.widgets.biotech',
        'about_scale_page_ivf' => 'frontend.about-scale.widgets.ivf',
        'about_scale_page_strategy' => 'frontend.about-scale.widgets.strategy',
        'about_scale_page_cta' => 'frontend.about-scale.widgets.cta',
    ];
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/about-scale.css') }}">
@endpush

@section('content')
    @foreach ($widgets as $widget)
        @php($partial = $aboutScaleWidgetPartials[$widget->key] ?? null)
        @if ($partial)
            @include($partial, ['widget' => $widget, 'splitLines' => $splitLines, 'widgetImages' => $widgetImages, 'expertProducts' => $expertProducts ?? collect()])
        @endif
    @endforeach
@endsection
