{{--
    Sidebar utama aplikasi (dipakai lewat <x-sidebar />).
    Desain kanonik: runner logo + navigasi dengan active-state dinamis.
    Link Categories hanya muncul untuk admin.
--}}
@php
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();
@endphp

<aside class="sidebar">
    <a href="{{ route('dashboard') }}" class="brand" aria-label="AthleteGear Dashboard">
        <svg class="runner-logo" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            {{-- Kepala --}}
            <circle cx="42" cy="11" r="6" fill="white"/>
            {{-- Badan: miring ke depan (atas ke kanan, pinggul ke kiri) --}}
            <path d="M38 22L30 38" stroke="white" stroke-width="5" stroke-linecap="round"/>
            {{-- Lengan depan: tertekuk, ayun ke depan atas --}}
            <path d="M37 24L45 29L51 23" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
            {{-- Lengan belakang: tertekuk, ayun ke belakang bawah --}}
            <path d="M37 24L29 27L22 33" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
            {{-- Kaki depan: lutut terangkat, betis turun --}}
            <path d="M30 38L40 42L38 53" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
            {{-- Kaki belakang: menendang ke belakang --}}
            <path d="M30 38L22 46L12 45" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
            {{-- Aksen merah menyilang badan --}}
            <path d="M32.9 24.4L39.1 27.6" stroke="#D94343" stroke-width="4" stroke-linecap="round"/>
        </svg>
        <span class="brand-name">Athlete<span>Gear</span></span>
    </a>

    <div class="nav-label">WORKSPACE</div>

    <nav class="nav" aria-label="Main navigation">
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon">⌂</span> Dashboard
        </a>

        <a href="{{ route('equipment.index') }}"
           class="nav-link {{ request()->routeIs('equipment.*') ? 'active' : '' }}">
            <span class="nav-icon">▤</span> Equipment
        </a>

        @if ($isAdmin)
            <a href="{{ route('categories.index') }}"
               class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <span class="nav-icon">▦</span> Categories
            </a>
        @endif

        <a href="{{ route('borrowings.index') }}"
           class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}">
            <span class="nav-icon">◷</span> Borrowings
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="lane-decoration"></div>
        <strong>BETTER GEAR.<br>BETTER PERFORMANCE.</strong>
        <p>Built for athletes. Ready for every training session.</p>
    </div>
</aside>
