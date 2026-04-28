@php
    $heroParagraphs = $splitLines($widget->description);
    $heroBackground = $widgetImages($widget, ['/image/bg_gioithieu.png'])->first();
@endphp
<style>
    .intro-overview__subtitle_span{
        flex-grow: 1;
        height: 1px;
        background: #f3b21a;
        display: block;
        position: relative;
        top: 50%;
    }
    .intro-overview__subtitle_span_right::after {
        content: "";
        display: block;
        width: 6px;
        height: 6px;
        position: absolute;
        right: 0;
        top: -3px;
        border-radius: 50%;
        background: #f3b21a;
    }
    .intro-overview__subtitle_span_left::before {
        content: "";
        display: block;
        width: 6px;
        height: 6px;
        position: absolute;
        left: 0;
        top: -3px;
        border-radius: 50%;
        background: #f3b21a;
    }
</style>
<section class="intro-overview">
    <div class="container">
        <div class="intro-overview__panel">
            <h1 class="intro-overview__title">{{ $widget->title ?: 'GIỚI THIỆU' }}</h1>
        </div>
        <div>
            <div class="d-flex position-relative align-items-center mb-4">
                <span class="intro-overview__subtitle_span intro-overview__subtitle_span_left"></span>
                @if($widget->sub_title)
                    <div class="intro-overview__subtitle">{{ $widget->sub_title }}</div>
                @endif
                <span class="intro-overview__subtitle_span intro-overview__subtitle_span_right"></span>
            </div>
            
            <div class="intro-overview__copy">
                @foreach ($heroParagraphs as $line)
                    <p>{!! nl2br(e($line)) !!}</p>
                @endforeach
            </div>
        </div>
    </div>
</section>
