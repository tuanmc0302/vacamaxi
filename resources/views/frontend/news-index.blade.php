@extends('frontend.master')

@php
    $pageTitle = __('Tin tức') . ' - VACAMAXI';
    $metaDescription = __('Tin tức mới nhất từ VACAMAXI');
    $active = 'news';
@endphp

@push('styles')
    @include('frontend.news._styles')
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ __('Tin tức') }}</h1>
            <p>{{ __('Góc nhìn và xu hướng từ VACAMAXI') }}</p>
        </div>
    </section>

    <section class="news-section">
        <div class="container">
            @forelse ($categories as $categoryIndex => $category)
                @php
                    $posts = $postsByCategory->get($category->id, collect());
                @endphp

                @continue($posts->isEmpty())

                <div class="news-category-block {{ !$loop->first ? 'mt-5 pt-4' : '' }}">
                    <div class="news-heading">
                        <h2 class="news-title">{{ $category->name }}</h2>
                        <span class="heading-line"></span>
                    </div>

                    <div class="news-grid">
                        @foreach ($posts as $post)
                            @php
                                $image = \App\Presentation\Http\Controllers\Frontend\NewsController::imageUrl($post->image, 'image/Rectangle 5.png');
                            @endphp
                            <a class="news-card" href="{{ route('frontend.news.show', ['slug' => $post->slug]) }}">
                                <img src="{{ $image }}" alt="{{ $post->title }}">
                                <div class="news-card-body">
                                    <h3>{{ $post->title }}</h3>
                                    <p>{{ $post->description ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}</p>
                                    <div class="news-meta">
                                        <span>{{ optional($post->published_at)->format('d/m/Y') ?: $post->created_at->format('d/m/Y') }}</span>
                                        <strong>{{ __('Xem thêm') }}</strong>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="news-more">
                        <a href="{{ route('frontend.news.category', ['categorySlug' => $category->slug]) }}" class="btn-vaca">{{ __('Xem thêm') }}</a>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted py-5">{{ __('Chưa có bài viết nào được cập nhật.') }}</p>
            @endforelse
        </div>
    </section>
@endsection
