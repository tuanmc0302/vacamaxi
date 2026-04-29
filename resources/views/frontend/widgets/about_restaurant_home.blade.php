@php
    $title = data_get($widget, 'title', 'NHÀ HÀNG 5 SAO VACAMAXI');
    $description = data_get($widget, 'description');
    $images = collect(data_get($widget, 'settings.images', [
        '/image/Rectangle 5.png', '/image/Rectangle 3.png', '/image/Rectangle 2.png', '/image/Rectangle 11.png',
        '/image/Rectangle 5.png', '/image/Rectangle 3.png', '/image/Rectangle 2.png', '/image/Rectangle 11.png'
    ]))->filter()->values();
    
    $chunks = $images->chunk(4);
    $imageSrc = fn ($path) => str_starts_with($path, 'http') || str_starts_with($path, '/') ? $path : asset($path);
@endphp

<section class="restaurant-section" id="restaurant">
    <div class="container">
        <div class="restaurant-heading">
            <h2>{{ $title }}</h2>
            <span></span>
        </div>
        <p class="restaurant-copy">{!! nl2br(e($description)) !!}</p>
        
        <div id="restaurantCarousel" class="carousel slide restaurant-carousel" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach ($chunks as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="restaurant-grid">
                            @foreach ($chunk as $imgIndex => $image)
                                <div class="restaurant-item">
                                    <img src="{{ $imageSrc($image) }}" alt="{{ $title }} {{ $index * 4 + $imgIndex + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            @if($chunks->count() > 1)
                <div class="carousel-indicators diamond-indicators-horizontal">
                    @foreach($chunks as $index => $chunk)
                        <button type="button" data-bs-target="#restaurantCarousel" data-bs-slide-to="{{ $index }}" 
                                class="{{ $index === 0 ? 'active' : '' }}" 
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
