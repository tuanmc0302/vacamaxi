@php
    $title = data_get($widget, 'title', 'NHÀ HÀNG 5 SAO VACA MAXI');
    $description = data_get($widget, 'description');
@endphp
<section class="restaurant-section" id="restaurant">
    <div class="container">
        <div class="restaurant-heading">
            <h2>{{ $title }}</h2>
            <span></span>
        </div>
        <p class="restaurant-copy">{!! nl2br(e($description)) !!}</p>
        <div class="restaurant-gallery">
            <img src="/image/Rectangle 5.png" alt="Nhà hàng Vaca Maxi">
            <img src="/image/Rectangle 3.png" alt="Món thịt bò Vaca Maxi">
            <img src="/image/Rectangle 2.png" alt="Không gian Vaca Maxi">
            <img src="/image/Rectangle 11.png" alt="Steak Vaca Maxi">
        </div>
        <div class="restaurant-dots"><i></i><i></i><i></i><span></span><i></i></div>
    </div>
</section>