<section class="about-cta-inline">
    <div class="container">
        <div class="about-cta-inline__inner">
            <div>
                <h2>{{ $widget->title ?: 'Tìm hiểu thêm về VACAMAXI' }}</h2>
                @if ($widget->description)
                    <p>{{ $widget->description }}</p>
                @endif
            </div>
            <a href="{{ data_get($widget, 'settings.button_url', '/gioi-thieu') }}" class="about-cta-inline__button">
                {{ data_get($widget, 'settings.button_text', 'Xem thêm') }}
            </a>
        </div>
    </div>
</section>
