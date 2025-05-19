@extends('layouts.app')

@section('title', 'Ajouter un nouveau RIB')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1>Ajouter un nouveau RIB</h1>
            <a href="{{ route('gestion-rib.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Ajouter un nouveau RIB</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('gestion-rib.store') }}">
                        @csrf

                        {{-- Champs pour agent existant --}}
                        <div id="existingAgentFields">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agent_id">Sélectionner un agent</label>
                                        <select name="agent_id" id="agent_id" class="form-control @error('agent_id') is-invalid @enderror" required>
                                            <option value="">-- Sélectionner un agent --</option>
                                            @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}</option>
                                            @endforeach
                                        </select>
                                        @error('agent_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RIB et Statut --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="rib">RIB</label>
                                    <input type="text" name="rib" class="form-control @error('rib') is-invalid @enderror" required>
                                    @error('rib')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="status">Statut</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="new">Nouvel agent</option>
                                        <option value="new rib">Nouveau RIB</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus-circle"></i> Ajouter
                                </button>
                                <a href="{{ route('gestion-rib.index') }}" class="btn btn-secondary">
                                    Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection