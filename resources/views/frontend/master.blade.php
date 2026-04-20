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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @include('frontend.partials.base-layout-styles')
    @stack('styles')
</head>
<body>
@php
    $frontendData = $frontendData ?? [];
    $nav = $nav ?? ($frontendData['nav'] ?? []);
    $footer = $footer ?? ($frontendData['footer'] ?? []);
    $active = $active ?? 'home';
@endphp

@if ($active === 'home')
    @include('frontend.partials.header', ['isHome' => true])
@else
    @include('frontend.partials.header')
@endif

<main>
    @yield('content')
</main>

@include('frontend.partials.footer')

@hasSection('hideFloating')
@else
    @include('frontend.partials.floating-contact')
@endif

<button id="back-to-top" class="back-to-top" title="Lên đầu trang">
    <i class="bi bi-chevron-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backToTop = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
@stack('scripts')
</body>
</html>

