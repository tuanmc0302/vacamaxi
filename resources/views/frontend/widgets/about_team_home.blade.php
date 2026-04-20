@php
    $title = data_get($widget, 'title', 'ĐỘI NGŨ CHUYÊN GIA CỦA VACA MAXI');
    $subTitle = data_get($widget, 'sub_title', 'Hợp tác giữa Vaca Maxi và chuyên gia Argentina');
    $description = data_get($widget, 'description');
    $buttonText = data_get($widget, 'settings.button_text', 'Tìm hiểu thêm');
    $buttonUrl = data_get($widget, 'settings.button_url', '/gioi-thieu');
    $images = collect(data_get($widget, 'settings.images', ['/image/Rectangle 2.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png']))
        ->filter()
        ->take(4)
        ->values();
    $imageSrc = fn ($path) => str_starts_with($path, 'http') || str_starts_with($path, '/') ? $path : asset($path);
@endphp
<section class="expert-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="expert-content">
                    <div class="expert-title">
                        <h2>{{ $title }}</h2>
                    </div>
                    <p class="expert-lead">{{ $subTitle }}</p>
                    <p class="expert-text">{!! nl2br(e($description)) !!}</p>
                    <a href="{{ $buttonUrl }}" class="about-action">{{ $buttonText }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="expert-gallery">
                    @foreach ($images as $index => $image)
                        <img src="{{ $imageSrc($image) }}" alt="{{ $title }} {{ $index + 1 }}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
