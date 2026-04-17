@php
    $active = $active ?? 'home';
    $nav = $nav ?? [];
@endphp

<header class="site-header">
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
                                @if($hasChildren)
                                    id="dropdown-{{ $item['key'] }}"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                @endif
                            >
                                {{ $item['label'] }}
                            </a>

                            @if($hasChildren)
                                <ul class="dropdown-menu" aria-labelledby="dropdown-{{ $item['key'] }}">
                                    @foreach ($item['children'] as $child)
                                        <li>
                                            <a class="dropdown-item {{ ($child['key'] ?? '') === $active ? 'active' : '' }}" href="{{ $child['url'] }}">
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