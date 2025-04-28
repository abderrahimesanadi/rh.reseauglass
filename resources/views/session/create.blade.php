@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Ajouter une Session de Formation</h1>
    
    <form action="{{ route('session.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="date_formation" class="form-label">Date de la formation</label>
            <input type="date" name="date_formation" id="date_formation" class="form-control @error('date_formation') is-invalid @enderror" value="{{ old('date_formation') }}" required>
            @error('date_formation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="module_id" class="form-label">Module</label>
            <select name="module_id" id="module_id" class="form-control @error('module_id') is-invalid @enderror" required>
                <option value="">Sélectionner un module</option>
                @foreach($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->titre }} ({{ $module->service }})</option>
                @endforeach
            </select>
            @error('module_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="agent_ids" class="form-label">Agents</label>
            <select name="agent_ids[]" id="agent_ids" class="form-control @error('agent_ids') is-invalid @enderror" multiple required>
                @foreach($agents as $agent)
                    <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}</option>
                @endforeach
            </select>
            @error('agent_ids')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('session.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection