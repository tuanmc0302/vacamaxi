@php
    $title = data_get($widget, 'title', 'ÄÃNH GIÃ Cá»¦A KHÃCH HÃ€NG');
    $subTitle = data_get($widget, 'sub_title', 'trÃªn Google Maps');
    $defaultItems = [
        [
            'avatar' => '/image/Rectangle 2.png',
            'role' => 'KhÃ¡ch hÃ ng',
            'name' => 'HoÃ ng Trang',
            'content' => 'Thá»‹t bÃ² Vaca Maxi tháº­t sá»± cháº¥t lÆ°á»£ng. BÃ² má»m, tÆ°Æ¡i vÃ  Ä‘Æ°á»£c nÃªm náº¿m ráº¥t vá»«a miá»‡ng.',
        ],
        [
            'avatar' => '/image/Rectangle 3.png',
            'role' => 'KhÃ¡ch hÃ ng',
            'name' => 'TÃ¹ng Phan',
            'content' => 'ÄÃºng chuáº©n quÃ¡n bÃ² cho ngÆ°á»i mÃª thá»‹t. KhÃ´ng gian Ä‘áº¹p, nhÃ¢n viÃªn thÃ¢n thiá»‡n, tÆ° váº¥n mÃ³n ráº¥t cÃ³ tÃ¢m.',
        ],
    ];
    $items = collect(data_get($widget, 'settings.items', $defaultItems))
        ->filter(fn ($item) => filled(data_get($item, 'name')) || filled(data_get($item, 'content')))
        ->take(10)
        ->values();
    $items = $items->isNotEmpty() ? $items : collect($defaultItems);
    $slides = $items->chunk(2)->values();
    $sliderId = 'feedback-slider-' . data_get($widget, 'id', 'default');
@endphp
<section class="testimonial-section">
<div class="container">
        <div class="testimonial-heading">
            <h2>{{ $title }}</h2>
            <p>{{ $subTitle }}</p>
        </div>
        <div id="{{ $sliderId }}" class="testimonial-slider" data-feedback-slider>
            @foreach ($slides as $slideIndex => $slideItems)
                <div class="testimonial-slide {{ $slideIndex === 0 ? 'is-active' : '' }}" data-feedback-slide>
                    @foreach ($slideItems as $item)
                        @php
                            $avatar = data_get($item, 'avatar', '/image/Rectangle 2.png');
                            $avatarSrc = str_starts_with($avatar, 'http') || str_starts_with($avatar, '/') ? $avatar : asset($avatar);
                        @endphp
                        <article class="testimonial-card">
                            <span class="testimonial-quote">â€</span>
                            <div class="d-flex gap-3 mt-3 align-items-center">
                                <img class="testimonial-avatar" src="{{ $avatarSrc }}" alt="{{ data_get($item, 'role', 'KhÃ¡ch hÃ ng') }} {{ data_get($item, 'name', '') }}">
                                <div class="testimonial-item">
                                    <p class="testimonial-role mt-1">{{ data_get($item, 'role', 'KhÃ¡ch hÃ ng') }}</p>
                                    <h3 class="testimonial-name mt-1 mb-0">{{ data_get($item, 'name', 'KhÃ¡ch hÃ ng') }}</h3>
                                </div>
                            </div>
                            <p class="testimonial-text mt-3">{{ data_get($item, 'content') }}</p>
                        </article>
                    @endforeach
                </div>
            @endforeach

            @if ($slides->count() > 1)
                <div class="testimonial-dots" aria-label="Chá»n slide feedback">
                    @foreach ($slides as $slideIndex => $slideItems)
                        <button type="button" class="testimonial-dot {{ $slideIndex === 0 ? 'is-active' : '' }}" data-feedback-dot data-feedback-index="{{ $slideIndex }}" aria-label="Feedback slide {{ $slideIndex + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if ($slides->count() > 1)
        <script>
            (function () {
                const root = document.getElementById(@json($sliderId));
                if (!root) return;

                const slides = Array.from(root.querySelectorAll('[data-feedback-slide]'));
                const dots = Array.from(root.querySelectorAll('[data-feedback-dot]'));
                let activeIndex = 0;

                const showSlide = function (index) {
                    activeIndex = index % slides.length;
                    slides.forEach(function (slide, slideIndex) {
                        slide.classList.toggle('is-active', slideIndex === activeIndex);
                    });
                    dots.forEach(function (dot, dotIndex) {
                        dot.classList.toggle('is-active', dotIndex === activeIndex);
                    });
                };

                dots.forEach(function (dot) {
                    dot.addEventListener('click', function () {
                        showSlide(Number(dot.dataset.feedbackIndex || 0));
                    });
                });

                window.setInterval(function () {
                    showSlide(activeIndex + 1);
                }, 4500);
            })();
        </script>
    @endif
</section>
