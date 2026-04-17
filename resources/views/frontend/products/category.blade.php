<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $category->name }} - VACA MAXI</title>
    <meta name="description" content="{{ $category->description ?: 'Danh sách sản phẩm ' . $category->name }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('frontend.products._styles')
</head>
<body>
@php
    $nav = $frontendData['nav'] ?? [];
    $active = 'product-' . $category->slug;
@endphp
@include('frontend.partials.header')

<main>
    <section class="page-hero">
        <div>
            <h1>{{ $category->name }}</h1>
            <p class="breadcrumb-line">Trang chủ / Sản phẩm / {{ $category->name }}</p>
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
</main>

@include('frontend.partials.floating-contact')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
