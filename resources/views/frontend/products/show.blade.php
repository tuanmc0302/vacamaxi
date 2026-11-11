@extends('frontend.master')

@php
    $pageTitle = $product->name . ' - VACAMAXI';
    $metaDescription = $product->short_description ?: Str::limit(strip_tags($product->description), 160);
    $active = 'product';
    $productImage = \App\Presentation\Http\Controllers\Frontend\ProductController::imageUrl($product->image);
@endphp

@push('styles')
    @include('frontend.products._styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/product-detail.css') }}?v={{ file_exists(public_path('css/frontend/product-detail.css')) ? filemtime(public_path('css/frontend/product-detail.css')) : time() }}">
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
                        <img id="mainProductImage" src="{{ $productImage }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-detail__thumbnails">
                        <div class="thumbnail-item active" onclick="changeMainImage(this)" data-src="{{ $productImage }}">
                            <img src="{{ $productImage }}" alt="{{ $product->name }}">
                        </div>
                        @php
                            $validGallery = collect($product->gallery ?? [])
                                ->map(fn($img) => \App\Presentation\Http\Controllers\Frontend\ProductController::imageUrl($img, ''))
                                ->filter()
                                ->values();
                        @endphp
                        @foreach($validGallery as $gUrl)
                            <div class="thumbnail-item" onclick="changeMainImage(this)" data-src="{{ $gUrl }}">
                                <img src="{{ $gUrl }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                        @for($i = $validGallery->count(); $i < 3; $i++)
                            <div class="thumbnail-item placeholder">
                                <div class="thumbnail-placeholder"></div>
                            </div>
                        @endfor
                    </div>
@php
    $shareCurrentUrl = request()->fullUrl();
@endphp
                    <div class="product-detail__share">
                        <span class="share-label">{{ __('Chia sẻ:') }}</span>
                        <div class="footer-social product-share-social">
                            {{-- Chia sẻ Zalo thật --}}
                            <a href="https://sp.zalo.me/share_inline?link={{ urlencode($shareCurrentUrl) }}" 
                               onclick="shareViaPopup('zalo', '{{ $shareCurrentUrl }}'); return false;"
                               class="social-link" 
                               aria-label="Chia sẻ qua Zalo" 
                               title="Chia sẻ lên Zalo">
                                <span class="zalo-text">ZALO</span>
                            </a>

                            {{-- Chia sẻ Facebook thật --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareCurrentUrl) }}" 
                               onclick="shareViaPopup('facebook', '{{ $shareCurrentUrl }}'); return false;"
                               class="social-link" 
                               aria-label="Chia sẻ qua Facebook" 
                               title="Chia sẻ lên Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>

                            {{-- Sao chép liên kết / Chia sẻ hệ thống --}}
                            <a href="javascript:void(0);" 
                               onclick="shareNativeOrCopy('{{ $shareCurrentUrl }}', '{{ addslashes($product->name) }}'); return false;"
                               class="social-link" 
                               aria-label="Sao chép liên kết" 
                               title="Sao chép liên kết chia sẻ">
                                <i class="bi bi-play-fill"></i>
                            </a>
                        </div>
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
                        {{-- Quantity and buy/cart buttons temporarily hidden
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
                        --}}
                        <div class="button-group">
                            <a href="{{ route('frontend.contact') }}" class="btn-contact-now">
                                <i class="bi bi-telephone-fill me-2"></i>{{ __('LIÊN HỆ') }}
                            </a>
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

    {{-- Toast thông báo sao chép liên kết --}}
    <div id="share-toast" class="share-toast">
        <i class="bi bi-check-circle-fill me-2" style="color: #f3b21a;"></i>
        <span>{{ __('Đã sao chép liên kết sản phẩm!') }}</span>
    </div>
@endsection

@push('scripts')
<script>
    function changeMainImage(el) {
        const src = el.getAttribute('data-src');
        if (src) {
            document.getElementById('mainProductImage').src = src;
            document.querySelectorAll('.thumbnail-item').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
        }
    }

    function shareViaPopup(platform, fallbackUrl) {
        const currentUrl = encodeURIComponent(window.location.href);
        let shareUrl = '';
        let w = 600, h = 550;

        if (platform === 'facebook') {
            shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + currentUrl;
            w = 600; h = 500;
        } else if (platform === 'zalo') {
            shareUrl = 'https://sp.zalo.me/share_inline?link=' + currentUrl;
            w = 600; h = 600;
        }

        if (shareUrl) {
            const left = Math.max(0, (window.screen.width - w) / 2);
            const top = Math.max(0, (window.screen.height - h) / 2);
            window.open(shareUrl, platform + '-share', `width=${w},height=${h},top=${top},left=${left},scrollbars=yes,status=no,toolbar=no`);
        }
    }

    function shareNativeOrCopy(url, title) {
        const shareData = {
            title: title || document.title,
            text: title || document.title,
            url: url || window.location.href
        };

        if (navigator.share && /mobile|android|iphone|ipad/i.test(navigator.userAgent)) {
            navigator.share(shareData).catch(() => {});
        } else {
            copyProductLink(shareData.url);
        }
    }

    function copyProductLink(text) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(showShareToast).catch(() => fallbackCopy(text));
        } else {
            fallbackCopy(text);
        }
    }

    function fallbackCopy(text) {
        const temp = document.createElement('textarea');
        temp.value = text;
        temp.style.position = 'fixed';
        temp.style.opacity = '0';
        document.body.appendChild(temp);
        temp.select();
        try {
            document.execCommand('copy');
            showShareToast();
        } catch (e) {
            prompt('Sao chép liên kết dưới đây:', text);
        }
        document.body.removeChild(temp);
    }

    function showShareToast() {
        const toast = document.getElementById('share-toast');
        if (toast) {
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        }
    }

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
            if (realContent) {
                // scrollHeight works even when parent is overflow:hidden
                if (realContent.scrollHeight > 420) {
                    infoWrapper.classList.add('is-long');
                }
            }
        }
    });
</script>
@endpush
