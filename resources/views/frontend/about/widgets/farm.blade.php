@php
    $farmLines = $splitLines($widget->description);
    $farmImage = $widgetImages($widget, ['/image/Rectangle 11.png'])->first();
@endphp

<section class="about-feature about-feature--farm">
    <div class="container">
        <div class="about-feature__grid">
            <div class="about-feature__image">
                <img src="{{ $farmImage }}" alt="Mô hình trang trại VACA MAXI">
            </div>

            <div class="about-feature__content">
                <div class="section-line-title">
                    <h2>{{ mb_strtoupper($widget->title ?: 'Mô hình trang trại') }}</h2>
                </div>
                @foreach ($farmLines as $index => $line)
                    @if ($index === 0)
                        <p><strong>{{ $line }}</strong></p>
                    @else
                        <p>{{ str_starts_with($line, '–') || str_starts_with($line, '-') ? ltrim($line, '–- ') : $line }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
