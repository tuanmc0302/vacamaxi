@php
    $summary = $widget->sub_title ?: 'Các chuyên gia không chỉ đóng vai trò cố vấn mà còn trực tiếp tham gia vận hành, kiểm định và nâng cao năng lực đội ngũ tại Việt Nam.';
    
    $imageSrc = function ($path) {
        if (!$path) return asset('image/logo.png');
        return str_starts_with($path, 'http') || str_starts_with($path, '/') ? $path : asset('storage/' . $path);
    };
@endphp

<section class="about-scale-experts">
    <div class="container">
        <div class="about-scale-section-title">
            <h2>{{ strtoupper($widget->title ?: 'ĐỘI NGŨ CHUYÊN GIA VACAMAXI') }}</h2>
            <span></span>
        </div>

        <div class="about-scale-experts__grid">
            @foreach ($experts as $expert)
                <article class="about-scale-expert-card">
                    <div class="about-scale-expert-card__photo">
                        <img src="{{ $imageSrc($expert->image) }}" alt="{{ $expert->name }}">
                    </div>
                    <div class="about-scale-expert-card__body">
                        <h3>{{ $expert->name }}</h3>
                        <p class="about-scale-expert-card__role">{{ $expert->role }}</p>
                        <p class="about-scale-expert-card__desc">{{ \Illuminate\Support\Str::limit(strip_tags($expert->description), 150) }}</p>
                        @if($expert->is_active)
                            <a class="about-scale-expert-card__link" href="javascript:void(0)">XEM THÊM</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        <div class="about-scale-experts__summary">
            <p>{{ $summary }}</p>
        </div>
    </div>
</section>
