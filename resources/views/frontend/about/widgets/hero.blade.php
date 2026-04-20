@php
    $heroParagraphs = $splitLines($widget->description);
    $heroBackground = $widgetImages($widget, ['/image/bg_gioithieu.png'])->first();
@endphp

<section class="intro-overview" style="background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.985), rgba(255, 255, 255, 0.95)), url('{{ $heroBackground }}');">
    <div class="container">
        <div class="intro-overview__panel">
            <p class="intro-overview__title">{{ $widget->title ?: 'GIỚI THIỆU' }}</p>
            <div class="intro-overview__subtitle">{{ $widget->sub_title ?: 'VỀ VACA MAXI' }}</div>
            <div class="intro-overview__rule" aria-hidden="true"><span></span></div>

            <div class="intro-overview__copy">
                @foreach ($heroParagraphs as $line)
                    <p>{!! nl2br(e($line)) !!}</p>
                @endforeach
            </div>
        </div>
    </div>
</section>
