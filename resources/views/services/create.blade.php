@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter un service</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('services.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nom">Nom du service</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="couleur">Couleur</label>
                            <input type="color" class="form-control @error('couleur') is-invalid @enderror" id="couleur" name="couleur" value="{{ old('couleur', '#f8fafc') }}">
                            @error('couleur')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('services.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection