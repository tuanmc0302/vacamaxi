@php
    $phone = preg_replace('/\D+/', '', $siteSettings['phone_wine'] ?? ($footer['hotlines'][0] ?? ''));
    $zaloUrl = $siteSettings['zalo_url'] ?? ($phone ? 'https://zalo.me/'.$phone : '#');
    $websiteOrMap = $siteSettings['website_url'] ?? ($siteSettings['google_map_url'] ?? ($footer['website'] ?? '#'));
@endphp
<div class="float-contact">
    <a href="tel:{{ $siteSettings['phone_wine'] ?? ($footer['hotlines'][0] ?? '') }}" class="float-item">
        <span class="float-label">Hotline</span>
        <div class="float-icon-wrap"><i class="bi bi-telephone-fill"></i></div>
    </a>
    <a href="{{ $zaloUrl }}" target="_blank" class="float-item">
        <span class="float-label">Zalo</span>
        <div class="float-icon-wrap"><span class="zalo-mini">Zalo</span></div>
    </a>
    <a href="{{ $websiteOrMap }}" target="_blank" class="float-item">
        <span class="float-label">Website</span>
        <div class="float-icon-wrap"><i class="bi bi-globe"></i></div>
    </a>
</div>
