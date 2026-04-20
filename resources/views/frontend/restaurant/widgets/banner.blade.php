@php
    $image = $widgetImages($widget, ['/image/banner.png'])->first();
    $buttonText = data_get($widget, 'settings.button_text', 'Khám phá ngay');
    $buttonUrl = data_get($widget, 'settings.button_url', '#restaurant-products');
@endphp

<section id="restaurant-banner" class="restaurant-feature-banner" style="--banner-image: url('{{ $imageUrl($image) }}')">
    <div class="restaurant-container">
        <div class="restaurant-banner-copy">
            @if (data_get($widget, 'sub_title'))
                <p class="restaurant-kicker">{{ data_get($widget, 'sub_title') }}</p>
            @endif
            <h2>{{ data_get($widget, 'title', 'VACA MAXI là nhà hàng steak & grill cao cấp') }}</h2>
            @if (data_get($widget, 'description'))
                <p class="restaurant-banner-description">{!! nl2br(e(data_get($widget, 'description'))) !!}</p>
            @endif
            @if ($buttonText)
                <a class="restaurant-button" href="{{ $buttonUrl }}">{{ $buttonText }}</a>
            @endif
        </div>
    </div>
    <div class="restaurant-diamonds" aria-hidden="true">
        <span></span><span></span><span></span><i></i><span></span>
    </div>
</section>
