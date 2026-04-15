<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Centre Santé Ouando') }} - @yield('title')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Couleurs personnalisables */
        :root {
            --primary: #0B5E42;
            --primary-dark: #074231;
            --primary-light: #2D8C6A;
            --secondary: #F59E0B;
            --danger: #DC2626;
            --success: #10B981;
            --info: #3B82F6;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
        }
        
        /* Sidebar link active */
        .sidebar-link-active {
            background: rgba(255, 255, 255, 0.15) !important;
            color: white !important;
            border-right: 3px solid var(--secondary);
        }
        
        .sidebar-link-active i {
            color: white !important;
        }
        
        /* Bouton déconnexion spécifique */
        .logout-btn {
            background: rgba(220, 38, 38, 0.15) !important;
            border: 1px solid rgba(220, 38, 38, 0.3);
        }
        
        .logout-btn:hover {
            background: rgba(220, 38, 38, 0.25) !important;
            border-color: rgba(220, 38, 38, 0.5);
        }
        
        .logout-btn i, .logout-btn span {
            color: #f87171 !important;
        }
        
        .logout-btn:hover i, .logout-btn:hover span {
            color: #ef4444 !important;
        }
        
        /* Empêcher la sidebar de disparaître sur desktop */
        @media (min-width: 768px) {
            .sidebar-open {
                transform: translateX(0) !important;
            }
        }
        
        /* Overlay pour mobile quand sidebar est ouverte */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 35;
            display: none;
        }
        
        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    
    <!-- Overlay pour mobile -->
    <div id="sidebar-overlay" class="sidebar-overlay" onclick="closeSidebar()"></div>
    
    <!-- Sidebar colorée -->
    <aside id="sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen bg-gradient-to-br from-[#0B5E42] to-[#074231] shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0">
        <div class="h-full flex flex-col">
            
            <!-- Logo -->
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center shadow-lg">
                        <i class="fas fa-hospital-user text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">Santé<span class="text-[#F59E0B]">RDV</span></h1>
                        <p class="text-xs text-white/70">Centre Médical</p>
                    </div>
                </div>
            </div>
            
            <!-- Menu selon rôle -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="font-medium">Dashboard</span>
                    @if(request()->routeIs('admin.dashboard'))
                    <i class="fas fa-circle text-xs ml-auto text-[#F59E0B]"></i>
                    @endif
                </a>
                
                <a href="{{ route('admin.patients.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.patients.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-users w-5"></i>
                    <span class="font-medium">Patients</span>
                    @if(request()->routeIs('admin.patients.*'))
                    <i class="fas fa-circle text-xs ml-auto text-[#F59E0B]"></i>
                    @endif
                </a>
                
                <a href="{{ route('admin.medecins.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.medecins.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-user-md w-5"></i>
                    <span class="font-medium">Médecins</span>
                    @if(request()->routeIs('admin.medecins.*'))
                    <i class="fas fa-circle text-xs ml-auto text-[#F59E0B]"></i>
                    @endif
                </a>
                
                <a href="{{ route('admin.rendez-vous.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.rendez-vous.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span class="font-medium">Rendez-vous</span>
                    @if(request()->routeIs('admin.rendez-vous.*'))
                    <i class="fas fa-circle text-xs ml-auto text-[#F59E0B]"></i>
                    @endif
                </a>
                
                <a href="{{ route('admin.consultations.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.consultations.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-notes-medical w-5"></i>
                    <span class="font-medium">Consultations</span>
                    @if(request()->routeIs('admin.consultations.*'))
                    <i class="fas fa-circle text-xs ml-auto text-[#F59E0B]"></i>
                    @endif
                </a>
                
                <a href="{{ route('admin.statistiques.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.statistiques.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span class="font-medium">Statistiques</span>
                    @if(request()->routeIs('admin.statistiques.*'))
                    <i class="fas fa-circle text-xs ml-auto text-[#F59E0B]"></i>
                    @endif
                </a>
                
                @elseif(Auth::user()->role === 'medecin')
                <a href="{{ route('medecin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('medecin.dashboard') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('medecin.rendez-vous.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('medecin.rendez-vous.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span class="font-medium">Mes Rendez-vous</span>
                </a>
                
                <a href="{{ route('medecin.patients.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('medecin.patients.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-users w-5"></i>
                    <span class="font-medium">Mes Patients</span>
                </a>
                
                @elseif(Auth::user()->role === 'patient')
                <a href="{{ route('patient.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('patient.dashboard') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('patient.rendez-vous.create') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group"
                   onclick="closeSidebar()">
                    <i class="fas fa-calendar-plus w-5"></i>
                    <span class="font-medium">Prendre RDV</span>
                </a>
                
                <a href="{{ route('patient.rendez-vous.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('patient.rendez-vous.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span class="font-medium">Mes RDV</span>
                </a>
                
                <a href="{{ route('patient.dossier.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition-all duration-200 group {{ request()->routeIs('patient.dossier.*') ? 'sidebar-link-active' : '' }}"
                   onclick="closeSidebar()">
                    <i class="fas fa-folder-medical w-5"></i>
                    <span class="font-medium">Mon Dossier</span>
                </a>
                @endif
            </nav>
            
            <!-- Déconnexion - style différent -->
            <div class="p-4 border-t border-white/20">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn flex items-center gap-3 w-full px-4 py-3 rounded-xl transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="font-medium">Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>
    
    <!-- Main content -->
    <div class="md:ml-72">
        <!-- Topbar -->
        <nav class="bg-white shadow-sm border-b sticky top-0 z-30">
            <div class="px-4 sm:px-6 py-4 flex justify-between items-center">
                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="md:hidden text-gray-600 hover:text-primary transition-colors focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                
                <!-- Page title -->
                <h1 class="text-lg sm:text-xl font-bold bg-gradient-to-r from-[#0B5E42] to-[#2D8C6A] bg-clip-text text-transparent">
                    @yield('header', 'Dashboard')
                </h1>
                
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <button class="relative text-gray-600 hover:text-primary transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                    
                    <!-- User menu -->
                    <div class="relative">
                        <button id="user-menu-btn" class="flex items-center space-x-3 focus:outline-none group">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-primary capitalize">{{ Auth::user()->role }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#0B5E42] to-[#074231] flex items-center justify-center text-white font-bold shadow-md">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-500 group-hover:text-primary transition-colors"></i>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border z-50 animate-fade-in">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-primary/10 hover:text-primary transition-colors rounded-t-xl">
                                <i class="fas fa-user-circle w-5 text-primary"></i>
                                <span>Mon Profil</span>
                            </a>
                            <hr class="my-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-red-600 hover:bg-red-50 transition-colors rounded-b-xl">
                                    <i class="fas fa-sign-out-alt w-5"></i>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <main class="p-4 sm:p-6">
            @yield('content')
        </main>
    </div>
    
    <script>
        // Mobile menu toggle
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        if (mobileBtn) {
            mobileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (sidebar.classList.contains('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });
        }
        
        // User dropdown toggle
        const userBtn = document.getElementById('user-menu-btn');
        const userDropdown = document.getElementById('user-dropdown');
        
        if (userBtn) {
            userBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
            
            document.addEventListener('click', () => {
                userDropdown.classList.add('hidden');
            });
        }
        
        // Fermer la sidebar quand on clique sur un lien (mobile)
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    closeSidebar();
                }
            });
        });
        
        // Fermer la sidebar en appuyant sur Echap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && window.innerWidth < 768) {
                closeSidebar();
            }
        });
    </script>
</body>
</html>