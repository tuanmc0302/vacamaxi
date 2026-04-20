@php
    $heroParagraphs = $splitLines($widget->description);
    $heroBackground = $widgetImages($widget, ['/image/bg_gioithieu.png'])->first();
@endphp

<section class="intro-overview">
    <div class="container">
        <div class="intro-overview__panel">
            <h1 class="intro-overview__title">{{ $widget->title ?: 'GIỚI THIỆU' }}</h1>
            @if($widget->sub_title)
                <div class="intro-overview__subtitle">{{ $widget->sub_title }}</div>
            @endif
            <div class="intro-overview__rule">
                <span></span>
            </div>
            <div class="intro-overview__copy">
                @foreach ($heroParagraphs as $line)
                    <p>{!! nl2br(e($line)) !!}</p>
                @endforeach
            </div>
        </div>
    </div>
</section>
