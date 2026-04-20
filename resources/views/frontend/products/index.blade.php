@extends('frontend.master')

@php
    $pageTitle = 'Tất cả sản phẩm - VACAMAXI';
    $metaDescription = 'Danh sách tất cả sản phẩm VACAMAXI';
    $active = 'product';
@endphp

@push('styles')
    @include('frontend.products._styles')
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>Tất cả các sản phẩm</h1>
            <p>Khám phá hệ sinh thái sản phẩm cao cấp từ VACAMAXI</p>
        </div>
    </section>

    <section class="product-page">
        <div class="container">
            @if ($categories->isNotEmpty())
                <div class="category-filter">
                    <ul class="category-filter__list">
                        <li>
                            <a href="{{ route('frontend.products.index') }}" class="category-filter__link {{ request()->routeIs('frontend.products.index') ? 'active' : '' }}">
                                Tất cả
                            </a>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ route('frontend.products.category', $cat->slug) }}" class="category-filter__link">
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
@endsection
