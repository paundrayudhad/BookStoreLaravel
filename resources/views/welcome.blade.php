@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-600 to-blue-800 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-blue-600 mix-blend-multiply"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            Toko Buku Digital Terpercaya
        </h1>
        <p class="mt-6 max-w-3xl text-xl text-blue-100">
            Temukan ribuan buku digital berkualitas dengan harga terjangkau. Baca kapan saja, di mana saja dengan koleksi buku terlengkap.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 transition duration-150 ease-in-out">
                Jelajahi Katalog
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
            @guest
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-400 transition duration-150 ease-in-out">
                    Daftar Gratis
                </a>
            @endguest
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Mengapa Memilih BookStore?
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                Kami menyediakan pengalaman berbelanja buku digital terbaik untuk Anda
            </p>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Koleksi Lengkap</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Ribuan buku digital dari berbagai genre dan penulis terkenal
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Aman & Terpercaya</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Transaksi aman dengan sistem pembayaran yang terpercaya
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Akses Selamanya</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Download dan baca buku Anda kapan saja tanpa batas waktu
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Harga Terjangkau</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Dapatkan buku berkualitas dengan harga yang sangat kompetitif
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Update Terbaru</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Selalu mendapatkan buku-buku terbaru dan terpopuler
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Support 24/7</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Tim customer service siap membantu Anda kapan saja
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Categories -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Kategori Populer
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                Temukan buku sesuai minat dan kebutuhan Anda
            </p>
        </div>

        <div class="mt-12 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            <div class="bg-white rounded-lg p-6 text-center hover:shadow-md transition duration-300 ease-in-out cursor-pointer">
                <div class="text-3xl mb-2">📚</div>
                <h3 class="text-sm font-medium text-gray-900">Pendidikan</h3>
            </div>
            <div class="bg-white rounded-lg p-6 text-center hover:shadow-md transition duration-300 ease-in-out cursor-pointer">
                <div class="text-3xl mb-2">💼</div>
                <h3 class="text-sm font-medium text-gray-900">Bisnis</h3>
            </div>
            <div class="bg-white rounded-lg p-6 text-center hover:shadow-md transition duration-300 ease-in-out cursor-pointer">
                <div class="text-3xl mb-2">🔬</div>
                <h3 class="text-sm font-medium text-gray-900">Sains</h3>
            </div>
            <div class="bg-white rounded-lg p-6 text-center hover:shadow-md transition duration-300 ease-in-out cursor-pointer">
                <div class="text-3xl mb-2">📖</div>
                <h3 class="text-sm font-medium text-gray-900">Novel</h3>
            </div>
            <div class="bg-white rounded-lg p-6 text-center hover:shadow-md transition duration-300 ease-in-out cursor-pointer">
                <div class="text-3xl mb-2">🎨</div>
                <h3 class="text-sm font-medium text-gray-900">Seni</h3>
            </div>
            <div class="bg-white rounded-lg p-6 text-center hover:shadow-md transition duration-300 ease-in-out cursor-pointer">
                <div class="text-3xl mb-2">💻</div>
                <h3 class="text-sm font-medium text-gray-900">Teknologi</h3>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-blue-600">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
            <span class="block">Siap untuk mulai membaca?</span>
            <span class="block text-blue-200">Bergabunglah dengan ribuan pembaca lainnya.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition duration-150 ease-in-out">
                    Mulai Berbelanja
                </a>
            </div>
            @guest
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-400 transition duration-150 ease-in-out">
                        Daftar Sekarang
                    </a>
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection
