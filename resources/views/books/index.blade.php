@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Katalog Buku</h1>
        <p class="text-gray-600">Temukan buku favorit Anda dari koleksi lengkap kami</p>
    </div>

    <div class="grid lg:grid-cols-4 gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center mb-4">
                    <i data-lucide="filter" class="h-5 w-5 mr-2"></i>
                    <h2 class="text-lg font-semibold">Filter</h2>
                </div>

                <form method="GET" action="{{ route('books.index') }}" class="space-y-6">
                    <!-- Search -->
                    <div>
                        <label for="search" class="text-sm font-medium mb-2 block">
                            Cari Buku
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="search"
                                name="search"
                                placeholder="Judul atau penulis..."
                                value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            >
                        </div>
                    </div>

                    <hr>

                    <!-- Format Filter -->
                    <div>
                        <label class="text-sm font-medium mb-3 block">Format Buku</label>
                        <select name="format" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Format</option>
                            <option value="digital" {{ request('format') == 'digital' ? 'selected' : '' }}>Buku Digital</option>
                            <option value="fisik" {{ request('format') == 'fisik' ? 'selected' : '' }}>Buku Fisik</option>
                        </select>
                    </div>

                    <hr>

                    <div class="flex space-x-2">
                        <button type="submit" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-medium transition-colors">
                            Filter
                        </button>
                        <a href="{{ route('books.index') }}" class="flex-1 border border-gray-300 hover:bg-gray-50 py-2 rounded-lg font-medium text-center transition-colors">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <!-- Results Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-gray-600">
                        Menampilkan {{ $books->count() }} dari {{ $books->total() }} buku
                        @if(request('search'))
                            untuk "{{ request('search') }}"
                        @endif
                    </p>
                </div>
            </div>

            <!-- Books Grid -->
            @if($books->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($books as $book)
                    @include('components.book-card', ['book' => $book])
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $books->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <i data-lucide="search" class="h-16 w-16 mx-auto"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Buku tidak ditemukan</h3>
                    <p class="text-gray-600">Coba ubah kata kunci pencarian atau filter yang Anda gunakan</p>
                    <a href="{{ route('books.index') }}" class="inline-block mt-4 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Lihat Semua Buku
                    </a>
                </div>
            @endif
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
@push('scripts')
<script>
    function viewBookDetail(bookId) {
        // Redirect to book detail page
        window.location.href = `/books/${bookId}`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
