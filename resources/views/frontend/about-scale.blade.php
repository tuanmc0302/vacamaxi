@extends('frontend.master')

@php
    $pageTitle = 'Quy mô - Công nghệ - VACA MAXI';
    $metaDescription = 'Quy mô và công nghệ của VACA MAXI';
    $active = 'about-scale';
    $wHero = $widgets->get('about_scale_page_hero');
@endphp

@section('content')
    <main class="container py-5">
        <h1>{{ $wHero->title ?? 'QUY MÔ - CÔNG NGHỆ' }}</h1>
        <p>{{ $wHero->sub_title ?? '' }}</p>
        <p>{{ $wHero->description ?? '' }}</p>
    </main>
@endsection
