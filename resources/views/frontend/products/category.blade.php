@extends('frontend.master')

@php
    $pageTitle = $category->name . ' - VACAMAXI';
    $metaDescription = 'Danh sách sản phẩm thuộc danh mục ' . $category->name;
    $active = 'product';
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
            @if ($categories->isNotEmpty())
                <div class="category-filter">
                    <ul class="category-filter__list">
                        <li>
                            <a href="{{ route('frontend.products.index') }}" class="category-filter__link">
                                Tất cả
                            </a>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <a href="{{ route('frontend.products.category', $cat->slug) }}" class="category-filter__link {{ $category->id === $cat->id ? 'active' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="product-grid">
                @foreach ($products as $product)
                    @include('frontend.products._card', ['product' => $product])
                @endforeach
            </div>

            @if ($products->isEmpty())
                <div class="empty-state text-center py-5">
                    <p class="text-muted">Chưa có sản phẩm nào trong danh mục này.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
