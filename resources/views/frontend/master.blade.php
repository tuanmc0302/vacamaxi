<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $pageTitle ?? 'VACAMAXI')</title>
    <meta name="description" content="@yield('metaDescription', $metaDescription ?? 'VACAMAXI')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;800&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @include('frontend.partials.base-layout-styles')
    @stack('styles')
</head>
<body>
@php
    $nav = $nav ?? ($frontendData['nav'] ?? []);
    $footer = $footer ?? ($frontendData['footer'] ?? []);
    $active = $active ?? 'home';
@endphp

@include('frontend.partials.header')

<main>
    @yield('content')
</main>

@include('frontend.partials.footer')

@hasSection('hideFloating')
@else
    @include('frontend.partials.floating-contact')
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

