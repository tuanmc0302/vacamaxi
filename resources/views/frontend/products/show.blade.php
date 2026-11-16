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
            <p>
                {{ __('Trang chủ') }} / {{ __('Sản phẩm') }}
                @if($product->category?->parent)
                    / {{ $product->category->parent->name }} / {{ $product->category->name }}
                @else
                    / {{ $product->category?->name ?? __('Chi tiết') }}
                @endif
            </p>
        </div>
    </section>

    <section class="product-detail">
        <div class="container">
            <div class="product-detail__grid">
@php
    $validGallery = collect($product->gallery ?? [])
        ->map(fn($img) => \App\Presentation\Http\Controllers\Frontend\ProductController::imageUrl($img, ''))
        ->filter()
        ->values();

    $allGalleryImages = collect([$productImage])
        ->filter()
        ->merge($validGallery)
        ->unique()
        ->values();

    $specifications = [];
    $rawAttrs = (app()->getLocale() === 'en' && !empty($product->attributes_en)) ? $product->attributes_en : ($product->attributes ?? []);
    if (!empty($rawAttrs) && is_array($rawAttrs)) {
        foreach ($rawAttrs as $k => $v) {
            if (is_array($v) && (isset($v['key']) || isset($v['name']) || isset($v['label']))) {
                $label = $v['label'] ?? $v['name'] ?? $v['key'];
                $val = $v['value'] ?? $v['val'] ?? '';
                $type = in_array($v['type'] ?? '', ['color', 'text'], true) ? $v['type'] : ((preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', (string)$val) || in_array(mb_strtolower($label), ['màu sắc', 'màu', 'color', 'colour'])) ? 'color' : 'text');
            } else {
                $label = is_string($k) ? $k : '';
                $val = is_scalar($v) ? (string)$v : json_encode($v, JSON_UNESCAPED_UNICODE);
                $type = (preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', (string)$val) || in_array(mb_strtolower($label), ['màu sắc', 'màu', 'color', 'colour'])) ? 'color' : 'text';
            }
            if ($label !== '') {
                $specifications[] = ['label' => $label, 'type' => $type, 'value' => $val];
            }
        }
    }
@endphp
                <div class="product-detail__gallery">
                    <div class="product-detail__main-image" onclick="openProductGallery()" title="{{ __('Bấm để xem ảnh toàn màn hình') }}">
                        <img id="mainProductImage" src="{{ $productImage }}" alt="{{ $product->name }}">
                        <button type="button" class="btn-zoom-image" aria-label="Xem toàn màn hình" title="{{ __('Xem toàn màn hình') }}">
                            <i class="bi bi-arrows-fullscreen"></i>
                        </button>
                    </div>
                    <div class="product-detail__thumbnails">
                        <div class="thumbnail-item active" onclick="changeMainImage(this)" data-src="{{ $productImage }}">
                            <img src="{{ $productImage }}" alt="{{ $product->name }}">
                        </div>
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
                    @if(!empty($product->subtitle))
                        <div class="product-detail__subtitle">{{ $product->subtitle }}</div>
                    @endif
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

                    {{-- Thông số & Đặc tính: Trạng thái, Màu sắc, Mùi vị... --}}
                    @if(!empty($specifications))
                        <div class="product-detail__specs">
                            @foreach($specifications as $spec)
                                @php
                                    $specType = $spec['type'] ?? 'text';
                                    $lowerLabel = mb_strtolower(trim($spec['label']));
                                    $valTrim = trim((string)($spec['value'] ?? ''));
                                    $isHex = (bool) preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', $valTrim);
                                    $isColor = ($specType === 'color') || in_array($lowerLabel, ['màu sắc', 'màu', 'color', 'colour'], true) || $isHex;
                                    $circleColor = $isHex ? $valTrim : '#ffffff';
                                @endphp
                                <div class="product-detail__spec-item">
                                    <span class="spec-label">{{ $spec['label'] }}:</span>
                                    <span class="spec-value">
                                        @if($isColor)
                                            <span class="spec-color-circle" style="background-color: {{ $circleColor }};" title="{{ $valTrim ?: 'Màu sắc' }}"></span>
                                        @endif
                                        @if(!$isHex && $valTrim !== '')
                                            <span>{{ $spec['value'] }}</span>
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif

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
                                <button type="button" class="btn-read-more" id="btn-read-more-info" onclick="toggleTabContent()">
                                    {{ __('Xem thêm') }} <i class="bi bi-chevron-down ms-1"></i>
                                </button>
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

    {{-- Fullscreen Product Gallery Modal --}}
    <div id="productGalleryModal" class="product-gallery-modal" aria-hidden="true" role="dialog" aria-label="{{ __('Xem ảnh sản phẩm') }}">
        <div class="pg-backdrop" onclick="closeProductGallery()"></div>
        <div class="pg-header">
            <div class="pg-counter" id="pgCounter">1 / {{ max(1, $allGalleryImages->count()) }}</div>
            <div class="pg-title">{{ $product->name }}</div>
            <button type="button" class="pg-close" onclick="closeProductGallery()" aria-label="{{ __('Đóng') }}" title="{{ __('Đóng (Esc)') }}">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <div class="pg-body">
            @if($allGalleryImages->count() > 1)
                <button type="button" class="pg-nav-btn pg-prev" onclick="prevProductImage(event)" aria-label="{{ __('Ảnh trước') }}" title="{{ __('Ảnh trước (←)') }}">
                    <i class="bi bi-chevron-left"></i>
                </button>
            @endif
            
            <div class="pg-main-image-wrap" onclick="closeProductGallery()">
                <img id="pgMainImage" src="{{ $productImage }}" alt="{{ $product->name }}" onclick="event.stopPropagation()">
            </div>

            @if($allGalleryImages->count() > 1)
                <button type="button" class="pg-nav-btn pg-next" onclick="nextProductImage(event)" aria-label="{{ __('Ảnh kế tiếp') }}" title="{{ __('Ảnh kế tiếp (→)') }}">
                    <i class="bi bi-chevron-right"></i>
                </button>
            @endif
        </div>

        @if($allGalleryImages->count() > 1)
            <div class="pg-footer">
                <div class="pg-thumbnails" id="pgThumbnails">
                    @foreach($allGalleryImages as $idx => $imgUrl)
                        <div class="pg-thumb-item {{ $idx === 0 ? 'active' : '' }}" onclick="goToProductImage({{ $idx }})" data-index="{{ $idx }}">
                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @include('frontend.products._age_verification_modal', ['targetProduct' => $product])
@endsection

@push('scripts')
<script>
    const productGalleryImages = @json($allGalleryImages);
    let currentGalleryIndex = 0;

    function openProductGallery(index) {
        if (!productGalleryImages || productGalleryImages.length === 0) return;
        
        if (typeof index === 'number') {
            currentGalleryIndex = index;
        } else {
            const currentSrc = document.getElementById('mainProductImage')?.getAttribute('src');
            const foundIdx = productGalleryImages.findIndex(url => url === currentSrc);
            currentGalleryIndex = foundIdx !== -1 ? foundIdx : 0;
        }

        renderGalleryImage(currentGalleryIndex);

        const modal = document.getElementById('productGalleryModal');
        if (modal) {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeProductGallery() {
        const modal = document.getElementById('productGalleryModal');
        if (modal) {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }

    function renderGalleryImage(index) {
        if (!productGalleryImages || productGalleryImages.length === 0) return;
        
        currentGalleryIndex = (index + productGalleryImages.length) % productGalleryImages.length;
        const currentUrl = productGalleryImages[currentGalleryIndex];

        const imgEl = document.getElementById('pgMainImage');
        if (imgEl) {
            imgEl.style.opacity = '0.3';
            imgEl.src = currentUrl;
            imgEl.onload = function() {
                imgEl.style.opacity = '1';
            };
        }

        const counterEl = document.getElementById('pgCounter');
        if (counterEl) {
            counterEl.textContent = `${currentGalleryIndex + 1} / ${productGalleryImages.length}`;
        }

        document.querySelectorAll('.pg-thumb-item').forEach(item => {
            const itemIdx = parseInt(item.getAttribute('data-index'));
            item.classList.toggle('active', itemIdx === currentGalleryIndex);
        });
    }

    function prevProductImage(e) {
        if (e) e.stopPropagation();
        renderGalleryImage(currentGalleryIndex - 1);
    }

    function nextProductImage(e) {
        if (e) e.stopPropagation();
        renderGalleryImage(currentGalleryIndex + 1);
    }

    function goToProductImage(index) {
        renderGalleryImage(index);
    }

    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('productGalleryModal');
        if (!modal || !modal.classList.contains('is-open')) return;

        if (e.key === 'Escape') closeProductGallery();
        if (e.key === 'ArrowLeft') prevProductImage();
        if (e.key === 'ArrowRight') nextProductImage();
    });

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

    function toggleTabContent() {
        const wrapper = document.getElementById('info-content-wrapper');
        const btn = document.getElementById('btn-read-more-info');
        if (!wrapper) return;

        if (wrapper.classList.contains('is-expanded')) {
            wrapper.classList.remove('is-expanded');
            wrapper.classList.add('is-long');
            if (btn) btn.innerHTML = '{{ __('Xem thêm') }} <i class="bi bi-chevron-down ms-1"></i>';
            wrapper.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } else {
            wrapper.classList.add('is-expanded');
            wrapper.classList.remove('is-long');
            if (btn) btn.innerHTML = '{{ __('Thu gọn') }} <i class="bi bi-chevron-up ms-1"></i>';
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

        // Vuốt cảm ứng xem ảnh trên điện thoại
        let touchStartX = 0;
        let touchEndX = 0;
        const galleryWrap = document.querySelector('.pg-main-image-wrap');
        if (galleryWrap) {
            galleryWrap.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            galleryWrap.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                if (touchStartX - touchEndX > 50) nextProductImage();
                if (touchEndX - touchStartX > 50) prevProductImage();
            }, { passive: true });
        }
    });
</script>
@endpush
