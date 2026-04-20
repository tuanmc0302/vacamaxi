@extends('frontend.master')

@php
    $pageTitle = ($post->seo_title ?: $post->title) . ' - VACAMAXI';
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
            <p>{{ optional($post->category)->name ?: 'Tin tức VACAMAXI' }}</p>
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
                                &bull; {{ $post->category->name }}
                            @endif
                        </p>
                        <p>{{ $description }}</p>
                    </div>
                </div>

                <div class="article-toc" id="toc-container" style="display: none;">
                    <div class="toc-header">
                        <i class="bi bi-list-ul"></i>
                        <strong>Mục lục bài viết</strong>
                    </div>
                    <ul id="toc-list"></ul>
                </div>

                <article class="article-content" id="post-content">
                    @if ($post->content)
                        {!! $post->content !!}
                    @else
                        <p>{{ $description }}</p>
                    @endif
                </article>

                <div class="article-share">
                    <span class="share-label">Chia sẻ bài viết:</span>
                    <div class="share-links">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="share-link fb">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://zalo.me/share?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="share-link zalo">
                            Zalo
                        </a>
                        <a href="https://www.youtube.com" target="_blank" class="share-link yt">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>

                <div class="comment-section">
                    <div class="comment-card">
                        <h3>Viết bình luận của bạn</h3>
                        <div id="comment-success" class="comment-success">
                            Bình luận của bạn đã được gửi và đang chờ kiểm duyệt. Cảm ơn bạn!
                        </div>
                        <form id="news-comment-form" class="comment-form">
                            <div class="form-group">
                                <input type="text" placeholder="Họ và Tên" required>
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Gmail" required>
                            </div>
                            <div class="form-group full-width">
                                <textarea rows="4" placeholder="Nội dung bình luận" required></textarea>
                            </div>
                            <button type="submit" class="btn-submit-comment">GỬI BÌNH LUẬN</button>
                        </form>
                    </div>
                </div>

                @if ($relatedPosts->isNotEmpty())
                    <section class="related-section">
                        <div class="related-title">
                            <h2>Bài viết liên quan</h2>
                            <span></span>
                        </div>
                        <div class="news-grid">
                            @foreach ($relatedPosts as $relatedPost)
                                @php
                                    $relatedImage = \App\Presentation\Http\Controllers\Frontend\NewsController::imageUrl($relatedPost->image, 'image/Rectangle 5.png');
                                @endphp
                                <a class="news-card" href="{{ route('frontend.news.show', $relatedPost->slug) }}">
                                    <img src="{{ $relatedImage }}" alt="{{ $relatedPost->title }}">
                                    <div class="news-card-body">
                                        <h3>{{ $relatedPost->title }}</h3>
                                        <p>{{ $relatedPost->description ?: \Illuminate\Support\Str::limit(strip_tags($relatedPost->content), 100) }}</p>
                                        <div class="news-meta">
                                            <span>{{ optional($relatedPost->published_at)->format('d/m/Y') ?: $relatedPost->created_at->format('d/m/Y') }}</span>
                                            <strong>Xem thêm</strong>
                                        </div>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Comment Form Logic
        const form = document.getElementById('news-comment-form');
        const successMsg = document.getElementById('comment-success');

        if (form && successMsg) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                form.style.display = 'none';
                successMsg.style.display = 'block';
            });
        }

        // TOC Generation Logic
        const content = document.getElementById('post-content');
        const tocContainer = document.getElementById('toc-container');
        const tocList = document.getElementById('toc-list');
        
        if (content && tocContainer && tocList) {
            const headings = content.querySelectorAll('h2, h3');
            
            if (headings.length > 0) {
                headings.forEach((heading, index) => {
                    // Create an ID for the heading if it doesn't have one
                    const id = 'heading-' + index;
                    heading.id = id;
                    
                    // Create TOC item
                    const li = document.createElement('li');
                    li.className = 'toc-item toc-' + heading.tagName.toLowerCase();
                    
                    const a = document.createElement('a');
                    a.href = '#' + id;
                    a.textContent = heading.textContent;
                    a.addEventListener('click', function(e) {
                        e.preventDefault();
                        const target = document.getElementById(id);
                        const headerOffset = 100;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: "smooth"
                        });
                    });
                    
                    li.appendChild(a);
                    tocList.appendChild(li);
                });
                
                tocContainer.style.display = 'block';
            }
        }
    });
</script>
@endpush
