@extends('layouts.app')

@section('styles')
<!-- Ajoutez les fichiers CSS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #6c757d;
        border: 1px solid #6c757d;
        color: white;
        padding: 3px 10px;
        margin-right: 5px;
        margin-top: 5px;
        border-radius: 3px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white;
        margin-right: 5px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Ajouter un Module</h1>
    
    <form action="{{ route('modules.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="services" class="form-label">Services</label>
            <select name="services[]" id="services" class="form-control select2-multiple @error('services') is-invalid @enderror" multiple required>
                @foreach($services as $service)
                    <option value="{{ $service->nom }}">{{ $service->nom }}</option>
                @endforeach
            </select>
            @error('services')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du Module</label>
            <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') }}" required>
            @error('titre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="competences" class="form-label">Compétences</label>
            <textarea name="competences" id="competences" class="form-control @error('competences') is-invalid @enderror" rows="3">{{ old('competences') }}</textarea>
            @error('competences')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="objectifs" class="form-label">Objectifs</label>
            <textarea name="objectifs" id="objectifs" class="form-control @error('objectifs') is-invalid @enderror" rows="3">{{ old('objectifs') }}</textarea>
            @error('objectifs')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('modules.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- Ajoutez les fichiers JavaScript de Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: "Sélectionner un ou plusieurs services",
            allowClear: true,
            tags: false,
            tokenSeparators: [',', ' ']
        });
    });
</script>
@endsection