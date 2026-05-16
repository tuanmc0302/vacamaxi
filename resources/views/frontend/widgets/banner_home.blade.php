@php
    $slides = data_get($widget, 'settings.slides');
    
    if (empty($slides)) {
        $slides = [
            [
                'title' => data_get($widget, 'title', 'VACAMAXI là nhà hàng steak & grill cao cấp'),
                'sub_title' => data_get($widget, 'sub_title', 'Nhà hàng 5 sao VACAMAXI'),
                'description' => data_get($widget, 'description', 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của chuyện phía sau mỗi lựa chọn.'),
                'button_text' => data_get($widget, 'settings.button_text', 'KHÁM PHÁ NGAY'),
                'button_url' => data_get($widget, 'settings.button_url', '#about'),
                'image' => data_get($widget, 'settings.image', '/image/banner.png'),
            ]
        ];
    }

    $imageUrl = function (?string $image): string {
        $image = $image ?: '/image/banner.png';

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, '/')) {
            return $image;
        }

        return str_starts_with($image, 'image/') ? asset($image) : asset('storage/' . $image);
    };
@endphp

<section id="heroCarousel" class="carousel slide hero-banner-carousel" data-bs-ride="carousel" data-bs-interval="5000">
    @if(count($slides) > 1)
        <div class="carousel-indicators">
            @foreach($slides as $index => $slide)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif

    <div class="carousel-inner">
        @foreach($slides as $index => $slide)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <div class="hero-banner" data-gallery-src="{{ $imageUrl($slide['image'] ?? null) }}" style="background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.45) 45%, rgba(0, 0, 0, 0) 100%), url('{{ $imageUrl($slide['image'] ?? null) }}');">
                    <div class="container">
                        <div class="hero-overlay"></div>
                        <div class="hero-content">
                            @if(!empty($slide['sub_title']))
                                <p class="hero-eyebrow">{{ $slide['sub_title'] }}</p>
                            @endif
                            <h1 class="hero-title">{{ $slide['title'] }}</h1>
                            <p class="hero-copy">{{ $slide['description'] }}</p>
                            @if(!empty($slide['button_text']))
                                <a href="{{ $slide['button_url'] ?? '#' }}" class="hero-action">{{ $slide['button_text'] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</section>
