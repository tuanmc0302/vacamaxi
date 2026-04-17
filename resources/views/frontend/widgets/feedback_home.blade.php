@php
    $title = data_get($widget, 'title', 'ĐÁNH GIÁ CỦA KHÁCH HÀNG');
    $subTitle = data_get($widget, 'sub_title', 'trên Google Maps');
    $defaultItems = [
        [
            'avatar' => '/image/Rectangle 2.png',
            'role' => 'Khách hàng',
            'name' => 'Hoàng Trang',
            'content' => 'Thịt bò Vaca Maxi thật sự chất lượng. Bò mềm, tươi và được nêm nếm rất vừa miệng.',
        ],
        [
            'avatar' => '/image/Rectangle 3.png',
            'role' => 'Khách hàng',
            'name' => 'Tùng Phan',
            'content' => 'Đúng chuẩn quán bò cho người mê thịt. Không gian đẹp, nhân viên thân thiện, tư vấn món rất có tâm.',
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
    <style>
        #{{ $sliderId }} .testimonial-slide {
            display: none;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 26px;
        }

        #{{ $sliderId }} .testimonial-slide.is-active {
            display: grid;
        }

        #{{ $sliderId }} .testimonial-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 22px;
        }

        #{{ $sliderId }} .testimonial-dot {
            width: 9px;
            height: 9px;
            border: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.45);
            padding: 0;
        }

        #{{ $sliderId }} .testimonial-dot.is-active {
            background: #f3b21a;
        }

        @media (max-width: 767.98px) {
            #{{ $sliderId }} .testimonial-slide {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                            <span class="testimonial-quote">”</span>
                            <div class="d-flex gap-3 mt-3 align-items-center">
                                <img class="testimonial-avatar" src="{{ $avatarSrc }}" alt="{{ data_get($item, 'role', 'Khách hàng') }} {{ data_get($item, 'name', '') }}">
                                <div class="testimonial-item">
                                    <p class="testimonial-role mt-1">{{ data_get($item, 'role', 'Khách hàng') }}</p>
                                    <h3 class="testimonial-name mt-1 mb-0">{{ data_get($item, 'name', 'Khách hàng') }}</h3>
                                </div>
                            </div>
                            <p class="testimonial-text mt-3">{{ data_get($item, 'content') }}</p>
                        </article>
                    @endforeach
                </div>
            @endforeach

            @if ($slides->count() > 1)
                <div class="testimonial-dots" aria-label="Chọn slide feedback">
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