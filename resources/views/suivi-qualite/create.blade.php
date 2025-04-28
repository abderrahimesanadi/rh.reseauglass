@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un Suivi qualite</h2>
    
    <form action="{{ route('suivi-qualite.store') }}" method="POST">
        @csrf
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="agent_select" class="form-label">Agent</label>
                <select id="agent_select" class="form-select select2-with-create @error('agent_id') is-invalid @enderror">
                    <option value="">Sélectionner un agent</option>
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}</option>
                    @endforeach
                </select>
                <!-- Champ caché pour stocker l'ID de l'agent ou le nom/prénom saisi -->
                <input type="hidden" name="agent_id" id="agent_id_hidden" value="{{ old('agent_id') }}">
                <input type="hidden" name="agent_nom_prenom" id="agent_nom_prenom" value="{{ old('agent_nom_prenom') }}">
                @error('agent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="module_select" class="form-label">Session</label>
                <select id="module_select" class="form-select select2-with-create @error('module_id') is-invalid @enderror">
                    <option value="">Sélectionner une session</option>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" data-date="{{ $module->date_fin }}">{{ $module->titre }}</option>
                    @endforeach
                </select>
                <!-- Champ caché pour stocker l'ID du module ou le titre saisi -->
                <input type="hidden" name="module_id" id="module_id_hidden" value="{{ old('module_id') }}">
                <input type="hidden" name="module_titre" id="module_titre" value="{{ old('module_titre') }}">
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
                    <option value="Conforme">Conforme</option>
                    <option value="Passable">Passable</option>
                    <option value="Non conforme">Non conforme</option>
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
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('suivi_qualite_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="numero_dossier" class="form-label">Numéro de Dossier</label>
                <input type="text" class="form-control @error('numero_dossier') is-invalid @enderror" id="numero_dossier" name="numero_dossier" value="{{ old('numero_dossier') }}">
                @error('numero_dossier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="date_traitement_dossier" class="form-label">Date de Traitement</label>
                <input type="date" class="form-control @error('date_traitement_dossier') is-invalid @enderror" id="date_traitement_dossier" name="date_traitement_dossier" value="{{ old('date_traitement_dossier') }}">
                @error('date_traitement_dossier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-8">
                <label for="commentaire" class="form-label">Commentaire</label>
                <textarea class="form-control @error('commentaire') is-invalid @enderror" id="commentaire" name="commentaire" rows="2">{{ old('commentaire') }}</textarea>
                @error('commentaire')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('suivi-qualite.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container {
        width: 100% !important;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Configuration pour les selects avec création à la volée
        $('.select2-with-create').select2({
            tags: true,
            createTag: function(params) {
                return {
                    id: 'new:' + params.term,
                    text: params.term,
                    newOption: true
                };
            }
        });
        
        // Gestion de l'agent
        $('#agent_select').on('change', function() {
            const selectedValue = $(this).val();
            
            if (selectedValue && selectedValue.startsWith('new:')) {
                // C'est une nouvelle entrée
                const agentNomPrenom = selectedValue.substring(4); // Enlever 'new:'
                $('#agent_id_hidden').val('');
                $('#agent_nom_prenom').val(agentNomPrenom);
            } else {
                // C'est une sélection existante
                $('#agent_id_hidden').val(selectedValue);
                $('#agent_nom_prenom').val('');
            }
        });
        
        // Gestion du module/session
        $('#module_select').on('change', function() {
            const selectedValue = $(this).val();
            
            if (selectedValue && selectedValue.startsWith('new:')) {
                // C'est une nouvelle entrée
                const moduleTitle = selectedValue.substring(4); // Enlever 'new:'
                $('#module_id_hidden').val('');
                $('#module_titre').val(moduleTitle);
            } else {
                // C'est une sélection existante
                $('#module_id_hidden').val(selectedValue);
                $('#module_titre').val('');
                
                // Récupérer la date associée au module si disponible
                const selectedOption = $(this).find('option:selected');
                const sessionDate = selectedOption.attr('data-date');
                if (sessionDate) {
                    console.log("Session end date:", sessionDate);
                }
            }
        });
    });
</script>
@endsection
@endsection