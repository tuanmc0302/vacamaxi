@php
    $careImage = $widgetImages($widget, ['/image/Rectangle 2.png'])->first();
@endphp

<section class="about-scale-section">
    <div class="container about-scale-split about-scale-split--reverse">
        <div class="about-scale-split__content">
            <div class="about-scale-section-title">
                <h2>{{ strtoupper($widget->title ?: 'CHẾ ĐỘ CHĂM SÓC VÀ DINH DƯỠNG CHUYÊN BIỆT') }}</h2>
            </div>
            @foreach ($splitLines($widget->description) as $line)
                <p>{{ $line }}</p>
            @endforeach
        </div>
        <div class="about-scale-split__image">
            <img src="{{ $careImage }}" alt="{{ $widget->title }}">
        </div>
    </div>
</section>
