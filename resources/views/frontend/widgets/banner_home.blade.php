@php
    $title = data_get($widget, 'title', 'VACAMAXI là nhà hàng steak & grill cao cấp');
    $subTitle = data_get($widget, 'sub_title', 'Nhà hàng 5 sao VACAMAXI');
    $description = data_get($widget, 'description', 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của chuyện phía sau mỗi lựa chọn.');
    $buttonText = data_get($widget, 'settings.button_text', 'KHÁM PHÁ NGAY');
    $buttonUrl = data_get($widget, 'settings.button_url', '#about');
@endphp
<section class="hero-banner">
    <div class="container">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <p class="hero-eyebrow">{{ $subTitle }}</p>
            <h1 class="hero-title">{{ $title }}</h1>
            <p class="hero-copy">{{ $description }}</p>
            <a href="{{ $buttonUrl }}" class="hero-action">{{ $buttonText }}</a>
        </div>
    </div>
    
</section>