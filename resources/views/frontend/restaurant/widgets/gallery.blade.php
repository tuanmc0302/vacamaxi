@php
    $images = $widgetImages($widget, [
        '/image/Rectangle 5.png', '/image/Rectangle 11.png', '/image/Rectangle 2.png', '/image/Rectangle 3.png',
        '/image/Rectangle 5.png', '/image/Rectangle 11.png', '/image/Rectangle 2.png', '/image/Rectangle 3.png'
    ]);
    $chunks = $images->chunk(4);
@endphp

<section class="restaurant-gallery">
    <div class="container">
        <div class="restaurant-section-heading">
            <h2 class="col-12 col-lg-6">{{ data_get($widget, 'title', 'Không gian nhà hàng') }}</h2>
            @if (data_get($widget, 'description'))
                <p>{!! nl2br(e(data_get($widget, 'description'))) !!}</p>
            @endif
        </div>

        <div id="galleryCarousel" class="carousel slide restaurant-carousel" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach ($chunks as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="restaurant-gallery-grid">
                            @foreach ($chunk as $image)
                                <img src="{{ $imageUrl($image) }}" alt="{{ data_get($widget, 'title', 'Nhà hàng VACAMAXI') }}">
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            @if($chunks->count() > 1)
                <div class="carousel-indicators diamond-indicators-horizontal">
                    @foreach($chunks as $index => $chunk)
                        <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="{{ $index }}" 
                                class="{{ $index === 0 ? 'active' : '' }}" 
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
