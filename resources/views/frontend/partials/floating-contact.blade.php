<div class="float-contact">
    <a href="tel:{{ $footer['hotlines'][0] ?? '' }}" class="float-item">
        <span class="float-label">Hotline</span>
        <div class="float-icon-wrap"><i class="bi bi-telephone-fill"></i></div>
    </a>
    <a href="https://zalo.me/{{ $footer['hotlines'][0] ?? '' }}" target="_blank" class="float-item">
        <span class="float-label">Zalo</span>
        <div class="float-icon-wrap"><span class="zalo-mini">Zalo</span></div>
    </a>
    <a href="{{ $footer['website'] ?? '#' }}" class="float-item">
        <span class="float-label">Website</span>
        <div class="float-icon-wrap"><i class="bi bi-globe"></i></div>
    </a>
</div>
