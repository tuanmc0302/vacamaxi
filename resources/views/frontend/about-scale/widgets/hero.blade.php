@php
    $heroLines = $splitLines($widget->description);
    $heroHeadline = $heroLines->get(0);
    $heroParagraphs = $heroLines->slice(1, 2);
    $heroBullets = $heroLines->slice(3);
    $heroBackground = $widgetImages($widget, ['/image/bg_about.png'])->first();
@endphp

<section class="about-scale-hero">
    <div class="container">
        <div class="about-scale-hero__panel">
            <h1 class="about-scale-hero__title">{{ $widget->title ?: 'QUY MÔ - CÔNG NGHỆ' }}</h1>
            <div class="about-scale-hero__subtitle-wrap">
                <div class="about-scale-hero__line"></div>
                @if ($widget->sub_title)
                    <div class="about-scale-hero__subtitle">{{ $widget->sub_title }}</div>
                @endif
                <div class="about-scale-hero__line"></div>
            </div>

            @if ($heroHeadline)
                <div class="about-scale-hero__headline"><strong>{{ $heroHeadline }}</strong></div>
            @endif
        </div>
    </div>
    <div class="about-scale-hero__copy text-center">
        @foreach ($heroParagraphs as $line)
            <p>{{ $line }}</p>
        @endforeach
    </div>

    @if ($heroBullets->isNotEmpty())
        <div class="about-scale-hero__list text-center">
            @foreach ($heroBullets as $line)
                <p>{{ ltrim($line, '–- ') }}</p>
            @endforeach
        </div>
    @endif
</section>
