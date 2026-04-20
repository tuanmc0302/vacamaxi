@php
    $images = $widgetImages($widget, ['/image/Rectangle 5.png', '/image/Rectangle 11.png', '/image/Rectangle 2.png', '/image/Rectangle 3.png']);
@endphp

<section class="restaurant-gallery">
    <div class="restaurant-container">
        <div class="restaurant-section-heading">
            <h2>{{ data_get($widget, 'title', 'Không gian nhà hàng') }}</h2>
            <span></span>
            @if (data_get($widget, 'description'))
                <p>{!! nl2br(e(data_get($widget, 'description'))) !!}</p>
            @endif
        </div>

        <div class="restaurant-gallery-grid">
            @foreach ($images->take(4) as $image)
                <img src="{{ $imageUrl($image) }}" alt="{{ data_get($widget, 'title', 'Nhà hàng Vaca Maxi') }}">
            @endforeach
        </div>

        <div class="restaurant-diamonds" aria-hidden="true">
            <span></span><span></span><span></span><i></i><span></span>
        </div>
    </div>
</section>
