<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SabaJayaPress') }} - @yield('title', 'Penerbit Terpercaya')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/60 border-b">
        <div class="container mx-auto flex h-16 items-center justify-between px-4">
            <!-- Logo -->
            <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                <div class="h-8 w-8 rounded bg-orange-500 flex items-center justify-center">
                    <i data-lucide="book-open" class="h-5 w-5 text-white"></i>
                </div>
                <div>
                    <span class="font-bold text-xl">SabaJayaPress</span>
                    <p class="text-xs text-gray-600">Penerbit Terpercaya</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('welcome') }}" class="text-sm font-medium transition-colors hover:text-orange-500 {{ request()->routeIs('welcome') ? 'text-orange-500' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('books.index') }}" class="text-sm font-medium transition-colors hover:text-orange-500 {{ request()->routeIs('books.*') ? 'text-orange-500' : '' }}">
                    Katalog
                </a>
                <a href="{{ route('about') }}" class="text-sm font-medium transition-colors hover:text-orange-500 {{ request()->routeIs('about') ? 'text-orange-500' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('contact') }}" class="text-sm font-medium transition-colors hover:text-orange-500 {{ request()->routeIs('contact') ? 'text-orange-500' : '' }}">
                    Kontak
                </a>
            </nav>

            <!-- Desktop Actions -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Search Button -->

                <!-- Cart Button -->
                <div class="relative">
                    <a href="{{ route('cart.index') }}" class="p-2 text-gray-600 hover:text-orange-500 transition-colors relative">
                        <i data-lucide="shopping-cart" class="h-5 w-5"></i>
                        <!-- Cart Badge -->
                        <span id="cart-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium hidden">
                            0
                        </span>
                    </a>
                </div>

                @auth
                    <!-- User Dropdown -->
                    <div class="relative inline-block text-left">
                        <div>
                            <button type="button" id="dropdownButton" onclick="toggleDropdown()" class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-colors duration-200">
                                <i data-lucide="user" class="h-4 w-4 mr-2"></i>
                                {{ Auth::user()->name }}
                                <i data-lucide="chevron-down" class="ml-2 h-4 w-4"></i>
                            </button>
                        </div>

                        <div id="dropdownMenu" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-50">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
                                <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i data-lucide="user" class="h-4 w-4 mr-3"></i>
                                    Profil Saya
                                </a>
                                <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    <i data-lucide="shopping-bag" class="h-4 w-4 mr-3"></i>
                                    Riwayat Pembelian
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50" role="menuitem">
                                    <i data-lucide="log-out" class="h-4 w-4 mr-3"></i>
                                    Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-orange-500">Login</a>
                    <a href="{{ route('register') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-orange-600">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center space-x-2">
                <!-- Mobile Cart Button -->
                <div class="relative">
                    <a href="{{ route('cart.index') }}" class="p-2 text-gray-600 hover:text-orange-500 transition-colors relative">
                        <i data-lucide="shopping-cart" class="h-5 w-5"></i>
                        <span id="cart-badge-mobile" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium hidden">
                            0
                        </span>
                    </a>
                </div>
                
                <button class="p-2" id="mobile-menu-button">
                    <i data-lucide="menu" class="h-5 w-5"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-4 py-2 space-y-2 bg-white border-t">
                <a href="{{ route('welcome') }}" class="block py-2 text-sm font-medium">Beranda</a>
                <a href="{{ route('books.index') }}" class="block py-2 text-sm font-medium">Katalog</a>
                <a href="{{ route('about') }}" class="block py-2 text-sm font-medium">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="block py-2 text-sm font-medium">Kontak</a>
                
                <!-- Mobile Cart Link -->
                <a href="{{ route('cart.index') }}" class="flex items-center py-2 text-sm font-medium">
                    <i data-lucide="shopping-cart" class="h-4 w-4 mr-2"></i>
                    Keranjang Belanja
                    <span id="cart-count-mobile" class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1 hidden">0</span>
                </a>
                
                @auth
                    <div class="border-t pt-2">
                        <span class="block py-2 text-sm font-medium">{{ Auth::user()->name }}</span>
                        <a href="{{ route('profile.show') }}" class="block py-2 text-sm font-medium text-gray-600">Profil</a>
                        <a href="{{ route('transactions.index') }}" class="block py-2 text-sm font-medium text-gray-600">Riwayat Pembelian</a>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                        class="block py-2 text-sm font-medium text-red-600">
                            Logout
                        </a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                @else
                    <div class="border-t pt-2 space-y-2">
                        <a href="{{ route('login') }}" class="block py-2 text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="block py-2 text-sm font-medium bg-orange-500 text-white rounded px-3">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="successAlert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 mt-4 transition-opacity duration-300" role="alert">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 hover:text-green-900 transition duration-150" onclick="closeAlert('successAlert')">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div id="errorAlert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4 transition-opacity duration-300" role="alert">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 hover:text-red-900 transition duration-150" onclick="closeAlert('errorAlert')">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
    @endif

    @if(session('warning'))
        <div id="warningAlert" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mx-4 mt-4 transition-opacity duration-300" role="alert">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                <span class="block sm:inline">{{ session('warning') }}</span>
            </div>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 hover:text-yellow-900 transition duration-150" onclick="closeAlert('warningAlert')">
                <svg class="fill-current h-6 w-6 text-yellow-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="h-8 w-8 rounded bg-orange-500 flex items-center justify-center">
                            <i data-lucide="book-open" class="h-5 w-5 text-white"></i>
                        </div>
                        <span class="font-bold text-xl">SabaJayaPress</span>
                    </div>
                    <p class="text-gray-400">
                        Platform terpercaya untuk buku digital dan fisik berkualitas tinggi di Indonesia.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Navigasi</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('welcome') }}" class="hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('books.index') }}" class="hover:text-white">Katalog</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Kategori</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Novel</a></li>
                        <li><a href="#" class="hover:text-white">Non-Fiksi</a></li>
                        <li><a href="#" class="hover:text-white">Pendidikan</a></li>
                        <li><a href="#" class="hover:text-white">Anak-anak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@sabajayapress.com</li>
                        <li>Telepon: (021) 1234-5678</li>
                        <li>WhatsApp: +62 812-3456-7890</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} SabaJayaPress. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // User dropdown toggle
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('hidden');
        }

        // Search toggle
        function toggleSearch() {
            const searchBar = document.getElementById('search-bar');
            searchBar.classList.toggle('hidden');
            if (!searchBar.classList.contains('hidden')) {
                searchBar.querySelector('input').focus();
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdownButton');
            const menu = document.getElementById('dropdownMenu');
            
            if (dropdown && menu && !dropdown.parentElement.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        // Close alert function
        function closeAlert(alertId) {
            const alert = document.getElementById(alertId);
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }

        // Auto close alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[id$="Alert"]');
            alerts.forEach(alert => {
                if (alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }
            });
        }, 5000);

        // Cart functionality
        function updateCartBadge(count) {
            const badges = ['cart-badge', 'cart-badge-mobile'];
            const mobileCounts = ['cart-count-mobile'];
            
            badges.forEach(badgeId => {
                const badge = document.getElementById(badgeId);
                if (badge) {
                    if (count > 0) {
                        badge.textContent = count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            });

            mobileCounts.forEach(countId => {
                const countEl = document.getElementById(countId);
                if (countEl) {
                    if (count > 0) {
                        countEl.textContent = count;
                        countEl.classList.remove('hidden');
                    } else {
                        countEl.classList.add('hidden');
                    }
                }
            });
        }

        // Load cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            // You can fetch cart count from server or localStorage
            const cartCount = localStorage.getItem('cartCount') || 0;
            updateCartBadge(parseInt(cartCount));
        });
    </script>

    @stack('scripts')
</body>
</html>
