<!-- resources/views/cart/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold">Keranjang Belanja</h1>
</div>

@if(count($cart) > 0)
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $details)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($details['cover'])
                                    <img src="{{ Storage::url($details['cover']) }}" alt="{{ $details['title'] }}" width="50" class="me-3">
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $details['title'] }}</div>
                                        <div class="text-muted small">{{ $details['author'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                                    <button type="submit" class="btn btn-sm btn-outline-primary ms-2">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ringkasan Belanja</h5>
                <table class="table">
                    <tr>
                        <th>Subtotal</th>
                        <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Biaya Admin</th>
                        <td>Rp 0</td>
                    </tr>
                    <tr class="fw-bold">
                        <th>Total</th>
                        <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </table>
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
        <h3 class="mt-3">Keranjang Belanja Kosong</h3>
        <p class="text-muted">Tambahkan buku ke keranjang belanja Anda</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Lihat Katalog Buku</a>
    </div>
</div>
@endif
@endsection
