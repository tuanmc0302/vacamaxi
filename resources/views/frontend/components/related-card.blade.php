@php
    $brand = $item['brand'] ?? ($item['price'] ?? '');
    $status = $item['status'] ?? 'Liên hệ';
@endphp
<article class="related-card">
    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
    <h3>{{ $item['title'] }}</h3>
    <p class="brand">{{ $brand }}</p>
    <p class="contact">{{ $status }}</p>
    <a class="view" href="{{ $item['url'] ?? '#' }}">{{ __('Xem thêm') }}</a>
</article>