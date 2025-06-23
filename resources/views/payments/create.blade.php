<!-- resources/views/payments/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold">Pembayaran</h1>
    <p class="text-muted">Lengkapi pembayaran untuk transaksi #{{ $transaction->id }}</p>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Detail Transaksi
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
                        <th>Total Pembayaran</th>
                        <td class="fw-bold text-primary">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </table>

                <h5 class="mt-4">Daftar Buku</h5>
                <ul class="list-group">
                    @foreach($transaction->details as $detail)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $detail->book->title }}
                        <span class="badge bg-primary rounded-pill">{{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Informasi Pembayaran
            </div>
            <div class="card-body">
                <form action="{{ route('payments.store', $transaction) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="bankTransfer" value="bank_transfer" checked>
                                <label class="form-check-label" for="bankTransfer">
                                    Transfer Bank
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="qris" value="qris">
                                <label class="form-check-label" for="qris">
                                    QRIS
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rekening Tujuan</label>
                        <select class="form-select" disabled>
                            <option>BCA - 1234567890 (Bookstore)</option>
                            <option>Mandiri - 0987654321 (Bookstore)</option>
                            <option>BRI - 1122334455 (Bookstore)</option>
                        </select>
                        <small class="text-muted">Pilih metode pembayaran untuk melihat detail</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Unggah Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="proof" required>
                        <div class="form-text">Format: JPG/PNG, maks 2MB</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        <i class="bi bi-check-circle me-1"></i> Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
