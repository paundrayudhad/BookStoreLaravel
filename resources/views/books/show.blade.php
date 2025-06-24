<!-- resources/views/books/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                @if($book->cover_image)
                <img src="{{ Storage::url($book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}">
                @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="bi bi-book fs-1"></i>
                </div>
                @endif
            </div>

            @if($book->book_type === 'digital')
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Unduh E-Book
                </div>
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-pdf fs-1 text-danger"></i>
                    <p class="mt-2">Format: PDF</p>
                    <p>{{ $book->page_count }} halaman</p>
                    <a href="#" class="btn btn-outline-primary w-100">
                        <i class="bi bi-download me-1"></i> Unduh Sampel
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title">{{ $book->title }}</h1>
                    <p class="text-muted">oleh {{ $book->author }}</p>

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-primary">{{ $book->book_type === 'fisik' ? 'Buku Fisik' : 'E-Book' }}</span>
                        <span class="badge bg-info">{{ $book->category }}</span>
                        @if($book->tags)
                            @foreach($book->tags as $tag)
                            <span class="badge bg-secondary">{{ $tag }}</span>
                            @endforeach
                        @endif
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-primary mb-0">Rp {{ number_format($book->price, 0, ',', '.') }}</h3>
                        @if($book->book_type === 'fisik')
                            @if($book->stock > 0)
                            <span class="badge bg-success">Tersedia ({{ $book->stock }})</span>
                            @else
                            <span class="badge bg-danger">Stok Habis</span>
                            @endif
                        @else
                            <span class="badge bg-success">Tersedia</span>
                        @endif
                    </div>

                    <form action="{{ route('cart.add', $book) }}" method="POST" class="mb-4">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg w-100"
                            {{ ($book->book_type === 'fisik' && $book->stock < 1) ? 'disabled' : '' }}>
                            <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                        </button>
                    </form>

                    <h4 class="mt-4">Deskripsi Singkat</h4>
                    <p>{{ $book->short_description }}</p>

                    <h4 class="mt-4">Sinopsis</h4>
                    <p>{{ $book->synopsis }}</p>

                    @if($book->book_type === 'fisik')
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="bi bi-journal-bookmark fs-1 text-primary"></i>
                                    <p class="mt-2 mb-0">Halaman</p>
                                    <h5>{{ $book->page_count ?: '-' }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="bi bi-box fs-1 text-primary"></i>
                                    <p class="mt-2 mb-0">Berat</p>
                                    <h5>{{ $book->weight ? $book->weight . ' gram' : '-' }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="bi bi-rulers fs-1 text-primary"></i>
                                    <p class="mt-2 mb-0">Ukuran</p>
                                    <h5>{{ $book->dimensions ?: '-' }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        <h4>Detail Buku</h4>
                        <table class="table">
                            <tr>
                                <th>Penerbit</th>
                                <td>{{ $book->publisher ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Terbit</th>
                                <td>{{ $book->release_year ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>ISBN</th>
                                <td>{{ $book->isbn ?: '-' }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $book->category ?: '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
