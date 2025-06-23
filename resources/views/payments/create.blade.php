@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran</h1>
        <p class="text-gray-600">Selesaikan pembayaran untuk transaksi #{{ $transaction->id }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Payment Form -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Pembayaran</h2>

            <form action="{{ route('payments.store', $transaction) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Payment Method -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Metode Pembayaran</label>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input id="bank_transfer" name="payment_method" type="radio" value="bank_transfer"
                                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" required>
                            <label for="bank_transfer" class="ml-3 block text-sm font-medium text-gray-700">
                                Transfer Bank
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="qris" name="payment_method" type="radio" value="qris"
                                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300" required>
                            <label for="qris" class="ml-3 block text-sm font-medium text-gray-700">
                                QRIS
                            </label>
                        </div>
                    </div>
                    @error('payment_method')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Instructions -->
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <h3 class="text-sm font-medium text-blue-900 mb-2">Instruksi Pembayaran:</h3>
                    <div id="bank-instructions" class="text-sm text-blue-800 hidden">
                        <p class="mb-2"><strong>Bank BCA:</strong></p>
                        <p>No. Rekening: 1234567890</p>
                        <p>Atas Nama: BookStore Indonesia</p>
                        <p class="mt-2 text-xs">Transfer sesuai nominal yang tertera dan upload bukti pembayaran.</p>
                    </div>
                    <div id="qris-instructions" class="text-sm text-blue-800 hidden">
                        <p class="mb-2"><strong>QRIS Payment:</strong></p>
                        <p>Scan QR Code menggunakan aplikasi mobile banking atau e-wallet Anda.</p>
                        <p class="mt-2 text-xs">Setelah pembayaran berhasil, upload screenshot bukti pembayaran.</p>
                    </div>
                </div>

                <!-- Upload Proof -->
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
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold transition duration-150 ease-in-out">
                    Upload Bukti Pembayaran
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Ringkasan Pesanan</h2>

            <!-- Transaction Details -->
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

            <!-- Items -->
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

            <!-- Total -->
            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between text-lg font-bold">
                    <span>Total Pembayaran</span>
                    <span class="text-blue-600">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bankRadio = document.getElementById('bank_transfer');
    const qrisRadio = document.getElementById('qris');
    const bankInstructions = document.getElementById('bank-instructions');
    const qrisInstructions = document.getElementById('qris-instructions');

    function toggleInstructions() {
        if (bankRadio.checked) {
            bankInstructions.classList.remove('hidden');
            qrisInstructions.classList.add('hidden');
        } else if (qrisRadio.checked) {
            qrisInstructions.classList.remove('hidden');
            bankInstructions.classList.add('hidden');
        }
    }

    bankRadio.addEventListener('change', toggleInstructions);
    qrisRadio.addEventListener('change', toggleInstructions);
});
</script>
@endsection
