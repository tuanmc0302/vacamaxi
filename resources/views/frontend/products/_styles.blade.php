<link rel="stylesheet" href="{{ asset('css/frontend/products.css') }}">
<style>
    .border-radius-50 {
        border-radius: 50px !important;
    }
    .product-filters .form-select:focus,
    .product-filters .form-control:focus {
        border-color: #f3b21a;
        box-shadow: 0 0 0 0.25rem rgba(243, 178, 26, 0.1);
    }
    .product-filters label {
        color: #250900;
    }
    .search-group button:hover svg {
        fill: #ffc642;
    }
    .subcategory-filter {
        display: flex;
        justify-content: center;
        margin-top: -15px;
    }
    .subcategory-filter__inner {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #fdfbf7;
        border: 1px solid #f0e6d6;
        padding: 8px 18px;
        border-radius: 50px;
        flex-wrap: wrap;
    }
    .subcategory-filter__label {
        font-weight: 700;
        font-size: 13px;
        color: #8c7355;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .subcategory-filter__list {
        display: flex;
        align-items: center;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
        flex-wrap: wrap;
    }
    .subcategory-filter__link {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        color: #555555;
        text-decoration: none;
        transition: all 0.2s ease;
        background: #ffffff;
        border: 1px solid #e8e2d8;
    }
    .subcategory-filter__link:hover {
        color: #f3b21a;
        border-color: #f3b21a;
        background: #fffdf8;
    }
    .subcategory-filter__link.active {
        background: #f3b21a;
        color: #250900;
        border-color: #f3b21a;
        font-weight: 700;
        box-shadow: 0 3px 10px rgba(243, 178, 26, 0.25);
    }
    .subcategory-count {
        font-size: 11px;
        opacity: 0.85;
        margin-left: 2px;
    }
</style>
