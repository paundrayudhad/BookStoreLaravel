@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-50 to-indigo-100 py-20 px-4">
    <div class="container mx-auto text-center">
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="inline-flex items-center bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium text-blue-600 mb-4">
                📖 Tentang SabaJayaPress
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                Penerbit <span class="text-blue-500">Terpercaya</span>
                <br>
                untuk Masa Depan
            </h1>
            <p class="text-lg lg:text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                SabaJayaPress didirikan dengan misi menyediakan akses mudah dan terjangkau ke buku-buku berkualitas tinggi
                untuk mendukung pendidikan dan literasi di Indonesia.
            </p>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900">Cerita Kami</h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>
                        SabaJayaPress dimulai dari sebuah visi sederhana: membuat buku berkualitas dapat diakses oleh semua
                        orang. Didirikan pada tahun 2015 oleh sekelompok profesional yang peduli dengan pendidikan, kami
                        memulai perjalanan dengan koleksi 100 judul buku.
                    </p>
                    <p>
                        Seiring berjalannya waktu, kami terus berkembang dan berinovasi. Hari ini, SabaJayaPress telah menjadi
                        platform terpercaya dengan lebih dari 10,000 judul buku digital dan fisik, melayani puluhan ribu
                        pelanggan di seluruh Indonesia.
                    </p>
                    <p>
                        Komitmen kami tidak hanya pada penyediaan buku, tetapi juga pada penciptaan ekosistem literasi yang
                        mendukung penulis, penerbit, dan pembaca untuk tumbuh bersama.
                    </p>
                </div>
            </div>
            <div class="relative">
                <div class="w-full h-96 bg-gray-200 rounded-2xl flex items-center justify-center">
                    <i data-lucide="book-open" class="h-24 w-24 text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Misi & Visi Kami</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto">
                        <i data-lucide="target" class="h-8 w-8 text-blue-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold">Misi Kami</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Menyediakan akses mudah dan terjangkau ke buku-buku berkualitas tinggi untuk mendukung pendidikan
                        dan literasi di Indonesia melalui platform digital yang inovatif.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto">
                        <i data-lucide="heart" class="h-8 w-8 text-purple-500"></i>
                    </div>
                    <h3 class="text-2xl font-bold">Visi Kami</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Menjadi platform literasi digital terdepan di Indonesia yang menghubungkan penulis, penerbit, dan
                        pembaca dalam ekosistem yang berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Nilai-Nilai Kami</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Nilai-nilai yang menjadi fondasi dalam setiap langkah perjalanan SabaJayaPress
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="book-open" class="h-8 w-8 text-blue-500"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Kualitas Terbaik</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Kami berkomitmen menyediakan buku-buku berkualitas tinggi dari penerbit terpercaya.</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="users" class="h-8 w-8 text-green-500"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Pelayanan Prima</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Tim customer service kami siap membantu Anda 24/7 dengan pelayanan yang ramah dan profesional.</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="shield" class="h-8 w-8 text-purple-500"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Terpercaya</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Kepercayaan pelanggan adalah prioritas utama kami dalam setiap transaksi.</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="truck" class="h-8 w-8 text-orange-500"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Pengiriman Cepat</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Sistem logistik yang efisien memastikan buku sampai ke tangan Anda dengan cepat dan aman.</p>
            </div>
        </div>
    </div>
</section>

<!-- Achievements -->
<section class="py-20 px-4 bg-blue-500 text-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl lg:text-4xl font-bold mb-12">Pencapaian Kami</h2>

        <div class="grid md:grid-cols-4 gap-8">
            <div class="space-y-2">
                <div class="text-4xl lg:text-5xl font-bold">10,000+</div>
                <div class="text-lg opacity-90">Koleksi Buku</div>
            </div>
            <div class="space-y-2">
                <div class="text-4xl lg:text-5xl font-bold">50,000+</div>
                <div class="text-lg opacity-90">Pelanggan Puas</div>
            </div>
            <div class="space-y-2">
                <div class="text-4xl lg:text-5xl font-bold">4.9/5</div>
                <div class="text-lg opacity-90">Rating Pelanggan</div>
            </div>
            <div class="space-y-2">
                <div class="text-4xl lg:text-5xl font-bold">100+</div>
                <div class="text-lg opacity-90">Penerbit Partner</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 px-4 bg-gray-50">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Komunitas Kami</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Jadilah bagian dari komunitas pembaca yang terus berkembang dan nikmati pengalaman literasi yang tak
            terlupakan
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('books.index') }}" class="bg-blue-500 text-white px-8 py-3 rounded-lg font-medium hover:bg-blue-600 transition-colors">
                Mulai Berbelanja
            </a>
            <a href="{{ route('contact') }}" class="border border-gray-300 px-8 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
