@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier un Suivi qualite</h2>
    
    <form action="{{route('suivi-qualite.update', ['suivi_qualite' => $suiviqualite->id])}}" method="POST">
    @csrf
    @method('PUT') 
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="agent_id" class="form-label">Agent</label>
                <select name="agent_id" id="agent_id" class="form-select @error('agent_id') is-invalid @enderror" required>
                    <option value="">Sélectionner un agent</option>
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}" {{ $suiviqualite->agent_id == $agent->id ? 'selected' : '' }}>
                            {{ $agent->nom }} {{ $agent->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('agent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="session_id" class="form-label">Session</label>
                <select name="module_id" id="module_id" class="form-select @error('module_id') is-invalid @enderror" required>
                    <option value="">Sélectionner une session</option>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" data-date="{{ $module->date_fin }}" 
                            {{ $suiviqualite->module_id == $module->id ? 'selected' : '' }}>
                            {{ $module->titre }}
                        </option>
                    @endforeach
                </select>
                @error('module_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="analyse" class="form-label">Analyse</label>
                <select name="analyse" id="analyse" class="form-select @error('analyse') is-invalid @enderror">
                    <option value="">Sélectionner une analyse</option>
                    <option value="Conforme" {{ $suiviqualite->analyse == 'Conforme' ? 'selected' : '' }}>Conforme</option>
                    <option value="Passable" {{ $suiviqualite->analyse == 'Passable' ? 'selected' : '' }}>Passable</option>
                    <option value="Non conforme" {{ $suiviqualite->analyse == 'Non conforme' ? 'selected' : '' }}>Non conforme</option>
                </select>
                @error('analyse')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="suivi_qualite_id" class="form-label">Suivi Qualité</label>
                <select name="suivi_qualite_id" id="suivi_qualite_id" class="form-select @error('suivi_qualite_id') is-invalid @enderror">
                    <option value="">Sélectionner un responsable</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $suiviqualite->suivi_qualite_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('suivi_qualite_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="numero_dossier" class="form-label">Numéro de Dossier</label>
                <input type="text" class="form-control @error('numero_dossier') is-invalid @enderror" id="numero_dossier" 
                    name="numero_dossier" value="{{ old('numero_dossier', $suiviqualite->numero_dossier) }}">
                @error('numero_dossier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="date_traitement_dossier" class="form-label">Date de Traitement</label>
                <input type="date" class="form-control @error('date_traitement_dossier') is-invalid @enderror" 
                    id="date_traitement_dossier" name="date_traitement_dossier" 
                    value="{{ old('date_traitement_dossier', $suiviqualite->date_traitement_dossier ? $suiviqualite->date_traitement_dossier->format('Y-m-d') : '') }}">
                @error('date_traitement_dossier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-8">
                <label for="commentaire" class="form-label">Commentaire</label>
                <textarea class="form-control @error('commentaire') is-invalid @enderror" id="commentaire" 
                    name="commentaire" rows="2">{{ old('commentaire', $suiviqualite->commentaire) }}</textarea>
                @error('commentaire')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('suivi-qualite.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection