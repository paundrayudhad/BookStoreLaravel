@extends('layouts.app')

@section('title', 'Masuk - SabaJayaPress')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <div class="mx-auto h-16 w-16 bg-orange-600 rounded-full flex items-center justify-center mb-4">
                <i data-lucide="book-open" class="h-8 w-8 text-white"></i>
            </div>
            <h1 class="text-2xl font-bold text-orange-600 mb-2">SabaJayaPress</h1>
            <h2 class="text-xl font-semibold text-gray-900 mb-2">Masuk ke Akun Anda</h2>
            <p class="text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-medium text-orange-600 hover:text-orange-500 transition-colors">
                    Daftar di sini
                </a>
            </p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            @if(session('status'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i data-lucide="mail" class="h-4 w-4 inline mr-1"></i>
                        Alamat Email
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        autocomplete="email" 
                        required
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 ring-2 ring-red-200 @enderror"
                        placeholder="Masukkan email Anda"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i data-lucide="alert-circle" class="h-4 w-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i data-lucide="lock" class="h-4 w-4 inline mr-1"></i>
                        Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 ring-2 ring-red-200 @enderror"
                            placeholder="Masukkan password Anda"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                        >
                            <i data-lucide="eye" class="h-5 w-5" id="password-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i data-lucide="alert-circle" class="h-4 w-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox"
                            {{ old('remember') ? 'checked' : '' }}
                            class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-orange-600 hover:text-orange-500 transition-colors">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                >
                    <i data-lucide="log-in" class="h-5 w-5"></i>
                    <span>Masuk</span>
                </button>
            </form>

            
        </div>

        <!-- Quick Access -->
        <div class="mt-6 bg-white rounded-lg shadow p-4">
            <h3 class="text-sm font-medium text-gray-900 mb-3">Akses Cepat</h3>
            <div class="grid grid-cols-2 gap-3 text-sm">
                <a href="{{ route('books.index') }}" class="flex items-center text-gray-600 hover:text-orange-600 transition-colors">
                    <i data-lucide="book" class="h-4 w-4 mr-2"></i>
                    Katalog Buku
                </a>
                <a href="{{ route('about') }}" class="flex items-center text-gray-600 hover:text-orange-600 transition-colors">
                    <i data-lucide="info" class="h-4 w-4 mr-2"></i>
                    Tentang Kami
                </a>
                <a href="{{ route('contact') }}" class="flex items-center text-gray-600 hover:text-orange-600 transition-colors">
                    <i data-lucide="phone" class="h-4 w-4 mr-2"></i>
                    Kontak
                </a>
                <a href="#" class="flex items-center text-gray-600 hover:text-orange-600 transition-colors">
                    <i data-lucide="help-circle" class="h-4 w-4 mr-2"></i>
                    Bantuan
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-xs text-gray-500">
                © 2024 SabaJayaPress. Semua hak dilindungi.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const eye = document.getElementById(fieldId + '-eye');
        
        if (field.type === 'password') {
            field.type = 'text';
            eye.setAttribute('data-lucide', 'eye-off');
        } else {
            field.type = 'password';
            eye.setAttribute('data-lucide', 'eye');
        }
        
        lucide.createIcons();
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection