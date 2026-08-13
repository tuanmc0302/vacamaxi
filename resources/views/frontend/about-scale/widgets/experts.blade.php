@php
    $summary = $widget->sub_title ?: __('Các chuyên gia không chỉ đóng vai trò cố vấn mà còn trực tiếp tham gia vận hành, kiểm định và nâng cao năng lực đội ngũ tại Việt Nam.');
    
    $imageSrc = function ($path) {
        if (!$path) return asset('image/logo.png');
        return str_starts_with($path, 'http') || str_starts_with($path, '/') ? $path : asset('storage/' . $path);
    };
@endphp

<section class="about-scale-experts">
    <div class="container">
        <div class="about-scale-experts__header">
            <h2>{{ $widget->title }}</h2>
            <div class="title-underline title-underline--center"></div>
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
                            <a class="about-scale-expert-card__link" href="javascript:void(0)">{{ __('XEM THÊM') }}</a>
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
