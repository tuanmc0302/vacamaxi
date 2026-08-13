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
                        <strong>{{ __('Mục lục bài viết') }}</strong>
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
                    <span class="share-label">{{ __('Chia sẻ bài viết:') }}</span>
                    <div class="share-links">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="share-link fb">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://zalo.me/share?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="share-link zalo">
                            {{ __('Zalo') }}
                        </a>
                        <a href="https://www.youtube.com" target="_blank" class="share-link yt">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>

                <div class="comment-section">
                    <div class="comment-card">
                        <h3>{{ __('Viết bình luận của bạn') }}</h3>
                        <div id="comment-success" class="comment-success">
                            {{ __('Bình luận của bạn đã được gửi và đang chờ kiểm duyệt. Cảm ơn bạn!') }}
                        </div>
                        <form id="news-comment-form" class="comment-form" action="{{ route('frontend.news.comment.submit', ['post' => $post]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="full_name" placeholder="{{ __('Họ và Tên') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="{{ __('Gmail') }}">
                            </div>
                            <div class="form-group full-width">
                                <textarea name="content" rows="4" placeholder="{{ __('Nội dung bình luận') }}" required></textarea>
                            </div>
                            <button type="submit" class="btn-submit-comment" id="comment-submit-btn">
                                <span class="btn-text">{{ __('GỬI BÌNH LUẬN') }}</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>

                    @if($post->approvedComments->isNotEmpty())
                        <div class="comments-list mt-5">
                            <h4 class="mb-4" style="color: #250900; font-weight: 800; text-transform: uppercase; font-size: 20px;">
                                {{ __('Bình luận') }} ({{ $post->approvedComments->count() }})
                            </h4>
                            <div class="d-flex flex-column gap-4">
                                @foreach($post->approvedComments as $comment)
                                    <div class="comment-item p-4 rounded-4" style="background: #fff; border: 1px solid #eee;">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong style="color: #250900; font-size: 16px;">{{ $comment->full_name }}</strong>
                                            <span style="color: #999; font-size: 13px;">{{ $comment->created_at->format('d/m/Y') }}</span>
                                        </div>
                                        <p class="mb-0" style="color: #555; line-height: 1.6;">{{ $comment->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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
                                <a class="news-card" href="{{ route('frontend.news.show', ['slug' => $relatedPost->slug]) }}">
                                    <img src="{{ $relatedImage }}" alt="{{ $relatedPost->title }}">
                                    <div class="news-card-body">
                                        <h3>{{ $relatedPost->title }}</h3>
                                        <p>{{ $relatedPost->description ?: \Illuminate\Support\Str::limit(strip_tags($relatedPost->content), 100) }}</p>
                                        <div class="news-meta">
                                            <span>{{ optional($relatedPost->published_at)->format('d/m/Y') ?: $relatedPost->created_at->format('d/m/Y') }}</span>
                                            <strong>{{ __('Xem thêm') }}</strong>
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
        const submitBtn = document.getElementById('comment-submit-btn');
        const btnText = submitBtn ? submitBtn.querySelector('.btn-text') : null;
        const spinner = submitBtn ? submitBtn.querySelector('.spinner-border') : null;

        const sendingText = "{{ __('ĐANG GỬI...') }}";
        const commentText = "{{ __('GỬI BÌNH LUẬN') }}";
        const errorText = "{{ __('Có lỗi xảy ra, vui lòng thử lại sau.') }}";

        if (form && successMsg && submitBtn) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading
                submitBtn.disabled = true;
                if(btnText) btnText.textContent = sendingText;
                if(spinner) spinner.classList.remove('d-none');

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    form.style.display = 'none';
                    successMsg.style.display = 'block';
                    successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(errorText);
                    submitBtn.disabled = false;
                    if(btnText) btnText.textContent = commentText;
                    if(spinner) spinner.classList.add('d-none');
                });
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
