@extends('frontend.master')

@php
    $pageTitle = $category->name . ' - VACA MAXI';
    $metaDescription = $category->description ?: 'Danh sách sản phẩm ' . $category->name;
    $active = 'product-' . $category->slug;
@endphp

@push('styles')
    @include('frontend.products._styles')
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>{{ $category->name }}</h1>
            <p>Trang chủ / Sản phẩm / {{ $category->name }}</p>
        </div>
    </section>

    <section class="product-page">
        <div class="container">
            <h2 class="category-title mt-0">{{ $category->name }}</h2>

            <form class="filter-row" action="{{ route('frontend.products.category', $category->slug) }}" method="get">
                <select name="sort" onchange="this.form.submit()">
                    <option value="newest" @selected(($filters['sort'] ?? '') === 'newest')>Sắp xếp</option>
                    <option value="name_asc" @selected(($filters['sort'] ?? '') === 'name_asc')>Tên A-Z</option>
                    <option value="name_desc" @selected(($filters['sort'] ?? '') === 'name_desc')>Tên Z-A</option>
                </select>

                <select name="category" onchange="if (this.value) window.location.href = this.value">
                    @foreach ($categories as $item)
                        <option value="{{ route('frontend.products.category', $item->slug) }}" @selected($item->id === $category->id)>{{ $item->name }}</option>
                    @endforeach
                </select>

                <div class="search-box">
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Tìm kiếm sản phẩm">
                </div>
            </form>

            @if ($products->isEmpty())
                <div class="empty-state">Chưa có sản phẩm trong danh mục này.</div>
            @else
                <div class="product-grid">
                    @foreach ($products as $product)
                        @include('frontend.products._card', ['product' => $product])
                    @endforeach
                </div>

                {{ $products->links() }}
            @endif
        </div>
    </section>
@endsection
