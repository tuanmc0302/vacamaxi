@php
    $description = $item['description'] ?? $item['summary'] ?? '';
@endphp
<article class="news-card">
    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
    <div class="news-card-body">
        <h3>{{ $item['title'] }}</h3>
        <p>{{ $description }}</p>
        <div class="news-meta">
            <span>{{ $item['date'] }}</span>
            <a href="{{ $item['url'] }}">Xem thêm</a>
        </div>
    </div>
</article>