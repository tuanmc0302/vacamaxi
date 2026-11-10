@extends('frontend.master')

@php
    $pageTitle = $category->name . ' - VACAMAXI';
    $metaDescription = __('Danh sách sản phẩm thuộc danh mục') . ' ' . $category->name;
    $active = 'product';
@endphp

@push('styles')
    @include('frontend.products._styles')
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ $activeSub ? $activeSub->name : $rootCategory->name }}</h1>
            <p>
                {{ __('Trang chủ') }} / {{ __('Sản phẩm') }} / 
                @if($activeSub && $activeSub->id !== $rootCategory->id)
                    <a href="{{ route('frontend.products.category', ['categorySlug' => $rootCategory->slug]) }}" class="text-white text-decoration-none hover-underline">{{ $rootCategory->name }}</a> / {{ $activeSub->name }}
                @else
                    {{ $rootCategory->name }}
                @endif
            </p>
        </div>
    </section>

    <section class="product-page">
        <div class="container">
            @if ($categories->isNotEmpty())
                <div class="category-filter">
                    <ul class="category-filter__list">
                        <li>
                            <a href="{{ route('frontend.products.index') }}" class="category-filter__link">
                                {{ __('Tất cả') }}
                            </a>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ route('frontend.products.category', ['categorySlug' => $cat->slug]) }}" class="category-filter__link {{ $rootCategory->id === $cat->id ? 'active' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Thanh lọc danh mục con (Subcategories) nếu có --}}
            @if(isset($subcategories) && $subcategories->isNotEmpty())
                <div class="subcategory-filter mb-5">
                    <div class="subcategory-filter__inner">
                        <span class="subcategory-filter__label d-none d-md-inline-block">{{ __('Phân loại:') }}</span>
                        <ul class="subcategory-filter__list">
                            <li>
                                <a href="{{ route('frontend.products.category', ['categorySlug' => $rootCategory->slug]) }}" 
                                   class="subcategory-filter__link {{ empty($activeSub) ? 'active' : '' }}">
                                    {{ __('Tất cả') }}
                                </a>
                            </li>
                            @foreach ($subcategories as $sub)
                                <li>
                                    <a href="{{ route('frontend.products.category', ['categorySlug' => $rootCategory->slug, 'sub' => $sub->slug]) }}" 
                                       class="subcategory-filter__link {{ ($activeSub && $activeSub->id === $sub->id) ? 'active' : '' }}">
                                        {{ $sub->name }}
                                        @if($sub->products_count > 0)
                                            <span class="subcategory-count">({{ $sub->products_count }})</span>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if(isset($subcategories) && $subcategories->isNotEmpty() && empty($activeSub))
                {{-- Chế độ xem theo từng component danh mục con --}}
                @php $hasAnySubProduct = false; @endphp

                @foreach ($subcategories as $sub)
                    @php
                        $subProducts = $productsBySubcategory->get($sub->id, collect());
                    @endphp

                    @continue($subProducts->isEmpty())
                    @php $hasAnySubProduct = true; @endphp

                    <div class="subcategory-block mb-5">
                        <div class="subcategory-header d-flex align-items-center justify-content-between mb-4">
                            <div class="related-title flex-grow-1 me-4 mb-0">
                                <h2>{{ $sub->name }}</h2>
                                <span></span>
                            </div>
                            <a href="{{ route('frontend.products.category', ['categorySlug' => $rootCategory->slug, 'sub' => $sub->slug]) }}" 
                               class="btn-view-all-sub">
                                {{ __('Xem tất cả') }} <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>

                        <div class="product-grid">
                            @foreach ($subProducts as $product)
                                @include('frontend.products._card', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
                @endforeach

                {{-- Sản phẩm thuộc danh mục cha trực tiếp (nếu có) --}}
                @if(isset($parentDirectProducts) && $parentDirectProducts->isNotEmpty())
                    @php $hasAnySubProduct = true; @endphp
                    <div class="subcategory-block mb-5">
                        <div class="subcategory-header d-flex align-items-center justify-content-between mb-4">
                            <div class="related-title flex-grow-1 me-4 mb-0">
                                <h2>{{ $rootCategory->name }}</h2>
                                <span></span>
                            </div>
                        </div>

                        <div class="product-grid">
                            @foreach ($parentDirectProducts as $product)
                                @include('frontend.products._card', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (! $hasAnySubProduct)
                    <div class="empty-state text-center py-5">
                        <p class="text-muted">{{ __('Chưa có sản phẩm nào phù hợp.') }}</p>
                    </div>
                @endif
            @else
                {{-- Chế độ xem 1 danh mục / danh mục con cụ thể có phân trang --}}
                <div class="product-grid">
                    @if(isset($products))
                        @foreach ($products as $product)
                            @include('frontend.products._card', ['product' => $product])
                        @endforeach
                    @endif
                </div>

                @if (isset($products) && $products->hasPages())
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                @endif

                @if (!isset($products) || $products->isEmpty())
                    <div class="empty-state text-center py-5">
                        <p class="text-muted">{{ __('Chưa có sản phẩm nào phù hợp.') }}</p>
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection
