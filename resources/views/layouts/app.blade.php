<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Accurate Web')</title>
    <link rel="stylesheet" href="{{ asset('css/modern-app.css') }}">
    @stack('styles')
</head>
<body class="app-body">
    @php
        $navItems = [
            [
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'match' => 'dashboard',
                'icon' => 'D',
                'hint' => 'Ringkasan bisnis',
            ],
            [
                'label' => 'Barang',
                'route' => 'barang.index',
                'match' => 'barang.*',
                'icon' => 'B',
                'hint' => 'Stok dan harga',
            ],
            [
                'label' => 'Pelanggan',
                'route' => 'pelanggan.index',
                'match' => 'pelanggan.*',
                'icon' => 'C',
                'hint' => 'Piutang dan kontak',
            ],
            [
                'label' => 'Pemasok',
                'route' => 'pemasok.index',
                'match' => 'pemasok.*',
                'icon' => 'P',
                'hint' => 'Hutang dan kontak',
            ],
            [
                'label' => 'Pembelian',
                'route' => 'pembelian.index',
                'match' => 'pembelian.*',
                'icon' => 'M',
                'hint' => 'Faktur masuk',
            ],
            [
                'label' => 'Penjualan',
                'route' => 'penjualan.index',
                'match' => 'penjualan.*',
                'icon' => 'S',
                'hint' => 'Faktur keluar',
            ],
        ];

        $activeItem = collect($navItems)->first(fn ($item) => request()->routeIs($item['match'])) ?? $navItems[0];
    @endphp

    <div class="app-shell">
        <aside class="app-sidebar" id="app-sidebar" aria-label="Navigasi utama">
            <div class="app-brand">
                <a class="app-brand__mark" href="{{ route('dashboard') }}" aria-label="Accurate Web dashboard">AW</a>
                <div>
                    <a class="app-brand__name" href="{{ route('dashboard') }}">Accurate Web</a>
                    <p class="app-brand__caption">Akuntansi & ERP</p>
                </div>
            </div>

            <nav class="app-nav">
                @foreach($navItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="app-nav__link {{ request()->routeIs($item['match']) ? 'is-active' : '' }}"
                        aria-current="{{ request()->routeIs($item['match']) ? 'page' : 'false' }}"
                    >
                        <span class="app-nav__icon" aria-hidden="true">{{ $item['icon'] }}</span>
                        <span>
                            <span class="app-nav__label">{{ $item['label'] }}</span>
                            <span class="app-nav__hint">{{ $item['hint'] }}</span>
                        </span>
                    </a>
                @endforeach
            </nav>

            <div class="app-sidebar__panel">
                <p class="app-sidebar__eyebrow">Workspace</p>
                <h2>Operasional harian lebih ringkas.</h2>
                <p>Data master, faktur, dan ringkasan pendapatan berada dalam satu alur kerja.</p>
            </div>
        </aside>

        <button class="app-sidebar__backdrop" type="button" data-sidebar-close aria-label="Tutup navigasi"></button>

        <div class="app-main">
            <header class="app-topbar">
                <div class="app-topbar__left">
                    <button class="icon-button app-topbar__menu" type="button" data-sidebar-toggle aria-controls="app-sidebar" aria-expanded="false">
                        <span class="icon-button__bars" aria-hidden="true"></span>
                        <span class="sr-only">Buka navigasi</span>
                    </button>
                    <div>
                        <p class="page-kicker">{{ $activeItem['hint'] }}</p>
                        <h1 class="page-title">@yield('page_title', $activeItem['label'])</h1>
                    </div>
                </div>
                <div class="app-topbar__actions">
                    <a class="btn btn-soft" href="{{ route('pembelian.create') }}">Faktur Masuk</a>
                    <a class="btn btn-primary" href="{{ route('penjualan.create') }}">Faktur Keluar</a>
                </div>
            </header>

            <main class="app-content">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Periksa input:</strong>
                        <ul class="alert-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/modern-app.js') }}"></script>
    @stack('scripts')
</body>
</html>
