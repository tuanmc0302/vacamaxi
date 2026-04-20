@extends('frontend.master')

@php
    $pageTitle = 'Giới thiệu Figma - VACA MAXI';
    $metaDescription = 'Bản dựng đối chiếu Figma cho trang giới thiệu VACA MAXI';
    $active = 'about';

    $wHero = $widgets->get('about_page_hero');
    $splitLines = function (?string $text) {
        return collect(preg_split('/\s*\|\s*/u', (string) $text))
            ->map(fn ($line) => trim((string) $line))
            ->filter()
            ->values();
    };
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/about-figma.css') }}">
@endpush

@section('content')
    <section class="about-figma-page">
        <div class="container">
            <div class="about-figma-panel">
                <p class="about-figma-title">{{ $wHero?->title ?: 'GIỚI THIỆU' }}</p>
                <div class="about-figma-subtitle">{{ $wHero?->sub_title ?: 'VỀ VACA MAXI' }}</div>
                <div class="about-figma-rule" aria-hidden="true"><span></span></div>

                <div class="about-figma-copy">
                    @foreach ($splitLines($wHero?->description) as $line)
                        <p>{{ $line }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
