@extends('layouts.app')

@section('title', 'Riwayat Pembelian')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Riwayat Pembelian</h1>
            <p class="text-gray-600">Lihat semua transaksi dan pembelian buku Anda</p>
        </div>

        <div class="grid lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <nav class="space-y-2">
                        <a href="{{ route('profile.show') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i data-lucide="user" class="h-4 w-4 mr-3"></i>
                            Informasi Profil
                        </a>
                        <a href="{{ route('transactions.index') }}" class="flex items-center px-3 py-2 text-sm font-medium text-orange-600 bg-orange-50 rounded-lg">
                            <i data-lucide="shopping-bag" class="h-4 w-4 mr-3"></i>
                            Riwayat Pembelian
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Filter -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <!-- Filter Pintar -->
<form method="GET" class="mb-6 flex flex-col md:flex-row md:items-end gap-4">
    <div class="flex-1">
        <label for="search" class="block text-sm font-medium text-gray-700">Cari ID atau Total</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}"
               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
               placeholder="Contoh: 123 atau 10000">
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
            <option value="">Semua</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Menunggu Verifikasi</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
    </div>

    <div>
        <button type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none">
            Filter
        </button>
    </div>
</form>
                </div>

                <!-- Orders List -->
                @if(isset($transactions) && $transactions->count() > 0)
                    <div class="space-y-4">
                        @foreach($transactions as $order)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold">Order #{{ $order->id }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div class="text-right">
                                        @if($order->status == 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i data-lucide="clock" class="h-3 w-3 mr-1"></i>
                                                Menunggu Pembayaran
                                            </span>
                                        @elseif($order->status == 'paid')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                <i data-lucide="package" class="h-3 w-3 mr-1"></i>
                                                Menunggu Verifikasi
                                            </span>
                                        @elseif($order->status == 'completed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i data-lucide="check-circle" class="h-3 w-3 mr-1"></i>
                                                Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i data-lucide="x-circle" class="h-3 w-3 mr-1"></i>
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div class="border-t pt-4">
                                    @if($order->details)
                                        @foreach($order->details as $detail)
                                        <div class="flex items-center space-x-4 py-3">
                                            <div class="w-16 h-20 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                                                @if($detail->book && $detail->book->cover_image)
                                                    <img src="{{ Storage::url($detail->book->cover_image) }}" alt="{{ $detail->book->title }}" class="w-full h-full object-cover rounded">
                                                @else
                                                    <i data-lucide="book" class="h-8 w-8 text-gray-400"></i>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-medium">{{ $detail->book->title ?? 'Buku tidak ditemukan' }}</h4>
                                                <p class="text-gray-600 text-sm">{{ $detail->book->author ?? '' }}</p>
                                                <p class="text-sm">Qty: {{ $detail->quantity }} × Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                            </div>
                                            @if($detail->book && $detail->book->type == 'digital' && $order->status == 'completed')
                                                <a href="{{ route('books.download', $detail->book) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
                                                    <i data-lucide="download" class="h-4 w-4 mr-2"></i>
                                                    Download
                                                </a>
                                            @endif
                                        </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="border-t pt-4 flex items-center justify-between">
                                    <div class="text-lg font-semibold">
                                        Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </div>
                                    <div class="flex space-x-2">
                                        @if($order->status == 'pending')
                                            <a href="{{ route('payments.create', $order) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                                Bayar Sekarang
                                            </a>
                                        @endif
                                        <a href="{{ route('transactions.show', $order->id) }}" class="border border-gray-300 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($transactions, 'links'))
                        <div class="mt-8">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-lg shadow-md p-12 text-center">
                        <div class="text-gray-400 mb-4">
                            <i data-lucide="shopping-bag" class="h-16 w-16 mx-auto"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Belum Ada Pembelian</h3>
                        <p class="text-gray-600 mb-6">Anda belum melakukan pembelian apapun. Mulai jelajahi koleksi buku kami!</p>
                        <a href="{{ route('books.index') }}" class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            <i data-lucide="book-open" class="h-5 w-5 mr-2"></i>
                            Jelajahi Buku
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
