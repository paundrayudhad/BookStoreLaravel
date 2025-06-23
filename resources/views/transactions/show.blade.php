<!-- resources/views/transactions/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold">Detail Transaksi #{{ $transaction->id }}</h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Informasi Transaksi
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID Transaksi</th>
                        <td>#{{ $transaction->id }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($transaction->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($transaction->status == 'paid')
                                <span class="badge bg-info">Menunggu Verifikasi</span>
                            @elseif($transaction->status == 'completed')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td class="fw-bold text-primary">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                Daftar Buku
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->details as $detail)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($detail->book->cover_image)
                                    <img src="{{ Storage::url($detail->book->cover_image) }}" alt="{{ $detail->book->title }}" width="50" class="me-3">
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $detail->book->title }}</div>
                                        <div class="text-muted small">{{ $detail->book->author }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Pembayaran
            </div>
            <div class="card-body">
                @if($transaction->payment)
                <table class="table">
                    <tr>
                        <th>Metode</th>
                        <td>
                            @if($transaction->payment->payment_method == 'bank_transfer')
                                Transfer Bank
                            @else
                                QRIS
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Bukti</th>
                        <td>
                            <a href="{{ Storage::url($transaction->payment->proof) }}" target="_blank">
                                <img src="{{ Storage::url($transaction->payment->proof) }}" alt="Bukti Pembayaran" class="img-thumbnail" width="100">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($transaction->payment->status == 'pending')
                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                            @elseif($transaction->payment->status == 'verified')
                                <span class="badge bg-success">Terverifikasi</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                </table>
                @else
                <p class="text-center text-muted py-4">
                    @if($transaction->status == 'pending')
                        <i class="bi bi-exclamation-circle fs-1 text-warning"></i>
                        <div class="mt-3">Silakan lakukan pembayaran</div>
                        <a href="{{ route('payments.create', $transaction) }}" class="btn btn-primary mt-2">Bayar Sekarang</a>
                    @else
                        Belum ada informasi pembayaran.
                    @endif
                </p>
                @endif
            </div>
        </div>

        @if($transaction->status == 'completed')
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                Buku yang Dibeli
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($transaction->details as $detail)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $detail->book->title }}
                        <a href="{{ route('books.download', $detail->book) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-download"></i> Unduh
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
