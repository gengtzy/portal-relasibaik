<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('images/logoriset.png') }}" type="image/png">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-800">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
                <div class="h-16 flex items-center px-6 border-b border-gray-200">
                    <span class="text-xl font-bold text-indigo-600">Admin Portal</span>
                </div>
                
                <nav class="flex-1 overflow-y-auto py-6">
                    <ul class="space-y-3 px-4">
                        <!-- Menu Items -->
                        <li>
                            <a href="{{ route('admin.publications') }}" class="flex items-center px-4 py-3 rounded-xl font-medium transition-all {{ request()->routeIs('admin.publications') ? 'bg-indigo-50 text-indigo-700 shadow-sm border border-indigo-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border border-transparent' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.publications') ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                Publikasi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.members') }}" class="flex items-center px-4 py-3 rounded-xl font-medium transition-all {{ request()->routeIs('admin.members') ? 'bg-indigo-50 text-indigo-700 shadow-sm border border-indigo-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 border border-transparent' }}">
                                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.members') ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                Members
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Logout / User profile at bottom -->
                <div class="p-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center px-3 py-2 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Header (Top bar) -->
                <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6">
                    <div>
                        <!-- Optional breadcrumb or title -->
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</span>
                    </div>
                </header>

                <!-- Main Content -->
                <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
