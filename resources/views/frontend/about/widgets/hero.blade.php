@php
    $heroParagraphs = $splitLines($widget->description);
@endphp

<section class="page-hero">
    <div class="container">
        <h1>{{ $widget->title ?: 'GIỚI THIỆU' }}</h1>
        @if($widget->sub_title)
            <p>{{ $widget->sub_title }}</p>
        @endif
        
        @if($heroParagraphs->isNotEmpty())
            <div class="mt-4" style="max-width: 800px; margin: 0 auto; font-size: 16px;">
                @foreach ($heroParagraphs as $line)
                    <p class="mb-2">{!! nl2br(e($line)) !!}</p>
                @endforeach
            </div>
        @endif
    </div>
</section>
