@php
    $heroLines = $splitLines($widget->description);
    $heroHeadline = $heroLines->get(0);
    $heroParagraphs = $heroLines->slice(1, 2);
    $heroBullets = $heroLines->slice(3);
    $heroBackground = $widgetImages($widget, ['/image/bg_about.png'])->first();
@endphp

<section class="about-scale-hero" style="background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.97), rgba(255, 255, 255, 0.94)), url('{{ $heroBackground }}');">
    <div class="container">
        <div class="about-scale-hero__panel">
            <h1 class="about-scale-hero__title">{{ $widget->title ?: 'QUY MÔ - CÔNG NGHỆ' }}</h1>
            <div class="about-scale-hero__subtitle-wrap">
                <span class="about-scale-hero__line"></span>
                <p class="about-scale-hero__subtitle">{{ $widget->sub_title ?: 'MÔ HÌNH TRANG TRẠI KÉP KÍN' }}</p>
                <span class="about-scale-hero__line"></span>
            </div>

            @if ($heroHeadline)
                <p class="about-scale-hero__headline">{{ $heroHeadline }}</p>
            @endif

            @foreach ($heroParagraphs as $line)
                <p class="about-scale-hero__copy">{{ $line }}</p>
            @endforeach

            @if ($heroBullets->isNotEmpty())
                <div class="about-scale-hero__list">
                    @foreach ($heroBullets as $line)
                        <p>{{ ltrim($line, '–- ') }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
