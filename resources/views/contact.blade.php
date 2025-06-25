@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-50 to-indigo-100 py-20 px-4">
    <div class="container mx-auto text-center">
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="inline-flex items-center bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium text-blue-600 mb-4">
                📞 Hubungi Kami
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                Kami Siap <span class="text-blue-500">Membantu</span>
                <br>
                Anda
            </h1>
            <p class="text-lg lg:text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Tim customer service SabaJayaPress siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami untuk
                pertanyaan, saran, atau bantuan apapun.
            </p>
        </div>
    </div>
</section>

<!-- Contact Info Cards -->
<section class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="map-pin" class="h-6 w-6 text-blue-500"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Alamat Kantor</h3>
                <div class="space-y-1 text-sm text-gray-600">
                    <p>Jl. Sudirman No. 123</p>
                    <p>Jakarta Pusat 10220</p>
                    <p>Indonesia</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="phone" class="h-6 w-6 text-green-500"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Telepon</h3>
                <div class="space-y-1 text-sm text-gray-600">
                    <p>(021) 1234-5678</p>
                    <p>+62 812-3456-7890</p>
                    <p>Senin - Jumat: 08:00 - 17:00</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="mail" class="h-6 w-6 text-purple-500"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Email</h3>
                <div class="space-y-1 text-sm text-gray-600">
                    <p>info@sabajayapress.com</p>
                    <p>support@sabajayapress.com</p>
                    <p>sales@sabajayapress.com</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="clock" class="h-6 w-6 text-orange-500"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Jam Operasional</h3>
                <div class="space-y-1 text-sm text-gray-600">
                    <p>Senin - Jumat: 08:00 - 17:00</p>
                    <p>Sabtu: 09:00 - 15:00</p>
                    <p>Minggu: Tutup</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Map -->
<section class="py-20 px-4 bg-gray-50">
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <h2 class="text-2xl font-bold">Kirim Pesan</h2>
                        <p class="text-gray-600">Isi formulir di bawah ini dan kami akan merespons dalam 24 jam.</p>
                    </div>
                    <div class="p-6">
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Masukkan nama lengkap"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                        required
                                    >
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="nama@email.com"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                        required
                                    >
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori Pertanyaan</label>
                                <select name="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Pilih kategori</option>
                                    <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>Pertanyaan Umum</option>
                                    <option value="order" {{ old('category') == 'order' ? 'selected' : '' }}>Pemesanan</option>
                                    <option value="technical" {{ old('category') == 'technical' ? 'selected' : '' }}>Bantuan Teknis</option>
                                    <option value="partnership" {{ old('category') == 'partnership' ? 'selected' : '' }}>Kerjasama</option>
                                    <option value="complaint" {{ old('category') == 'complaint' ? 'selected' : '' }}>Keluhan</option>
                                </select>
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek *</label>
                                <input
                                    type="text"
                                    id="subject"
                                    name="subject"
                                    value="{{ old('subject') }}"
                                    placeholder="Subjek pesan Anda"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subject') border-red-500 @enderror"
                                    required
                                >
                                @error('subject')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan *</label>
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="5"
                                    placeholder="Tulis pesan Anda di sini..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror"
                                    required
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-medium transition-colors flex items-center justify-center">
                                <i data-lucide="send" class="mr-2 h-5 w-5"></i>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map & Additional Info -->
            <div class="space-y-6">
                <!-- Map Placeholder -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-64 bg-gray-200 flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <i data-lucide="map-pin" class="h-12 w-12 mx-auto mb-2"></i>
                            <p>Peta Lokasi Kantor</p>
                            <p class="text-sm">Jl. Sudirman No. 123, Jakarta Pusat</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold mb-2">Kunjungi Kantor Kami</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Anda dapat mengunjungi kantor kami untuk konsultasi langsung atau melihat koleksi buku fisik.
                        </p>
                        <button class="w-full border border-gray-300 hover:bg-gray-50 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
                            <i data-lucide="map-pin" class="mr-2 h-4 w-4"></i>
                            Lihat di Google Maps
                        </button>
                    </div>
                </div>

                <!-- Quick Contact -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <h3 class="text-xl font-bold">Kontak Cepat</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <a href="tel:02112345678" class="w-full border border-gray-300 hover:bg-gray-50 py-3 rounded-lg font-medium transition-colors flex items-center">
                            <i data-lucide="phone" class="mr-2 h-4 w-4"></i>
                            Telepon: (021) 1234-5678
                        </a>
                        <a href="https://wa.me/6281234567890" class="w-full border border-gray-300 hover:bg-gray-50 py-3 rounded-lg font-medium transition-colors flex items-center">
                            <i data-lucide="message-circle" class="mr-2 h-4 w-4"></i>
                            WhatsApp: +62 812-3456-7890
                        </a>
                        <a href="mailto:info@sabajayapress.com" class="w-full border border-gray-300 hover:bg-gray-50 py-3 rounded-lg font-medium transition-colors flex items-center">
                            <i data-lucide="mail" class="mr-2 h-4 w-4"></i>
                            Email: info@sabajayapress.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 px-4 bg-white">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Temukan jawaban untuk pertanyaan yang paling sering ditanyakan pelanggan kami
            </p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-3">Bagaimana cara memesan buku?</h3>
                    <p class="text-gray-600 leading-relaxed">Anda dapat memesan buku melalui website kami dengan memilih buku yang diinginkan, menambahkan ke keranjang, dan melakukan checkout.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-3">Berapa lama waktu pengiriman?</h3>
                    <p class="text-gray-600 leading-relaxed">Untuk wilayah Jakarta dan sekitarnya 1-2 hari kerja, untuk luar Jakarta 2-5 hari kerja tergantung lokasi.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-3">Apakah ada garansi untuk buku yang rusak?</h3>
                    <p class="text-gray-600 leading-relaxed">Ya, kami memberikan garansi 100% untuk buku yang rusak atau cacat. Anda dapat mengembalikan dalam 7 hari.</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-3">Bagaimana cara mengakses buku digital?</h3>
                    <p class="text-gray-600 leading-relaxed">Setelah pembelian, Anda akan menerima link download dan akses ke platform digital kami melalui email.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <p class="text-gray-600 mb-4">Tidak menemukan jawaban yang Anda cari?</p>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center mx-auto">
                <i data-lucide="message-circle" class="mr-2 h-4 w-4"></i>
                Hubungi Customer Service
            </button>
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
