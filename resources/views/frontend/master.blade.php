<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $pageTitle ?? ($siteSettings['seo_title'] ?? 'VACAMAXI'))</title>
    <meta name="description" content="@yield('metaDescription', $metaDescription ?? ($siteSettings['seo_description'] ?? 'VACAMAXI'))">
    <meta name="keywords" content="@yield('metaKeywords', $metaKeywords ?? ($siteSettings['seo_keywords'] ?? ''))">
    <meta property="og:title" content="@yield('title', $pageTitle ?? ($siteSettings['seo_title'] ?? 'VACAMAXI'))">
    <meta property="og:description" content="@yield('metaDescription', $metaDescription ?? ($siteSettings['seo_description'] ?? 'VACAMAXI'))">
    @php
        $finalOgImage = $ogImage ?? ($siteSettings['seo_image_url'] ?? null);
    @endphp
    @if (!empty($finalOgImage))
        <meta property="og:image" content="{{ Str::startsWith($finalOgImage, ['http://', 'https://']) ? $finalOgImage : asset($finalOgImage) }}">
    @endif
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="website">
    <link rel="icon" href="{{ $siteSettings['favicon_url'] ?? asset('favicon.ico') }}">
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

<div id="image-lightbox" class="image-lightbox" aria-hidden="true" role="dialog" aria-label="Xem ảnh">
    <button type="button" class="image-lightbox__close" aria-label="Đóng">&times;</button>
    <img class="image-lightbox__image" src="" alt="">
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backToTop = document.getElementById('back-to-top');
        const lightbox = document.getElementById('image-lightbox');
        const lightboxImage = lightbox?.querySelector('.image-lightbox__image');
        const lightboxClose = lightbox?.querySelector('.image-lightbox__close');
        const gallerySelector = [
            '.about-gallery img',
            '.expert-gallery img',
            '.restaurant-carousel img',
            '.about-story__gallery img',
            '.about-feature__image img',
            '.core-values__center img',
            '.about-scale-split__image img',
            '.about-scale-strategy-card__image img',
            '.about-scale-expert-card__photo img'
        ].join(',');

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

        const closeLightbox = function() {
            if (!lightbox || !lightboxImage) return;
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            lightboxImage.src = '';
            lightboxImage.alt = '';
            document.body.style.overflow = '';
        };

        document.addEventListener('click', function(event) {
            const image = event.target.closest(gallerySelector);
            const galleryBackground = event.target.closest('[data-gallery-src]');

            if (!lightbox || !lightboxImage) return;
            if (!image && !galleryBackground) return;
            if (!image && galleryBackground && event.target.closest('a, button')) return;

            event.preventDefault();
            lightboxImage.src = image ? (image.currentSrc || image.src) : galleryBackground.dataset.gallerySrc;
            lightboxImage.alt = image ? (image.alt || 'VACAMAXI') : 'VACAMAXI';
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        });

        lightboxClose?.addEventListener('click', closeLightbox);

        lightbox?.addEventListener('click', function(event) {
            if (event.target === lightbox) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeLightbox();
            }
        });
    });
</script>
@stack('scripts')
</body>
</html>
