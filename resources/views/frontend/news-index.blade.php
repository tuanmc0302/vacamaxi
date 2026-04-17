<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tin tức - VACA MAXI</title>
    <meta name="description" content="Tin tức mới nhất từ VACA MAXI">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { margin: 0; background: #fff; color: #111; font-family: Arial, Helvetica, sans-serif; }
        .site-header { position: absolute; inset: 0 0 auto; z-index: 10; background: rgba(16, 16, 16, .62); }
        .site-header .navbar { padding: 0; }
        .brand-mark { width: 170px; max-height: 58px; object-fit: contain; }
        .site-header .nav-link { color: #fff; font-weight: 500; }
        .site-header .nav-link.active, .site-header .nav-link:hover { color: #e7a900; }
        .site-header .dropdown-menu { border: 0; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,.16); }
        @media (min-width: 992px) { .site-header .nav-item.dropdown:hover .dropdown-menu { display: block; margin-top: 0; } }
        .page-hero { min-height: 278px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; background-image: linear-gradient(rgba(0,0,0,.58), rgba(0,0,0,.58)), url('/image/banner.png'); background-size: cover; background-position: center; padding: 105px 16px 54px; }
        .page-hero h1 { margin: 0; font-size: 38px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
        .page-hero p { margin: 8px 0 0; color: rgba(255,255,255,.82); }
        .news-section { padding: 58px 0 70px; }
        .news-heading { display: grid; grid-template-columns: minmax(0, 1fr) minmax(280px, 1fr); gap: 36px; align-items: start; margin-bottom: 56px; }
        .news-kicker { margin: 0 0 8px; font-size: 18px; letter-spacing: 1px; text-transform: uppercase; }
        .news-title { margin: 0; font-size: 32px; font-weight: 700; line-height: 1.12; text-transform: uppercase; }
        .news-title span { color: #e7a900; }
        .news-description { margin: 0; font-size: 18px; line-height: 1.45; letter-spacing: .3px; }
        .news-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 22px 12px; }
        .news-card { overflow: hidden; border-radius: 8px; background: #fff; box-shadow: 0 7px 14px rgba(0,0,0,.22); text-decoration: none; color: inherit; }
        .news-card img { width: 100%; aspect-ratio: 269 / 124; display: block; object-fit: cover; }
        .news-card-body { padding: 11px 13px 13px; }
        .news-card h2 { margin: 0 0 7px; font-size: 20px; font-weight: 700; line-height: 1.1; }
        .news-card p { min-height: 34px; margin: 0 0 13px; font-size: 13px; line-height: 1.35; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .news-meta { display: flex; justify-content: space-between; gap: 12px; font-size: 11px; color: #111; }
        .news-meta strong { font-size: 11px; text-transform: lowercase; }
        .pagination { justify-content: center; margin-top: 42px; }
        .page-link { color: #111; }
        .page-item.active .page-link { border-color: #e7a900; background: #e7a900; color: #fff; }
        @media (max-width: 991.98px) { .news-heading { grid-template-columns: 1fr; margin-bottom: 34px; } .news-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 575.98px) { .brand-mark { width: 140px; } .page-hero h1 { font-size: 30px; } .news-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
@php
    $nav = $frontendData['nav'] ?? [];
    $footer = $frontendData['footer'] ?? [];
    $active = 'news';
@endphp
@include('frontend.partials.header')
<main>
    <section class="page-hero">
        <div>
            <h1>Tin tức</h1>
            <p>Góc nhìn và xu hướng từ VACA MAXI</p>
        </div>
    </section>

    <section class="news-section">
        <div class="container">
            <div class="news-heading">
                <div>
                    <p class="news-kicker">Tin tức mới nhất</p>
                    <h2 class="news-title">Góc nhìn &amp; <span>xu hướng</span></h2>
                </div>
                <p class="news-description">Tin tức mới nhất về nông nghiệp, nhà hàng hiện đại, kết nối văn hóa ẩm thực và những xu hướng ẩm thực đang định hình thị trường.</p>
            </div>

            @if ($posts->isEmpty())
                <p class="text-center text-muted">Chưa có bài viết nào.</p>
            @else
                <div class="news-grid">
                    @foreach ($posts as $post)
                        @php
                            $image = \App\Presentation\Http\Controllers\Frontend\NewsController::imageUrl($post->image, 'image/Rectangle 5.png');
                        @endphp
                        <a class="news-card" href="{{ route('frontend.news.show', $post->slug) }}">
                            <img src="{{ $image }}" alt="{{ $post->title }}">
                            <div class="news-card-body">
                                <h2>{{ $post->title }}</h2>
                                <p>{{ $post->description ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 110) }}</p>
                                <div class="news-meta">
                                    <span>{{ optional($post->published_at)->format('d-m-Y') ?: $post->created_at->format('d-m-Y') }}</span>
                                    <strong>Xem thêm</strong>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{ $posts->links() }}
            @endif
        </div>
    </section>
</main>
@include('frontend.partials.footer')
@include('frontend.partials.floating-contact')
</body>
</html>
