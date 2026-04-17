<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $pageTitle ?? 'VACA MAXI')</title>
    <meta name="description" content="@yield('metaDescription', $metaDescription ?? 'VACA MAXI')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            color: #111111;
            font-family: Arial, Helvetica, sans-serif;
            background: #ffffff;
        }

        .site-header {
            position: absolute;
            inset: 0 0 auto;
            z-index: 10;
            min-height: 54px;
            background: rgba(0, 0, 0, 0.62);
        }

        .site-header .navbar {
            min-height: 54px;
            padding: 0;
        }

        .brand-mark,
        .brand-logo {
            width: 116px;
            max-height: 42px;
            object-fit: contain;
        }

        .site-header .nav-link {
            color: #ffffff;
            font-size: 12px;
            font-weight: 500;
            padding: 0 7px;
        }

        .site-header .nav-link.active,
        .site-header .nav-link:hover {
            color: #e7a900;
        }

        .site-header .dropdown-menu {
            border: 0;
            border-radius: 6px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
        }

        @media (min-width: 992px) {
            .site-header .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
            }
        }

        .site-footer {
            padding: 46px 0 42px;
            color: #ffffff;
            background: #250900;
        }

        .footer-logo {
            width: 180px;
            max-height: 68px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .footer-about,
        .footer-contact p {
            max-width: 420px;
            margin: 0 0 10px;
            font-size: 14px;
            line-height: 1.55;
        }

        .footer-menu {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-menu li {
            margin-bottom: 13px;
        }

        .footer-menu a {
            color: #ffffff;
            font-size: 14px;
            text-decoration: none;
        }

        .footer-map {
            width: 100%;
            min-height: 120px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.82);
            margin-bottom: 18px;
        }

        .footer-social-title {
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .footer-social {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .footer-social a {
            min-width: 36px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            color: #0b4fe8;
            background: #ffffff;
            font-size: 12px;
            text-decoration: none;
        }

        .float-contact {
            position: fixed;
            right: 0;
            top: 50%;
            z-index: 20;
            width: 58px;
            padding: 18px 0;
            display: grid;
            gap: 16px;
            border-radius: 34px 0 0 34px;
            background: #f8c446;
            transform: translateY(-50%);
        }

        .float-contact a {
            display: grid;
            justify-items: center;
            gap: 4px;
            color: #ffffff;
            font-size: 9px;
            text-decoration: none;
        }

        .float-icon {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #ffffff;
            color: #f0b000;
            font-size: 13px;
            font-weight: 700;
        }

        @media (max-width: 575.98px) {
            .brand-mark,
            .brand-logo {
                width: 104px;
            }

            .float-contact {
                display: none;
            }
        }
    </style>
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
