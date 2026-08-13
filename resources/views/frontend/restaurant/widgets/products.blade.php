@php
    $products = $productResolver($widget);
    $buttonText = data_get($widget, 'settings.button_text', 'Xem thêm');
    $buttonUrl = data_get($widget, 'settings.button_url', '/san-pham');

    if ($products->isNotEmpty() && $products->first()->category) {
        $buttonUrl = route('frontend.products.category', ['categorySlug' => $products->first()->category->slug]);
    }
@endphp

<section id="{{ $widget->key === 'restaurant_product_one' ? 'restaurant-products' : $widget->key }}" class="restaurant-products">
    <div class="container">
        <div class="restaurant-products-head">
            <h2>{{ data_get($widget, 'title', 'Sản phẩm VACAMAXI') }}</h2>
            <span></span>
            @if (data_get($widget, 'description'))
                <p>{!! nl2br(e(data_get($widget, 'description'))) !!}</p>
            @endif
        </div>

        @if ($products->isNotEmpty())
            <div class="product-grid restaurant-product-grid">
                @foreach ($products as $product)
                    @include('frontend.products._card', ['product' => $product])
                @endforeach
            </div>
        @else
            <div class="restaurant-empty">{{ __('Chưa có sản phẩm phù hợp.') }}</div>
        @endif

        @if ($buttonText)
            <div class="restaurant-more">
                <a class="btn-vaca" href="{{ $buttonUrl }}">{{ $buttonText }}</a>
            </div>
        @endif
    </div>
</section>
