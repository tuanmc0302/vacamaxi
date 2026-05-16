@php
    $isPost = $item instanceof \App\Models\Post;
    $title = $isPost ? $item->title : data_get($item, 'title', '');
    $image = $isPost
        ? \App\Presentation\Http\Controllers\Frontend\NewsController::imageUrl($item->image, 'image/Rectangle 5.png')
        : data_get($item, 'image', asset('image/Rectangle 5.png'));
    $description = $isPost
        ? ($item->description ?: \Illuminate\Support\Str::limit(strip_tags($item->content ?? ''), 100))
        : (data_get($item, 'description') ?? data_get($item, 'summary', ''));
    $date = $isPost
        ? (optional($item->published_at)->format('d/m/Y') ?: $item->created_at->format('d/m/Y'))
        : data_get($item, 'date', '');
    $url = $isPost ? route('frontend.news.show', $item->slug) : data_get($item, 'url', '#');
@endphp
<article class="news-card">
    <img src="{{ $image }}" alt="{{ $title }}">
    <div class="news-card-body">
        <h3>{{ $title }}</h3>
        <p>{{ $description }}</p>
        <div class="news-meta">
            <span>{{ $date }}</span>
            <a href="{{ $url }}">Xem thêm</a>
        </div>
    </div>
</article>
