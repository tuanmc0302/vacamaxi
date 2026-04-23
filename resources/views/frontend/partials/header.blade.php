@php
    $active = $active ?? 'home';
    $nav = $nav ?? [];
    $isHome = $isHome ?? false;
@endphp

<header class="site-header {{ $isHome ? 'is-home' : '' }}">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container container-header">
            <a class="navbar-brand brand-link" href="/">
                <img class="brand-logo brand-mark" src="{{ $siteSettings['logo_url'] ?? asset('image/logo.png') }}" alt="{{ $siteSettings['site_name'] ?? 'VACAMAXI' }}">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                <ul class="navbar-nav gap-lg-2 align-items-lg-center">
                    @foreach ($nav as $item)
                        @php
                            $hasChildren = !empty($item['children']);
                            $isActive = ($item['key'] ?? '') === $active;

                            if (! $isActive && $hasChildren) {
                                foreach ($item['children'] as $child) {
                                    if (($child['key'] ?? '') === $active) {
                                        $isActive = true;
                                        break;
                                    }
                                }
                            }
                        @endphp

                        <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }}">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <a
                                    class="nav-link {{ $isActive ? 'active' : '' }} flex-grow-1"
                                    href="{{ $item['url'] ?? '#' }}"
                                    target="{{ $item['target'] ?? '_self' }}"
                                    @if($hasChildren)
                                        id="dropdown-{{ $item['key'] }}"
                                    @endif
                                >
                                    {{ $item['label'] }}
                                </a>
                                @if($hasChildren)
                                    <span class="dropdown-mobile-toggle d-lg-none px-3" data-target="dropdown-menu-{{ $item['key'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" stroke="currentColor" stroke-width="1" class="bi bi-chevron-down dropdown-chevron" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </span>
                                    {{-- Desktop-only chevron to maintain visual consistency --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" stroke="currentColor" stroke-width="1" class="bi bi-chevron-down ms-2 dropdown-chevron d-none d-lg-block" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                @endif
                            </div>

                            @if($hasChildren)
                                <ul class="dropdown-menu" id="dropdown-menu-{{ $item['key'] }}" aria-labelledby="dropdown-{{ $item['key'] }}">
                                    @foreach ($item['children'] as $child)
                                        <li>
                                            <a class="dropdown-item {{ ($child['key'] ?? '') === $active ? 'active' : '' }}" href="{{ $child['url'] }}" target="{{ $child['target'] ?? '_self' }}">
                                                {{ $child['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
<style>
    @media (max-width: 991.98px) {
        .dropdown-menu.show {
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }
        .dropdown-mobile-toggle {
            cursor: pointer;
            color: rgba(255, 255, 255, 0.7);
            transition: transform 0.3s ease;
        }
        .dropdown-mobile-toggle.active {
            transform: rotate(180deg);
            color: #f3b21a;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('.site-header');
        const handleScroll = () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };

        window.addEventListener('scroll', handleScroll);
        handleScroll();

        // Mobile Dropdown Toggle Logic
        const mobileToggles = document.querySelectorAll('.dropdown-mobile-toggle');
        mobileToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const targetId = this.getAttribute('data-target');
                const targetMenu = document.getElementById(targetId);
                
                if (targetMenu) {
                    targetMenu.classList.toggle('show');
                    this.classList.toggle('active');
                }
            });
        });
    });
</script>
@endpush
