<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS @yield('title', '')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { primary: '#6366f1' } } }
        }
    </script>

    <!-- Alpine.js for mobile menu -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col md:flex-row">

    {{-- ==================== SIDEBAR (All Pages) ==================== --}}
    <aside x-data="{ open: false }" class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 md:static md:inset-0 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col h-full">

            <!-- Logo / Header -->
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-primary">CMS</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <x-sidebar-link href="/dashboard" icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    Dashboard
                </x-sidebar-link>

                <x-sidebar-link href="/forms" icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    Forms
                </x-sidebar-link>

                <x-sidebar-link href="/pages" icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    Pages
                </x-sidebar-link>
            </nav>

           
        </div>
    </aside>

    {{-- ==================== MOBILE OVERLAY ==================== --}}
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

    {{-- ==================== MAIN CONTENT (All Pages) ==================== --}}
    <div class="flex-1 flex flex-col">
        <!-- Mobile Header + Toggle -->
        <header class="md:hidden bg-white shadow-sm p-4 flex items-center justify-between">
            <button @click="open = !open" class="p-2 rounded hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-lg font-semibold">FormBuilder</h1>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 md:p-8 bg-gray-50">
            @yield('content')
        </main>
    </div>

</body>
</html>