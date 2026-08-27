@extends('layouts.app')

@section('title', 'Peminjaman')
@section('page-title', 'Pengajuan Peminjaman')
@section('page-subtitle', 'Mengajukan peminjaman alat & bahan')

@section('content')
    @if (session('success'))
        <div class="mb-4 flex items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-700">
            <x-icon name="check" class="h-5 w-5" />
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded-2xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm font-medium text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
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
                        <input class="input" id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>

                    <div>
                        <label class="label" for="user_id">Peminjam</label>
                        <select class="input" id="user_id" name="user_id" required>
                            <option value="">Pilih peminjam…</option>
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>{{ $u->name }} ({{ $u->role }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="label" for="barang_id">Barang (BHP)</label>
                        <select class="input" id="barang_id" name="barang_id" required>
                            <option value="">Pilih barang…</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->id }}" @selected(old('barang_id') == $b->id)>
                                    {{ $b->nama }} — {{ $b->spesifikasi }} ({{ $b->satuan?->nama }}, stok {{ $b->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="label" for="qty">QTY (Jumlah)</label>
                        <input class="input" id="qty" name="qty" type="number" min="1" value="{{ old('qty', 1) }}" required>
                    </div>

                    <div>
                        <label class="label" for="pemanfaatan_id">Pemanfaatan</label>
                        <select class="input" id="pemanfaatan_id" name="pemanfaatan_id" required>
                            <option value="">Pilih pemanfaatan…</option>
                            @foreach ($pemanfaatan as $p)
                                <option value="{{ $p->id }}" @selected(old('pemanfaatan_id') == $p->id)>{{ $p->nama }} — {{ $p->deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="label" for="keterangan">Keterangan</label>
                        <textarea class="input" id="keterangan" name="keterangan" rows="3" placeholder="Tambahan penjelasan lain (opsional)">{{ old('keterangan') }}</textarea>
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
                    <li class="flex gap-2"><x-icon name="check" class="h-4 w-4 shrink-0 text-emerald-500" /> Peminjam dipilih dari pengguna terdaftar.</li>
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
                            @foreach ($barang->where('unit_id', $selectedUnit)->take(6) as $b)
                                <tr>
                                    <td class="font-medium">{{ $b->nama }}</td>
                                    <td class="text-xs">{{ $b->spesifikasi }}</td>
                                    <td class="text-right font-semibold">{{ $b->stok }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
