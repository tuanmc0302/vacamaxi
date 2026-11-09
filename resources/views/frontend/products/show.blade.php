@extends('frontend.master')

@php
    $pageTitle = $product->name . ' - VACAMAXI';
    $metaDescription = $product->short_description ?: Str::limit(strip_tags($product->description), 160);
    $active = 'product';
    $productImage = \App\Presentation\Http\Controllers\Frontend\ProductController::imageUrl($product->image);
@endphp

@push('styles')
    @include('frontend.products._styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/product-detail.css') }}">
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ $product->name }}</h1>
            <p>{{ __('Trang chủ') }} / {{ __('Sản phẩm') }} / {{ $product->category?->name ?? __('Chi tiết') }}</p>
        </div>
    </section>

    <section class="product-detail">
        <div class="container">
            <div class="product-detail__grid">
                <div class="product-detail__gallery">
                    <div class="product-detail__main-image">
                        <img src="{{ $productImage }}" alt="{{ $product->name }}">
                    </div>
                </div>
                
                <div class="product-detail__info">
                    <h2 class="product-detail__title">{{ $product->name }}</h2>
                    <div class="product-detail__meta">
                        <span>{{ __('MÃ:') }} {{ $product->sku ?? '006' }}</span>
                        <span class="divider">|</span>
                        <span>{{ __('Thương hiệu') }} {{ $product->brand ?? 'VACAMAXI' }}</span>
                        <span class="divider">|</span>
                        <span class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </span>
                    </div>

                    <div class="product-detail__status">
                        <span class="status-label">{{ __('Liên hệ') }}</span>
                    </div>

                    <div class="product-detail__excerpt">
                        @if($product->slug === 'thit-bo-vaca-a' || $product->slug_en === 'vaca-a')
                            {{ __('Theo Bộ Nông nghiệp Hoa Kỳ (USDA) thịt bò Vaca - A đạt điểm vân mỡ cao, giúp sản phẩm có giá trị cao trên thị trường. Dễ chế biến, thích hợp cho nhà hàng') }}<br>
                            {{ __('Sinh sản ổn định: bản năng làm mẹ tốt.') }}
                        @else
                            {!! nl2br(e($product->short_description)) !!}
                        @endif
                    </div>

                    <div class="product-detail__purchase">
                        <div class="quantity-wrapper">
                            <label>{{ __('Số Lượng') }}</label>
                            <div class="quantity-selector">
                                <button type="button" class="qty-btn minus">-</button>
                                <input type="text" id="product-qty" value="01" readonly class="qty-input">
                                <button type="button" class="qty-btn plus">+</button>
                            </div>
                        </div>
                        
                        <div class="button-group">
                            <button type="button" class="btn-buy-now">{{ __('MUA NGAY') }}</button>
                            <button type="button" class="btn-add-cart">{{ __('THÊM VÀO GIỎ HÀNG') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-detail__tabs">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-pane" type="button" role="tab">{{ __('Thông tin sản phẩm') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="guide-tab" data-bs-toggle="tab" data-bs-target="#guide-pane" type="button" role="tab">{{ __('Hướng dẫn mua hàng') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping-pane" type="button" role="tab">{{ __('Giao hàng') }}</button>
                    </li>
                </ul>
                <div class="tab-content" id="productTabsContent">
                    <div class="tab-pane fade show active" id="info-pane" role="tabpanel" tabindex="0">
                        <div class="py-4">
                            <div class="tab-content-wrapper" id="info-content-wrapper">
                                <div class="tab-real-content">
                                    {!! $product->description !!}
                                    @if($product->specifications)
                                        <div class="mt-4">
                                            {!! $product->specifications !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="read-more-wrapper">
                                <button type="button" class="btn-read-more" data-bs-toggle="modal" data-bs-target="#infoModal">{{ __('Xem thêm') }}</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="guide-pane" role="tabpanel" tabindex="0">
                        <div class="py-4">
                            <p>{{ __('Vui lòng liên hệ để biết thêm thông tin chi tiết.') }}</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="shipping-pane" role="tabpanel" tabindex="0">
                        <div class="py-4">
                            <p>{{ __('Vui lòng liên hệ để biết thêm thông tin chi tiết.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Info -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Thông tin chi tiết sản phẩm') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! $product->description !!}
                    @if($product->specifications)
                        <div class="mt-4">
                            {!! $product->specifications !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($relatedProducts->isNotEmpty())
        <section class="related-products">
            <div class="container">
                <div class="related-title">
                    <h2>{{ __('Sản phẩm liên quan') }}</h2>
                    <span></span>
                </div>
                <div class="product-grid">
                    @foreach ($relatedProducts as $related)
                        @include('frontend.products._card', ['product' => $related])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qtyInput = document.getElementById('product-qty');
        const minusBtn = document.querySelector('.qty-btn.minus');
        const plusBtn = document.querySelector('.qty-btn.plus');

        if (qtyInput && minusBtn && plusBtn) {
            minusBtn.addEventListener('click', function() {
                let value = parseInt(qtyInput.value);
                if (value > 1) {
                    value--;
                    qtyInput.value = value < 10 ? '0' + value : value;
                }
            });

            plusBtn.addEventListener('click', function() {
                let value = parseInt(qtyInput.value);
                value++;
                qtyInput.value = value < 10 ? '0' + value : value;
            });
        }

        // Handle Read More for Tab Content
        const infoWrapper = document.getElementById('info-content-wrapper');
        if (infoWrapper) {
            const realContent = infoWrapper.querySelector('.tab-real-content');
            if (realContent && realContent.offsetHeight > 400) {
                infoWrapper.classList.add('is-long');
            }
        }
    });
</script>
@endpush
