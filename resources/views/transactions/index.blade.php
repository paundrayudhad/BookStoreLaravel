<!-- resources/views/transactions/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold">Transaksi Saya</h1>
</div>

@if($transactions->count() > 0)
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>#{{ $transaction->id }}</td>
                    <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
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
                    <td>
                        <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-receipt text-muted" style="font-size: 4rem;"></i>
        <h3 class="mt-3">Belum Ada Transaksi</h3>
        <p class="text-muted">Anda belum melakukan transaksi apapun</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
    </div>
</div>
@endif

<div class="d-flex justify-content-center mt-4">
    {{ $transactions->links() }}
</div>
@endsection
