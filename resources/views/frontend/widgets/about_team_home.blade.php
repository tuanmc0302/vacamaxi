@php
    $title = data_get($widget, 'title', 'ĐỘI NGŨ CHUYÊN GIA CỦA VACA MAXI');
    $subTitle = data_get($widget, 'sub_title', 'Hợp tác giữa Vaca Maxi và chuyên gia Argentina');
    $description = data_get($widget, 'description');
    $buttonText = data_get($widget, 'settings.button_text', 'Tìm hiểu thêm');
    $buttonUrl = data_get($widget, 'settings.button_url', '/gioi-thieu');
@endphp
<section class="expert-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="expert-content">
                    <div class="expert-title">
                        <h2>{{ $title }}</h2>
                        <span></span>
                    </div>
                    <p class="expert-lead">{{ $subTitle }}</p>
                    <p class="expert-text">{!! nl2br(e($description)) !!}</p>
                    <a href="{{ $buttonUrl }}" class="about-action">{{ $buttonText }}</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="expert-gallery">
                    <img src="/image/Rectangle 2.png" alt="Chuyên gia Vaca Maxi">
                    <img src="/image/Rectangle 3.png" alt="Thịt bò Vaca Maxi">
                    <img src="/image/Rectangle 4.png" alt="Trang trại Vaca Maxi">
                    <img src="/image/Rectangle 5.png" alt="Nhà hàng Vaca Maxi">
                </div>
            </div>
        </div>
    </div>
</section>