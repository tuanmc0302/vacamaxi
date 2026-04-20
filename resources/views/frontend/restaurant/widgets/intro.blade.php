@php
    $images = $widgetImages($widget, ['/image/Rectangle 5.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png']);
    $buttonText = data_get($widget, 'settings.button_text', 'Tìm hiểu thêm');
    $buttonUrl = data_get($widget, 'settings.button_url', '#restaurant-banner');
@endphp

<section class="restaurant-intro">
    <div class="container restaurant-intro-grid">
        <div class="restaurant-image-mosaic">
            @foreach ($images->take(4) as $image)
                <img src="{{ $imageUrl($image) }}" alt="{{ data_get($widget, 'title', 'Nhà hàng VACAMAXI') }}">
            @endforeach
        </div>

        <div class="restaurant-copy">
            <div class="restaurant-heading-wrap">
                <h2>{{ data_get($widget, 'title', 'Nhà hàng VACAMAXI') }}</h2>
                <span></span>
            </div>
            @if (data_get($widget, 'description'))
                <p>{!! nl2br(e(data_get($widget, 'description'))) !!}</p>
            @endif
            @if ($buttonText)
                <a class="btn-vaca" href="{{ $buttonUrl }}">{{ $buttonText }}</a>
            @endif
        </div>
    </div>
</section>
