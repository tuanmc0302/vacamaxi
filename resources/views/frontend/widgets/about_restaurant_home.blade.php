@php
    $title = data_get($widget, 'title', 'NHÀ HÀNG 5 SAO VACA MAXI');
    $description = data_get($widget, 'description');
    $images = collect(data_get($widget, 'settings.images', ['/image/Rectangle 5.png', '/image/Rectangle 3.png', '/image/Rectangle 2.png', '/image/Rectangle 11.png']))
        ->filter()
        ->take(4)
        ->values();
    $imageSrc = fn ($path) => str_starts_with($path, 'http') || str_starts_with($path, '/') ? $path : asset($path);
@endphp
<section class="restaurant-section" id="restaurant">
    <div class="container">
        <div class="restaurant-heading">
            <h2>{{ $title }}</h2>
            <span></span>
        </div>
        <p class="restaurant-copy">{!! nl2br(e($description)) !!}</p>
        <div class="restaurant-gallery">
            @foreach ($images as $index => $image)
                <img src="{{ $imageSrc($image) }}" alt="{{ $title }} {{ $index + 1 }}">
            @endforeach
        </div>
        <div class="restaurant-dots"><i></i><i></i><i></i><span></span><i></i></div>
    </div>
</section>
