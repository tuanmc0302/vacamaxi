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
    <link rel="stylesheet" href="{{ asset('css/frontend/news-detail.css') }}">
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
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
                                Â· {{ $post->category->name }}
                            @endif
                        </p>
                        <p>{{ $description }}</p>
                    </div>
                </div>

                @if ($description)
                    <div class="article-note">
                        <strong>Ná»™i dung bÃ i viáº¿t</strong>
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
                        <h2 class="related-title">BÃ i viáº¿t <span>liÃªn quan</span></h2>
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

