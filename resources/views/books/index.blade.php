@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Katalog Buku</h1>
        <p class="text-gray-600">Temukan buku digital favorit Anda</p>
    </div>

    <!-- Search and Filter -->
    <div class="mb-8 bg-white rounded-lg shadow-sm p-6">
        <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari judul buku atau penulis..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-150 ease-in-out">
                    Cari
                </button>
                <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium transition duration-150 ease-in-out">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Books Grid -->
    @if($books->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($books as $book)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition duration-300 ease-in-out overflow-hidden">
                    <!-- Book Cover -->
                    <a href="{{ route('books.show', $book) }}" class="block">
                        <div class="aspect-w-3 aspect-h-4 bg-gray-200">
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}"
                                     class="w-full h-full object-cover hover:opacity-90 transition duration-150">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center hover:opacity-90 transition duration-150">
                                    <svg class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Book Info -->
                    <div class="p-4">
                        <a href="{{ route('books.show', $book) }}" class="block hover:text-blue-600 transition duration-150">
                            <h3 class="font-semibold text-gray-900 text-lg mb-1 line-clamp-2">{{ $book->title }}</h3>
                        </a>
                        <p class="text-gray-600 text-sm mb-2">{{ $book->author }}</p>

                        @if($book->description)
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $book->description }}</p>
                        @endif

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-500">Stok: {{ $book->stock }}</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('books.show', $book) }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg font-medium text-center transition duration-150 ease-in-out">
                                <svg class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                            @auth
                                @if($book->stock > 0)
                                    <form action="{{ route('cart.add', $book) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition duration-150 ease-in-out">
                                            <svg class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h6a2 2 0 002-2v-8m-8 0V9a2 2 0 012-2h4a2 2 0 012 2v4.01" />
                                            </svg>
                                            Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-lg font-medium cursor-not-allowed">
                                        Stok Habis
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium text-center transition duration-150 ease-in-out">
                                    Login untuk Beli
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $books->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada buku ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci pencarian Anda.</p>
        </div>
    @endif
</div>
@endsection
