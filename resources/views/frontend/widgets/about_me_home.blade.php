@php
    $title = data_get($widget, 'title', 'VỀ VACAMAXI');
    $description = data_get($widget, 'description', 'VACAMAXI tiên phong kiến tạo hệ sinh thái chăn nuôi công nghệ cao tại Việt Nam.');
    $buttonText = data_get($widget, 'settings.button_text', 'Tìm hiểu thêm');
    $buttonUrl = data_get($widget, 'settings.button_url', '/gioi-thieu');
    $images = collect(data_get($widget, 'settings.images', ['/image/Rectangle 2.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png']))
        ->filter()
        ->take(4)
        ->values();
    $imageSrc = function ($path) {
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return str_starts_with($path, 'image/') ? asset($path) : asset('storage/' . $path);
    };
@endphp
<section class="about-section" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="about-gallery">
                    @foreach ($images as $index => $image)
                        <img class="about-photo" src="{{ $imageSrc($image) }}" alt="{{ $title }} {{ $index + 1 }}">
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5">
                <div class="about-content">
                    <div class="section-heading">
                        <h2>{{ $title }}</h2>
                        <span></span>
                    </div>
                    <p class="about-text">{!! nl2br(e($description)) !!}</p>
                    <div class="about-more">
                        <a href="{{ $buttonUrl }}" class="btn-vaca">{{ $buttonText }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
