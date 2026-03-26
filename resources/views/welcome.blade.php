<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SanteRDV – Centre de santé de Ouando</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -12px rgba(0,0,0,0.15);
        }
        .emergency-btn {
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(229, 57, 53, 0.3);
        }
        .emergency-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(229, 57, 53, 0.4);
        }
        .sticky-nav {
            backdrop-filter: blur(8px);
            background-color: rgba(255,255,255,0.98);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-white font-sans antialiased">

    <!-- HEADER / NAVBAR avec hauteur augmentée -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 transition-all duration-300 sticky-nav">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <!-- Logo avec texte uniquement -->
            <div class="flex items-center">
                <span class="text-3xl font-bold text-[#E53935] tracking-tight">SanteRDV</span>
            </div>
            <nav class="hidden md:flex space-x-8 text-gray-700 font-medium">
                <a href="#accueil" class="hover:text-[#1E88E5] transition">Accueil</a>
                <a href="#services" class="hover:text-[#1E88E5] transition">Services</a>
                <a href="#specialistes" class="hover:text-[#1E88E5] transition">Spécialistes</a>
                <a href="#centre" class="hover:text-[#1E88E5] transition">Le centre</a>
            </nav>
            <div class="flex items-center space-x-3">
                <a href="{{ route('login') }}" class="hidden md:inline-block text-gray-700 hover:text-[#1E88E5] transition font-medium">Connexion</a>
                <a href="{{ route('register') }}" class="hidden md:inline-block bg-[#43A047] text-white px-5 py-2 rounded-full hover:bg-[#2E7D32] transition shadow-sm">Inscription</a>
                <a href="#" id="emergency-nav" class="bg-[#E53935] text-white px-4 py-2 rounded-full flex items-center space-x-2 hover:bg-[#C62828] transition shadow-md">
                    <i class="fas fa-ambulance"></i>
                    <span class="hidden md:inline">Urgence</span>
                </a>
            </div>
        </div>
    </header>

    <!-- BOUTON URGENCE FLOTTANT -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="#" id="emergency-fab" class="emergency-btn bg-[#E53935] text-white rounded-full w-14 h-14 flex items-center justify-center shadow-xl hover:bg-[#C62828] transition-all duration-300">
            <i class="fas fa-ambulance text-2xl"></i>
        </a>
    </div>

    <!-- ==================== BANNIÈRE ==================== -->
    <section id="accueil" class="py-10 md:py-16" style="background-color: #2E4392;">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-8 leading-tight whitespace-nowrap">
                    Prenez <span class="underline decoration-2 decoration-white">rendez-vous</span> avec un <span class="underline decoration-2 decoration-white">médecin</span> en quelques clics
                </h1>
                <div class="bg-white rounded-2xl shadow-xl p-5 md:p-6 border border-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div>
                            <select id="specialite" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1E88E5]">
                                <option value=""> Spécialité</option>
                                <option value="generaliste">Médecine générale</option>
                                <option value="pediatrie">Pédiatrie</option>
                                <option value="gynecologie">Gynécologie</option>
                                <option value="cardiologie">Cardiologie</option>
                            </select>
                        </div>
                        <div>
                            <select id="medecin" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#1E88E5]">
                                <option value="">Choisir spécialité</option>
                            </select>
                        </div>
                        <div>
                            <button id="btnRechercher" class="w-full bg-[#E53935] text-white font-semibold py-2.5 rounded-lg hover:bg-[#C62828] transition shadow-md">
                                <i class="fas fa-search mr-2"></i> Rechercher
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== TROIS CARTES DE FONCTIONNALITÉS ==================== -->
    <section class="py-16 bg-gradient-to-br from-white to-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card-hover bg-transparent rounded-2xl p-8 shadow-xl text-center border border-gray-200 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-md">
                        <i class="fas fa-search text-3xl text-[#1E88E5]"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Trouvez facilement</h3>
                    <p class="text-gray-600 text-lg">Recherchez des professionnels de santé près de chez vous, par spécialité ou par nom.</p>
                </div>
                <div class="card-hover bg-transparent rounded-2xl p-8 shadow-xl text-center border border-gray-200 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="w-20 h-20 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-md">
                        <i class="fas fa-calendar-check text-3xl text-[#E53935]"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Réservez en ligne</h3>
                    <p class="text-gray-600 text-lg">Prenez rendez-vous 24h/24 depuis votre téléphone ou ordinateur, en quelques clics.</p>
                </div>
                <div class="card-hover bg-transparent rounded-2xl p-8 shadow-xl text-center border border-gray-200 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-md">
                        <i class="fas fa-shield-alt text-3xl text-[#1E88E5]"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Espace patient sécurisé</h3>
                    <p class="text-gray-600 text-lg">Gérez votre historique médical, vos ordonnances et échangez avec vos praticiens en toute confidentialité.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION URGENCE ==================== -->
    <section class="bg-red-50 py-16">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto">
                <i class="fas fa-heartbeat text-5xl text-[#E53935] mb-4"></i>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Besoin d’une prise en charge urgente ?</h2>
                <p class="text-gray-600 text-lg mb-6">
                    Une prise en charge rapide peut sauver des vies. Si vous ou un proche présentez des symptômes graves, n'attendez pas.
                </p>
                <a href="#" class="inline-flex items-center bg-[#E53935] text-white px-8 py-3 rounded-full font-semibold hover:bg-[#C62828] transition shadow-md">
                    <i class="fas fa-phone-alt mr-2"></i> Signaler une urgence
                </a>
                <p class="text-sm text-gray-500 mt-4">Notre équipe vous recontactera immédiatement.</p>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION CONFIANCE (CARTES) ==================== -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Pourquoi nous faire confiance ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="card-hover bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lock text-2xl text-[#1E88E5]"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Données sécurisées</h3>
                    <p class="text-gray-600">Vos informations médicales sont protégées selon les normes de sécurité les plus strictes.</p>
                </div>
                <div class="card-hover bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hospital-user text-2xl text-[#43A047]"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Centre certifié</h3>
                    <p class="text-gray-600">Le Centre de santé de Ouando est agréé par le ministère de la Santé.</p>
                </div>
                <div class="card-hover bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-check text-2xl text-[#1E88E5]"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Rendez-vous fiables</h3>
                    <p class="text-gray-600">Confirmation immédiate et rappel automatique pour ne rien oublier.</p>
                </div>
                <div class="card-hover bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bell text-2xl text-[#43A047]"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Notifications automatiques</h3>
                    <p class="text-gray-600">SMS et emails pour confirmer, rappeler et informer des changements.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION SERVICES (cliquables) ==================== -->
    <section id="services" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Nos services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="card-hover bg-white rounded-xl p-6 shadow-sm text-center cursor-pointer transition-all duration-300 hover:shadow-md group" onclick="window.location='{{ route('register') }}'">
                    <i class="fas fa-calendar-alt text-4xl text-[#1E88E5] mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Prise de rendez-vous en ligne</h3>
                    <p class="text-gray-600">Choisissez votre médecin, votre créneau, et validez en quelques clics.</p>
                    <span class="inline-block mt-4 text-[#1E88E5] font-medium group-hover:underline">Prendre rendez-vous →</span>
                </div>
                <div class="card-hover bg-white rounded-xl p-6 shadow-sm text-center cursor-pointer transition-all duration-300 hover:shadow-md group" onclick="window.location='{{ route('register') }}'">
                    <i class="fas fa-folder-open text-4xl text-[#1E88E5] mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Dossier médical numérique</h3>
                    <p class="text-gray-600">Accédez à votre historique, résultats et ordonnances à tout moment.</p>
                    <span class="inline-block mt-4 text-[#1E88E5] font-medium group-hover:underline">En savoir plus →</span>
                </div>
                <div class="card-hover bg-white rounded-xl p-6 shadow-sm text-center cursor-pointer transition-all duration-300 hover:shadow-md group" onclick="window.location='{{ route('register') }}'">
                    <i class="fas fa-user-md text-4xl text-[#1E88E5] mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Accès aux médecins</h3>
                    <p class="text-gray-600">Contactez facilement votre médecin traitant ou spécialiste.</p>
                    <span class="inline-block mt-4 text-[#1E88E5] font-medium group-hover:underline">Prendre rendez-vous →</span>
                </div>
                <div class="card-hover bg-white rounded-xl p-6 shadow-sm text-center cursor-pointer transition-all duration-300 hover:shadow-md group" onclick="window.location='{{ route('register') }}'">
                    <i class="fas fa-chart-line text-4xl text-[#1E88E5] mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Gestion intelligente</h3>
                    <p class="text-gray-600">Optimisation des flux de patients et réduction des temps d'attente.</p>
                    <span class="inline-block mt-4 text-[#1E88E5] font-medium group-hover:underline">En savoir plus →</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION SPÉCIALISTES ==================== -->
    <section id="specialistes" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Nos spécialistes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="bg-gradient-to-r from-[#1E88E5] to-[#0b5e9e] h-24"></div>
                    <div class="p-6 text-center -mt-12">
                        <div class="w-24 h-24 rounded-full mx-auto border-4 border-white bg-gray-200 flex items-center justify-center overflow-hidden">
                            <i class="fas fa-user-md text-5xl text-[#1E88E5]"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mt-4">Dr. Koffi Mensah</h3>
                        <p class="text-[#1E88E5] font-medium">Médecin généraliste</p>
                        <p class="text-gray-600 text-sm mt-2">Disponible du lundi au vendredi, 8h-16h</p>
                        <a href="{{ route('register') }}" class="inline-block mt-4 bg-[#43A047] text-white px-6 py-2 rounded-full text-sm hover:bg-[#2E7D32] transition">Prendre rendez-vous</a>
                    </div>
                </div>
                <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="bg-gradient-to-r from-[#1E88E5] to-[#0b5e9e] h-24"></div>
                    <div class="p-6 text-center -mt-12">
                        <div class="w-24 h-24 rounded-full mx-auto border-4 border-white bg-gray-200 flex items-center justify-center overflow-hidden">
                            <i class="fas fa-female text-5xl text-[#1E88E5]"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mt-4">Dr. Amélie Dossou</h3>
                        <p class="text-[#1E88E5] font-medium">Gynécologue</p>
                        <p class="text-gray-600 text-sm mt-2">Consultations sur rendez-vous</p>
                        <a href="{{ route('register') }}" class="inline-block mt-4 bg-[#43A047] text-white px-6 py-2 rounded-full text-sm hover:bg-[#2E7D32] transition">Prendre rendez-vous</a>
                    </div>
                </div>
                <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100">
                    <div class="bg-gradient-to-r from-[#1E88E5] to-[#0b5e9e] h-24"></div>
                    <div class="p-6 text-center -mt-12">
                        <div class="w-24 h-24 rounded-full mx-auto border-4 border-white bg-gray-200 flex items-center justify-center overflow-hidden">
                            <i class="fas fa-user-md text-5xl text-[#1E88E5]"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mt-4">Dr. Jean Houénou</h3>
                        <p class="text-[#1E88E5] font-medium">Pédiatre</p>
                        <p class="text-gray-600 text-sm mt-2">Consultations pour enfants</p>
                        <a href="{{ route('register') }}" class="inline-block mt-4 bg-[#43A047] text-white px-6 py-2 rounded-full text-sm hover:bg-[#2E7D32] transition">Prendre rendez-vous</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== COMMENT ÇA MARCHE ==================== -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Comment ça marche ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="bg-[#1E88E5] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                    <h3 class="text-xl font-semibold mb-2">Créer un compte</h3>
                    <p class="text-gray-600">Inscrivez-vous en 2 minutes avec votre email ou numéro de téléphone.</p>
                </div>
                <div class="text-center">
                    <div class="bg-[#1E88E5] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                    <h3 class="text-xl font-semibold mb-2">Choisir le centre</h3>
                    <p class="text-gray-600">Sélectionnez le Centre de santé de Ouando.</p>
                </div>
                <div class="text-center">
                    <div class="bg-[#1E88E5] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                    <h3 class="text-xl font-semibold mb-2">Prendre rendez-vous</h3>
                    <p class="text-gray-600">Choisissez la date et l'heure qui vous conviennent.</p>
                </div>
                <div class="text-center">
                    <div class="bg-[#1E88E5] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">4</div>
                    <h3 class="text-xl font-semibold mb-2">Recevoir confirmation</h3>
                    <p class="text-gray-600">Un SMS/email confirme votre rendez-vous avec les détails nécessaires.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION CENTRE DE SANTÉ ==================== -->
    <section id="centre" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Notre centre</h2>
            <div class="card-hover bg-white rounded-2xl overflow-hidden shadow-lg flex flex-col md:flex-row max-w-4xl mx-auto">
                <div class="md:w-1/3 bg-cover bg-center" style="background-image: url('{{ asset('images/centre-ouando.jpg') }}'); min-height: 200px;"></div>
                <div class="p-6 md:w-2/3">
                    <h3 class="text-2xl font-bold text-gray-800">Centre de santé de Ouando</h3>
                    <p class="text-gray-600 mt-2"><i class="fas fa-map-marker-alt text-[#1E88E5] mr-1"></i> Porto-Novo, Bénin</p>
                    <p class="text-gray-600 mt-2"><i class="fas fa-user-md text-[#1E88E5] mr-1"></i> 8 médecins généralistes, 3 spécialistes</p>
                    <p class="text-gray-600 mt-2"><i class="fas fa-clock text-[#1E88E5] mr-1"></i> Ouvert 7j/7, 8h-18h</p>
                    <a href="{{ route('register') }}" class="inline-block mt-4 text-[#1E88E5] font-medium hover:underline">Prendre un rendez-vous →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== AVANTAGES ==================== -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Pourquoi choisir SanteRDV ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                <div><i class="fas fa-hourglass-half text-4xl text-[#1E88E5] mb-2"></i><p class="text-lg font-semibold">Réduction des files d'attente</p><p class="text-gray-600">Moins d'attente, plus de confort.</p></div>
                <div><i class="fas fa-stopwatch text-4xl text-[#1E88E5] mb-2"></i><p class="text-lg font-semibold">Gain de temps</p><p class="text-gray-600">Prise de RDV en 2 minutes chrono.</p></div>
                <div><i class="fas fa-chart-simple text-4xl text-[#1E88E5] mb-2"></i><p class="text-lg font-semibold">Meilleure organisation</p><p class="text-gray-600">Planning optimisé pour les médecins.</p></div>
                <div><i class="fas fa-notes-medical text-4xl text-[#1E88E5] mb-2"></i><p class="text-lg font-semibold">Suivi médical optimisé</p><p class="text-gray-600">Historique complet à portée de main.</p></div>
            </div>
        </div>
    </section>

    <!-- ==================== CTA ==================== -->
    <section class="bg-gradient-to-r from-[#1E88E5] to-[#0b5e9e] text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Prêt à prendre soin de votre santé ?</h2>
            <p class="text-xl mb-8 opacity-90">Prenez rendez-vous dès maintenant et rejoignez des milliers de patients satisfaits.</p>
            <a href="{{ route('register') }}" class="inline-block bg-[#43A047] text-white px-8 py-3 rounded-full font-semibold text-lg hover:bg-[#2E7D32] transition shadow-lg">Prendre rendez-vous</a>
        </div>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-heartbeat text-2xl text-[#1E88E5]"></i>
                        <span class="text-xl font-bold text-white">SanteRDV</span>
                    </div>
                    <p>Rendez-vous médical simplifié, suivi intelligent.</p>
                    <p class="mt-2"><i class="fas fa-map-marker-alt mr-2"></i> Porto-Novo, Bénin</p>
                    <p><i class="fas fa-phone-alt mr-2"></i> +229 21 30 00 00</p>
                    <p><i class="fas fa-envelope mr-2"></i> contact@santerdv.bj</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#accueil" class="hover:text-white transition">Accueil</a></li>
                        <li><a href="#services" class="hover:text-white transition">Services</a></li>
                        <li><a href="#specialistes" class="hover:text-white transition">Spécialistes</a></li>
                        <li><a href="#centre" class="hover:text-white transition">Le centre</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Légal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Confidentialité</a></li>
                        <li><a href="#" class="hover:text-white transition">Conditions d'utilisation</a></li>
                        <li><a href="#" class="hover:text-white transition">Mentions légales</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookies</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Sécurité</h4>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-lock text-[#43A047] text-xl"></i>
                        <span>Données sécurisées</span>
                    </div>
                    <div class="flex items-center space-x-2 mt-2">
                        <i class="fas fa-certificate text-[#43A047] text-xl"></i>
                        <span>Plateforme conforme aux bonnes pratiques de e-santé</span>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm">
                &copy; {{ date('Y') }} SanteRDV. Tous droits réservés.
            </div>
        </div>
    </footer>

    <script>
        // Données fictives des médecins par spécialité
        const medecinsParSpecialite = {
            generaliste: [
                { id: 1, nom: "Dr. Koffi Mensah" },
                { id: 2, nom: "Dr. Awa Traoré" }
            ],
            pediatrie: [
                { id: 3, nom: "Dr. Jean Houénou" },
                { id: 4, nom: "Dr. Marie Adjovi" }
            ],
            gynecologie: [
                { id: 5, nom: "Dr. Amélie Dossou" },
                { id: 6, nom: "Dr. Camille Hounkpatin" }
            ],
            cardiologie: [
                { id: 7, nom: "Dr. Paul Akpovo" },
                { id: 8, nom: "Dr. Léa Zinsou" }
            ]
        };

        const specialiteSelect = document.getElementById('specialite');
        const medecinSelect = document.getElementById('medecin');
        const btnRechercher = document.getElementById('btnRechercher');

        // Mise à jour de la liste des médecins
        specialiteSelect.addEventListener('change', function() {
            const valeur = this.value;
            medecinSelect.innerHTML = '<option value="">Sélectionnez un médecin</option>';

            if (valeur && medecinsParSpecialite[valeur]) {
                medecinsParSpecialite[valeur].forEach(medecin => {
                    const option = document.createElement('option');
                    option.value = medecin.id;
                    option.textContent = medecin.nom;
                    medecinSelect.appendChild(option);
                });
            }
        });

        // Action du bouton Rechercher
        btnRechercher.addEventListener('click', function() {
            const medecinId = medecinSelect.value;
            if (!medecinId) {
                alert('Veuillez sélectionner un médecin.');
                return;
            }
            window.location.href = "{{ route('register') }}?doctor=" + medecinId;
        });

        // Gestion des boutons d'urgence (défilement vers la section urgence)
        document.querySelectorAll('#emergency-nav, #emergency-fab').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                const urgentSection = document.querySelector('.bg-red-50');
                if (urgentSection) {
                    urgentSection.scrollIntoView({ behavior: 'smooth' });
                } else {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>