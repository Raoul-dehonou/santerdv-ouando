@extends('layouts.app')

@section('title', 'Mon Profil')
@section('header', 'Modifier mon profil')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <!-- Message de succès -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 animate-fade-in">
        <div class="flex items-center gap-2">
            <i class="fas fa-check-circle text-green-500"></i>
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 animate-fade-in">
        <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    </div>
    @endif
    
    <!-- Formulaire modification profil avec photo -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Informations personnelles</h3>
        
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            
            <div class="flex flex-col md:flex-row gap-6 mb-6">
                <!-- Avatar / Photo de profil -->
                <div class="flex flex-col items-center">
                    <div class="relative">
                        <div id="avatarPreview" class="w-32 h-32 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white text-4xl font-bold shadow-lg overflow-hidden border-4 border-primary">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/avatars/'.Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <label for="avatarInput" class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center cursor-pointer hover:bg-primary-dark transition shadow-md">
                            <i class="fas fa-camera text-xs"></i>
                        </label>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden">
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Photo de Profil </p>
                    
                </div>
                
                <!-- Champs -->
                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                               class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('dashboard') }}" class="px-5 py-2 border rounded-lg hover:bg-gray-50 transition">
                    Annuler
                </a>
                <button type="submit" class="px-5 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
    
    <!-- Formulaire changement mot de passe -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Changer le mot de passe</h3>
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                    <input type="password" name="current_password" 
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                    <input type="password" name="password" 
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" 
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <button type="submit" class="px-5 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition flex items-center gap-2">
                    <i class="fas fa-key"></i>
                    Changer le mot de passe
                </button>
            </div>
        </form>
    </div>
    
    <!-- Zone de danger - Suppression compte -->
    <div class="bg-red-50 rounded-xl shadow-lg p-6 border border-red-200">
        <h3 class="text-lg font-semibold text-red-800 mb-2">Supprimer le compte</h3>
        <p class="text-sm text-red-600 mb-4">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.</p>
        
        <button id="deleteAccountBtn" class="px-5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition flex items-center gap-2">
            <i class="fas fa-trash"></i>
            Supprimer mon compte
        </button>
    </div>
</div>

<!-- Modal confirmation suppression -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 animate-fade-in">
        <div class="p-6">
            <div class="text-center mb-4">
                <div class="w-16 h-16 rounded-full bg-red-100 mx-auto flex items-center justify-center mb-3">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Confirmer la suppression</h3>
                <p class="text-gray-500 text-sm mt-1">Cette action est irréversible.</p>
            </div>
            
            <form id="deleteAccountForm" method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" name="password" id="deletePassword" required
                           class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500">
                    <p class="text-xs text-gray-500 mt-1">Veuillez entrer votre mot de passe pour confirmer</p>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border rounded-lg hover:bg-gray-50 transition">Annuler</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview avatar avant upload
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    avatarPreview.innerHTML = `<img src="${event.target.result}" alt="Avatar" class="w-full h-full object-cover rounded-full">`;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Modal suppression
    const deleteBtn = document.getElementById('deleteAccountBtn');
    const deleteModal = document.getElementById('deleteModal');
    
    if (deleteBtn) {
        deleteBtn.addEventListener('click', () => {
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        });
    }
    
    function closeDeleteModal() {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
        const passwordInput = document.getElementById('deletePassword');
        if (passwordInput) passwordInput.value = '';
    }
    
    // Fermer avec Echap
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endsection