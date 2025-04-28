@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le Module</h1>
    
    <form action="{{ route('modules.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="service" class="form-label">Service</label>
            <select name="service" id="service" class="form-control @error('service') is-invalid @enderror" required>
                <option value="">Sélectionner un service</option>
                @foreach($services as $service)
                    <option value="{{ $service->nom }}" {{ $module->service == $service->nom ? 'selected' : '' }}>{{ $service->nom }}</option>
                @endforeach
            </select>
            @error('service')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du Module</label>
            <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre', $module->titre) }}" required>
            @error('titre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="competences" class="form-label">Compétences</label>
            <textarea name="competences" id="competences" class="form-control @error('competences') is-invalid @enderror" rows="3">{{ old('competences', $module->competences) }}</textarea>
            @error('competences')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="objectifs" class="form-label">Objectifs</label>
            <textarea name="objectifs" id="objectifs" class="form-control @error('objectifs') is-invalid @enderror" rows="3">{{ old('objectifs', $module->objectifs) }}</textarea>
            @error('objectifs')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('modules.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection