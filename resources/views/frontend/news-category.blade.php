@extends('frontend.master')

@php
    $pageTitle = $category->name . ' - VACA MAXI';
    $metaDescription = $category->description ?: ('Danh sách tin tức ' . $category->name);
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
                <div>
                    <p class="news-kicker">Tin tức</p>
                    <h2 class="news-title">{{ $category->name }}</h2>
                </div>
                <p class="news-description">
                    {{ $category->description ?: 'Tin tức mới nhất về nông nghiệp, nhà hàng hiện đại, kết nối văn hóa ẩm thực và những xu hướng đang định hình thị trường.' }}
                </p>
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
@endsection
