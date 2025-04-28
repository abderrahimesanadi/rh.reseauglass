@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter un agent</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('agents.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="service_id">Service</label>
                            <select class="form-control @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
                                <option value="">Sélectionner un service</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" style="background-color: '#dc3545'">
                                        {{ $service->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="nombre_formation_suivi">Nombre de formation suivi</label>
                            <input type="number" class="form-control @error('nombre_formation_suivi') is-invalid @enderror" id="nombre_formation_suivi" name="nombre_formation_suivi" value="{{ old('nombre_formation_suivi', 0) }}" min="0">
                            @error('nombre_formation_suivi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('agents.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection