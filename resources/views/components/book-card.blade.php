<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
    <!-- Book Cover with Type Badge -->
    <div class="relative">
        @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-48 sm:h-56 bg-gray-200 flex items-center justify-center">
                <i data-lucide="book" class="h-16 w-16 text-gray-400"></i>
            </div>
        @endif
        
        <!-- Type Badge (Digital/Fisik) -->
        <div class="absolute top-3 right-3">
            @if($book->book_type === 'digital')
                <span class="bg-orange-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                    Digital
                </span>
            @else
                <span class="bg-gray-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                    Fisik
                </span>
            @endif
        </div>
    </div>

    <!-- Card Content -->
    <div class="p-4 space-y-3">
        <!-- Category Tag -->
        @if($book->category)
            <span class="bg-orange-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                {{ $book->category }}
            </span>
        @endif

        <!-- Book Title -->
        <h3 class="font-semibold text-lg text-gray-900 line-clamp-2 group-hover:text-orange-600 transition-colors">
            {{ $book->title }}
        </h3>

        <!-- Author -->
        <p class="text-sm text-gray-600">
            oleh {{ $book->author }}
        </p>

        <!-- Publisher & Year (Optional info) -->
        @if($book->publisher || $book->release_year)
            <div class="text-xs text-gray-500">
                @if($book->publisher)
                    {{ $book->publisher }}
                @endif
                @if($book->publisher && $book->release_year) • @endif
                @if($book->release_year)
                    {{ $book->release_year }}
                @endif
            </div>
        @endif

        <!-- Tags (if available) -->
        @if($book->tags && count($book->tags) > 0)
            <div class="flex flex-wrap gap-1">
                @foreach(array_slice($book->tags, 0, 2) as $tag)
                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                        {{ $tag }}
                    </span>
                @endforeach
                @if(count($book->tags) > 2)
                    <span class="text-xs text-gray-500">+{{ count($book->tags) - 2 }}</span>
                @endif
            </div>
        @endif

        <!-- Price -->
        <div class="flex items-center space-x-2">
            <span class="text-lg font-bold text-orange-600">
                Rp {{ number_format($book->price, 0, ',', '.') }}
            </span>
        </div>

        <!-- Stock Info -->
            <div class="text-xs text-gray-500">
                @if($book->stock > 0)
                    Stok: {{ $book->stock }} Tersedia
                @else
                    <span class="text-red-500">Stok habis</span>
                @endif
            </div>

        <!-- Action Button -->
        <div class="pt-2">
            <button onclick="viewBookDetail('{{ $book->id }}')" 
                   class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2.5 px-4 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center space-x-2 {{ $book->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                   {{ $book->stock <= 0 ? 'disabled' : '' }}>
                <i data-lucide="shopping-cart" class="h-4 w-4"></i>
                <span>Lihat Detail</span>
            </button>
        </div>
    </div>
</div>