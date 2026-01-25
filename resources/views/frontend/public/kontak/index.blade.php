@extends('frontend.layout.app')

@section('title', 'Hubungi Kami - STOURSYS')

@section('content')
    <!-- Header - Horizontal Layout -->
    <section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <!-- Left Side -->
                <div class="flex-1">
                    <div class="inline-block mb-3 px-4 py-2 bg-orange-100 rounded-full border border-orange-200">
                        <span class="text-orange-600 text-sm font-semibold">Kontak & Dukungan</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Hubungi <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Kami</span>
                    </h1>
                </div>
                
                <!-- Right Side -->
                <div class="flex-shrink-0 md:max-w-md">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Ada pertanyaan atau saran? Kami siap membantu Anda. Silakan hubungi kami melalui formulir di bawah ini
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200/50">
                <div class="p-8 md:p-12">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl p-6 flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-bold text-slate-900 mb-2">
                                Nama Lengkap <span class="text-orange-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nama" 
                                id="nama" 
                                required
                                value="{{ old('nama') }}"
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/20 transition-all duration-300 placeholder:text-gray-400"
                                placeholder="Masukkan nama lengkap Anda"
                            >
                            @error('nama')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-900 mb-2">
                                Email <span class="text-orange-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required
                                value="{{ old('email') }}"
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/20 transition-all duration-300 placeholder:text-gray-400"
                                placeholder="nama@email.com"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Subjek -->
                        <div>
                            <label for="subjek" class="block text-sm font-bold text-slate-900 mb-2">
                                Subjek
                            </label>
                            <input 
                                type="text" 
                                name="subjek" 
                                id="subjek"
                                value="{{ old('subjek') }}"
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/20 transition-all duration-300 placeholder:text-gray-400"
                                placeholder="Topik pesan Anda"
                            >
                            @error('subjek')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Pesan -->
                        <div>
                            <label for="pesan" class="block text-sm font-bold text-slate-900 mb-2">
                                Pesan <span class="text-orange-500">*</span>
                            </label>
                            <textarea 
                                name="pesan" 
                                id="pesan" 
                                rows="6" 
                                required
                                class="block w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/20 transition-all duration-300 placeholder:text-gray-400 resize-none"
                                placeholder="Tulis pesan Anda di sini..."
                            >{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button 
                                type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group"
                            >
                                <span>Kirim Pesan</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    Atau hubungi kami melalui email di 
                    <a href="mailto:info@stoursys.com" class="text-orange-600 hover:text-orange-700 font-semibold hover:underline">
                        info@stoursys.com
                    </a>
                </p>
            </div>
        </div>
    </section>
@endsection