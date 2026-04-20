@extends('frontend.master')

@php
    $pageTitle = 'Giới thiệu - VACAMAXI';
    $metaDescription = 'Giới thiệu về VACAMAXI';
    $active = 'about';

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

    $aboutWidgetPartials = [
        'about_page_hero' => 'frontend.about.widgets.hero',
        'about_page_intro' => 'frontend.about.widgets.intro',
        'about_page_values' => 'frontend.about.widgets.values',
        'about_page_experts' => 'frontend.about.widgets.experts',
        'about_page_farm' => 'frontend.about.widgets.farm',
        'about_page_cta' => 'frontend.about.widgets.cta',
    ];
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/about.css') }}">
@endpush

@section('content')
    @foreach ($widgets as $widget)
        @php($partial = $aboutWidgetPartials[$widget->key] ?? null)
        @if ($partial)
            @include($partial, ['widget' => $widget, 'splitLines' => $splitLines, 'widgetImages' => $widgetImages, 'expertProducts' => $expertProducts ?? collect()])
        @endif
    @endforeach
@endsection
