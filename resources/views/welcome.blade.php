<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre de Santé Ouando - Excellence en soins de santé</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-60px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(60px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(2deg); }
        }
        
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(25px) rotate(-2deg); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        @keyframes rotateSlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animate-fadeInUp { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards; }
        .animate-fadeInLeft { animation: fadeInLeft 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards; }
        .animate-fadeInRight { animation: fadeInRight 0.8s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards; }
        .animate-zoomIn { animation: zoomIn 0.6s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards; }
        .animate-float { animation: float 8s ease-in-out infinite; }
        .animate-float-reverse { animation: floatReverse 8s ease-in-out infinite; }
        .animate-pulse-slow { animation: pulse 4s ease-in-out infinite; }
        .animate-rotate-slow { animation: rotateSlow 20s linear infinite; }
        .animate-bounce-slow { animation: bounce 3s ease-in-out infinite; }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }
        .delay-700 { animation-delay: 0.7s; }
        .delay-800 { animation-delay: 0.8s; }
        
        .bg-gradient-hero {
            background: linear-gradient(135deg, #0B5E42 0%, #074231 40%, #0a4e38 70%, #0B5E42 100%);
            background-size: 200% 200%;
            animation: gradientShift 10s ease infinite;
        }
        
        .bg-gradient-card {
            background: linear-gradient(135deg, rgba(11, 94, 66, 0.08) 0%, rgba(7, 66, 49, 0.03) 100%);
        }
        
        .bg-gradient-footer {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 100%);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #0B5E42 0%, #2D8C6A 50%, #F59E0B 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 200% auto;
            animation: gradientShift 5s ease infinite;
        }
        
        .hover-scale {
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        
        .hover-scale:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 30px 40px -20px rgba(0, 0, 0, 0.3);
        }
        
        .card-shine {
            position: relative;
            overflow: hidden;
        }
        
        .card-shine::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }
        
        .card-shine:hover::before {
            left: 100%;
        }
        
        .counter-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0B5E42, #F59E0B);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* Particles canvas */
        #particles-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #0B5E42;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #074231;
        }
    </style>
</head>
<body class="bg-gray-50 overflow-x-hidden">
    
    <!-- Canvas Particules -->
    <canvas id="particles-canvas"></canvas>
    
    <!-- Navbar sticky avec effet glassmorphism -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-500" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3 group cursor-pointer">
                    <div class="w-12 h-12 rounded-xl bg-gradient-hero flex items-center justify-center shadow-lg animate-bounce-slow">
                        <i class="fas fa-hospital-user text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Santé<span class="text-[#0B5E42]">RDV</span></span>
                        <p class="text-xs text-gray-500">Centre Médical d'Excellence</p>
                    </div>
                </div>
                
                <div class="hidden lg:flex space-x-10">
                    <a href="#accueil" class="text-gray-600 hover:text-[#0B5E42] transition-all duration-300 font-medium relative group">
                        Accueil
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#0B5E42] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#services" class="text-gray-600 hover:text-[#0B5E42] transition-all duration-300 font-medium relative group">
                        Services
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#0B5E42] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#specialites" class="text-gray-600 hover:text-[#0B5E42] transition-all duration-300 font-medium relative group">
                        Spécialités
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#0B5E42] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#medecins" class="text-gray-600 hover:text-[#0B5E42] transition-all duration-300 font-medium relative group">
                        Médecins
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#0B5E42] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#temoignages" class="text-gray-600 hover:text-[#0B5E42] transition-all duration-300 font-medium relative group">
                        Témoignages
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#0B5E42] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#contact" class="text-gray-600 hover:text-[#0B5E42] transition-all duration-300 font-medium relative group">
                        Contact
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#0B5E42] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('login') }}" class="px-5 py-2.5 border-2 border-[#0B5E42] text-[#0B5E42] rounded-xl font-semibold hover:bg-[#0B5E42] hover:text-white transition-all duration-300 hover:shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-hero text-white rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="fas fa-user-plus mr-2"></i>Inscription
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section id="accueil" class="min-h-screen bg-gradient-hero relative overflow-hidden pt-20">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-20 right-10 w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl animate-pulse-slow delay-500"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-white/10 rounded-full animate-rotate-slow"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] border border-white/5 rounded-full animate-rotate-slow" style="animation-direction: reverse;"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur rounded-full px-5 py-2 animate-fadeInUp">
                        <span class="w-2.5 h-2.5 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-white text-sm font-medium">🏥 Centre médical d'excellence</span>
                    </div>
                    
                    <h1 class="text-5xl lg:text-7xl font-bold text-white leading-tight animate-fadeInUp delay-100">
                        Votre santé,
                        <span class="text-gradient bg-white/20 bg-clip-text text-white">notre passion</span>
                    </h1>
                    
                    <p class="text-white/80 text-lg leading-relaxed animate-fadeInUp delay-200">
                        Prenez rendez-vous en ligne et suivez votre parcours de soins depuis chez vous. 
                        Une équipe dédiée à votre bien-être 24h/24 et 7j/7.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 animate-fadeInUp delay-300">
                        <a href="{{ route('register') }}" class="group px-8 py-4 bg-white text-[#0B5E42] rounded-xl font-bold hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-calendar-plus mr-2 group-hover:rotate-6 transition"></i>
                            Prendre rendez-vous
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                        </a>
                        <a href="#services" class="px-8 py-4 border-2 border-white/30 text-white rounded-xl font-bold hover:bg-white/10 transition-all duration-300">
                            <i class="fas fa-play-circle mr-2"></i>
                            Découvrir nos services
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/20 animate-fadeInUp delay-400">
                        <div class="text-center group cursor-pointer">
                            <div class="text-4xl font-bold text-white counter-number" data-target="10000">0</div>
                            <p class="text-white/70 text-sm mt-1 group-hover:text-white transition">Patients satisfaits</p>
                            <div class="w-0 h-0.5 bg-[#F59E0B] mx-auto mt-2 group-hover:w-full transition-all duration-300"></div>
                        </div>
                        <div class="text-center group cursor-pointer">
                            <div class="text-4xl font-bold text-white counter-number" data-target="15">0</div>
                            <p class="text-white/70 text-sm mt-1 group-hover:text-white transition">Médecins experts</p>
                            <div class="w-0 h-0.5 bg-[#F59E0B] mx-auto mt-2 group-hover:w-full transition-all duration-300"></div>
                        </div>
                        <div class="text-center group cursor-pointer">
                            <div class="text-4xl font-bold text-white counter-number" data-target="24">0</div>
                            <p class="text-white/70 text-sm mt-1 group-hover:text-white transition">Service disponible</p>
                            <div class="w-0 h-0.5 bg-[#F59E0B] mx-auto mt-2 group-hover:w-full transition-all duration-300"></div>
                        </div>
                    </div>
                </div>
                
                <div class="relative animate-float" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&h=550&fit=crop" alt="Doctor" class="w-full h-auto object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    </div>
                    
                    <!-- Floating cards -->
                    <div class="absolute -top-6 -right-6 bg-white rounded-2xl shadow-2xl p-4 animate-float-reverse">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">RDV en ligne</p>
                                <p class="text-sm text-gray-500">Gratuit et rapide</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-2xl p-4 animate-float">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-clock text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">24h/24 - 7j/7</p>
                                <p class="text-sm text-gray-500">Service d'urgence</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Wave bottom -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f9fafb" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,208C384,203,480,181,576,176C672,171,768,181,864,197.3C960,213,1056,235,1152,234.7C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>
    
    <!-- Services Section -->
    <section id="services" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-[#0B5E42] font-semibold uppercase tracking-wider text-sm">Nos services</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mt-3">Des soins complets pour<br>toute la famille</h2>
                <div class="w-24 h-1 bg-gradient-hero mx-auto mt-5 rounded-full"></div>
                <p class="text-gray-500 mt-5 max-w-2xl mx-auto">Des prestations médicales de qualité supérieure pour répondre à tous vos besoins de santé</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-scale card-shine" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-hero flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-stethoscope text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Consultations</h3>
                    <p class="text-gray-500 leading-relaxed">Consultations générales et spécialisées avec nos médecins experts.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[#0B5E42] font-medium mt-5 hover:gap-3 transition-all">
                        En savoir plus <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-scale card-shine" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-hero flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-ambulance text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Urgences 24/7</h3>
                    <p class="text-gray-500 leading-relaxed">Service d'urgence disponible 24 heures sur 24, 7 jours sur 7.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[#0B5E42] font-medium mt-5 hover:gap-3 transition-all">
                        En savoir plus <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-scale card-shine" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-hero flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-prescription-bottle text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Pharmacie</h3>
                    <p class="text-gray-500 leading-relaxed">Pharmacie intégrée avec prise en charge de vos ordonnances.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[#0B5E42] font-medium mt-5 hover:gap-3 transition-all">
                        En savoir plus <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-lg hover-scale card-shine" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-hero flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-flask text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Laboratoire</h3>
                    <p class="text-gray-500 leading-relaxed">Analyses médicales rapides et fiables sur place.</p>
                    <a href="#" class="inline-flex items-center gap-2 text-[#0B5E42] font-medium mt-5 hover:gap-3 transition-all">
                        En savoir plus <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Spécialités Section -->
    <section id="specialites" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-[#0B5E42] font-semibold uppercase tracking-wider text-sm">Nos spécialités</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mt-3">Des experts dans<br>chaque domaine</h2>
                <div class="w-24 h-1 bg-gradient-hero mx-auto mt-5 rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="group relative overflow-hidden rounded-2xl shadow-lg" data-aos="flip-left" data-aos-delay="0">
                    <img src="https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=400&h=300&fit=crop" alt="Cardiologie" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold text-white">Cardiologie</h3>
                        <p class="text-white/80 text-sm mt-1">Soins cardiaques avancés</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-2xl shadow-lg" data-aos="flip-left" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1581056771107-24ca5f033842?w=400&h=300&fit=crop" alt="Pédiatrie" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold text-white">Pédiatrie</h3>
                        <p class="text-white/80 text-sm mt-1">Soins pour enfants</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-2xl shadow-lg" data-aos="flip-left" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=400&h=300&fit=crop" alt="Gynécologie" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <h3 class="text-2xl font-bold text-white">Gynécologie</h3>
                        <p class="text-white/80 text-sm mt-1">Santé de la femme</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Médecins Section -->
    <section id="medecins" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-[#0B5E42] font-semibold uppercase tracking-wider text-sm">Notre équipe</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mt-3">Des médecins d'exception</h2>
                <div class="w-24 h-1 bg-gradient-hero mx-auto mt-5 rounded-full"></div>
                <p class="text-gray-500 mt-5 max-w-2xl mx-auto">Une équipe pluridisciplinaire à votre écoute</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group cursor-pointer" data-aos="zoom-in" data-aos-delay="0">
                    <div class="relative">
                        <div class="w-48 h-48 mx-auto rounded-full overflow-hidden shadow-xl group-hover:scale-105 transition duration-500">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Doctor" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-[#0B5E42] text-white px-4 py-1 rounded-full text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                            Voir profil
                        </div>
                    </div>
                    <h4 class="font-bold text-xl text-gray-800 mt-5">Dr. Adjanohoun</h4>
                    <p class="text-[#0B5E42] font-medium">Cardiologue</p>
                    <p class="text-gray-500 text-sm mt-2">15 ans d'expérience</p>
                    <div class="flex justify-center gap-2 mt-3">
                        <i class="fab fa-facebook text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                        <i class="fab fa-twitter text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                        <i class="fab fa-linkedin text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                    </div>
                </div>
                <div class="text-center group cursor-pointer" data-aos="zoom-in" data-aos-delay="100">
                    <div class="relative">
                        <div class="w-48 h-48 mx-auto rounded-full overflow-hidden shadow-xl group-hover:scale-105 transition duration-500">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Doctor" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-[#0B5E42] text-white px-4 py-1 rounded-full text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                            Voir profil
                        </div>
                    </div>
                    <h4 class="font-bold text-xl text-gray-800 mt-5">Dr. Bio</h4>
                    <p class="text-[#0B5E42] font-medium">Généraliste</p>
                    <p class="text-gray-500 text-sm mt-2">10 ans d'expérience</p>
                    <div class="flex justify-center gap-2 mt-3">
                        <i class="fab fa-facebook text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                        <i class="fab fa-twitter text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                        <i class="fab fa-linkedin text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                    </div>
                </div>
                <div class="text-center group cursor-pointer" data-aos="zoom-in" data-aos-delay="200">
                    <div class="relative">
                        <div class="w-48 h-48 mx-auto rounded-full overflow-hidden shadow-xl group-hover:scale-105 transition duration-500">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Doctor" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-[#0B5E42] text-white px-4 py-1 rounded-full text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                            Voir profil
                        </div>
                    </div>
                    <h4 class="font-bold text-xl text-gray-800 mt-5">Dr. Zinsou</h4>
                    <p class="text-[#0B5E42] font-medium">Pédiatre</p>
                    <p class="text-gray-500 text-sm mt-2">8 ans d'expérience</p>
                    <div class="flex justify-center gap-2 mt-3">
                        <i class="fab fa-facebook text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                        <i class="fab fa-twitter text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                        <i class="fab fa-linkedin text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                    </div>
                </div>
                <div class="text-center group cursor-pointer" data-aos="zoom-in" data-aos-delay="300">
                    <div class="relative">
                        <div class="w-48 h-48 mx-auto rounded-full overflow-hidden shadow-xl group-hover:scale-105 transition duration-500">
                            <img src="https://randomuser.me/api/portraits/women/90.jpg" alt="Doctor" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-[#0B5E42] text-white px-4 py-1 rounded-full text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                            Voir profil
                        </div>
                    </div>
                    <h4 class="font-bold text-xl text-gray-800 mt-5">Dr. Houndjo</h4>
                    <p class="text-[#0B5E42] font-medium">Gynécologue</p>
                    <p class="text-gray-500 text-sm mt-2">12 ans d'expérience</p>
                    <div class="flex justify-center gap-2 mt-3">
                        <i class="fab fa-facebook text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                        <i class="fab fa-twitter text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                        <i class="fab fa-linkedin text-gray-400 hover:text-[#0B5E42] transition cursor-pointer"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Témoignages Section -->
    <section id="temoignages" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-[#0B5E42] font-semibold uppercase tracking-wider text-sm">Témoignages</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mt-3">Ce que disent nos patients</h2>
                <div class="w-24 h-1 bg-gradient-hero mx-auto mt-5 rounded-full"></div>
            </div>
            
            <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="bg-gray-50 rounded-2xl p-8 shadow-lg mx-4">
                            <div class="flex items-center gap-4 mb-6">
                                <img src="https://randomuser.me/api/portraits/women/1.jpg" class="w-16 h-16 rounded-full object-cover">
                                <div>
                                    <h4 class="font-bold text-gray-800">Marie Zinsou</h4>
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 italic">"Excellent service ! Prise de rendez-vous rapide et équipe très professionnelle. Je recommande vivement !"</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-gray-50 rounded-2xl p-8 shadow-lg mx-4">
                            <div class="flex items-center gap-4 mb-6">
                                <img src="https://randomuser.me/api/portraits/men/2.jpg" class="w-16 h-16 rounded-full object-cover">
                                <div>
                                    <h4 class="font-bold text-gray-800">Jean Kouassi</h4>
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 italic">"Très bonne expérience. Le docteur a été à l'écoute et le personnel très accueillant."</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-gray-50 rounded-2xl p-8 shadow-lg mx-4">
                            <div class="flex items-center gap-4 mb-6">
                                <img src="https://randomuser.me/api/portraits/women/3.jpg" class="w-16 h-16 rounded-full object-cover">
                                <div>
                                    <h4 class="font-bold text-gray-800">Fatima Bello</h4>
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 italic">"Plateforme moderne et intuitive. Suivi médical de qualité. Je suis ravie !"</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination mt-8"></div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-24 bg-gradient-hero relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-10 left-10 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto text-center px-4" data-aos="zoom-in">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-5">Prenez rendez-vous dès maintenant</h2>
            <p class="text-white/80 text-xl mb-10">Inscrivez-vous et bénéficiez d'un suivi médical personnalisé</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="group px-10 py-4 bg-white text-[#0B5E42] rounded-xl font-bold text-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-calendar-plus mr-2 group-hover:rotate-6 transition"></i>
                    Commencer
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                </a>
                <a href="#contact" class="px-10 py-4 border-2 border-white text-white rounded-xl font-bold text-lg hover:bg-white/10 transition-all duration-300">
                    <i class="fas fa-phone-alt mr-2"></i>
                    Nous contacter
                </a>
            </div>
        </div>
    </section>
    
    <!-- Newsletter Section -->
    <section class="py-16 bg-gray-900">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h3 class="text-2xl font-bold text-white mb-3">Restez informé</h3>
            <p class="text-gray-400 mb-6">Recevez nos actualités et conseils santé</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input type="email" placeholder="Votre email" class="flex-1 px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-700 focus:outline-none focus:border-[#0B5E42] transition">
                <button type="submit" class="px-6 py-3 bg-[#0B5E42] text-white rounded-xl font-semibold hover:bg-[#074231] transition">S'abonner</button>
            </form>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-gradient-footer text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-12 h-12 rounded-xl bg-gradient-hero flex items-center justify-center">
                            <i class="fas fa-hospital-user text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold">OuandoSanté</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Centre médical d'excellence dédié à votre bien-être depuis plus de 10 ans.</p>
                    <div class="flex gap-4 mt-6">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-[#0B5E42] transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-[#0B5E42] transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-[#0B5E42] transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-[#0B5E42] transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-5">Liens rapides</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li><a href="#accueil" class="hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Accueil</a></li>
                        <li><a href="#services" class="hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Services</a></li>
                        <li><a href="#medecins" class="hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Médecins</a></li>
                        <li><a href="#temoignages" class="hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px]"></i> Témoignages</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-5">Horaires</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li><i class="fas fa-calendar-day w-5 text-[#0B5E42]"></i> Lundi - Vendredi: 08h - 18h</li>
                        <li><i class="fas fa-calendar-week w-5 text-[#0B5E42]"></i> Samedi: 08h - 13h</li>
                        <li><i class="fas fa-calendar-times w-5 text-[#0B5E42]"></i> Dimanche: Fermé</li>
                        <li><i class="fas fa-ambulance w-5 text-[#0B5E42]"></i> Urgences: 24h/24</li>
                    </ul>
                </div>
                <div id="contact">
                    <h4 class="font-semibold text-lg mb-5">Contact</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li><i class="fas fa-phone-alt w-5 text-[#0B5E42]"></i> +229 97 12 34 56</li>
                        <li><i class="fas fa-envelope w-5 text-[#0B5E42]"></i> contact@ouandosante.bj</li>
                        <li><i class="fas fa-map-marker-alt w-5 text-[#0B5E42]"></i> Cotonou, Bénin</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; 2024 Centre de Santé Ouando. Tous droits réservés. | Conçu avec <i class="fas fa-heart text-red-500"></i> pour votre santé</p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white/95', 'backdrop-blur-md', 'shadow-lg');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('bg-white/95', 'backdrop-blur-md', 'shadow-lg');
                navbar.classList.add('bg-transparent');
            }
        });
        
        // Counter animation
        const counters = document.querySelectorAll('.counter-number');
        const speed = 200;
        
        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            let count = 0;
            const increment = target / speed;
            
            const updateCount = () => {
                count += increment;
                if (count < target) {
                    counter.textContent = Math.ceil(count);
                    setTimeout(updateCount, 20);
                } else {
                    counter.textContent = target;
                }
            };
            updateCount();
        };
        
        // Intersection Observer for counters
        const observerOptions = { threshold: 0.5 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        counters.forEach(counter => observer.observe(counter));
        
        // Initialize Swiper
        new Swiper('.testimonial-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: { 768: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } }
        });
        
        // Particles animation
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        const particles = [];
        for (let i = 0; i < 50; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                radius: Math.random() * 3 + 1,
                alpha: Math.random() * 0.5 + 0.2,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5
            });
        }
        
        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(255, 255, 255, ${p.alpha})`;
                ctx.fill();
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0) p.x = canvas.width;
                if (p.x > canvas.width) p.x = 0;
                if (p.y < 0) p.y = canvas.height;
                if (p.y > canvas.height) p.y = 0;
            });
            requestAnimationFrame(drawParticles);
        }
        
        drawParticles();
        
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>