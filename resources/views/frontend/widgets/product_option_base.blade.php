@php
    $title = data_get($widget, 'title', 'VACAMAXI');
    $subTitle = data_get($widget, 'sub_title');
    $description = data_get($widget, 'description');
    $highlight = data_get($widget, 'settings.highlight');
    $buttonText = data_get($widget, 'settings.button_text', 'XEM THÊM');
    $buttonUrl = data_get($widget, 'settings.button_url', '/san-pham');
    $items = $items ?? [];
@endphp
<section class="breeds-section">
    <div class="container">
        <div class="row breeds-intro align-items-start g-4">
            <div class="col-lg-7">
                @if($subTitle)
                    <p class="breeds-kicker">{{ $subTitle }}</p>
                @endif
                <h2 class="breeds-title">
                    @if($highlight && str_contains($title, $highlight))
                        {!! e(str_replace($highlight, '', $title)) !!}<span>{{ $highlight }}</span>
                    @else
                        {{ $title }}
                    @endif
                </h2>
            </div>
            <div class="col-lg-5">
                @if($description)
                    <p class="breeds-description">{!! nl2br(e($description)) !!}</p>
                @endif
            </div>
        </div>
        <div class="breed-grid">
            @foreach($items as $item)
                @include('frontend.components.product-card', ['item' => $item, 'class' => 'breed-card'])
            @endforeach
        </div>
        <div class="breeds-more">
            <a href="{{ $buttonUrl }}" class="about-action">{{ $buttonText }}</a>
        </div>
    </div>
</section>