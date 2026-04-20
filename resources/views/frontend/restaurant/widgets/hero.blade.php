<section class="page-hero">
    <div class="container">
        <h1>{{ data_get($widget, 'title', 'Dịch vụ - Nhà hàng') }}</h1>
        @if (data_get($widget, 'sub_title'))
            <p>{{ data_get($widget, 'sub_title') }}</p>
        @endif
    </div>
</section>
