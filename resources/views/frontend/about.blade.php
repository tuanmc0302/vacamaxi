@extends('frontend.master')

@php
    $pageTitle = 'Giới thiệu - VACA MAXI';
    $metaDescription = 'Giới thiệu về VACA MAXI';
    $active = 'about';
    $wHero = $widgets->get('about_page_hero');
    $wIntro = $widgets->get('about_page_intro');
    $wValues = $widgets->get('about_page_values');
    $wExperts = $widgets->get('about_page_experts');
    $wFarm = $widgets->get('about_page_farm');
    $wCta = $widgets->get('about_page_cta');
@endphp

@section('content')
    <main class="container py-5">
        <h1>{{ $wHero->title ?? 'GIỚI THIỆU' }}</h1>
        <p>{{ $wHero->sub_title ?? '' }}</p>
        <p>{{ $wHero->description ?? '' }}</p>
    </main>
@endsection
