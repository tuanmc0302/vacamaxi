@php
    $image = \App\Presentation\Http\Controllers\Frontend\ProductController::imageUrl($product->image);
    $url = \App\Presentation\Http\Controllers\Frontend\ProductController::productUrl($product);
@endphp

<article class="product-card">
    <a href="{{ $url }}" class="product-card__image">
        <img src="{{ $image }}" alt="{{ $product->name }}">
    </a>
    <div class="product-card__body">
        @if(!($hideCategory ?? false))
            <p class="product-card__category">{{ $product->category?->name ?? 'VACAMAXI' }}</p>
        @endif
        <h3 class="product-card__title">
            <a href="{{ $url }}" style="text-decoration: none; color: inherit;">{{ $product->name }}</a>
        </h3>
        @if($showDescription ?? false)
            <p class="product-card__description" style="font-size: 14px; color: #666; margin-bottom: 20px; line-height: 1.5; height: 4.5em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                {{ $product->short_description }}
            </p>
        @else
            <p class="product-card__price" @if(!$product->show_contact_button) style="display:none" @endif>{{ __('Liên hệ') }}</p>
        @endif
        <a href="{{ $url }}" class="btn-vaca" style="min-width: 100%; min-height: 40px; font-size: 12px; padding: 10px;">{{ __('Xem chi tiết') }}</a>
    </div>
</article>
