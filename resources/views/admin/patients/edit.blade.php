@extends('layouts.app')

@section('title', 'Modifier Patient')
@section('header', 'Modifier les informations du patient')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet *</label>
                    <input type="text" name="name" value="Jean Kouassi" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" value="jean@email.com" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                    <input type="tel" name="telephone" value="+229 97 12 34 56" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date naissance</label>
                    <input type="date" name="date_naissance" value="1985-06-15" class="w-full border rounded-lg px-3 py-2">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                    <textarea name="adresse" rows="2" class="w-full border rounded-lg px-3 py-2">Cotonou, Bénin</textarea>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                <a href="{{ route('admin.patients.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Annuler</a>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection