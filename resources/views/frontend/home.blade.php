@extends('frontend.master')

@php
    $pageTitle = 'VACAMAXI - Từ Trang Trại Đến Bàn Ăn';
    $active = 'home';
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/feedback-home.css') }}">
@endpush

@section('content')
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
                'news' => $news,
            ],
        ];
    @endphp

    @if ($widgets->isNotEmpty())
        @foreach ($widgets as $widget)
            @continue(! isset($widgetIncludes[$widget->key]))

            @php
                $includeConfig = $widgetIncludes[$widget->key];
                $includeData = ['widget' => $widget] + collect($includeConfig)
                    ->except('view')
                    ->all();
            @endphp

            @include($includeConfig['view'], $includeData)
        @endforeach
    @else
        @foreach ($defaultWidgetOrder as $widgetKey)
            @continue(! isset($widgetIncludes[$widgetKey]))

            @php
                $includeConfig = $widgetIncludes[$widgetKey];
                $includeData = ['widget' => null] + collect($includeConfig)
                    ->except('view')
                    ->all();
            @endphp

            @include($includeConfig['view'], $includeData)
        @endforeach
    @endif
@endsection
