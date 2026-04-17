@php
    $title = data_get($widget, 'title', 'VỀ VACA MAXI');
    $description = data_get($widget, 'description', 'VACA MAXI tiên phong kiến tạo hệ sinh thái chăn nuôi công nghệ cao tại Việt Nam.');
    $buttonText = data_get($widget, 'settings.button_text', 'Tìm hiểu thêm');
    $buttonUrl = data_get($widget, 'settings.button_url', '/gioi-thieu');
@endphp
<section class="about-section" id="about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="about-gallery">
                    <img class="about-photo" src="/image/Rectangle 2.png" alt="Trang trại Vaca Maxi">
                    <img class="about-photo" src="/image/Rectangle 3.png" alt="Thịt bò Vaca Maxi">
                    <img class="about-photo" src="/image/Rectangle 4.png" alt="Rượu Vaca Maxi">
                    <img class="about-photo" src="/image/Rectangle 5.png" alt="Nhà hàng Vaca Maxi">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content">
                    <div class="section-heading">
                        <h2>{{ $title }}</h2>
                        <span></span>
                    </div>
                    <p class="about-text">{!! nl2br(e($description)) !!}</p>
                    <a href="{{ $buttonUrl }}" class="about-action">{{ $buttonText }}</a>
                </div>
            </div>
        </div>
    </div>
</section>