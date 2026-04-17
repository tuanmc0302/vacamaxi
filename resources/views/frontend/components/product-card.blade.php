@php
    $class = $class ?? 'breed-card';
    $description = $item['description'] ?? $item['summary'] ?? '';
@endphp
<article class="{{ $class }}">
    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
    <div class="breed-card-body">
        <div>
            <h3>{{ $item['title'] }}</h3>
            <p>{!! nl2br(e($description)) !!}</p>
        </div>
        <a class="breed-link" href="{{ $item['url'] ?? '#' }}">XEM THÊM</a>
    </div>
</article>