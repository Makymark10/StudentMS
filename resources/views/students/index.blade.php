@extends('layouts.app')

@section('title', 'Student Dashboard - StudentMS')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Dashboard Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight bg-gradient-to-r from-white via-slate-100 to-indigo-300 bg-clip-text text-transparent">
                Student Database Dashboard
            </h1>
            <p class="text-slate-400 mt-1 text-sm">
                Manage and view registered student records, check details, and execute administrative actions.
            </p>
        </div>
        <a href="{{ route('students.create') }}" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 hover:shadow-indigo-500/20 text-white font-semibold px-5 py-3 rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Register Student
        </a>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <!-- Stat Card 1 -->
        <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold tracking-wider text-indigo-400 uppercase">Total Students</span>
                <h3 class="text-3xl font-extrabold text-white mt-1">{{ $students->count() }}</h3>
            </div>
            <div class="bg-indigo-500/10 text-indigo-400 p-3.5 rounded-xl border border-indigo-500/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold tracking-wider text-purple-400 uppercase">Average Student Age</span>
                <h3 class="text-3xl font-extrabold text-white mt-1">
                    {{ $students->count() > 0 ? round($students->avg('age'), 1) : 0 }} <span class="text-lg font-medium text-slate-400">yrs</span>
                </h3>
            </div>
            <div class="bg-purple-500/10 text-purple-400 p-3.5 rounded-xl border border-purple-500/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                </svg>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="glass-card p-6 rounded-2xl flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold tracking-wider text-pink-400 uppercase">Age Distribution</span>
                <h3 class="text-lg font-extrabold text-white mt-2">
                    @if($students->count() > 0)
                        {{ $students->min('age') }} <span class="text-xs font-normal text-slate-400">Min</span>
                        <span class="text-slate-600 mx-2">|</span>
                        {{ $students->max('age') }} <span class="text-xs font-normal text-slate-400">Max</span>
                    @else
                        N/A
                    @endif
                </h3>
            </div>
            <div class="bg-pink-500/10 text-pink-400 p-3.5 rounded-xl border border-pink-500/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Table Controller & Database Panel -->
    <div class="glass-card rounded-3xl overflow-hidden">
        <!-- Panel Header & Search Bar -->
        <div class="p-6 border-b border-slate-800/80 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span>Registered Students</span>
                <span class="text-xs px-2.5 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 font-medium">
                    {{ $students->count() }} active
                </span>
            </h2>
            
            <!-- Real-time Filter Search -->
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" id="table-search" onkeyup="filterStudentsTable()" placeholder="Search name or email..." class="w-full pl-10 pr-4 py-2.5 rounded-xl input-glass text-sm focus:ring-2 focus:ring-indigo-500/20" />
            </div>
        </div>

        <!-- Student Database Table -->
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse" id="students-table">
                <thead>
                    <tr class="border-b border-slate-800 text-xs font-semibold uppercase tracking-wider text-slate-400 bg-slate-900/35">
                        <th class="px-6 py-4">Student</th>
                        <th class="px-6 py-4">Email Address</th>
                        <th class="px-6 py-4">Age</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-800/25 transition-colors duration-150 group student-row">
                            <!-- Name / Student Column -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 text-white font-extrabold text-sm flex items-center justify-center shadow-md">
                                        {{ strtoupper(substr($student->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-white group-hover:text-indigo-300 transition-colors duration-150 student-name">
                                            {{ $student->name }}
                                        </div>
                                        <div class="text-xs text-slate-400">
                                            ID: #STU-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <!-- Email Column -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-300 font-medium student-email">
                                    {{ $student->email }}
                                </div>
                            </td>
                            <!-- Age Column -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-slate-800 text-slate-300 border border-slate-700/60">
                                    {{ $student->age }} yrs
                                </span>
                            </td>
                            <!-- Actions Column -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3">
                                    <!-- Edit Button -->
                                    <a href="{{ route('students.edit', $student->id) }}" class="inline-flex items-center justify-center p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700/40 transition-all duration-150" title="Edit Student Record">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <!-- Delete Trigger Button -->
                                    <button type="button" onclick="confirmDelete({{ $student->id }}, '{{ addslashes($student->name) }}')" class="inline-flex items-center justify-center p-2 rounded-lg bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white border border-rose-500/20 transition-all duration-150 focus:outline-none" title="Delete Student Record">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty-row">
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-16 w-16 rounded-full bg-slate-800/40 text-slate-400 flex items-center justify-center border border-slate-700/30 mb-4 animate-bounce">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-bold text-white">No Students Registered</h4>
                                    <p class="text-sm text-slate-400 mt-1 max-w-sm">The database is currently empty. Click the button above to add the first student to the system.</p>
                                    <a href="{{ route('students.create') }}" class="mt-4 text-xs font-semibold bg-indigo-600/20 hover:bg-indigo-600 text-indigo-300 hover:text-white px-4 py-2.5 rounded-xl border border-indigo-500/20 transition-all duration-200">
                                        Register New Student Now
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Premium Confirmation Delete Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="glass-card max-w-md w-full rounded-3xl p-6 border border-slate-800 shadow-2xl transform scale-95 transition-transform duration-300">
        <!-- Warning Icon badge -->
        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <h3 class="text-xl font-bold text-center text-white mb-2">Delete Student Record?</h3>
        <p class="text-sm text-center text-slate-400 mb-6">
            Are you sure you want to permanently remove <span id="modal-student-name" class="font-bold text-slate-200">this student</span>? This administrative action cannot be undone.
        </p>

        <!-- Actions -->
        <div class="flex gap-4">
            <button type="button" onclick="closeDeleteModal()" class="flex-1 py-3 px-4 rounded-xl border border-slate-700 bg-slate-800 hover:bg-slate-700 text-sm font-semibold text-slate-300 hover:text-white transition-all duration-200 focus:outline-none">
                Cancel
            </button>
            <form id="delete-form" method="POST" action="" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-3 px-4 rounded-xl bg-rose-600 hover:bg-rose-500 hover:shadow-rose-600/20 text-sm font-semibold text-white shadow-lg transition-all duration-200 focus:outline-none">
                    Confirm Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Real-time table searching logic (filters columns live)
    function filterStudentsTable() {
        const input = document.getElementById('table-search');
        const filter = input.value.toLowerCase().trim();
        const rows = document.getElementsByClassName('student-row');
        const emptyRow = document.getElementById('empty-row');
        let visibleCount = 0;

        for (let i = 0; i < rows.length; i++) {
            const nameEl = rows[i].querySelector('.student-name');
            const emailEl = rows[i].querySelector('.student-email');
            
            const nameText = nameEl ? nameEl.textContent.toLowerCase() : '';
            const emailText = emailEl ? emailEl.textContent.toLowerCase() : '';

            if (nameText.includes(filter) || emailText.includes(filter)) {
                rows[i].style.display = "";
                visibleCount++;
            } else {
                rows[i].style.display = "none";
            }
        }

        // Show/hide empty state message dynamically if filtered table ends up with zero matches
        const existingNoResultsRow = document.getElementById('no-results-row');
        if (visibleCount === 0 && rows.length > 0) {
            if (!existingNoResultsRow) {
                const tbody = document.querySelector('#students-table tbody');
                const tr = document.createElement('tr');
                tr.id = 'no-results-row';
                tr.innerHTML = `
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-semibold block text-white text-sm">No students match your search</span>
                        <span class="text-xs">Double check spelling or try a different search keyword</span>
                    </td>
                `;
                tbody.appendChild(tr);
            }
        } else {
            if (existingNoResultsRow) {
                existingNoResultsRow.remove();
            }
        }
    }

    // Modal Control Logic
    function confirmDelete(id, name) {
        const modal = document.getElementById('delete-modal');
        const modalContainer = modal.firstElementChild;
        const nameDisplay = document.getElementById('modal-student-name');
        const form = document.getElementById('delete-form');

        nameDisplay.textContent = name;
        form.action = `/students/${id}`;

        // Enable styling animations
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modalContainer.classList.remove('scale-95');
        modalContainer.classList.add('scale-100');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        const modalContainer = modal.firstElementChild;

        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContainer.classList.remove('scale-100');
        modalContainer.classList.add('scale-95');
    }

    // Close Modal on clicking outside the card
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('delete-modal');
        if (e.target === modal) {
            closeDeleteModal();
        }
    });
</script>
@endsection
