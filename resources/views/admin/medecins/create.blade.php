@extends('layouts.app')

@section('title', 'Ajouter un Médecin')
@section('header', 'Nouveau Médecin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form method="POST">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet *</label>
                    <input type="text" name="name" required class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" required class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Spécialité *</label>
                    <select name="specialite" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Sélectionner</option>
                        <option value="Cardiologue">Cardiologue</option>
                        <option value="Généraliste">Généraliste</option>
                        <option value="Pédiatre">Pédiatre</option>
                        <option value="Gynécologue">Gynécologue</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe *</label>
                    <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2">
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <a href="{{ route('admin.medecins.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Créer</button>
            </div>
        </form>
    </div>
</div>
@endsection