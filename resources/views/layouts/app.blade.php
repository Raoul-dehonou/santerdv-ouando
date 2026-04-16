<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Centre Santé Ouando') }} - @yield('title')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
        
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(10px); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        .animate-fade-out {
            animation: fadeOut 0.3s ease-in;
        }
        
        /* Loader global */
        .global-loader {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }
        
        .global-loader.active {
            display: flex;
        }
        
        .loader-content {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            animation: fadeIn 0.3s ease-out;
        }
        
        .loader-spinner {
            width: 48px;
            height: 48px;
            border: 3px solid #e5e7eb;
            border-bottom-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
            transition: background 0.2s;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
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
            transition: all 0.2s ease;
        }
        
        .logout-btn:hover {
            background: rgba(220, 38, 38, 0.25) !important;
            border-color: rgba(220, 38, 38, 0.5);
            transform: translateX(4px);
        }
        
        .logout-btn i, .logout-btn span {
            color: #f87171 !important;
            transition: all 0.2s ease;
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
            backdrop-filter: blur(2px);
            z-index: 35;
            display: none;
        }
        
        .sidebar-overlay.active {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }
        
        /* Transition pour le contenu principal */
        .main-content {
            transition: margin-left 0.3s ease;
        }
        
        /* Notifications toast */
        .toast-notification {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 10000;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: fadeIn 0.3s ease-out;
            pointer-events: none;
        }
        
        .toast-success {
            background: var(--success);
            color: white;
        }
        
        .toast-error {
            background: var(--danger);
            color: white;
        }
        
        .toast-info {
            background: var(--info);
            color: white;
        }
        
        .toast-warning {
            background: var(--secondary);
            color: white;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100">
    
    <!-- Global Loader -->
    <div id="globalLoader" class="global-loader">
        <div class="loader-content">
            <div class="loader-spinner"></div>
            <p class="text-gray-600">Chargement en cours...</p>
        </div>
    </div>
    
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
                        <h1 class="text-xl font-bold text-white">Ouando<span class="text-[#F59E0B]">Santé</span></h1>
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
    <div class="md:ml-72 main-content">
        <!-- Topbar -->
        <nav class="bg-white/80 backdrop-blur-sm shadow-sm border-b sticky top-0 z-30">
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
                    <button id="notificationsBtn" class="relative text-gray-600 hover:text-primary transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span id="notifBadge" class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
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
        // ============================================
        // SIDEBAR FUNCTIONS
        // ============================================
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
        
        // ============================================
        // USER DROPDOWN
        // ============================================
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
        
        // ============================================
        // GLOBAL LOADER FUNCTIONS
        // ============================================
        window.showLoader = function() {
            const loader = document.getElementById('globalLoader');
            if (loader) loader.classList.add('active');
        };
        
        window.hideLoader = function() {
            const loader = document.getElementById('globalLoader');
            if (loader) loader.classList.remove('active');
        };
        
        // ============================================
        // NOTIFICATION SYSTEM
        // ============================================
        window.showToast = function(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast-notification toast-${type}`;
            
            let icon = '';
            switch(type) {
                case 'success': icon = '<i class="fas fa-check-circle"></i>'; break;
                case 'error': icon = '<i class="fas fa-exclamation-circle"></i>'; break;
                case 'warning': icon = '<i class="fas fa-exclamation-triangle"></i>'; break;
                case 'info': icon = '<i class="fas fa-info-circle"></i>'; break;
            }
            
            toast.innerHTML = `${icon} <span>${message}</span>`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'fadeOut 0.3s ease-in';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        };
        
        // ============================================
        // SWEET ALERT CONFIRMATION
        // ============================================
        window.confirmAction = function(title, text, confirmText = 'Confirmer', cancelText = 'Annuler') {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0B5E42',
                cancelButtonColor: '#DC2626',
                confirmButtonText: confirmText,
                cancelButtonText: cancelText
            });
        };
        
        // ============================================
        // NOTIFICATION CLICK (demo)
        // ============================================
        const notifBtn = document.getElementById('notificationsBtn');
        if (notifBtn) {
            notifBtn.addEventListener('click', () => {
                showToast('Aucune nouvelle notification', 'info');
            });
        }
        
        // ============================================
        // AUTO-HIDE FLASH MESSAGES
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(msg => {
                setTimeout(() => {
                    msg.style.animation = 'fadeOut 0.3s ease-in';
                    setTimeout(() => msg.remove(), 300);
                }, 5000);
            });
        });
    </script>
</body>
</html>