@php
    $introParagraphs = $splitLines($widget->description);
    $galleryImages = $widgetImages($widget, ['/image/Rectangle 11.png', '/image/Rectangle 2.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png']);
@endphp

<section class="about-story">
    <div class="container">
        <div class="about-story__grid">
            <div class="about-story__gallery">
                @foreach ($galleryImages as $image)
                    <div class="about-story__media">
                        <img src="{{ $image }}" alt="VACA MAXI">
                    </div>
                @endforeach
            </div>

            <div class="about-story__content">
                <p class="about-story__eyebrow">{{ $widget->title ?: 'VACA MAXI' }}</p>
                @if ($widget->sub_title)
                    <p class="about-story__quote">{{ $widget->sub_title }}</p>
                @endif

                <div class="about-story__block">
                    <p>{{ $introParagraphs->get(0) }}</p>
                </div>

                <div class="about-story__block">
                    <p>{{ $introParagraphs->get(1) }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
