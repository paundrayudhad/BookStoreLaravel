<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="fw-bold">Profil Saya</h1>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle" style="font-size: 5rem;"></i>
                </div>
                <h4>{{ Auth::user()->name }}</h4>
                <p class="text-muted">{{ Auth::user()->email }}</p>
                <p>
                    <span class="badge bg-primary">
                        {{ Auth::user()->role == 'admin' ? 'Administrator' : 'User' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Informasi Profil
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <th>Bergabung Pada</th>
                        <td>{{ Auth::user()->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
                <div class="text-end">
                    <a href="{{ route('profile.show') }}" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
