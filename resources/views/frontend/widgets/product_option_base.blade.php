@php
    $title = data_get($widget, 'title', 'VACA MAXI');
    $subTitle = data_get($widget, 'sub_title');
    $description = data_get($widget, 'description');
    $highlight = data_get($widget, 'settings.highlight');
    $buttonText = data_get($widget, 'settings.button_text', 'XEM THÊM');
    $buttonUrl = data_get($widget, 'settings.button_url', '/san-pham');
    $items = $items ?? [];
    $sectionClass = $sectionClass ?? 'breeds-section';
    $titleClass = $titleClass ?? 'breeds-title';
    $gridClass = $gridClass ?? 'breed-grid';
    $cardClass = $cardClass ?? 'breed-card';
@endphp
<section class="{{ $sectionClass }}">
    <div class="container">
        <div class="row breeds-intro align-items-start g-4">
            <div class="col-lg-5">
                @if($subTitle)
                    <p class="breeds-kicker">{{ $subTitle }}</p>
                @endif
                <h2 class="{{ $titleClass }}">
                    @if($highlight && str_contains($title, $highlight))
                        {!! e(str_replace($highlight, '', $title)) !!}<span>{{ $highlight }}</span>
                    @else
                        {{ $title }}
                    @endif
                </h2>
            </div>
            <div class="col-lg-7">
                @if($description)
                    <p class="breeds-description">{!! nl2br(e($description)) !!}</p>
                @endif
            </div>
        </div>
        <div class="{{ $gridClass }}">
            @foreach($items as $item)
                @include('frontend.components.product-card', ['item' => $item, 'class' => $cardClass])
            @endforeach
        </div>
        <div class="breeds-more">
            <a href="{{ $buttonUrl }}" class="about-action">{{ $buttonText }}</a>
        </div>
    </div>
</section>