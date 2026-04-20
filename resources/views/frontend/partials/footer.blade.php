@php
    $footer = $footer ?? [];
    $nav = $nav ?? [];
@endphp
<footer class="site-footer" id="footer">
    <div class="container">
        <div class="footer-top">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <img class="footer-logo" src="/image/logo.png" alt="VACAMAXI">
                        <p class="footer-about">{{ $footer['intro'] ?? '' }}</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h4 class="footer-title">LIÊN KẾT</h4>
                        <ul class="footer-menu">
                            @foreach ($nav as $item)
                                <li><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">
                        <h4 class="footer-title">THÔNG TIN LIÊN HỆ</h4>
                        <div class="footer-contact">
                            <p><i class="bi bi-geo-alt-fill me-2"></i>{{ $footer['address'] ?? '' }}</p>
                            @foreach (($footer['hotlines'] ?? []) as $hotline)
                                <p><i class="bi bi-telephone-fill me-2"></i>{{ $hotline }}</p>
                            @endforeach
                            <p><i class="bi bi-envelope-fill me-2"></i>{{ $footer['email'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-social-wrap">
                        <h4 class="footer-title">MẠNG XÃ HỘI</h4>
                        <div class="footer-social">
                            @foreach (($footer['socials'] ?? []) as $social)
                                <a href="{{ $social['url'] }}" class="social-link" aria-label="{{ $social['label'] }}">
                                    @if(str_contains(strtolower($social['label']), 'facebook'))
                                        <i class="bi bi-facebook"></i>
                                    @elseif(str_contains(strtolower($social['label']), 'youtube'))
                                        <i class="bi bi-youtube"></i>
                                    @elseif(str_contains(strtolower($social['label']), 'zalo'))
                                        <span class="zalo-text">Zalo</span>
                                    @else
                                        {{ $social['label'] }}
                                    @endif
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <div class="footer-map-placeholder"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright mb-md-0">© {{ date('Y') }} VACAMAXI. Tất cả quyền được bảo lưu.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="design-by mb-0">Phát triển bởi Embera</p>
                </div>
            </div>
        </div>
    </div>
</footer>