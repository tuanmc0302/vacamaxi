@php
    $valueItems = $splitLines($widget->description)
        ->map(function ($line) {
            [$title, $body] = array_pad(explode(':', $line, 2), 2, '');

            return [
                'title' => trim($title),
                'body' => trim($body),
            ];
        })
        ->filter(fn ($item) => $item['title'] !== '' || $item['body'] !== '')
        ->values();
    $centerImage = $widgetImages($widget, ['/image/GIÁ TRỊ CỐT LÕI-01 1.png'])->first();
@endphp

@if ($valueItems->isNotEmpty())
    <section class="core-values">
        <div class="container">
            <div class="core-values__wrap">
                <div class="core-values__center">
                    <img src="{{ $centerImage }}" alt="Giá trị cốt lõi VACA MAXI">
                </div>

                @foreach ($valueItems as $index => $item)
                    <article class="core-values__item core-values__item--{{ $index + 1 }}">
                        <h3>{{ $index + 1 }}. {{ mb_strtoupper($item['title']) }}</h3>
                        @if ($item['body'])
                            <p>{{ $item['body'] }}</p>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif
