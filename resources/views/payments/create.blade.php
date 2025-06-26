@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran</h1>
        <p class="text-gray-600">Selesaikan pembayaran untuk transaksi #{{ $transaction->id }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow-sm p-6 lg:row-span-2">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Ringkasan Pesanan</h2>

            <div class="space-y-4 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">ID Transaksi</span>
                    <span class="font-medium">#{{ $transaction->id }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Tanggal</span>
                    <span class="font-medium">{{ $transaction->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Status</span>
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4 mb-4">
                <h3 class="text-sm font-medium text-gray-900 mb-3">Item yang dibeli:</h3>
                <div class="space-y-3">
                    @foreach($transaction->details as $detail)
                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="font-medium text-gray-900">{{ $detail->book->title }}</p>
                                <p class="text-gray-600">{{ $detail->quantity }}x @ Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                            </div>
                            <span class="font-medium">Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between text-lg font-bold">
                    <span>Total Pembayaran</span>
                    <span class="text-blue-600">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('payments.store', $transaction) }}" method="POST" enctype="multipart/form-data" id="payment-form">
                @csrf
                <input type="hidden" name="payment_method" id="payment_method_input" value="bank_transfer">

                <div id="step-1" class="step @if(!$hasPhysicalBook) hidden @endif">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Langkah 1: Informasi Pengiriman</h2>
                    <p class="text-gray-600 mb-6">Harap isi detail pengiriman karena pesanan Anda mengandung buku fisik.</p>

                    <div class="mb-4">
                        <label for="recipient_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                        <input type="text" id="recipient_name" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name) }}" required
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('recipient_name') border-red-500 @enderror">
                        @error('recipient_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman</label>
                        <textarea id="shipping_address" name="shipping_address" rows="3" required
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required
                            class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone_number') border-red-500 @enderror">
                        @error('phone_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="button" id="next-step-btn" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold transition duration-150 ease-in-out">
                        Lanjut ke Pembayaran
                    </button>
                </div>

                <div id="step-2" class="step @if($hasPhysicalBook) hidden @endif">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Langkah 2: Pilih Pembayaran</h2>

                    @if(!$hasPhysicalBook)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <p class="text-blue-700 flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            Pesanan Anda hanya berisi produk digital. Tidak perlu informasi pengiriman.
                        </p>
                    </div>
                    @endif

                    <div class="mb-5">
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                                <button type="button" data-method="bank_transfer" class="tab-button active-tab">
                                    Transfer Bank
                                </button>
                                <button type="button" data-method="qris" class="tab-button">
                                    QRIS
                                </button>
                            </nav>
                        </div>
                    </div>

                    <div class="mb-6 p-4 bg-blue-50 rounded-lg min-h-[120px]">
                        <h3 class="text-sm font-medium text-blue-900 mb-2">Instruksi Pembayaran:</h3>
                        <div id="bank_transfer-content" class="tab-content text-sm text-blue-800">
                             <p class="mb-2"><strong>Bank BCA:</strong></p>
                             <p>No. Rekening: 1234567890</p>
                             <p>Atas Nama: BookStore Indonesia</p>
                             <p class="mt-2 text-xs">Transfer sesuai nominal yang tertera dan upload bukti pembayaran.</p>
                        </div>
                        <div id="qris-content" class="tab-content text-sm text-blue-800 hidden">
                             <p class="mb-2"><strong>QRIS Payment:</strong></p>
                             <p>Scan QR Code menggunakan aplikasi mobile banking atau e-wallet Anda.</p>
                             <img src="https://placehold.jp/150x150.png?text=QRIS&css=%7B%22font-size%22%3A%2220px%22%7D" 
     alt="QRIS Placeholder" 
     class="my-4 w-48 mx-auto rounded border" />

                             <p class="mt-2 text-xs">Setelah pembayaran berhasil, upload screenshot bukti pembayaran.</p>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="proof" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Bukti Pembayaran
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="proof" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload file</span>
                                        <input id="proof" name="proof" type="file" accept="image/*" class="sr-only" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                            </div>
                        </div>
                        @error('proof')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div id="preview-container" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-2">Preview Bukti Pembayaran:</p>
                        <img id="preview-image" class="max-w-xs rounded shadow-md mx-auto" alt="Preview Bukti" />
                    </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        @if($hasPhysicalBook)
                        <button type="button" id="prev-step-btn" class="w-1/3 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 px-4 rounded-lg font-semibold transition duration-150 ease-in-out">
                            Kembali
                        </button>
                        @endif
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold transition duration-150 ease-in-out">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Menambahkan beberapa style untuk tab yang aktif dan non-aktif */
    .tab-button {
        @apply whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300;
    }
    .active-tab {
        @apply border-blue-600 text-blue-600;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Kondisi dari Blade untuk JS
    const hasPhysicalBook = {{ $hasPhysicalBook ? 'true' : 'false' }};

    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const nextBtn = document.getElementById('next-step-btn');
    const prevBtn = document.getElementById('prev-step-btn');

    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    const paymentMethodInput = document.getElementById('payment_method_input');
    const form = document.getElementById('payment-form');

    function showStep(step) {
    if (step === 1) {
        step1.classList.remove('hidden');
        step2.classList.add('hidden');
        // Aktifkan field step 1
        step1.querySelectorAll('input, textarea, select').forEach(el => el.disabled = false);
        step2.querySelectorAll('input, textarea, select').forEach(el => el.disabled = true);
    } else {
        step1.classList.add('hidden');
        step2.classList.remove('hidden');
        // Nonaktifkan field step 1 agar tidak divalidasi
        step1.querySelectorAll('input, textarea, select').forEach(el => el.disabled = true);
        step2.querySelectorAll('input, textarea, select').forEach(el => el.disabled = false);
    }
}


    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            showStep(2);
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            showStep(1);
        });
    }

    // Tab Payment Handler
    tabButtons.forEach(button => {
        button.addEventListener('click', function () {
            const method = this.dataset.method;

            // Set hidden input
            paymentMethodInput.value = method;

            // Style tab aktif
            tabButtons.forEach(btn => btn.classList.remove('active-tab'));
            this.classList.add('active-tab');

            // Tampilkan konten tab
            tabContents.forEach(content => {
                if (content.id === method + '-content') {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });

    // Validasi final saat submit
    form.addEventListener('submit', function (e) {
        const method = paymentMethodInput.value;
        const validMethods = ['bank_transfer', 'qris'];

        if (!validMethods.includes(method)) {
            e.preventDefault();
            alert('Silakan pilih metode pembayaran yang valid.');
        }
    });

    // Inisialisasi tampilan awal
    showStep(hasPhysicalBook ? 1 : 2);
    document.querySelector('.tab-button[data-method="bank_transfer"]').click();
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const proofInput = document.getElementById('proof');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');

        proofInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewContainer.classList.add('hidden');
            }
        });
    });
</script>

@endsection