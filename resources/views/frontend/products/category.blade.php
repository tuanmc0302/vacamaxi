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

            <div class="product-grid">
                @foreach ($products as $product)
                    @include('frontend.products._card', ['product' => $product])
                @endforeach
            </div>

            @if ($products->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @endif

            @if ($products->isEmpty())
                <div class="empty-state text-center py-5">
                    <p class="text-muted">{{ __('Chưa có sản phẩm nào phù hợp.') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection
