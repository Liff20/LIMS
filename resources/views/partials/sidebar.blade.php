@php
    $current = request()->route()->getName() ?? '';
    $isActive = fn ($names) => in_array($current, (array) $names);
    $openGroups = fn ($prefix) => str_starts_with($current, $prefix);
@endphp

<aside class="sticky top-0 z-30 flex h-screen w-[280px] shrink-0 flex-col border-r border-brand-100 bg-white p-4 text-brand-900 shadow-soft">
    {{-- Logo --}}
    <a href="{{ route('dashboard') }}" class="mb-6 flex items-center gap-3 rounded-xl px-2 py-2 transition hover:bg-brand-50">
        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-600 text-xl font-extrabold text-white shadow-glow">
            <span>L</span>
        </div>
        <div class="leading-tight">
            <div class="text-base font-extrabold tracking-tight text-brand-800">LIMS Lite</div>
            <div class="text-[11px] font-medium text-[#475569]">Laboratory Inventory Management</div>
        </div>
    </a>

    <nav class="flex-1 space-y-1 overflow-y-auto pr-1" x-data="{ open: '{{ str_starts_with($current, 'konfigurasi') ? 'konfigurasi' : (str_starts_with($current, 'barang') ? 'barang' : (str_starts_with($current, 'transaksi') ? 'transaksi' : '')) }}' }">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" class="{{ $isActive('dashboard') ? 'menu-item-active' : 'menu-item' }}">
            <x-icon name="home" class="h-5 w-5" />
            <span>Dashboard</span>
        </a>

        {{-- Konfigurasi --}}
        <div>
            <button type="button" @click="open = open === 'konfigurasi' ? '' : 'konfigurasi'"
                class="flex w-full items-center justify-between rounded-xl px-3.5 py-2.5 text-sm font-medium text-brand-800 transition hover:bg-brand-50">
                <span class="flex items-center gap-3">
                    <x-icon name="cog" class="h-5 w-5" />
                    <span>Konfigurasi</span>
                </span>
                <x-icon name="chevron-down" class="h-4 w-4 transition-transform" ::class="open === 'konfigurasi' && 'rotate-180'" />
            </button>
            <div x-show="open === 'konfigurasi'" x-collapse class="mt-1 space-y-0.5 pl-9">
                @foreach ([['konfigurasi.unit', 'Data Unit'], ['konfigurasi.satuan', 'Data Satuan'], ['konfigurasi.jenis-barang', 'Data Jenis Barang'], ['konfigurasi.jenis-pengguna', 'Data Jenis Pengguna'], ['konfigurasi.pengguna', 'Data Pengguna'], ['konfigurasi.supplier', 'Data Supplier']] as [$r, $label])
                    <a href="{{ route($r) }}" class="block rounded-lg px-3 py-2 text-[13px] {{ $isActive($r) ? 'bg-brand-100 font-semibold text-brand-700' : 'text-[#475569] hover:bg-brand-50 hover:text-brand-700' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>

        {{-- Alat dan Bahan --}}
        <div>
            <button type="button" @click="open = open === 'barang' ? '' : 'barang'"
                class="flex w-full items-center justify-between rounded-xl px-3.5 py-2.5 text-sm font-medium text-brand-800 transition hover:bg-brand-50">
                <span class="flex items-center gap-3">
                    <x-icon name="cube" class="h-5 w-5" />
                    <span>Alat &amp; Bahan</span>
                </span>
                <x-icon name="chevron-down" class="h-4 w-4 transition-transform" ::class="open === 'barang' && 'rotate-180'" />
            </button>
            <div x-show="open === 'barang'" x-collapse class="mt-1 space-y-0.5 pl-9">
                @foreach ([['barang.unit', 'Berdasarkan Unit'], ['barang.semua', 'Semua'], ['barang.expire', 'Expire Date']] as [$r, $label])
                    <a href="{{ route($r) }}" class="block rounded-lg px-3 py-2 text-[13px] {{ $isActive($r) ? 'bg-brand-100 font-semibold text-brand-700' : 'text-[#475569] hover:bg-brand-50 hover:text-brand-700' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>

        {{-- Transaksi --}}
        <div>
            <button type="button" @click="open = open === 'transaksi' ? '' : 'transaksi'"
                class="flex w-full items-center justify-between rounded-xl px-3.5 py-2.5 text-sm font-medium text-brand-800 transition hover:bg-brand-50">
                <span class="flex items-center gap-3">
                    <x-icon name="swap" class="h-5 w-5" />
                    <span>Transaksi</span>
                </span>
                <x-icon name="chevron-down" class="h-4 w-4 transition-transform" ::class="open === 'transaksi' && 'rotate-180'" />
            </button>
            <div x-show="open === 'transaksi'" x-collapse class="mt-1 space-y-0.5 pl-9">
                @foreach ([
                    ['transaksi.peminjaman', 'Peminjaman'],
                    ['transaksi.data-peminjaman', 'Data Peminjaman'],
                    ['transaksi.permintaan-personal', 'Permintaan Personal'],
                    ['transaksi.permintaan-unit', 'Permintaan Unit'],
                    ['transaksi.alat-bahan-masuk', 'Alat Bahan Masuk'],
                    ['transaksi.alat-bahan-keluar', 'Alat Bahan Keluar'],
                    ['transaksi.transaksi-masuk', 'Transaksi Masuk'],
                    ['transaksi.transaksi-keluar', 'Transaksi Keluar'],
                    ['transaksi.supply-baru', 'Supply Baru'],
                    ['transaksi.permintaan-baru', 'Permintaan Baru'],
                ] as [$r, $label])
                    <a href="{{ route($r) }}" class="block rounded-lg px-3 py-2 text-[13px] {{ $isActive($r) ? 'bg-brand-100 font-semibold text-brand-700' : 'text-[#475569] hover:bg-brand-50 hover:text-brand-700' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>

        {{-- Laporan --}}
        <div>
            <button type="button" @click="open = open === 'laporan' ? '' : 'laporan'"
                class="flex w-full items-center justify-between rounded-xl px-3.5 py-2.5 text-sm font-medium text-brand-800 transition hover:bg-brand-50">
                <span class="flex items-center gap-3">
                    <x-icon name="report" class="h-5 w-5" />
                    <span>Laporan</span>
                </span>
                <x-icon name="chevron-down" class="h-4 w-4 transition-transform" ::class="open === 'laporan' && 'rotate-180'" />
            </button>
            <div x-show="open === 'laporan'" x-collapse class="mt-1 space-y-0.5 pl-9">
                @foreach ([['laporan.keluar', 'Detail Alat Bahan Keluar'], ['laporan.masuk', 'Detail Alat Bahan Masuk']] as [$r, $label])
                    <a href="{{ route($r) }}" class="block rounded-lg px-3 py-2 text-[13px] {{ $isActive($r) ? 'bg-brand-100 font-semibold text-brand-700' : 'text-[#475569] hover:bg-brand-50 hover:text-brand-700' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>

        {{-- Analitik --}}
        <a href="{{ route('analitik') }}" class="{{ $isActive('analitik') ? 'menu-item-active' : 'menu-item' }}">
            <x-icon name="chart" class="h-5 w-5" />
            <span>Analitik</span>
        </a>
    </nav>

    <div class="mt-4 rounded-xl bg-brand-50 p-3 text-[11px] leading-relaxed text-[#475569]">
        <div class="mb-1 font-semibold text-brand-800">Stok Opname BHP 2026</div>
        Fakultas Kedokteran Gigi<br>Universitas Gadjah Mada
    </div>
</aside>
