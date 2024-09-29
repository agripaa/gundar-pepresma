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
                <ul class="space-y-4">
                    <div class="group">
                        <a href="javascript:void(0)" class="block px-4 py-2 {{ Route::is('list-*') ? 'text-purple-600 bg-purple-100' : 'text-gray-700 hover:text-purple-600 hover:bg-purple-100' }} rounded-lg font-semibold">
                            List Data
                        </a>
                        <ul class="ml-4 mt-2 space-y-2 hidden group-hover:block">
                            <li>
                                <a href="{{ route('list-prestasi') }}" class="block px-4 py-2 {{ Route::is('list-prestasi') ? 'text-purple-600 bg-purple-100 border-l-4 border-purple-600' : 'text-gray-700 hover:bg-purple-100 hover:text-purple-600' }} rounded-lg">List Prestasi</a>
                            </li>
                            @if (Auth::user()->role == 1)
                            <li>
                                <a href="{{ route('list-admin') }}" class="block px-4 py-2 {{ Route::is('list-admin') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">List Admin</a>
                            </li>
                            <li>
                                <a href="{{ route('list-master-data') }}" class="block px-4 py-2 {{ Route::is('list-master-data') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">List Master Data</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <li>
                        <div class="group">
                            <a href="javascript:void(0)" class="block px-4 py-2 {{ Route::is('tambah-*') ? 'text-purple-600 bg-purple-100' : 'text-gray-700 hover:text-purple-600 hover:bg-purple-100' }} rounded-lg font-semibold">
                                Tambah Data
                            </a>
                            <ul class="ml-4 mt-2 space-y-2 hidden group-hover:block">
                                <li>
                                    <a href="{{ route('tambah-mahasiswa') }}" class="block px-4 py-2 {{ Route::is('tambah-mahasiswa') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">Mahasiswa</a>
                                </li>
                                <li>
                                    <a href="{{ route('tambah-dospem') }}" class="block px-4 py-2 {{ Route::is('tambah-dospem') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">Dosen Pendamping</a>
                                </li>
                                <li>
                                    <a href="{{ route('tambah-prestasi') }}" class="block px-4 py-2 {{ Route::is('tambah-prestasi') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">Prestasi</a>
                                </li>
                                @if (Auth::user()->role == 1)
                                <li>
                                    <a href="{{ route('tambah-fakultas') }}" class="block px-4 py-2 {{ Route::is('tambah-fakultas') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">Fakultas</a>
                                </li>
                                <li>
                                    <a href="{{ route('tambah-prodi') }}" class="block px-4 py-2 {{ Route::is('tambah-prodi') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">Program Studi</a>
                                </li>
                                <li>
                                    <a href="{{ route('tambah-master-data') }}" class="block px-4 py-2 {{ Route::is('tambah-master-data') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">Master Data</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
        
                    <li>
                        <a href="{{ route('laporan') }}" class="block px-4 py-2 {{ Route::is('laporan') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">Laporan</a>
                    </li>
                    @if (Auth::user()->role == 1)
                        <li>
                            <a href="{{ route('manage-visitor') }}" class="block px-4 py-2 {{ Route::is('manage-visitor') ? 'text-purple-600 bg-purple-200 border-l-4 border-purple-600' : 'text-black hover:text-purple-600 hover:bg-purple-200' }} rounded-lg">Manage Visitor</a>
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
    @yield('scripts')

</body>
</html>
