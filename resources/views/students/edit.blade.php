@extends('layouts.app')

@section('title', 'Edit Student Record - StudentMS')

@section('content')
<div class="max-w-2xl mx-auto animate-fade-in space-y-6">
    <!-- Breadcrumbs / Back button -->
    <div>
        <a href="{{ route('students.index') }}" class="inline-flex items-center gap-2 text-sm text-indigo-400 hover:text-indigo-300 font-semibold group transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Dashboard
        </a>
    </div>

    <!-- Registration Panel Card -->
    <div class="glass-card rounded-3xl overflow-hidden shadow-xl border border-slate-800">
        <!-- Form Header -->
        <div class="px-8 py-6 bg-slate-900/40 border-b border-slate-800/80">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center border border-indigo-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Edit Student Record</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Modify the information for <span class="font-bold text-indigo-300">{{ $student->name }}</span> below.</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form method="POST" action="{{ route('students.update', $student->id) }}" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Input Field -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-semibold text-slate-300">
                    Full Name <span class="text-indigo-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" placeholder="John Doe" required class="w-full pl-10 pr-4 py-3 rounded-xl input-glass text-sm focus:ring-2 focus:ring-indigo-500/20 @error('name') border-rose-500/80 focus:border-rose-500 @enderror" />
                </div>
                @error('name')
                    <p class="text-xs font-semibold text-rose-400 flex items-center gap-1.5 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email Input Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold text-slate-300">
                    Email Address <span class="text-indigo-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" placeholder="john.doe@example.com" required class="w-full pl-10 pr-4 py-3 rounded-xl input-glass text-sm focus:ring-2 focus:ring-indigo-500/20 @error('email') border-rose-500/80 focus:border-rose-500 @enderror" />
                </div>
                @error('email')
                    <p class="text-xs font-semibold text-rose-400 flex items-center gap-1.5 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Age Input Field -->
            <div class="space-y-2">
                <label for="age" class="block text-sm font-semibold text-slate-300">
                    Age <span class="text-indigo-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <input type="number" name="age" id="age" value="{{ old('age', $student->age) }}" min="5" max="120" placeholder="21" required class="w-full pl-10 pr-4 py-3 rounded-xl input-glass text-sm focus:ring-2 focus:ring-indigo-500/20 @error('age') border-rose-500/80 focus:border-rose-500 @enderror" />
                </div>
                @error('age')
                    <p class="text-xs font-semibold text-rose-400 flex items-center gap-1.5 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Form Actions Button panel -->
            <div class="flex flex-col sm:flex-row items-center gap-4 pt-4 border-t border-slate-800/80">
                <a href="{{ route('students.index') }}" class="w-full sm:w-auto text-center py-3 px-6 rounded-xl border border-slate-700 bg-slate-800 hover:bg-slate-700 text-sm font-semibold text-slate-300 hover:text-white transition-all duration-200 focus:outline-none">
                    Cancel
                </a>
                <button type="submit" class="w-full sm:flex-grow py-3 px-6 rounded-xl bg-indigo-600 hover:bg-indigo-500 hover:shadow-indigo-500/20 text-sm font-semibold text-white shadow-lg transition-all duration-200 focus:outline-none">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
