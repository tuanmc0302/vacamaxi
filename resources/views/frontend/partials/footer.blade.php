@php
    $footer = $footer ?? [];
    $nav = $nav ?? [];
@endphp
<footer class="site-footer" id="footer">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <img class="footer-logo" src="/image/logo.png" alt="VACA MAXI">
                <p class="footer-about">{{ $footer['intro'] ?? '' }}</p>
                <div class="footer-contact">
                    <p>{{ $footer['address'] ?? '' }}</p>
                    @foreach (($footer['hotlines'] ?? []) as $hotline)
                        <p>{{ $hotline }}</p>
                    @endforeach
                    <p>{{ $footer['email'] ?? '' }}</p>
                    <p>{{ $footer['website'] ?? '' }}</p>
                </div>
            </div>
            <div class="col-lg-2">
                <ul class="footer-menu">
                    @foreach ($nav as $item)
                        <li><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="footer-map"></div>
                <div class="footer-social-title">MẠNG XÃ HỘI</div>
                <div class="footer-social">
                    @foreach (($footer['socials'] ?? []) as $social)
                        <a href="{{ $social['url'] }}" aria-label="{{ $social['label'] }}">{{ $social['label'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>