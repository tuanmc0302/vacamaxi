@php
    $title = data_get($widget, 'title', 'GÓC NHÌN & XU HƯỚNG');
    $subTitle = data_get($widget, 'sub_title', 'TIN TỨC MỚI NHẤT');
    $description = data_get($widget, 'description');
    $highlight = data_get($widget, 'settings.highlight', 'XU HƯỚNG');
    $buttonText = data_get($widget, 'settings.button_text', 'XEM THÊM');
    $buttonUrl = data_get($widget, 'settings.button_url', '/tin-tuc/ruou-trang-tam-coc');
    $news = $news ?? [];
@endphp
<section class="news-section">
    <div class="container">
        <div class="row news-intro align-items-start g-4">
            <div class="col-lg-5">
                <p class="news-kicker">{{ $subTitle }}</p>
                <h2 class="news-title">
                    @if($highlight && str_contains($title, $highlight))
                        {!! e(str_replace($highlight, '', $title)) !!}<span>{{ $highlight }}</span>
                    @else
                        {{ $title }}
                    @endif
                </h2>
            </div>
            <div class="col-lg-7">
                <p class="news-description">{!! nl2br(e($description)) !!}</p>
            </div>
        </div>
        <div class="news-grid">
            @foreach($news as $item)
                @include('frontend.components.news-card', ['item' => $item])
            @endforeach
        </div>
        <div class="news-more">
            <a href="{{ $buttonUrl }}" class="about-action">{{ $buttonText }}</a>
        </div>
    </div>
</section>