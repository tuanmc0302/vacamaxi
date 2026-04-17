@extends('frontend.master')

@php
    $pageTitle = 'Tất cả sản phẩm - VACA MAXI';
    $metaDescription = 'Danh sách tất cả sản phẩm VACA MAXI';
    $active = 'product';
@endphp

@push('styles')
    @include('frontend.products._styles')
@endpush

@section('content')
    <section class="page-hero">
        <div>
            <h1>Tất cả các sản phẩm</h1>
            <p class="breadcrumb-line">Trang chủ / Tất cả sản phẩm</p>
        </div>
    </section>

    <section class="product-page">
        <div class="container">
            <h2 class="section-title">Sản phẩm mới ra mắt</h2>

            @if ($featuredProducts->isNotEmpty())
                <div class="product-grid">
                    @foreach ($featuredProducts as $product)
                        @include('frontend.products._card', ['product' => $product])
                    @endforeach
                </div>
            @endif

            <form class="filter-row" action="{{ route('frontend.products.index') }}" method="get">
                <select name="sort" onchange="this.form.submit()">
                    <option value="newest" @selected(($filters['sort'] ?? '') === 'newest')>Sắp xếp</option>
                    <option value="name_asc" @selected(($filters['sort'] ?? '') === 'name_asc')>Tên A-Z</option>
                    <option value="name_desc" @selected(($filters['sort'] ?? '') === 'name_desc')>Tên Z-A</option>
                </select>

                <select name="category" onchange="this.form.submit()">
                    <option value="">Danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <div class="search-box">
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Tìm kiếm sản phẩm">
                </div>
            </form>

            @foreach ($categories as $category)
                @php
                    $categoryProducts = $productsByCategory->get($category->id, collect());
                @endphp

                @continue($categoryProducts->isEmpty())

                <h2 class="category-title">{{ $category->name }}</h2>
                <div class="product-grid">
                    @foreach ($categoryProducts as $product)
                        @include('frontend.products._card', ['product' => $product])
                    @endforeach
                </div>
            @endforeach

            @if ($categories->isEmpty())
                <div class="empty-state">Chưa có danh mục sản phẩm.</div>
            @endif
        </div>
    </section>
@endsection
