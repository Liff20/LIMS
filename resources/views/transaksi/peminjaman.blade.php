@extends('layouts.app')

@section('title', 'Peminjaman')
@section('page-title', 'Pengajuan Peminjaman')
@section('page-subtitle', 'Mengajukan peminjaman alat & bahan')

@section('content')
    @if (session('success'))
        <div class="mb-4 flex items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-700 backdrop-blur">
            <x-icon name="check" class="h-5 w-5" />
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-2">
        {{-- Form --}}
        <div class="card p-6">
            <h3 class="mb-5 flex items-center gap-2 font-bold text-deep-space-600">
                <x-icon name="swap" class="h-5 w-5 text-blue-green-400" />
                Form Peminjaman
            </h3>

            <form method="POST" action="{{ route('transaksi.peminjaman.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="label" for="unit">ID Unit</label>
                        <input class="input cursor-not-allowed bg-brand-50 opacity-70" id="unit" type="text"
                               value="{{ \App\Support\DataProvider::unitName(session('selected_unit', 1)) }}" readonly>
                        <p class="mt-1 text-xs text-deep-space-600/50">Otomatis sesuai unit login</p>
                    </div>

                    <div>
                        <label class="label" for="tanggal">Tanggal Pinjam</label>
                        <input class="input" id="tanggal" name="tanggal" type="date" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div>
                        <label class="label" for="peminjam">Peminjam</label>
                        <input class="input" id="peminjam" name="peminjam" list="peminjam-list" placeholder="Cari & pilih nama peminjam…" required>
                        <datalist id="peminjam-list">
                            @foreach ($users as $u)
                                <option value="{{ $u['nama'] }}">{{ $u['role'] }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div>
                        <label class="label" for="barang">Barang (BHP)</label>
                        <input class="input" id="barang" name="barang" list="barang-list" placeholder="Cari & pilih data barang…" required>
                        <datalist id="barang-list">
                            @foreach ($barang as $b)
                                <option value="{{ $b['nama'] }}">{{ $b['spesifikasi'] }} — {{ $b['satuan'] }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div>
                        <label class="label" for="qty">QTY (Jumlah)</label>
                        <input class="input" id="qty" name="qty" type="number" min="1" placeholder="Jumlah yang dipinjam" required>
                    </div>

                    <div>
                        <label class="label" for="pemanfaatan">Pemanfaatan</label>
                        <input class="input" id="pemanfaatan" name="pemanfaatan" list="pemanfaatan-list" placeholder="Cari & pilih pemanfaatan…" required>
                        <datalist id="pemanfaatan-list">
                            @foreach ($pemanfaatan as $p)
                                <option value="{{ $p['nama'] }}">{{ $p['deskripsi'] }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div>
                        <label class="label" for="keterangan">Keterangan</label>
                        <textarea class="input" id="keterangan" name="keterangan" rows="3" placeholder="Tambahan penjelasan lain (opsional)"></textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full">
                        <x-icon name="check" class="h-4 w-4" /> Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>

        {{-- Info --}}
        <div class="space-y-4">
            <div class="card p-6">
                <h3 class="mb-3 flex items-center gap-2 font-bold text-deep-space-600">
                    <x-icon name="eye" class="h-5 w-5 text-blue-green-400" />
                    Panduan
                </h3>
                <ul class="space-y-2 text-sm text-deep-space-600/80">
                    <li class="flex gap-2"><x-icon name="check" class="h-4 w-4 shrink-0 text-emerald-500" /> Unit terisi otomatis sesuai login Anda.</li>
                    <li class="flex gap-2"><x-icon name="check" class="h-4 w-4 shrink-0 text-emerald-500" /> Peminjam dicari berdasarkan nama pengguna terdaftar.</li>
                    <li class="flex gap-2"><x-icon name="check" class="h-4 w-4 shrink-0 text-emerald-500" /> Barang (BHP) dipilih dari daftar inventaris unit.</li>
                    <li class="flex gap-2"><x-icon name="check" class="h-4 w-4 shrink-0 text-emerald-500" /> Peminjaman langsung tercatat dan mengurangi stok.</li>
                </ul>
            </div>

            <div class="card p-6">
                <h3 class="mb-3 font-bold text-deep-space-600">Stok Unit Saat Ini</h3>
                <div class="table-wrap !shadow-none">
                    <table class="table-base">
                        <thead>
                            <tr><th>Barang</th><th>Spesifikasi</th><th class="text-right">Stok</th></tr>
                        </thead>
                        <tbody>
                            @php $selectedUnit = session('selected_unit', 1); @endphp
                            @foreach (collect($barang)->where('unit_id', $selectedUnit)->take(6) as $b)
                                <tr>
                                    <td class="font-medium">{{ $b['nama'] }}</td>
                                    <td class="text-xs">{{ $b['spesifikasi'] }}</td>
                                    <td class="text-right font-semibold">{{ $b['stok'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
