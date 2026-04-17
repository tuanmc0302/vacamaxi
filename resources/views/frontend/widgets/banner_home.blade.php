@php
    $title = data_get($widget, 'title', 'VACA MAXI là nhà hàng steak & grill cao cấp');
    $subTitle = data_get($widget, 'sub_title', 'Nhà hàng 5 sao Vaca Maxi');
    $description = data_get($widget, 'description', 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của chuyện phía sau mỗi lựa chọn.');
    $buttonText = data_get($widget, 'settings.button_text', 'KHÁM PHÁ NGAY');
    $buttonUrl = data_get($widget, 'settings.button_url', '#about');
@endphp
<section class="hero-banner">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <p class="hero-kicker">{{ $subTitle }}</p>
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
        <a href="{{ $buttonUrl }}" class="btn-gold">{{ $buttonText }}</a>
    </div>
</section>