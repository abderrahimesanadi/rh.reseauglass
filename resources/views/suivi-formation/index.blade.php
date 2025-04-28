@extends('layouts.app')

@section('content')
<style>
    .custom-thead {
        background-color:rgb(93, 102, 112); /* 💡 Mets ici ta couleur désirée */
    }

    .custom-thead th {
        color: #ffffff; /* Texte blanc sur fond foncé */
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }
</style>

<div class="container">
    <h1 class="mb-4">Suivi de Formation</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Filtres de recherche</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('suivi-formation.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="agent" class="form-label">Agent</label>
                    <input type="text" class="form-control" id="agent" name="agent" placeholder="Rechercher par nom d'agent" value="{{ request('agent') }}">
                </div>
                <div class="col-md-4">
                    <label for="module" class="form-label">Module</label>
                    <input type="text" class="form-control" id="module" name="module" placeholder="Rechercher par module" value="{{ request('module') }}">
                </div>
                <div class="col-md-4">
                    <label for="service" class="form-label">Service</label>
                    <select class="form-select" id="service" name="service">
                        <option value="">Tous les services</option>
                        @foreach($services ?? [] as $service)
                            <option value="{{ $service->id }}" {{ request('service') == $service->id ? 'selected' : '' }}>
                                {{ $service->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                    <a href="{{ route('suivi-formation.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="custom-thead">
                <tr>
                    <th>Date Formation</th>
                    <th>Titre du Module</th>
                    <th>Agent</th>
                    <th>Service</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suivis as $suivi)
                <tr>
                    <td>
                        @if ($suivi->session && $suivi->session->date_formation)
                            {{ \Carbon\Carbon::parse($suivi->session->date_formation)->format('d/m/Y') }}
                        @else
                            Non définie
                        @endif
                    </td>
                    <td>{{ $suivi->session->module->titre ?? '-----' }}</td>
                    <td>{{ $suivi->agent->prenom ?? '' }} {{ $suivi->agent->nom ?? '' }}</td>
                    <td>
                        <span class="badge rounded-pill" 
                              style="background-color: {{ $suivi->agent?->service?->couleur ?? '#CCCCCC' }}; color: #FFFFFF; padding: 0.5em 1em; font-weight: bold;">
                            {{ $suivi->agent?->service?->nom ?? 'Non défini' }}
                        </span>
                    </td>
                    <td>
    <span class="badge {{ $suivi->statut == 'INSCRIT' ? 'bg-warning text-dark' : 'bg-success text-white' }}">
        {{ $suivi->statut }}
    </span>
</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun suivi de formation trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('suivi-formation.update-statuts') }}" class="btn btn-primary">Mettre à jour les statuts</a>
    </div>
</div>
<style>
    /* Ajoutez ces styles dans votre section style */
    .statut-inscrit {
        background-color: #FFC107; /* Jaune pour "INSCRIT" */
        color: #000;
    }
    
    .statut-terminee {
        background-color: #28A745; /* Vert pour "TERMINÉE" */
        color: #FFF;
    }
    
    .statut-badge {
        padding: 0.5em 1em;
        border-radius: 50px;
        font-weight: bold;
        min-width: 100px;
        text-align: center;
        display: inline-block;
    }
    
    .dropdown-menu .dropdown-item.active {
        background-color: #0d6efd;
        color: white;
    }
</style>
@endsection