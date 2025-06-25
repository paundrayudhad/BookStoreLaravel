@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="relative bg-white py-20 px-4 min-h-[80vh] flex items-center">
    <div class="container mx-auto text-center">
        <div class="max-w-4xl mx-auto space-y-8">
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                Temukan Buku <span class="text-blue-500">Digital & Fisik</span>
                <br>
                Berkualitas Tinggi
            </h1>

            <p class="text-lg lg:text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                SabaJayaPress adalah platform terpercaya untuk membeli buku digital dan fisik dengan koleksi lengkap dan
                kualitas terbaik. Dapatkan akses instan ke ribuan judul buku.
            </p>

            <div class="pt-4">
                <a href="{{ route('books.index') }}" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white text-lg px-8 py-4 rounded-lg font-medium transition-colors">
                    Jelajahi Katalog
                    <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
                </a>
            </div>

            <!-- Statistics -->
            <div class="grid md:grid-cols-3 gap-8 pt-16 max-w-4xl mx-auto">
                <div class="text-center space-y-3">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto">
                        <i data-lucide="book-open" class="h-8 w-8 text-blue-500"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">{{ number_format($totalBooks) }}+</div>
                    <div class="text-gray-600">Koleksi Buku Lengkap</div>
                </div>

                <div class="text-center space-y-3">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                        <i data-lucide="users" class="h-8 w-8 text-green-500"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">50,000+</div>
                    <div class="text-gray-600">Pelanggan Puas</div>
                </div>

                <div class="text-center space-y-3">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto">
                        <i data-lucide="star" class="h-8 w-8 text-purple-500"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">4.9/5</div>
                    <div class="text-gray-600">Rating Pelanggan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 px-4 bg-white">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto">
                    <i data-lucide="truck" class="h-8 w-8 text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold">Pengiriman Cepat</h3>
                <p class="text-gray-600">Pengiriman ke seluruh Indonesia dengan jaminan aman dan cepat</p>
            </div>
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                    <i data-lucide="shield" class="h-8 w-8 text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold">Garansi Kualitas</h3>
                <p class="text-gray-600">Semua buku dijamin original dan dalam kondisi terbaik</p>
            </div>
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto">
                    <i data-lucide="book-open" class="h-8 w-8 text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold">Koleksi Lengkap</h3>
                <p class="text-gray-600">Ribuan judul buku dari berbagai genre dan penulis terbaik</p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Books Section -->
@if($latestBooks->count() > 0)
<section class="py-20 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Buku Terbaru</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Koleksi buku terbaru yang baru saja ditambahkan ke katalog kami
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestBooks as $book)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <div class="relative">
                    @if($book->cover_image)
                        <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                            <i data-lucide="book" class="h-16 w-16 text-gray-400"></i>
                        </div>
                    @endif
                    <div class="absolute top-2 left-2">
                        <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Baru</span>
                    </div>
                </div>
                <div class="p-4 space-y-2">
                    <h3 class="font-semibold text-lg line-clamp-2 hover:text-blue-500 transition-colors">
                        {{ $book->title }}
                    </h3>
                    <p class="text-sm text-gray-600">{{ $book->author }}</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-bold text-blue-500">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-sm text-gray-600 line-clamp-2">{{ $book->description }}</p>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition-colors mt-3">
                        Lihat Detail
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('books.index') }}" class="inline-flex items-center border border-gray-300 hover:bg-gray-50 px-8 py-3 rounded-lg font-medium transition-colors">
                Lihat Semua Buku
                <i data-lucide="arrow-right" class="ml-2 h-5 w-5"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Best Seller Books Section -->
@if($bestSellerBooks->count() > 0)
<section class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Buku Terlaris</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Buku-buku yang paling diminati dan dibeli oleh pembaca
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bestSellerBooks as $book)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <div class="relative">
                    @if($book->cover_image)
                        <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                            <i data-lucide="book" class="h-16 w-16 text-gray-400"></i>
                        </div>
                    @endif
                    <div class="absolute top-2 left-2">
                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">Terlaris</span>
                    </div>
                </div>
                <div class="p-4 space-y-2">
                    <h3 class="font-semibold text-lg line-clamp-2 hover:text-blue-500 transition-colors">
                        {{ $book->title }}
                    </h3>
                    <p class="text-sm text-gray-600">{{ $book->author }}</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-lg font-bold text-blue-500">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-sm text-gray-600 line-clamp-2">{{ $book->description }}</p>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition-colors mt-3">
                        Lihat Detail
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Newsletter Section -->
<section class="py-16 px-4 bg-blue-500 text-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Dapatkan Update Terbaru</h2>
        <p class="text-xl mb-8 opacity-90">
            Berlangganan newsletter untuk mendapatkan info buku terbaru dan promo menarik
        </p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            @csrf
            <input
                type="email"
                name="email"
                placeholder="Masukkan email Anda"
                class="flex-1 px-4 py-3 rounded-lg text-gray-900"
                required
            >
            <button type="submit" class="bg-white text-blue-500 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                Berlangganan
            </button>
        </form>
    </div>
</section>

@push('scripts')
<script>
    // Initialize Lucide icons after content loads
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
