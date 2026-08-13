@extends('frontend.master')

@php
    $pageTitle = __('Tất cả sản phẩm') . ' - VACAMAXI';
    $metaDescription = __('Danh sách tất cả sản phẩm VACAMAXI');
    $active = 'product';
@endphp

@push('styles')
    @include('frontend.products._styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/home.css') }}">
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ __('Tất cả các sản phẩm') }}</h1>
            <p>{{ __('Khám phá hệ sinh thái sản phẩm cao cấp từ VACAMAXI') }}</p>
        </div>
    </section>

    <section class="product-page">
        <div class="container">
            @if($featuredProducts->isNotEmpty())
                <div class="related-title">
                    <h2>{{ __('Sản phẩm mới ra mắt') }}</h2>
                    <span></span>
                </div>
                
                <div class="product-grid mb-5">
                    @foreach ($featuredProducts as $product)
                        @include('frontend.products._card', ['product' => $product])
                    @endforeach
                </div>
            @endif

            <div class="product-filters mb-5">
                <form action="{{ route('frontend.products.index') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <div class="filter-group d-flex align-items-center">
                            <label class="me-3 fw-bold text-nowrap">{{ __('Sắp xếp:') }}</label>
                            <select name="sort" class="form-select border-radius-50" onchange="this.form.submit()">
                                <option value="newest" {{ ($filters['sort'] ?? '') == 'newest' ? 'selected' : '' }}>{{ __('Mới nhất') }}</option>
                                <option value="oldest" {{ ($filters['sort'] ?? '') == 'oldest' ? 'selected' : '' }}>{{ __('Cũ nhất') }}</option>
                                <option value="name_asc" {{ ($filters['sort'] ?? '') == 'name_asc' ? 'selected' : '' }}>{{ __('Tên A-Z') }}</option>
                                <option value="name_desc" {{ ($filters['sort'] ?? '') == 'name_desc' ? 'selected' : '' }}>{{ __('Tên Z-A') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 ms-auto">
                        <div class="search-group position-relative">
                            <input type="text" name="search" class="form-control border-radius-50 ps-4 pe-5" 
                                   placeholder="{{ __('Tìm kiếm sản phẩm...') }}" value="{{ $filters['search'] ?? '' }}">
                            <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent pe-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f3b21a" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if ($categories->isNotEmpty())
                <div class="category-filter">
                    <ul class="category-filter__list">
                        <li>
                            <a href="{{ route('frontend.products.index') }}" class="category-filter__link {{ request()->routeIs('frontend.products.index') ? 'active' : '' }}">
                                {{ __('Tất cả') }}
                            </a>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ route('frontend.products.category', ['categorySlug' => $cat->slug]) }}" class="category-filter__link">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @foreach ($categories as $category)
                @php
                    $categoryProducts = $productsByCategory->get($category->id, collect());
                @endphp

                @continue($categoryProducts->isEmpty())

                <div class="related-title mt-5">
                    <h2>{{ $category->name }}</h2>
                    <span></span>
                </div>
                
                <div class="product-grid">
                    @foreach ($categoryProducts as $product)
                        @include('frontend.products._card', ['product' => $product])
                    @endforeach
                </div>
            @endforeach

            @if ($categories->isEmpty())
                <div class="empty-state text-center py-5">
                    <p class="text-muted">Chưa có danh mục sản phẩm nào được cập nhật.</p>
                </div>
            @endif
        </div>
    </section>

    @include('frontend.widgets.product_option_base', [
        'widget' => $breedsWidget,
        'items' => $breedsItems
    ])

    @include('frontend.widgets.news_home', [
        'widget' => $newsWidget,
        'news' => $news
    ])
@endsection
