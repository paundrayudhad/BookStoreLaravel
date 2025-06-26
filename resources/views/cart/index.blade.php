@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Keranjang Belanja</h1>
        <p class="text-gray-600">Review buku yang akan Anda beli</p>
    </div>

    @if(!empty($cart) && count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Item dalam Keranjang</h2>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @foreach($cart as $id => $details)
                            <div class="p-6 flex items-center space-x-4">
                                <!-- Book Cover -->
                                <div class="flex-shrink-0">
                                    @if($details['cover'])
                                        <img src="{{ Storage::url($details['cover']) }}" alt="{{ $details['title'] }}"
                                             class="h-20 w-16 object-cover rounded">
                                    @else
                                        <div class="h-20 w-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded flex items-center justify-center">
                                            <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Book Details -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $details['title'] }}</h3>
                                    <p class="text-sm text-gray-600">{{ $details['author'] }}</p>
                                    <p class="text-lg font-bold text-orange-600 mt-1">Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <label for="quantity-{{ $id }}" class="sr-only">Jumlah</label>
                                        <input type="number" id="quantity-{{ $id }}" name="quantity" value="{{ $details['quantity'] }}"
                                               min="1" max="10"
                                               class="w-16 px-2 py-1 border border-gray-300 rounded text-center focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                        <button type="submit" class="text-orange-600 hover:text-orange-800 text-sm font-medium">
                                            Update
                                        </button>
                                    </form>
                                </div>

                                <!-- Remove Button -->
                                <div class="flex-shrink-0">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition duration-150 ease-in-out">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h2>

                    <div class="space-y-3 mb-4">
                        @foreach($cart as $id => $details)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">{{ $details['title'] }} ({{ $details['quantity'] }}x)</span>
                                <span class="font-medium">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-orange-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        @auth
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 px-4 rounded-lg font-semibold transition duration-150 ease-in-out">
                                    Checkout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-orange-600 hover:bg-orange-700 text-white py-3 px-4 rounded-lg font-semibold text-center transition duration-150 ease-in-out">
                                Login untuk Checkout
                            </a>
                        @endauth

                        <a href="{{ route('books.index') }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-4 rounded-lg font-semibold text-center transition duration-150 ease-in-out">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-12">
            <i data-lucide="shopping-cart" class="mx-auto h-12 w-12 text-gray-400"></i>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Keranjang belanja kosong</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai berbelanja untuk menambahkan item ke keranjang Anda.</p>
            <div class="mt-6">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                    </svg>
                    Mulai Belanja
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
