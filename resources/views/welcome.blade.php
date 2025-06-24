@extends('layouts.app')

@section('content')
<!-- Enhanced Hero Section with Dynamic Stats -->
<div class="relative bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-blue-600 mix-blend-multiply"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Toko Buku Digital Terpercaya
            </h1>
            <p class="mt-6 max-w-3xl mx-auto text-xl text-blue-100">
                Temukan ribuan buku digital berkualitas dengan harga terjangkau. Baca kapan saja, di mana saja dengan koleksi buku terlengkap.
            </p>
            
            <!-- Dynamic Stats -->
            <div class="mt-10 grid grid-cols-2 gap-8 sm:grid-cols-3 max-w-lg mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">{{ number_format($totalBooks) }}+</div>
                    <div class="text-sm text-blue-200">Buku Digital</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">{{ number_format($totalAuthors) }}+</div>
                    <div class="text-sm text-blue-200">Penulis</div>
                </div>
                <div class="text-center col-span-2 sm:col-span-1">
                    <div class="text-3xl font-bold text-white">24/7</div>
                    <div class="text-sm text-blue-200">Support</div>
                </div>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 hover:shadow-lg transform hover:-translate-y-1 transition duration-300 ease-in-out">
                    Jelajahi Katalog
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-400 hover:shadow-lg transform hover:-translate-y-1 transition duration-300 ease-in-out">
                        Daftar Gratis
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Buku Terbaru Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Buku Terbaru
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                Koleksi terbaru yang baru saja ditambahkan ke perpustakaan digital kami
            </p>
        </div>

        @if($latestBooks->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                @foreach($latestBooks as $book)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-2">
                        <div class="aspect-w-3 aspect-h-4">
                            @if($book->cover_image)
                                <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-medium text-gray-900 truncate" title="{{ $book->title }}">{{ $book->title }}</h3>
                            <p class="text-xs text-gray-500 truncate">{{ $book->author }}</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                <span class="text-xs text-green-600">Stok: {{ $book->stock }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">Belum ada buku terbaru tersedia.</p>
            </div>
        @endif

        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-blue-50 hover:bg-blue-100 transition duration-150 ease-in-out">
                Lihat Semua Buku
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Buku Terlaris Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Buku Terlaris
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                Buku-buku favorit yang paling banyak dibeli oleh pembaca
            </p>
        </div>

        @if($bestSellerBooks->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                @foreach($bestSellerBooks as $index => $book)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-2 relative">
                        <!-- Badge Ranking -->
                        <div class="absolute top-2 left-2 z-10">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                @if($index < 3) bg-yellow-100 text-yellow-800 @else bg-blue-100 text-blue-800 @endif">
                                #{{ $index + 1 }}
                            </span>
                        </div>
                        
                        <div class="aspect-w-3 aspect-h-4">
                            @if($book->cover_image)
                                <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-medium text-gray-900 truncate" title="{{ $book->title }}">{{ $book->title }}</h3>
                            <p class="text-xs text-gray-500 truncate">{{ $book->author }}</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                <span class="text-xs text-orange-600">🔥 Laris</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">Belum ada data buku terlaris.</p>
            </div>
        @endif
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-gray-50">
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
                <div class="text-center group hover:bg-white hover:shadow-lg rounded-lg p-6 transition duration-300">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto group-hover:bg-blue-600 transition duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Koleksi Lengkap</h3>
                    <p class="mt-2 text-base text-gray-500">
                        {{ number_format($totalBooks) }}+ buku digital dari berbagai genre dan penulis terkenal
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center group hover:bg-white hover:shadow-lg rounded-lg p-6 transition duration-300">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto group-hover:bg-blue-600 transition duration-300">
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
                <div class="text-center group hover:bg-white hover:shadow-lg rounded-lg p-6 transition duration-300">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto group-hover:bg-blue-600 transition duration-300">
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
                <div class="text-center group hover:bg-white hover:shadow-lg rounded-lg p-6 transition duration-300">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto group-hover:bg-blue-600 transition duration-300">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Harga Terjangkau</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Dapatkan buku berkualitas mulai dari Rp 5.000 saja
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="text-center group hover:bg-white hover:shadow-lg rounded-lg p-6 transition duration-300">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto group-hover:bg-blue-600 transition duration-300">
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
                <div class="text-center group hover:bg-white hover:shadow-lg rounded-lg p-6 transition duration-300">
                    <div class="flex items-center justify-center h-16 w-16 rounded-md bg-blue-500 text-white mx-auto group-hover:bg-blue-600 transition duration-300">
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
<div class="bg-white py-16">
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
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 text-center hover:shadow-md hover:from-blue-100 hover:to-blue-200 transition duration-300 ease-in-out cursor-pointer transform hover:-translate-y-1">
                <div class="text-3xl mb-2">📚</div>
                <h3 class="text-sm font-medium text-gray-900">Pendidikan</h3>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 text-center hover:shadow-md hover:from-green-100 hover:to-green-200 transition duration-300 ease-in-out cursor-pointer transform hover:-translate-y-1">
                <div class="text-3xl mb-2">💼</div>
                <h3 class="text-sm font-medium text-gray-900">Bisnis</h3>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6 text-center hover:shadow-md hover:from-purple-100 hover:to-purple-200 transition duration-300 ease-in-out cursor-pointer transform hover:-translate-y-1">
                <div class="text-3xl mb-2">🔬</div>
                <h3 class="text-sm font-medium text-gray-900">Sains</h3>
            </div>
            <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-lg p-6 text-center hover:shadow-md hover:from-pink-100 hover:to-pink-200 transition duration-300 ease-in-out cursor-pointer transform hover:-translate-y-1">
                <div class="text-3xl mb-2">📖</div>
                <h3 class="text-sm font-medium text-gray-900">Novel</h3>
            </div>
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-6 text-center hover:shadow-md hover:from-yellow-100 hover:to-yellow-200 transition duration-300 ease-in-out cursor-pointer transform hover:-translate-y-1">
                <div class="text-3xl mb-2">🎨</div>
                <h3 class="text-sm font-medium text-gray-900">Seni</h3>
            </div>
            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-lg p-6 text-center hover:shadow-md hover:from-indigo-100 hover:to-indigo-200 transition duration-300 ease-in-out cursor-pointer transform hover:-translate-y-1">
                <div class="text-3xl mb-2">💻</div>
                <h3 class="text-sm font-medium text-gray-900">Teknologi</h3>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
            <span class="block">Siap untuk mulai membaca?</span>
            <span class="block text-blue-200">Bergabunglah dengan ribuan pembaca lainnya.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 hover:shadow-lg transform hover:-translate-y-1 transition duration-300 ease-in-out">
                    Mulai Berbelanja
                </a>
            </div>
            @guest
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-400 hover:shadow-lg transform hover:-translate-y-1 transition duration-300 ease-in-out">
                        Daftar Sekarang
                    </a>
                </div>
            @endguest
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Apa Kata Mereka?
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                Testimoni dari para pembaca setia BookStore
            </p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                            <span class="text-white font-medium">AS</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">Ahmad Santoso</div>
                        <div class="text-sm text-gray-500">Mahasiswa</div>
                    </div>
                </div>
                <p class="text-gray-600 italic">"Koleksi bukunya sangat lengkap dan harganya terjangkau untuk mahasiswa seperti saya. Download cepat dan kualitas PDF-nya bagus!"</p>
                <div class="mt-4 flex text-yellow-400">
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-pink-500 flex items-center justify-center">
                            <span class="text-white font-medium">SR</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">Sari Rahayu</div>
                        <div class="text-sm text-gray-500">Guru</div>
                    </div>
                </div>
                <p class="text-gray-600 italic">"Sebagai guru, saya sangat terbantu dengan koleksi buku pendidikan di sini. Bisa langsung download dan digunakan untuk mengajar."</p>
                <div class="mt-4 flex text-yellow-400">
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center">
                            <span class="text-white font-medium">BP</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">Budi Pratama</div>
                        <div class="text-sm text-gray-500">Pengusaha</div>
                    </div>
                </div>
                <p class="text-gray-600 italic">"BookStore membantu saya mengembangkan bisnis dengan koleksi buku bisnis dan manajemen yang sangat berkualitas. Highly recommended!"</p>
                <div class="mt-4 flex text-yellow-400">
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection