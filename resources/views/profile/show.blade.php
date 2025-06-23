@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Profil Saya</h1>
        <p class="text-gray-600">Kelola informasi profil dan akun Anda</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Info -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Informasi Profil</h2>
                    <button onclick="showEditForm()" class="text-blue-600 hover:text-blue-800 font-medium">
                        Edit Profil
                    </button>
                </div>

                <!-- Profile Display -->
                <div id="profile-display" class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div class="h-20 w-20 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-600">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <p class="text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900">{{ Auth::user()->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bergabung Sejak</label>
                            <p class="text-gray-900">{{ Auth::user()->created_at->format('d F Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Akun</label>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Edit Form (Hidden by default) -->
                <div id="profile-edit" class="hidden">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Profile Picture -->
                            <div class="flex items-center space-x-6">
                                <div class="h-20 w-20 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-2xl font-bold text-blue-600">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Foto Profil</h3>
                                    <p class="text-sm text-gray-500">Fitur upload foto akan segera tersedia</p>
                                </div>
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Current Password -->
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password Saat Ini
                                </label>
                                <input type="password" name="current_password" id="current_password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('current_password') border-red-300 @enderror"
                                       placeholder="Masukkan password saat ini untuk konfirmasi">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password Baru (Opsional)
                                </label>
                                <input type="password" name="password" id="password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-300 @enderror"
                                       placeholder="Kosongkan jika tidak ingin mengubah password">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Konfirmasi Password Baru
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Konfirmasi password baru">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex items-center justify-between">
                            <button type="button" onclick="hideEditForm()"
                                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg font-medium transition duration-150 ease-in-out">
                                Batal
                            </button>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg font-medium transition duration-150 ease-in-out">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="space-y-6">
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

            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('home') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium text-center transition duration-150 ease-in-out">
                        Jelajahi Buku
                    </a>
                    <a href="{{ route('transactions.index') }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg font-medium text-center transition duration-150 ease-in-out">
                        Riwayat Transaksi
                    </a>
                    <a href="{{ route('cart.index') }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg font-medium text-center transition duration-150 ease-in-out">
                        Keranjang Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showEditForm() {
    document.getElementById('profile-display').classList.add('hidden');
    document.getElementById('profile-edit').classList.remove('hidden');
}

function hideEditForm() {
    document.getElementById('profile-display').classList.remove('hidden');
    document.getElementById('profile-edit').classList.add('hidden');
}
</script>
@endsection
