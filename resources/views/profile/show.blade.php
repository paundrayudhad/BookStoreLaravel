@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Profil Saya</h1>
            <p class="text-gray-600">Kelola informasi profil dan pengaturan akun Anda</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="user" class="h-10 w-10 text-blue-500"></i>
                        </div>
                        <h3 class="font-semibold text-lg">{{ Auth::user()->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                    </div>

                    <nav class="space-y-2">
                        <a href="{{ route('profile.show') }}" class="flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg">
                            <i data-lucide="user" class="h-4 w-4 mr-3"></i>
                            Informasi Profil
                        </a>
                        <a href="{{ route('transactions.index') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i data-lucide="shopping-bag" class="h-4 w-4 mr-3"></i>
                            Riwayat Pembelian
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Transaksi</span>
                        <span class="font-semibold text-gray-900">{{ Auth::user()->transactions->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Buku Dibeli</span>
                        <span class="font-semibold text-gray-900">
                            {{ Auth::user()->transactions->where('status', 'completed')->sum(function($transaction) {
                                return $transaction->details->sum('quantity');
                            }) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Belanja</span>
                        <span class="font-semibold text-blue-600">
                            Rp {{ number_format(Auth::user()->transactions->where('status', 'completed')->sum('total_amount'), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

                <!-- Change Password Section -->
                <div class="bg-white rounded-lg shadow-md mt-6">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-semibold">Ubah Password</h2>
                        <p class="text-gray-600 text-sm">Pastikan akun Anda menggunakan password yang kuat</p>
                    </div>

                    <div class="p-6">
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input
                                    type="text"
                                    id="name"
                                    value="{{ Auth::user()->name }}"
                                    name="name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                    required
                                >
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('current_password') border-red-500 @enderror"
                                    required
                                >
                                @error('current_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                                        required
                                    >
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                    Ubah Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
@endsection
