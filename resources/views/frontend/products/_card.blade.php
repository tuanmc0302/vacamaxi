@php
    $image = \App\Presentation\Http\Controllers\Frontend\ProductController::imageUrl($product->image);
    $url = \App\Presentation\Http\Controllers\Frontend\ProductController::productUrl($product);
    $code = str_pad((string) $product->id, 2, '0', STR_PAD_LEFT);
@endphp

<a class="catalog-card" href="{{ $url }}">
    <img src="{{ $image }}" alt="{{ $product->name }}">
    <h3>{{ $product->name }}</h3>
    <p class="meta">Mã: {{ $code }} | {{ $product->category?->name ?? 'Vaca Maxi' }}</p>
    <p class="status">Liên hệ</p>
    <span class="view">Xem thêm</span>
</a>
