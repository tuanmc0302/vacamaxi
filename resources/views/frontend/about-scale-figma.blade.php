@extends('frontend.master')

@php
    $pageTitle = 'Giới thiệu quy mô Figma - VACA MAXI';
    $metaDescription = 'Bản dựng đối chiếu Figma cho trang quy mô phát triển VACA MAXI';
    $active = 'about-scale';

    $wHero = $widgets->get('about_scale_page_hero');
    $wFarm = $widgets->get('about_scale_page_farm');
    $wCare = $widgets->get('about_scale_page_care');
    $wBiotech = $widgets->get('about_scale_page_biotech');
    $wIvf = $widgets->get('about_scale_page_ivf');
    $wStrategy = $widgets->get('about_scale_page_strategy');

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

    $heroLines = $splitLines($wHero?->description);
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/about-figma.css') }}">
@endpush

@section('content')
    <section class="about-figma-scale-hero">
        <div class="container">
            <div class="about-figma-scale-hero__content">
                <p class="about-figma-title">{{ $wHero?->title ?: 'QUY MÔ - CÔNG NGHỆ' }}</p>
                <div class="about-figma-subtitle">{{ $wHero?->sub_title ?: 'MÔ HÌNH TRANG TRẠI KHÉP KÍN' }}</div>
                <div class="about-figma-rule about-figma-rule--left" aria-hidden="true"><span></span></div>

                <div class="about-figma-copy about-figma-copy--left">
                    @foreach ($heroLines as $line)
                        @if (str_starts_with($line, '–') || str_starts_with($line, '-'))
                            <p class="about-figma-bullet">{{ ltrim($line, '–- ') }}</p>
                        @else
                            <p>{{ $line }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="about-figma-section">
        <div class="container">
            <div class="about-figma-grid">
                <div class="about-figma-image-stack">
                    <img src="{{ $widgetImages($wFarm, ['/image/Rectangle 11.png'])->first() }}" alt="Trang trại VACA MAXI">
                    <img src="{{ $widgetImages($wCare, ['/image/Rectangle 2.png'])->first() }}" alt="Chăm sóc đàn bò">
                </div>

                <div class="about-figma-content">
                    <h2>{{ $wFarm?->title ?: 'Mô hình trang trại' }}</h2>
                    @foreach ($splitLines($wFarm?->description) as $line)
                        <p>{{ $line }}</p>
                    @endforeach

                    <h3>{{ $wBiotech?->title ?: 'Công nghệ sinh học' }}</h3>
                    @foreach ($splitLines($wBiotech?->description) as $line)
                        <p>{{ $line }}</p>
                    @endforeach
                </div>
            </div>

            <div class="about-figma-block">
                <h3>{{ $wIvf?->title ?: 'Vì sao chúng tôi chọn IVF?' }}</h3>
                @foreach ($splitLines($wIvf?->description) as $line)
                    <p>{{ $line }}</p>
                @endforeach
            </div>

            <div class="about-figma-block">
                <h3>{{ $wStrategy?->title ?: 'Chiến lược phát triển' }}</h3>
                @foreach ($splitLines($wStrategy?->description) as $line)
                    <p>{{ $line }}</p>
                @endforeach
            </div>
        </div>
    </section>
@endsection
