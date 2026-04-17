@extends('frontend.master')

@php
    $pageTitle = 'Tin tức - VACA MAXI';
    $metaDescription = 'Tin tức mới nhất từ VACA MAXI';
    $active = 'news';
@endphp

@push('styles')
    @include('frontend.news._styles')
@endpush

@section('content')
    <section class="page-hero">
        <div>
            <h1>Tin tức</h1>
            <p>Góc nhìn và xu hướng từ VACA MAXI</p>
        </div>
    </section>

    <section class="news-section">
        <div class="container">
            @forelse ($categories as $categoryIndex => $category)
                @php
                    $posts = $postsByCategory->get($category->id, collect());
                @endphp

                @continue($posts->isEmpty())

                <div class="news-category-block">
                    <div class="news-heading">
                        <div>
                            <p class="news-kicker">{{ $categoryIndex === 0 ? 'Tin tức mới nhất' : 'Tin tức' }}</p>
                            <h2 class="news-title">{{ $category->name }}</h2>
                        </div>
                        <p class="news-description">{{ $category->description ?: 'Tin tức mới nhất về nông nghiệp, nhà hàng hiện đại, kết nối văn hóa ẩm thực và những xu hướng đang định hình thị trường.' }}</p>
                    </div>

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

                    <a class="news-more" href="{{ route('frontend.news.category', $category->slug) }}">Xem thêm</a>
                </div>
            @empty
                <p class="text-center text-muted">Chưa có danh mục tin tức nào.</p>
            @endforelse
        </div>
    </section>
@endsection
