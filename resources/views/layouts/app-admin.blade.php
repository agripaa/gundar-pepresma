<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gunadarma Prestasi')</title>
    <link rel="icon" href="{{ asset('images/logo-gundar.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-md fixed w-full z-40 top-0">
        <div class="px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Gunadarma Logo" class="h-12">
            </div>
    
            <!-- User Info and Logout Button -->
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10">
                    @if (Auth::user() && Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile Image" class="w-full h-full rounded-full object-cover">
                    @else
                        <!-- Default profile icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    @endif
                </div>
                <div class="text-gray-700">
                    <p class="text-sm font-semibold">{{ Auth::user()->username ?? 'Username' }}</p>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email ?? 'example@gmail.com' }}</p>
                </div>
    
                <!-- Logout Button -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex flex-col text-center border border-red-600 hover:border-red-700 hover:text-white hover:bg-red-600 transition-all duration-100 justify-center items-center space-x-2 text-red-600 px-2 py-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" viewBox="0 0 24 24" fill="currentColor"><path d="M4 18H6V20H18V4H6V6H4V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V18ZM6 11H13V13H6V16L1 12L6 8V11Z"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    

    <!-- Main content wrapper -->
    <div class="flex">
        <!-- Sidebar (fixed) -->
        <aside class="w-64 bg-white h-screen shadow-lg fixed z-30 top-16 left-0 pt-6 flex flex-col justify-between">
            <div class="px-4">
                @php
                    $isPrestasiOpen = Route::is('list-prestasi') || Route::is('tambah-prestasi') || Route::is('laporan') || Route::is('prestasi.*');
                    $isKampusOpen = Route::is('mahasiswa.*') || Route::is('dospem.*') || Route::is('fakultas.*') || Route::is('prodi.*');
                    $isMasterOpen = Route::is('list-master-data') || Route::is('master-data.*');
                    $isPengaturanOpen = Route::is('list-admin') || Route::is('manage-visitor');
                @endphp
                <ul class="space-y-4">
                    <li>
                        <button
                            type="button"
                            data-collapse-toggle="sidebar-prestasi"
                            aria-expanded="{{ $isPrestasiOpen ? 'true' : 'false' }}"
                            class="w-full flex items-center justify-between px-4 py-2 {{ $isPrestasiOpen ? 'text-purple-600 bg-purple-100' : 'text-gray-700 hover:text-purple-600 hover:bg-purple-100' }} rounded-lg font-semibold"
                        >
                            <span>Data Prestasi</span>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ $isPrestasiOpen ? 'rotate-180' : '' }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul id="sidebar-prestasi" class="ml-4 space-y-2 overflow-hidden transition-all duration-300 ease-in-out {{ $isPrestasiOpen ? 'mt-2 max-h-[520px] opacity-100 pointer-events-auto' : 'mt-0 max-h-0 opacity-0 pointer-events-none' }}">
                            <li>
                                <a href="{{ route('list-prestasi') }}" class="block px-4 py-2 {{ Route::is('list-prestasi') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">List Prestasi</a>
                            </li>
                            <li>
                                <a href="{{ route('tambah-prestasi') }}" class="block px-4 py-2 {{ Route::is('tambah-prestasi') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Tambah Prestasi</a>
                            </li>
                            <li>
                                <a href="{{ route('laporan') }}" class="block px-4 py-2 {{ Route::is('laporan') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Laporan</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <button
                            type="button"
                            data-collapse-toggle="sidebar-kampus"
                            aria-expanded="{{ $isKampusOpen ? 'true' : 'false' }}"
                            class="w-full flex items-center justify-between px-4 py-2 {{ $isKampusOpen ? 'text-purple-600 bg-purple-100' : 'text-gray-700 hover:text-purple-600 hover:bg-purple-100' }} rounded-lg font-semibold"
                        >
                            <span>Data Kampus</span>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ $isKampusOpen ? 'rotate-180' : '' }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul id="sidebar-kampus" class="ml-4 space-y-2 overflow-hidden transition-all duration-300 ease-in-out {{ $isKampusOpen ? 'mt-2 max-h-[520px] opacity-100 pointer-events-auto' : 'mt-0 max-h-0 opacity-0 pointer-events-none' }}">
                            <li>
                                <a href="{{ route('mahasiswa.index') }}" class="block px-4 py-2 {{ Route::is('mahasiswa.*') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Mahasiswa</a>
                            </li>
                            <li>
                                <a href="{{ route('dospem.index') }}" class="block px-4 py-2 {{ Route::is('dospem.*') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Dosen Pendamping</a>
                            </li>
                            @if (Auth::user()->role == 1)
                            <li>
                                <a href="{{ route('fakultas.index') }}" class="block px-4 py-2 {{ Route::is('fakultas.*') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Fakultas</a>
                            </li>
                            <li>
                                <a href="{{ route('prodi.index') }}" class="block px-4 py-2 {{ Route::is('prodi.*') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Program Studi</a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    @if (Auth::user()->role == 1)
                    <li>
                        <button
                            type="button"
                            data-collapse-toggle="sidebar-master"
                            aria-expanded="{{ $isMasterOpen ? 'true' : 'false' }}"
                            class="w-full flex items-center justify-between px-4 py-2 {{ $isMasterOpen ? 'text-purple-600 bg-purple-100' : 'text-gray-700 hover:text-purple-600 hover:bg-purple-100' }} rounded-lg font-semibold"
                        >
                            <span>Master Data</span>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ $isMasterOpen ? 'rotate-180' : '' }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul id="sidebar-master" class="ml-4 space-y-2 overflow-hidden transition-all duration-300 ease-in-out {{ $isMasterOpen ? 'mt-2 max-h-[520px] opacity-100 pointer-events-auto' : 'mt-0 max-h-0 opacity-0 pointer-events-none' }}">
                            <li>
                                <a href="{{ route('list-master-data') }}" class="block px-4 py-2 {{ Route::is('list-master-data') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Overview</a>
                            </li>
                            <li>
                                <a href="{{ route('master-data.kepesertaan') }}" class="block px-4 py-2 {{ Route::is('master-data.kepesertaan') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Kepesertaan</a>
                            </li>
                            <li>
                                <a href="{{ route('master-data.kategori') }}" class="block px-4 py-2 {{ Route::is('master-data.kategori') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Kategori Lomba</a>
                            </li>
                            <li>
                                <a href="{{ route('master-data.prestasi') }}" class="block px-4 py-2 {{ Route::is('master-data.prestasi') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Prestasi</a>
                            </li>
                            <li>
                                <a href="{{ route('master-data.capaian-juara') }}" class="block px-4 py-2 {{ Route::is('master-data.capaian-juara') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Capaian Juara</a>
                            </li>
                            <li>
                                <a href="{{ route('master-data.posisi') }}" class="block px-4 py-2 {{ Route::is('master-data.posisi') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Posisi Peserta</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if (Auth::user()->role == 1)
                    <li>
                        <button
                            type="button"
                            data-collapse-toggle="sidebar-pengaturan"
                            aria-expanded="{{ $isPengaturanOpen ? 'true' : 'false' }}"
                            class="w-full flex items-center justify-between px-4 py-2 {{ $isPengaturanOpen ? 'text-purple-600 bg-purple-100' : 'text-gray-700 hover:text-purple-600 hover:bg-purple-100' }} rounded-lg font-semibold"
                        >
                            <span>Pengaturan</span>
                            <svg class="w-4 h-4 transition-transform duration-200 {{ $isPengaturanOpen ? 'rotate-180' : '' }}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul id="sidebar-pengaturan" class="ml-4 space-y-2 overflow-hidden transition-all duration-300 ease-in-out {{ $isPengaturanOpen ? 'mt-2 max-h-[520px] opacity-100 pointer-events-auto' : 'mt-0 max-h-0 opacity-0 pointer-events-none' }}">
                            <li>
                                <a href="{{ route('list-admin') }}" class="block px-4 py-2 {{ Route::is('list-admin') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">List Admin</a>
                            </li>
                            <li>
                                <a href="{{ route('manage-visitor') }}" class="block px-4 py-2 {{ Route::is('manage-visitor') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">Manage Visitor</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="px-4 py-4 mt-auto">
                <p class="text-gray-800 text-sm">Version 1.0.0</p>
            </div>
        </aside>        

        <!-- Main Content Section -->
        <main class="flex-1 p-6 bg-gray-100 ml-64 mt-16">
            @yield('content')
        </main>
    </div>
    <script>
        const collapseButtons = Array.from(document.querySelectorAll('[data-collapse-toggle]'));

        function setExpanded(button, expanded) {
            const targetId = button.getAttribute('data-collapse-toggle');
            const target = document.getElementById(targetId);
            if (!target) return;

            target.classList.toggle('max-h-0', !expanded);
            target.classList.toggle('opacity-0', !expanded);
            target.classList.toggle('pointer-events-none', !expanded);
            target.classList.toggle('mt-0', !expanded);

            target.classList.toggle('max-h-[520px]', expanded);
            target.classList.toggle('opacity-100', expanded);
            target.classList.toggle('pointer-events-auto', expanded);
            target.classList.toggle('mt-2', expanded);
            button.setAttribute('aria-expanded', expanded ? 'true' : 'false');

            const icon = button.querySelector('svg');
            if (icon) {
                icon.classList.toggle('rotate-180', expanded);
            }
        }

        collapseButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const isExpanded = button.getAttribute('aria-expanded') === 'true';

                if (isExpanded) {
                    setExpanded(button, false);
                    return;
                }

                collapseButtons.forEach((other) => {
                    if (other !== button) {
                        setExpanded(other, false);
                    }
                });
                setExpanded(button, true);
            });
        });
    </script>
    @yield('scripts')

</body>
</html>
