<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>VACA MAXI</title>
        <link rel="stylesheet" href="{{ asset('css/frontend/app.css') }}">
    @include('frontend.partials.base-layout-styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/feedback-home.css') }}">
    @stack('styles')
</head>

<body>
@php
    $frontendData = $frontendData ?? json_decode(file_get_contents(resource_path('data/frontend.json')), true) ?: [];
    $widgets = $widgets ?? collect();
    $productOptionItems = $productOptionItems ?? [];
    $nav = $frontendData['nav'] ?? [];
    $footer = $frontendData['footer'] ?? [];
    $active = 'home';
@endphp
@include('frontend.partials.header', ['isHome' => true])
<main>
    @php
        $defaultWidgetOrder = collect([
            'banner_home',
            'about_me_home',
            'product_option_one',
            'about_team_home',
            'product_option_two',
            'product_option_three',
            'about_restaurant_home',
            'feedback_home',
            'news_home',
        ]);

        $widgetOrder = $widgets->isNotEmpty() ? $widgets->keys() : $defaultWidgetOrder;
        $widgetIncludes = [
            'banner_home' => ['view' => 'frontend.widgets.banner_home'],
            'about_me_home' => ['view' => 'frontend.widgets.about_me_home'],
            'product_option_one' => [
                'view' => 'frontend.widgets.product_option_one',
                'items' => $productOptionItems['product_option_one'] ?? $frontendData['breeds'] ?? [],
            ],
            'about_team_home' => ['view' => 'frontend.widgets.about_team_home'],
            'product_option_two' => [
                'view' => 'frontend.widgets.product_option_two',
                'items' => $productOptionItems['product_option_two'] ?? $frontendData['beefProducts'] ?? [],
            ],
            'product_option_three' => [
                'view' => 'frontend.widgets.product_option_three',
                'items' => $productOptionItems['product_option_three'] ?? $frontendData['wineProducts'] ?? [],
            ],
            'about_restaurant_home' => ['view' => 'frontend.widgets.about_restaurant_home'],
            'feedback_home' => ['view' => 'frontend.widgets.feedback_home'],
            'news_home' => [
                'view' => 'frontend.widgets.news_home',
                'news' => $frontendData['news'] ?? [],
            ],
        ];
    @endphp

    @foreach ($widgetOrder as $widgetKey)
        @continue(! isset($widgetIncludes[$widgetKey]))

        @php
            $includeConfig = $widgetIncludes[$widgetKey];
            $includeData = ['widget' => $widgets->get($widgetKey)] + collect($includeConfig)
                ->except('view')
                ->all();
        @endphp

        @include($includeConfig['view'], $includeData)
    @endforeach
</main>
@include('frontend.partials.footer')
@include('frontend.partials.floating-contact')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

