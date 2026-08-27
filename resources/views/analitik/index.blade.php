@extends('layouts.app')

@section('title', 'Analitik')
@section('page-title', 'Analitik Pemakaian Bahan')
@section('page-subtitle', 'Wawasan konsumsi BHP untuk pengelola laboratorium')

@section('content')
    @php
        $kpi = $data['kpi'];
        $jenisMax = max($data['jenis_distribusi']) ?: 1;
    @endphp

    {{-- KPI Cards --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-[#475569]">Total Pemakaian (12 bln)</div>
                    <div class="mt-1 text-3xl font-extrabold text-brand-700">{{ number_format($kpi['total_pakai'], 0, ',', '.') }}</div>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-600 text-white shadow-glow">
                    <x-icon name="swap" class="h-6 w-6" />
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-[#475569]">Rata-rata / Bulan</div>
                    <div class="mt-1 text-3xl font-extrabold text-brand-700">{{ number_format($kpi['rata_bulanan'], 0, ',', '.') }}</div>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-400 text-white shadow-md">
                    <x-icon name="chart" class="h-6 w-6" />
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-[#475569]">Bulan Puncak</div>
                    <div class="mt-1 text-2xl font-extrabold text-brand-700">{{ $kpi['bulan_puncak'] }}</div>
                    <div class="text-xs text-[#475569]">{{ number_format($kpi['max_pakai'], 0, ',', '.') }} item</div>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-accent text-[#61460c] shadow-md">
                    <x-icon name="flask" class="h-6 w-6" />
                </div>
            </div>
        </div>
        <div class="card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-wide text-[#475569]">Stok Kritis (&lt; 30 hari)</div>
                    <div class="mt-1 text-3xl font-extrabold {{ $kpi['stok_menipis'] > 0 ? 'text-[#d97706]' : 'text-brand-700' }}">{{ $kpi['stok_menipis'] }}</div>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#f4c542] text-[#61460c] shadow-md">
                    <x-icon name="box" class="h-6 w-6" />
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="mt-6 flex flex-wrap items-center gap-3">
        <span class="text-sm font-semibold text-brand-800">Filter:</span>
        <form method="GET" action="{{ route('analitik') }}" class="flex flex-wrap gap-2">
            <select name="unit" class="input !w-56 !py-2 !text-xs" onchange="this.form.submit()">
                <option value="">Semua Unit</option>
                @foreach ($units as $u)
                    <option value="{{ $u['id'] }}" @selected($filters['unit'] == $u['id'])>{{ $u['nama'] }}</option>
                @endforeach
            </select>
            <select name="jenis" class="input !w-48 !py-2 !text-xs" onchange="this.form.submit()">
                <option value="">Semua Jenis</option>
                @foreach ($jenis as $j)
                    <option value="{{ $j['nama'] }}" @selected($filters['jenis'] === $j['nama'])>{{ $j['nama'] }}</option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Chart tren + distribusi jenis --}}
    <div class="mt-4 grid gap-6 lg:grid-cols-3">
        <div class="card p-5 lg:col-span-2">
            <h3 class="mb-4 flex items-center gap-2 font-bold text-brand-700">
                <x-icon name="chart" class="h-5 w-5 text-brand-400" />
                Tren Pemakaian &amp; Penerimaan (12 Bulan Terakhir)
            </h3>
            <div class="relative h-72">
                <canvas id="chartTren"></canvas>
            </div>
            <p class="mt-3 text-xs text-[#475569]">
                📌 Puncak pemakaian umumnya terjadi di awal semester (Agustus–Oktober &amp; Januari–Maret).
            </p>
        </div>

        <div class="card p-5">
            <h3 class="mb-4 flex items-center gap-2 font-bold text-brand-700">
                <x-icon name="cube" class="h-5 w-5 text-brand-400" />
                Distribusi Stok per Jenis
            </h3>
            <div class="relative h-56">
                <canvas id="chartJenis"></canvas>
            </div>
            <div class="mt-3 space-y-2">
                @foreach ($data['jenis_distribusi'] as $nama => $jumlah)
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-[#475569]">{{ $nama }}</span>
                        <span class="font-semibold text-brand-700">{{ number_format($jumlah, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Barang tercepat + proyeksi habis --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <div class="card p-5">
            <h3 class="mb-4 flex items-center gap-2 font-bold text-brand-700">
                <x-icon name="flask" class="h-5 w-5 text-brand-400" />
                Barang Paling Cepat Terpakai
            </h3>
            <div class="space-y-3">
                @php $maxPakai = max(array_column($data['top_cepat'], 'total_pakai')) ?: 1; @endphp
                @foreach ($data['top_cepat'] as $t)
                    <div>
                        <div class="mb-1 flex items-center justify-between text-sm">
                            <span class="font-medium text-[#0f172a]">{{ $t['nama'] }}</span>
                            <span class="text-xs font-semibold text-brand-700">{{ $t['total_pakai'] }} {{ $t['satuan'] }}</span>
                        </div>
                        <div class="h-2.5 w-full overflow-hidden rounded-full bg-brand-50">
                            <div class="h-full rounded-full bg-gradient-brand" style="width: {{ round($t['total_pakai'] / $maxPakai * 100) }}%"></div>
                        </div>
                        <div class="mt-0.5 text-[11px] text-[#475569]">{{ $t['spesifikasi'] }} · ~{{ $t['rate_per_bulan'] }}/bln · sisa {{ $t['stok'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card p-5">
            <h3 class="mb-4 flex items-center gap-2 font-bold text-brand-700">
                <x-icon name="box" class="h-5 w-5 text-[#d97706]" />
                Proyeksi Stok Akan Habis
            </h3>
            <div class="table-wrap !shadow-none">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th class="text-center">Sisa Stok</th>
                            <th class="text-center">Estimasi Habis</th>
                            <th>Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['proyeksi_habis'] as $p)
                            <tr>
                                <td class="font-medium">{{ $p['nama'] }}</td>
                                <td class="text-center">{{ $p['stok'] }} {{ $p['satuan'] }}</td>
                                <td class="text-center">{{ $p['hari_habis'] }} hari</td>
                                <td>
                                    <span class="{{ $p['level'] === 'Kritis' ? 'badge-red' : 'badge-amber' }}">{{ $p['level'] }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-6 text-center text-[#475569]">Tidak ada stok yang diproyeksikan habis dalam waktu dekat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pemakaian per unit + pemanfaatan --}}
    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <div class="card p-5">
            <h3 class="mb-4 flex items-center gap-2 font-bold text-brand-700">
                <x-icon name="flask" class="h-5 w-5 text-brand-400" />
                Pemakaian per Unit Lab
            </h3>
            <div class="relative h-80">
                <canvas id="chartUnit"></canvas>
            </div>
        </div>

        <div class="card p-5">
            <h3 class="mb-4 flex items-center gap-2 font-bold text-brand-700">
                <x-icon name="report" class="h-5 w-5 text-brand-400" />
                Pemanfaatan (Tujuan Pemakaian)
            </h3>
            <div class="relative h-56">
                <canvas id="chartPemanfaatan"></canvas>
            </div>
            <div class="mt-3 grid grid-cols-2 gap-2">
                @foreach ($data['pemanfaatan'] as $p)
                    <div class="flex items-center justify-between rounded-lg bg-brand-50 px-3 py-2 text-xs">
                        <span class="text-[#475569]">{{ $p['nama'] }}</span>
                        <span class="font-semibold text-brand-700">{{ $p['persen'] }}%</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const brand = '#166083';
    const brandLight = '#8cc6e4';
    const amber = '#f4c542';
    const orange = '#fb8500';

    Chart.defaults.font.family = "'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif";
    Chart.defaults.color = '#475569';

    // Tren pemakaian vs penerimaan
    const ctxTren = document.getElementById('chartTren');
    if (ctxTren) {
        new Chart(ctxTren, {
            type: 'bar',
            data: {
                labels: @json($data['bulan_labels']),
                datasets: [
                    {
                        label: 'Pemakaian',
                        data: @json($data['pemakaian_bulanan']),
                        backgroundColor: brand,
                        borderRadius: 6,
                        barPercentage: 0.6,
                    },
                    {
                        label: 'Penerimaan',
                        data: @json($data['penerimaan_bulanan']),
                        backgroundColor: brandLight,
                        borderRadius: 6,
                        barPercentage: 0.6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: { y: { beginAtZero: true, grid: { color: 'rgba(22,96,131,0.08)' } }, x: { grid: { display: false } } },
            },
        });
    }

    // Distribusi jenis (donut)
    const ctxJenis = document.getElementById('chartJenis');
    if (ctxJenis) {
        new Chart(ctxJenis, {
            type: 'doughnut',
            data: {
                labels: @json(array_keys($data['jenis_distribusi'])),
                datasets: [{
                    data: @json(array_values($data['jenis_distribusi'])),
                    backgroundColor: ['#166083', '#4d9ecb', '#8ecae6', '#f4c542', '#fb8500', '#b9ddef'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } },
            },
        });
    }

    // Pemakaian per unit (horizontal bar)
    const ctxUnit = document.getElementById('chartUnit');
    if (ctxUnit) {
        new Chart(ctxUnit, {
            type: 'bar',
            data: {
                labels: @json(array_column($data['pemakaian_per_unit'], 'nama')),
                datasets: [{
                    label: 'Total Pemakaian',
                    data: @json(array_column($data['pemakaian_per_unit'], 'total')),
                    backgroundColor: brand,
                    borderRadius: 6,
                }],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { x: { beginAtZero: true, grid: { color: 'rgba(22,96,131,0.08)' } }, y: { grid: { display: false } } },
            },
        });
    }

    // Pemanfaatan (donut)
    const ctxPemanfaatan = document.getElementById('chartPemanfaatan');
    if (ctxPemanfaatan) {
        new Chart(ctxPemanfaatan, {
            type: 'doughnut',
            data: {
                labels: @json(array_column($data['pemanfaatan'], 'nama')),
                datasets: [{
                    data: @json(array_column($data['pemanfaatan'], 'jumlah')),
                    backgroundColor: ['#166083', '#4d9ecb', '#8ecae6', '#f4c542', '#fb8500'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } },
            },
        });
    }
});
</script>
@endpush
