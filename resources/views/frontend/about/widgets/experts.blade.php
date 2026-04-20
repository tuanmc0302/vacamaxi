@php
    $expertImage = $widgetImages($widget, [optional($expertProducts->first())->image ? asset($expertProducts->first()->image) : '/image/Rectangle 3.png'])->first();
    $lines = $splitLines($widget->description);
@endphp

<section class="about-feature">
    <div class="container">
        <div class="about-feature__grid about-feature__grid--experts">
            <div class="about-feature__content">
                <div class="section-line-title">
                    <h2>{{ $widget->title ?: 'Đội ngũ chuyên gia của VACAMAXI' }}</h2>
                </div>
                @if ($widget->sub_title)
                    <h3>{{ $widget->sub_title }}</h3>
                @endif
                @foreach ($lines as $line)
                    <p>{{ $line }}</p>
                @endforeach
            </div>

            <div class="about-feature__image">
                <img src="{{ $expertImage }}" alt="Đội ngũ chuyên gia VACAMAXI">
            </div>
        </div>
    </div>
</section>
