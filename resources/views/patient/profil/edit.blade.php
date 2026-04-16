@extends('layouts.app')

@section('title', 'Mon Profil')
@section('header', 'Modifier mon profil')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet *</label>
                    <input type="text" name="name" value="Jean Kouassi" required class="w-full border rounded-lg px-3 py-2">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" value="jean@email.com" required class="w-full border rounded-lg px-3 py-2">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                    <input type="tel" name="telephone" value="+229 97 12 34 56" class="w-full border rounded-lg px-3 py-2">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                    <textarea name="adresse" rows="2" class="w-full border rounded-lg px-3 py-2">Cotonou, Bénin</textarea>
                </div>
                
                <div class="pt-4 border-t">
                    <h3 class="font-semibold text-gray-800 mb-3">Changer le mot de passe</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                            <input type="password" name="current_password" class="w-full border rounded-lg px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                            <input type="password" name="password" class="w-full border rounded-lg px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <a href="{{ route('patient.dashboard') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection