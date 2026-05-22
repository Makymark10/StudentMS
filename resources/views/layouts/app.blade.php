<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'StudentMS - Student Management System')</title>
    <!-- icon image from the internet source  -->
     <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS & Vite -->
    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #020617 100%);
            background-attachment: fixed;
        }
        
        .glass-panel {
            background: rgba(30, 41, 59, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 10px 30px 0 rgba(99, 102, 241, 0.15);
            transform: translateY(-2px);
        }

        .input-glass {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
            transition: all 0.3s ease;
        }

        .input-glass:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
            outline: none;
        }

        /* Ambient light blobs */
        .blob {
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.15;
            pointer-events: none;
            animation: float 20s infinite alternate;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(100px, 50px) scale(1.2); }
        }
    </style>
</head>
<body class="text-slate-100 min-h-full flex flex-col antialiased">
    <!-- Background Glow Blobs -->
    <div class="blob bg-indigo-600 top-[-10%] left-[-10%]"></div>
    <div class="blob bg-purple-600 bottom-[-10%] right-[-10%]"></div>
    <div class="blob bg-pink-600 top-[40%] right-[15%]"></div>

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 w-full glass-panel border-b border-slate-800/60 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('students.index') }}" class="flex items-center gap-2 group">
                        <div class="bg-indigo-600 group-hover:bg-indigo-500 text-white p-2 rounded-xl shadow-lg transition-all duration-300 transform group-hover:rotate-6">
                            <!-- Graduation Cap Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14v7" />
                            </svg>
                        </div>
                        <span class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-white via-slate-100 to-indigo-300 bg-clip-text text-transparent group-hover:text-indigo-300 transition-colors">
                            StudentMS
                        </span>
                    </a>
                </div>

                <!-- Nav Links -->
                <!-- <nav class="flex items-center gap-4">
                    <span class="text-xs uppercase tracking-widest font-semibold px-2.5 py-1 rounded-full bg-slate-800 text-slate-400 border border-slate-700/50">
                        Midterm Project
                    </span>
                </nav> -->
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <!-- Toast / Alert Notification -->
        @if(session('success'))
            <div id="success-alert" class="mb-6 flex items-center justify-between p-4 rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-300 shadow-lg shadow-emerald-950/20 backdrop-blur-md transition-all duration-500 ease-out transform translate-y-0 opacity-100">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
                <button onclick="dismissAlert('success-alert')" class="text-emerald-400 hover:text-emerald-100 transition-colors duration-200 ml-4 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Premium Designed Footer -->
    <footer class="w-full mt-16 glass-panel border-t border-slate-800/60 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center border-b border-slate-800/40 pb-8">
                <!-- Branding/Intro -->
                <div class="space-y-3 text-left">
                    <div class="flex items-center gap-2.5">
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-2 rounded-xl shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold tracking-tight bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent">
                            StudentMS
                        </span>
                    </div>
                    <p class="text-sm text-slate-400 max-w-sm leading-relaxed">
                        A state-of-the-art Student Management System crafted for seamless administrative control, analytics, and record keeping.
                    </p>
                </div>

                <!-- Proponents -->
                <div class="space-y-4 text-left md:text-right">
                    <h3 class="text-xs uppercase tracking-widest font-semibold text-slate-400">
                        Project Proponents
                    </h3>
                    <div class="flex flex-wrap md:justify-end gap-2.5">
                        <!-- Mark Joero -->
                        <div class="flex items-center gap-2 bg-slate-900/40 hover:bg-slate-800/60 border border-slate-800 hover:border-indigo-500/50 px-3.5 py-1.5 rounded-full transition-all duration-300 shadow-md group cursor-default">
                            <span class="w-2 h-2 rounded-full bg-indigo-500 group-hover:scale-125 transition-transform"></span>
                            <span class="text-xs font-semibold text-slate-300 group-hover:text-white">Mark Joero</span>
                        </div>
                        <!-- Kevin Cancino -->
                        <div class="flex items-center gap-2 bg-slate-900/40 hover:bg-slate-800/60 border border-slate-800 hover:border-purple-500/50 px-3.5 py-1.5 rounded-full transition-all duration-300 shadow-md group cursor-default">
                            <span class="w-2 h-2 rounded-full bg-purple-500 group-hover:scale-125 transition-transform"></span>
                            <span class="text-xs font-semibold text-slate-300 group-hover:text-white">Kevin Cancino</span>
                        </div>
                        <!-- Mary Parana -->
                        <div class="flex items-center gap-2 bg-slate-900/40 hover:bg-slate-800/60 border border-slate-800 hover:border-pink-500/50 px-3.5 py-1.5 rounded-full transition-all duration-300 shadow-md group cursor-default">
                            <span class="w-2 h-2 rounded-full bg-pink-500 group-hover:scale-125 transition-transform"></span>
                            <span class="text-xs font-semibold text-slate-300 group-hover:text-white">Mary Parana</span>
                        </div>
                        <!-- Aice Ruetas -->
                        <div class="flex items-center gap-2 bg-slate-900/40 hover:bg-slate-800/60 border border-slate-800 hover:border-emerald-500/50 px-3.5 py-1.5 rounded-full transition-all duration-300 shadow-md group cursor-default">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 group-hover:scale-125 transition-transform"></span>
                            <span class="text-xs font-semibold text-slate-300 group-hover:text-white">Aice Ruetas</span>
                        </div>
                        <!-- Lawrence Collado -->
                        <div class="flex items-center gap-2 bg-slate-900/40 hover:bg-slate-800/60 border border-slate-800 hover:border-sky-500/50 px-3.5 py-1.5 rounded-full transition-all duration-300 shadow-md group cursor-default">
                            <span class="w-2 h-2 rounded-full bg-sky-500 group-hover:scale-125 transition-transform"></span>
                            <span class="text-xs font-semibold text-slate-300 group-hover:text-white">Lawrence Collado</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Stack -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; 2026 Student Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Dismiss Alerts Automatically
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                dismissAlert('success-alert');
            }
        }, 5000);

        function dismissAlert(id) {
            const alert = document.getElementById(id);
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
