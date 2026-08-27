@php
    $unitList = \App\Support\DataProvider::units();
    $selectedUnit = session('selected_unit', $unitList[0]['id'] ?? null);
@endphp

<header class="sticky top-0 z-20 border-b border-brand-100 bg-white/90 backdrop-blur">
    <div class="flex items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <button type="button" class="lg:hidden btn-ghost !px-3" data-sidebar-toggle>
                <x-icon name="menu" class="h-5 w-5" />
            </button>
            <div>
                <h1 class="text-sm font-bold text-brand-800 sm:text-base">@yield('page-title', 'Dashboard')</h1>
                <p class="hidden text-xs text-[#475569] sm:block">@yield('page-subtitle', 'Selamat datang di LIMS Lite')</p>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3">
            {{-- Pilih Unit --}}
            <form method="POST" action="{{ route('unit.select') }}" class="hidden sm:block">
                @csrf
                <label class="sr-only" for="unit">Pilih Unit</label>
                <select id="unit" name="unit_id" onchange="this.form.submit()"
                    class="input !w-56 !py-2 !text-xs">
                    @foreach ($unitList as $u)
                        <option value="{{ $u['id'] }}" @selected($selectedUnit == $u['id'])>{{ $u['nama'] }}</option>
                    @endforeach
                </select>
            </form>

            {{-- Profil --}}
            <div class="flex items-center gap-2.5 rounded-xl border border-brand-100 bg-white px-2 py-1.5">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-600 text-sm font-bold text-white">
                    {{ strtoupper(substr(session('user_name', 'AD'), 0, 2)) }}
                </div>
                <div class="hidden leading-tight sm:block">
                    <div class="text-xs font-bold text-brand-800">{{ session('user_name', 'Administrator Sistem') }}</div>
                    <div class="text-[11px] text-[#475569]">{{ session('user_role', 'Super Admin') }}</div>
                </div>
            </div>

            <a href="{{ route('logout') }}" class="btn-ghost !px-3" title="Keluar">
                <x-icon name="logout" class="h-5 w-5" />
            </a>
        </div>
    </div>
</header>
