<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->seo_title ?: $post->title }} - VACA MAXI</title>
    <meta name="description" content="{{ $post->seo_description ?: $post->description }}">
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
        .page-hero { min-height: 278px; display: flex; align-items: center; justify-content: center; text-align: center; color: #fff; background-image: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('/image/banner.png'); background-size: cover; background-position: center; padding: 105px 16px 54px; }
        .page-hero h1 { margin: 0; font-size: 34px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        .page-hero p { margin: 8px 0 0; color: rgba(255,255,255,.82); }
        .article-section { padding: 44px 0 70px; }
        .article-top { display: grid; grid-template-columns: minmax(300px, 42%) minmax(0, 1fr); gap: 26px; align-items: start; margin-bottom: 30px; }
        .article-cover { width: 100%; aspect-ratio: 422 / 280; object-fit: cover; border-radius: 4px; box-shadow: 0 8px 18px rgba(0,0,0,.15); }
        .article-summary h2 { margin: 0 0 8px; font-size: 28px; font-weight: 700; line-height: 1.18; }
        .article-meta { margin: 0 0 13px; color: #777; font-size: 13px; }
        .article-summary p { margin: 0; font-size: 16px; line-height: 1.75; }
        .article-note { max-width: 430px; margin: 20px 0 26px; padding: 16px 18px; border-radius: 6px; background: #c3a98a; color: #fff; }
        .article-note strong { display: block; margin-bottom: 6px; font-size: 15px; }
        .article-note ul { margin: 0; padding-left: 18px; font-size: 14px; line-height: 1.55; }
        .article-content { max-width: 920px; font-size: 16px; line-height: 1.85; }
        .article-content h1, .article-content h2, .article-content h3 { margin: 28px 0 12px; font-weight: 700; line-height: 1.2; }
        .article-content img { max-width: 100%; height: auto; border-radius: 6px; }
        .related-section { padding-top: 34px; margin-top: 44px; border-top: 1px solid #e5e5e5; }
        .related-title { margin: 0 0 24px; font-size: 28px; font-weight: 700; text-transform: uppercase; }
        .related-title span { color: #e7a900; }
        .related-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; }
        .related-card { overflow: hidden; border-radius: 8px; background: #fff; box-shadow: 0 7px 14px rgba(0,0,0,.18); color: inherit; text-decoration: none; }
        .related-card img { width: 100%; aspect-ratio: 269 / 124; object-fit: cover; display: block; }
        .related-card-body { padding: 11px 13px 13px; }
        .related-card h3 { margin: 0 0 8px; font-size: 18px; font-weight: 700; line-height: 1.15; }
        .related-card p { margin: 0; font-size: 13px; line-height: 1.35; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        @media (max-width: 991.98px) { .article-top { grid-template-columns: 1fr; } .related-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 575.98px) { .brand-mark { width: 140px; } .page-hero h1 { font-size: 28px; } .related-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
@php
    $nav = $frontendData['nav'] ?? [];
    $footer = $frontendData['footer'] ?? [];
    $active = 'news';
    $image = \App\Presentation\Http\Controllers\Frontend\NewsController::imageUrl($post->image, 'image/Rectangle 4.png');
    $description = $post->description ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 220);
@endphp
@include('frontend.partials.header')
<main>
    <section class="page-hero">
        <div>
            <h1>{{ $post->title }}</h1>
            <p>{{ optional($post->category)->name ?: 'Tin tức VACA MAXI' }}</p>
        </div>
    </section>

    <section class="article-section">
        <div class="container">
            <div class="article-top">
                <img class="article-cover" src="{{ $image }}" alt="{{ $post->title }}">
                <div class="article-summary">
                    <h2>{{ $post->title }}</h2>
                    <p class="article-meta">
                        {{ optional($post->published_at)->format('d/m/Y') ?: $post->created_at->format('d/m/Y') }}
                        @if ($post->category)
                            · {{ $post->category->name }}
                        @endif
                    </p>
                    <p>{{ $description }}</p>
                </div>
            </div>

            @if ($description)
                <div class="article-note">
                    <strong>Nội dung bài viết</strong>
                    <ul>
                        <li>{{ \Illuminate\Support\Str::limit($description, 90) }}</li>
                    </ul>
                </div>
            @endif

            <article class="article-content">
                @if ($post->content)
                    {!! $post->content !!}
                @else
                    <p>{{ $description }}</p>
                @endif
            </article>

            @if ($relatedPosts->isNotEmpty())
                <section class="related-section">
                    <h2 class="related-title">Bài viết <span>liên quan</span></h2>
                    <div class="related-grid">
                        @foreach ($relatedPosts as $relatedPost)
                            @php
                                $relatedImage = \App\Presentation\Http\Controllers\Frontend\NewsController::imageUrl($relatedPost->image, 'image/Rectangle 5.png');
                            @endphp
                            <a class="related-card" href="{{ route('frontend.news.show', $relatedPost->slug) }}">
                                <img src="{{ $relatedImage }}" alt="{{ $relatedPost->title }}">
                                <div class="related-card-body">
                                    <h3>{{ $relatedPost->title }}</h3>
                                    <p>{{ $relatedPost->description ?: \Illuminate\Support\Str::limit(strip_tags($relatedPost->content), 90) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </section>
</main>
@include('frontend.partials.footer')
@include('frontend.partials.floating-contact')
</body>
</html>
