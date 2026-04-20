@php
    $active = $active ?? 'home';
    $nav = $nav ?? [];
    $isHome = $isHome ?? false;
@endphp

<header class="site-header {{ $isHome ? 'is-home' : '' }}">
    <nav class="navbar navbar-expand-lg navbar-dark container">
        <div class="container-fluid">
            <a class="navbar-brand brand-link" href="/">
                <img class="brand-logo brand-mark" src="/image/logo.png" alt="VACA MAXI">
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

                            if (!$isActive && $hasChildren) {
                                foreach ($item['children'] as $child) {
                                    if (($child['key'] ?? '') === $active) {
                                        $isActive = true;
                                        break;
                                    }
                                }
                            }
                        @endphp

                        <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }}">
                            <a
                                class="nav-link {{ $hasChildren ? 'dropdown-toggle' : '' }} {{ $isActive ? 'active' : '' }}"
                                href="{{ $item['url'] ?? '#' }}"
                                target="{{ $item['target'] ?? '_self' }}"
                                @if($hasChildren)
                                    id="dropdown-{{ $item['key'] }}"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                @endif
                            >
                                {{ $item['label'] }}
                                @if($hasChildren)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" stroke="currentColor" stroke-width="1" class="bi bi-chevron-down ms-2 dropdown-chevron" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                @endif
                            </a>

                            @if($hasChildren)
                                <ul class="dropdown-menu" aria-labelledby="dropdown-{{ $item['key'] }}">
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
        handleScroll(); // Check on load
    });
</script>
@endpush
