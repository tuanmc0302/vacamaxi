@extends('frontend.master')

@php
    $pageTitle = ($product->seo_title ?: $product->name) . ' - VACA MAXI';
    $metaDescription = $product->seo_description ?: ($product->short_description ?: 'Chi tiết sản phẩm ' . $product->name);
    $active = 'product-' . ($product->category?->slug ?? '');
    $image = \App\Presentation\Http\Controllers\Frontend\ProductController::imageUrl($product->image);
    $thumbs = collect([$image, '/image/Rectangle 2.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png'])->take(4);
    $code = str_pad((string) $product->id, 2, '0', STR_PAD_LEFT);
@endphp

@push('styles')
    @include('frontend.products._styles')
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ $product->name }}</h1>
            <p>Trang chủ / Sản phẩm / {{ $product->category?->name ?? 'VACA MAXI' }}</p>
        </div>
    </section>

    <section class="product-detail">
        <div class="container">
            <div class="detail-layout">
                <div class="product-gallery">
                    <img class="main-product-image" src="{{ $image }}" alt="{{ $product->name }}">
                    <div class="thumb-grid">
                        @foreach ($thumbs as $thumb)
                            <img src="{{ $thumb }}" alt="{{ $product->name }}">
                        @endforeach
                    </div>
                </div>

                <div class="product-info">
                    <h2>{{ $product->name }}</h2>
                    <div class="product-code">
                        <span>Mã: {{ $code }}</span>
                        <span>Thương hiệu Vaca Maxi</span>
                        <span class="stars">★★★★★</span>
                        <span>0 Đánh giá</span>
                    </div>
                    <div class="contact-price">Liên hệ</div>
                    <div class="product-summary">
                        @if ($product->short_description)
                            <p>{{ $product->short_description }}</p>
                        @endif

                        @php
                            $summaryLines = collect(preg_split('/\r\n|\r|\n/', strip_tags($product->description ?? '')))
                                ->filter()
                                ->take(3);
                        @endphp

                        @if ($summaryLines->isNotEmpty())
                            <ul>
                                @foreach ($summaryLines as $line)
                                    <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                        @else
                            <ul>
                                <li>Sản phẩm được chọn lọc theo tiêu chuẩn VACA MAXI.</li>
                                <li>Phù hợp cho nhà hàng, quà tặng và trải nghiệm ẩm thực cao cấp.</li>
                            </ul>
                        @endif
                    </div>

                    <div class="quantity-row">
                        <span>Số lượng</span>
                        <input type="number" value="1" min="1" aria-label="Số lượng">
                    </div>

                    <div class="action-row">
                        <a class="buy-now" href="#contact">Mua ngay</a>
                        <button type="button">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-tabs">
        <div class="container">
            <div class="tab-buttons">
                <button class="active" type="button">Thông tin sản phẩm</button>
                <button type="button">Hướng dẫn mua hàng</button>
                <button type="button">Giao hàng</button>
            </div>
            <div class="description-box">
                @if ($product->description)
                    {!! $product->description !!}
                @else
                    <p>{{ $product->short_description ?: 'Sản phẩm VACA MAXI được tuyển chọn theo tiêu chuẩn chất lượng cao, phù hợp cho trải nghiệm ẩm thực tinh tế.' }}</p>
                @endif
            </div>
        </div>
    </section>

    @if ($relatedProducts->isNotEmpty())
        <section class="related-products">
            <div class="container">
                <h2 class="category-title mt-0">{{ $product->category?->name ?? 'Sản phẩm liên quan' }}</h2>
                <div class="product-grid">
                    @foreach ($relatedProducts as $relatedProduct)
                        @include('frontend.products._card', ['product' => $relatedProduct])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
