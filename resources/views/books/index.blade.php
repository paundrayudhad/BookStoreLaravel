<!-- resources/views/books/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold">Katalog Buku</h1>
    <p class="text-muted">Temukan buku-buku terbaik untuk koleksi Anda</p>
</div>

<div class="row g-4">
    @foreach($books as $book)
    <div class="col-md-3">
        <div class="card book-card h-100">
            @if($book->cover_image)
            <img src="{{ Storage::url($book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 200px; object-fit: cover;">
            @else
            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                <i class="bi bi-book fs-1"></i>
            </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text text-muted">{{ $book->author }}</p>
                <p class="card-text fw-bold text-primary">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                <p class="card-text small">
                    @if($book->stock > 0)
                    <span class="badge bg-success">Tersedia ({{ $book->stock }})</span>
                    @else
                    <span class="badge bg-danger">Stok Habis</span>
                    @endif
                </p>
            </div>
            <div class="card-footer bg-white border-0">
                <form action="{{ route('cart.add', $book) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100" {{ $book->stock < 1 ? 'disabled' : '' }}>
                        <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $books->links() }}
</div>
@endsection
