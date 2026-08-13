@php
    $footer = $footer ?? [];
    $nav = $nav ?? [];
    $phoneWine = !empty($siteSettings['phone_wine']) ? __($siteSettings['phone_wine']) : '';
    $phoneBeef = !empty($siteSettings['phone_beef']) ? __($siteSettings['phone_beef']) : '';
    $socialLinks = [
        ['label' => 'Zalo', 'url' => $siteSettings['zalo_url'] ?? ''],
        ['label' => 'Facebook', 'url' => $siteSettings['facebook_url'] ?? ''],
        ['label' => 'Youtube', 'url' => $siteSettings['youtube_url'] ?? ''],
    ];
@endphp
<footer class="site-footer" id="footer">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <img class="footer-logo" src="{{ $siteSettings['logo_url'] ?? asset('image/logo.png') }}" alt="{{ $siteSettings['site_name'] ?? 'VACAMAXI' }}">
                        <p class="footer-about">{{ $siteSettings['site_description'] ?? ($footer['intro'] ?? '') }}</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h4 class="footer-title">{{ __('LIÊN KẾT') }}</h4>
                        <ul class="footer-menu">
                            @foreach ($nav as $item)
                                <li><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">
                        <h4 class="footer-title">{{ __('THÔNG TIN LIÊN HỆ') }}</h4>
                        <div class="footer-contact">
                            @if(!empty($siteSettings['address']) || !empty($footer['address']))
                                <p><i class="bi bi-geo-alt-fill me-2"></i>{{ $siteSettings['address'] ?? $footer['address'] ?? '' }}</p>
                            @endif
                            @if($phoneWine)
                                <p><i class="bi bi-telephone-fill me-2"></i>{{ $phoneWine }}</p>
                            @endif
                            @if($phoneBeef)
                                <p><i class="bi bi-telephone-fill me-2"></i>{{ $phoneBeef }}</p>
                            @endif
                            @if(!empty($siteSettings['email']))
                                <p><i class="bi bi-envelope-fill me-2"></i>{{ $siteSettings['email'] }}</p>
                            @elseif(!empty($footer['email']))
                                <p><i class="bi bi-envelope-fill me-2"></i>{{ $footer['email'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-social-wrap">
                        @if(!empty($siteSettings['google_map_embed_url']))
                            <h4 class="footer-title">{{ __('BẢN ĐỒ') }}</h4>
                            <div class="footer-map mt-2">
                                {!! $siteSettings['google_map_embed_url'] !!}
                            </div>
                        @endif

                        <h4 class="footer-title {{ !empty($siteSettings['google_map_embed_url']) ? 'mt-4' : '' }}">{{ __('MẠNG XÃ HỘI') }}</h4>
                        <div class="footer-social">
                            @php
                                $socials = $footer['socials'] ?? [
                                    ['label' => 'Facebook', 'url' => '#'],
                                    ['label' => 'Youtube', 'url' => '#'],
                                    ['label' => 'Zalo', 'url' => '#']
                                ];
                            @endphp
                            @foreach ($socials as $social)
                                <a href="{{ $social['url'] }}" class="social-link" aria-label="{{ $social['label'] }}" target="_blank">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright mb-md-0">© {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'VACAMAXI' }}. {{ __('Tất cả quyền được bảo lưu.') }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="design-by mb-0">{{ __('Phát triển bởi') }} Vacamaxi</p>
                </div>
            </div>
        </div>
    </div>
</footer>
