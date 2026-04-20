@php
    $heroLines = $splitLines($widget->description);
    $heroHeadline = $heroLines->get(0);
    $heroParagraphs = $heroLines->slice(1, 2);
    $heroBullets = $heroLines->slice(3);
@endphp

<section class="page-hero">
    <div class="container">
        <h1>{{ $widget->title ?: 'QUY MÔ - CÔNG NGHỆ' }}</h1>
        @if ($widget->sub_title)
            <p>{{ $widget->sub_title }}</p>
        @endif

        <div class="mt-4" style="max-width: 900px; margin: 0 auto; font-size: 16px;">
            @if ($heroHeadline)
                <p class="mb-3 font-weight-bold" style="font-size: 18px;">{{ $heroHeadline }}</p>
            @endif

            @foreach ($heroParagraphs as $line)
                <p class="mb-2">{{ $line }}</p>
            @endforeach

            @if ($heroBullets->isNotEmpty())
                <div class="mt-3">
                    @foreach ($heroBullets as $line)
                        <p class="mb-1">• {{ ltrim($line, '–- ') }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
