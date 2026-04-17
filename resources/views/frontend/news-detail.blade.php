@extends('frontend.master')

@php
    $pageTitle = ($post->seo_title ?: $post->title) . ' - VACA MAXI';
    $metaDescription = $post->seo_description ?: $post->description;
    $active = 'news';
    $image = \App\Presentation\Http\Controllers\Frontend\NewsController::imageUrl($post->image, 'image/Rectangle 4.png');
    $description = $post->description ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 220);
@endphp

@push('styles')
    @include('frontend.news._styles')
    <style>
        .article-section { padding: 44px 0 70px; background: #f5f5f5; }
        .article-shell { background: #fff; border-radius: 14px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,.08); }
        .article-top { display: grid; grid-template-columns: minmax(300px, 42%) minmax(0, 1fr); gap: 26px; align-items: start; margin-bottom: 30px; }
        .article-cover { width: 100%; aspect-ratio: 422 / 280; object-fit: cover; border-radius: 4px; box-shadow: 0 8px 18px rgba(0,0,0,.15); }
        .article-summary h2 { margin: 0 0 8px; font-size: 32px; font-weight: 700; line-height: 1.16; color: #151515; }
        .article-summary .title-rule { display: flex; align-items: center; gap: 10px; margin: 0 0 12px; }
        .article-summary .title-rule::before { content: ""; width: 100%; height: 1px; background: #e7a900; }
        .article-meta { margin: 0 0 13px; color: #777; font-size: 13px; }
        .article-summary p { margin: 0; font-size: 15px; line-height: 1.75; }
        .article-note { max-width: 520px; margin: 20px 0 26px; padding: 16px 18px; border-radius: 8px; background: #c3a98a; color: #fff; }
        .article-note strong { display: block; margin-bottom: 6px; font-size: 15px; }
        .article-note ul { margin: 0; padding-left: 18px; font-size: 14px; line-height: 1.55; }
        .article-content { max-width: 920px; font-size: 15px; line-height: 1.85; }
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
        @media (max-width: 991.98px) {
            .article-shell { padding: 20px; }
            .article-top { grid-template-columns: 1fr; }
            .related-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 575.98px) {
            .article-summary h2 { font-size: 26px; }
            .related-grid { grid-template-columns: 1fr; }
        }
    </style>
@endpush

@section('content')
    <section class="page-hero">
        <div>
            <h1>{{ $post->title }}</h1>
            <p>{{ optional($post->category)->name ?: 'Tin tức VACA MAXI' }}</p>
        </div>
    </section>

    <section class="article-section">
        <div class="container">
            <div class="article-shell">
                <div class="article-top">
                    <img class="article-cover" src="{{ $image }}" alt="{{ $post->title }}">
                    <div class="article-summary">
                        <h2>{{ $post->title }}</h2>
                        <div class="title-rule" aria-hidden="true"></div>
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
        </div>
    </section>
@endsection
