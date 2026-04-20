@php
    $image = $widgetImages($widget, ['/image/banner.png'])->first();
@endphp

<section class="restaurant-page-hero" style="--hero-image: url('{{ $imageUrl($image) }}')">
    <div class="restaurant-container">
        <h1>{{ data_get($widget, 'title', 'Dịch vụ - Nhà hàng') }}</h1>
        @if (data_get($widget, 'sub_title'))
            <p>{{ data_get($widget, 'sub_title') }}</p>
        @endif
    </div>
</section>
