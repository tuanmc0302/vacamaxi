@php
    $expertImages = $widgetImages($widget, []);
    $fallbackImages = collect(['/image/Rectangle 2.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png']);
    $widgetExpertNames = $splitLines($widget->description);
    $experts = ($expertProducts ?? collect())->take(8)->values()->map(function ($product, $index) use ($expertImages, $fallbackImages) {
        $image = trim((string) ($expertImages->get($index) ?: ($product->image ? asset($product->image) : $fallbackImages[$index % $fallbackImages->count()])));

        return [
            'name' => $product->name,
            'role' => $product->short_description ?: 'Chuyên gia VACA MAXI',
            'description' => $product->description ?: 'Đội ngũ chuyên gia đồng hành cùng VACA MAXI trong các lĩnh vực di truyền, dinh dưỡng, sức khỏe đàn và chất lượng thịt.',
            'image' => $image,
            'url' => route('frontend.product.show', ['categorySlug' => $product->category?->slug ?? 'chuyen-gia', 'productSlug' => $product->slug]),
        ];
    });

    if ($experts->count() < 8) {
        $experts = $experts->concat(
            $widgetExpertNames
                ->slice($experts->count(), 8 - $experts->count())
                ->values()
                ->map(function ($name, $offset) use ($experts, $expertImages, $fallbackImages) {
                    $index = $experts->count() + $offset;

                    return [
                        'name' => $name,
                        'role' => 'Chuyên gia VACA MAXI',
                        'description' => 'Chuyên gia đồng hành cùng VACA MAXI trong các lĩnh vực sinh học, dinh dưỡng, sức khỏe đàn và chất lượng thịt.',
                        'image' => trim((string) ($expertImages->get($index) ?: $fallbackImages[$index % $fallbackImages->count()])),
                        'url' => 'javascript:void(0)',
                    ];
                })
        )->take(8)->values();
    }

    $summary = $widget->sub_title ?: 'Các chuyên gia không chỉ đóng vai trò cố vấn mà còn trực tiếp tham gia vận hành, kiểm định và nâng cao năng lực đội ngũ tại Việt Nam. Các chuyên gia có chuyên môn về dinh dưỡng động vật, sức khỏe bò và chất lượng thịt, chịu trách nhiệm giám sát toàn bộ quy trình — từ chẩn đoán thai kỳ, sinh sản, đến giai đoạn vỗ béo và lấy thịt. Những chuyên gia này không chỉ dẫn đầu tại Argentina mà còn được công nhận trên toàn thế giới, liên tục tư vấn và chuyển giao công nghệ cho các quốc gia có nền chăn nuôi tiên tiến.';
@endphp

<section class="about-scale-experts">
    <div class="container">
        <div class="about-scale-section-title about-scale-section-title--full">
            <h2>{{ strtoupper($widget->title ?: 'ĐỘI NGŨ CHUYÊN GIA VACA MAXI') }}</h2>
            <span></span>
        </div>

        <div class="about-scale-experts__grid">
            @foreach ($experts as $expert)
                <article class="about-scale-expert-card">
                    <div class="about-scale-expert-card__photo">
                        <img src="{{ $expert['image'] }}" alt="{{ $expert['name'] }}">
                    </div>
                    <div class="about-scale-expert-card__body">
                        <h3>{{ $expert['name'] }}</h3>
                        <p class="about-scale-expert-card__role">{{ $expert['role'] }}</p>
                        <p class="about-scale-expert-card__desc">{{ \Illuminate\Support\Str::limit(strip_tags($expert['description']), 150) }}</p>
                        <a class="about-scale-expert-card__link" href="{{ $expert['url'] }}">XEM THÊM</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="about-scale-experts__summary">
            <p>{{ $summary }}</p>
        </div>
    </div>
</section>

