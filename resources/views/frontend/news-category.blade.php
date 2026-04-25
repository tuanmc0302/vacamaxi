@extends('frontend.master')

@php
    $pageTitle = $category->name . ' - VACAMAXI';
    $metaDescription = $category->description ?: 'Tin tức thuộc danh mục ' . $category->name;
    $active = 'news';
@endphp

@push('styles')
    @include('frontend.news._styles')
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ $category->name }}</h1>
            <p>Trang chủ / Tin tức / {{ $category->name }}</p>
        </div>
    </section>

    <section class="news-section">
        <div class="container">
            <div class="news-heading">
                <h2 class="news-title">Tin mới nhất</h2>
                <span class="heading-line"></span>
            </div>

            <div class="news-grid">
                @foreach ($posts as $post)
                    @php
                        $image = \App\Presentation\Http\Controllers\Frontend\NewsController::imageUrl($post->image, 'image/Rectangle 5.png');
                    @endphp
                    <a class="news-card" href="{{ route('frontend.news.show', $post->slug) }}">
                        <img src="{{ $image }}" alt="{{ $post->title }}">
                        <div class="news-card-body">
                            <h3>{{ $post->title }}</h3>
                            <p>{{ $post->description ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}</p>
                            <div class="news-meta">
                                <span>{{ optional($post->published_at)->format('d/m/Y') ?: $post->created_at->format('d/m/Y') }}</span>
                                <strong>Xem thêm</strong>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $posts->links() }}
            </div>

            @if ($posts->isEmpty())
                <p class="text-center text-muted py-5">Chưa có bài viết nào trong danh mục này.</p>
            @endif
        </div>
    </section>
@endsection
