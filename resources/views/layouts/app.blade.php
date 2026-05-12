<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Asset System')</title>

    <!-- DataTable -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body{
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-gray-100 text-gray-800">

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white shadow-2xl hidden lg:flex flex-col">

        <!-- Logo -->
        <div class="h-20 flex items-center px-6 border-b border-white/10">

            <div class="w-11 h-11 rounded-xl bg-blue-500 flex items-center justify-center font-bold text-lg shadow-lg">
                A
            </div>

            <div class="ml-3">
                <h1 class="text-lg font-bold tracking-wide">
                    Asset System
                </h1>

                <p class="text-xs text-gray-400">
                    Management Dashboard
                </p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-7">

            <!-- Main -->
            <div>

                <p class="text-xs uppercase tracking-widest text-gray-500 mb-3 px-3">
                    Main
                </p>

                <a href="/dashboard"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition
                   {{ request()->is('dashboard')
                        ? 'bg-blue-500/20 text-blue-300 border border-blue-500/20'
                        : 'text-gray-300 hover:bg-white/10' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="size-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 10l9-7 9 7v11a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1V10z"/>
                    </svg>

                    Dashboard
                </a>
            </div>

            <!-- Management -->
            <div>

                <p class="text-xs uppercase tracking-widest text-gray-500 mb-3 px-3">
                    Management
                </p>

                <div class="space-y-2">

                    <!-- Users -->
                    @if(auth()->user()?->role?->permission?->contains('name','manage-users'))

                    <details class="group bg-white/5 rounded-2xl overflow-hidden">

                        <summary class="flex items-center justify-between px-4 py-3 cursor-pointer hover:bg-white/10 transition">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-blue-500/20 flex items-center justify-center">
                                    👤
                                </div>

                                <span class="font-medium">
                                    Users Management
                                </span>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="size-4 transition group-open:rotate-180"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>

                        <div class="px-4 pb-4 space-y-2">

                            <a href="/users"
                                class="block px-4 py-2 rounded-xl text-sm hover:bg-white/10 transition {{ request()->is('users') ? 'bg-white/10' : '' }}">
                                    All Users
                                </a>

                                <a href="/users/create"
                                class="block px-4 py-2 rounded-xl text-sm hover:bg-white/10 transition {{ request()->is('users/create') ? 'bg-white/10' : '' }}">
                                    Create User
                            </a>

                        </div>
                    </details>

                    @endif


                    <!-- Manage Asset -->
                    @if(auth()->user()?->role?->permission?->contains('name','view-assets'))

                    <details class="group bg-white/5 rounded-2xl overflow-hidden">

                        <summary class="flex items-center justify-between px-4 py-3 cursor-pointer hover:bg-white/10 transition">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-purple-500/20 flex items-center justify-center">
                                    ⚙️
                                </div>

                                <span class="font-medium">
                                    Asset Management
                                </span>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="size-4 transition group-open:rotate-180"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>

                        <div class="px-4 pb-4 space-y-2">

                            <a href="/assets"
                                class="block px-4 py-2 rounded-xl text-sm hover:bg-white/10 transition {{ request()->is('categories') ? 'bg-white/10 font-bold' : '' }}">
                                Manage Asset
                            </a>

                            <a href="/assets/create"
                                class="block px-4 py-2 rounded-xl text-sm hover:bg-white/10 transition {{ request()->is('categories/create') ? 'bg-white/10 font-bold' : '' }}">
                                Create Asset
                            </a>

                        </div>
                    </details>

                    @endif

            
                    <!-- Manage Category -->
                    @if(auth()->user()?->role?->permission?->contains('name','manage-categories'))

                    <details class="group bg-white/5 rounded-2xl overflow-hidden">

                        <summary class="flex items-center justify-between px-4 py-3 cursor-pointer hover:bg-white/10 transition">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-purple-500/20 flex items-center justify-center">
                                    ⚙️
                                </div>

                                <span class="font-medium">
                                    Category Management
                                </span>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="size-4 transition group-open:rotate-180"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>

                        <div class="px-4 pb-4 space-y-2">

                            <a href="/categories"
                                class="block px-4 py-2 rounded-xl text-sm hover:bg-white/10 transition {{ request()->is('categories') ? 'bg-white/10 font-bold' : '' }}">
                                Manage Category
                            </a>

                            <a href="/categories/create"
                                class="block px-4 py-2 rounded-xl text-sm hover:bg-white/10 transition {{ request()->is('categories/create') ? 'bg-white/10 font-bold' : '' }}">
                                Create Category
                            </a>

                        </div>
                    </details>

                    @endif

                    <!-- Roles -->
                    @if(auth()->user()?->role?->permission?->contains('name','manage-roles'))

                    <details class="group bg-white/5 rounded-2xl overflow-hidden">

                        <summary class="flex items-center justify-between px-4 py-3 cursor-pointer hover:bg-white/10 transition">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-purple-500/20 flex items-center justify-center">
                                    ⚙️
                                </div>

                                <span class="font-medium">
                                    Role Management
                                </span>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="size-4 transition group-open:rotate-180"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>

                        <div class="px-4 pb-4 space-y-2">

                            <a href="/roles"
                               class="block px-4 py-2 rounded-xl text-sm hover:bg-white/10 transition">
                                Manage Roles
                            </a>

                            <a href="/roles/create"
                               class="block px-4 py-2 rounded-xl text-sm hover:bg-white/10 transition">
                                Create Role
                            </a>

                        </div>
                    </details>

                    @endif

                </div>
            </div>
        </nav>

        <!-- User -->
        <div class="border-t border-white/10 p-4">

            <div class="flex items-center gap-3">

                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}"
                     class="w-11 h-11 rounded-full border-2 border-white/20">

                <div>
                    <h3 class="font-semibold text-sm">
                        {{ auth()->user()->role->name ?? 'Guest' }}
                    </h3>

                    <p class="text-xs text-gray-400">
                        {{ auth()->user()->name ?? 'Guest' }}
                    </p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Topbar -->
        <header class="h-20 bg-white border-b border-gray-200 px-8 flex items-center justify-between shadow-sm">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">
                    @yield('page-title', 'Dashboard')
                </h2>

                <p class="text-sm text-gray-500">
                    @yield('subtitle', 'Welcome back 👋')
                </p>
            </div>

            <div class="flex items-center gap-4">

                <form action="/logout" method="POST">
                    @csrf

                    <button type="submit"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl text-sm font-medium transition">
                        Logout
                    </button>
                </form>

            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-8 bg-gray-100">

            <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-8 min-h-[500px]">

                @yield('content')

            </div>

        </main>
    </div>
</div>

</body>
</html>