@php
    $farmImage = $widgetImages($widget, ['/image/Rectangle 11.png'])->first();
@endphp

<section class="about-scale-section">
    <div class="container about-scale-split">
        <div class="about-scale-split__image">
            <img src="{{ $farmImage }}" alt="Mô hình trang trại VACA MAXI">
        </div>
        <div class="about-scale-split__content">
            <div class="about-scale-section-title">
                <h2>{{ strtoupper($widget->title ?: 'MÔ HÌNH TRANG TRẠI') }}</h2>
                <span></span>
            </div>
            @foreach ($splitLines($widget->description) as $line)
                <p>{!! nl2br(e($line)) !!}</p>
            @endforeach
        </div>
    </div>
</section>
