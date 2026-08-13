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

    $locale = app()->getLocale();
    $centerImage = null;
    if ($locale === 'en') {
        $centerImage = data_get($widget, 'settings.image_en') ?: data_get($widget, 'settings.images_en.0');
        if ($centerImage) {
            $centerImage = (str_starts_with($centerImage, 'http://') || str_starts_with($centerImage, 'https://') || str_starts_with($centerImage, '/'))
                ? $centerImage
                : (str_starts_with($centerImage, 'image/') ? asset($centerImage) : asset('storage/' . $centerImage));
        }
    }
    if (!$centerImage) {
        $centerImage = $widgetImages($widget, ['/image/GIÁ TRỊ CỐT LÕI-01 1.png'])->first();
    }
@endphp

@if ($valueItems->isNotEmpty())
    <section class="core-values">
        <div class="container">
            <div class="core-values__wrap">
                <div class="core-values__center">
                    <img src="{{ $centerImage }}" alt="Giá trị cốt lõi VACAMAXI">
                </div>
            </div>
        </div>
    </section>
@endif
