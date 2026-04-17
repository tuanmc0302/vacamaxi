@php
    $footer = $footer ?? [];
    $nav = $nav ?? [];
@endphp
<footer class="site-footer" id="lien-he">
    <div class="footer-inner">
        <div class="footer-brand">
            <img src="/image/logo.png" alt="VACA MAXI">
            <p>{{ $footer['intro'] ?? '' }}</p>
            <p>{{ $footer['address'] ?? '' }}</p>
            @foreach (($footer['hotlines'] ?? []) as $hotline)
                <p>{{ $hotline }}</p>
            @endforeach
            <p>{{ $footer['email'] ?? '' }}</p>
            <p>{{ $footer['website'] ?? '' }}</p>
        </div>
        <div class="footer-links">
            @foreach ($nav as $item)
                <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
            @endforeach
        </div>
        <div class="footer-map">
            <img src="{{ $footer['mapImage'] ?? '/image/Rectangle 4.png' }}" alt="Bản đồ VACA MAXI">
            <div class="footer-social-title">MẠNG XÃ HỘI</div>
            <div class="footer-socials">
                @foreach (($footer['socials'] ?? []) as $social)
                    <a href="{{ $social['url'] }}" aria-label="{{ $social['label'] }}">{{ $social['label'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</footer>
