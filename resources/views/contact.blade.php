@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-orange-50 to-indigo-100 py-20 px-4">
    <div class="container mx-auto text-center">
        <div class="max-w-4xl mx-auto space-y-6">
            <div class="inline-flex items-center bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium text-orange-600 mb-4">
                📞 Hubungi Kami
            </div>
            <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                Kami Siap <span class="text-orange-500">Membantu</span>
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
                    <i data-lucide="map-pin" class="h-6 w-6 text-orange-500"></i>
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

<section class="py-20 px-4 bg-gray-50">
    <div class="container mx-auto max-w-6xl">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Google Maps Embed -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7417375569454!2d106.82715311526172!3d-6.170233095531308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2ad8f8ab9%3A0xbad45612a410b429!2sJl.%20Sudirman%20No.123%2C%20Jakarta%20Pusat!5e0!3m2!1sen!2sid!4v1719412345678"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                class="w-full h-[450px]">
            </iframe>
            <div class="p-6">
                <h3 class="text-2xl font-semibold mb-2">Kantor Kami</h3>
                <p class="text-gray-600">
                    Jl. Sudirman No. 123, Jakarta Pusat — Silakan kunjungi kami untuk konsultasi atau pembelian langsung.
                </p>
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
            <button onclick="window.open('https://wa.me/6281234567890', '_blank')"
    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center mx-auto">
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
