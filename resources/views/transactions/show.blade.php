@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Transaksi #{{ $transaction->id }}</h1>
                <p class="text-gray-600">{{ $transaction->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div class="text-right">
                @switch($transaction->status)
                    @case('pending')
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Menunggu Pembayaran
                        </span>
                        @break
                    @case('paid')
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            Menunggu Verifikasi
                        </span>
                        @break
                    @case('completed')
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            Selesai
                        </span>
                        @break
                    @case('cancelled')
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            Dibatalkan
                        </span>
                        @break
                @endswitch
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Transaction Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Items -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Item yang Dibeli</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($transaction->details as $detail)
                        <div class="p-6 flex items-center space-x-4">
                            <!-- Book Cover -->
                            <div class="flex-shrink-0">
                                @if($detail->book->cover_image)
                                    <img src="{{ Storage::url($detail->book->cover_image) }}" alt="{{ $detail->book->title }}"
                                         class="h-20 w-16 object-cover rounded">
                                @else
                                    <div class="h-20 w-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded flex items-center justify-center">
                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Book Details -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $detail->book->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $detail->book->author }}</p>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-sm text-gray-500">{{ $detail->quantity }}x @ Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                                    <span class="text-lg font-bold text-blue-600">Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Download Button -->
                            @if($transaction->status === 'completed' && $detail->book->file)
                                <div class="flex-shrink-0">
                                    <a href="{{ route('books.download', $detail->book) }}"
                                       class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Payment Information -->
            @if($transaction->payment)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pembayaran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Metode Pembayaran</p>
                            <p class="font-medium">{{ ucfirst(str_replace('_', ' ', $transaction->payment->payment_method)) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status Pembayaran</p>
                            <p class="font-medium">
                                @switch($transaction->payment->status)
                                    @case('pending')
                                        <span class="text-yellow-600">Menunggu Verifikasi</span>
                                        @break
                                    @case('verified')
                                        <span class="text-green-600">Terverifikasi</span>
                                        @break
                                    @case('rejected')
                                        <span class="text-red-600">Ditolak</span>
                                        @break
                                @endswitch
                            </p>
                        </div>
                        @if($transaction->payment->proof)
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-600 mb-2">Bukti Pembayaran</p>
                                <img src="{{ Storage::url($transaction->payment->proof) }}" alt="Bukti Pembayaran"
                                     class="max-w-xs rounded-lg shadow-sm">
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan</h2>

                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">ID Transaksi</span>
                        <span class="font-medium">#{{ $transaction->id }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Tanggal</span>
                        <span class="font-medium">{{ $transaction->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Jumlah Item</span>
                        <span class="font-medium">{{ $transaction->details->sum('quantity') }} item</span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-blue-600">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    @if($transaction->status === 'pending')
                        <a href="{{ route('payments.create', $transaction) }}"
                           class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium text-center transition duration-150 ease-in-out">
                            Bayar Sekarang
                        </a>
                    @endif
                    @if($transaction->status === 'paid')
                        <a href="https://wa.me/6287739964722?text=Halo, saya ingin mengonfirmasi pembayaran untuk transaksi #{{ $transaction->id }}. Terima kasih!"
                           class="block w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-medium text-center transition duration-150 ease-in-out">
                            Konfirmasi Pembayaran
                        </a>
                    @endif

                    <a href="{{ route('transactions.index') }}"
                       class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg font-medium text-center transition duration-150 ease-in-out">
                        Kembali ke Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
