@extends('layouts.app')

@section('content')
<style>
    .custom-thead {
        background-color:rgb(93, 102, 112); /* 🔵 Bleu foncé élégant */
    }
    .custom-thead th {
        color: white;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Suivi qualite</h1>
        <a href="{{ route('suivi-qualite.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un suivi
        </a>
    </div>
    
    <div class="mb-4">
        <form action="{{ route('suivi-qualite.index') }}" method="GET" class="d-flex">
            <div class="flex-grow-1 me-2">
                <input type="text" name="agent_search" class="form-control" placeholder="Rechercher par nom d'agent..." value="{{ request('agent_search') }}">
            </div>
            <button type="submit" class="btn btn-outline-secondary">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </form>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="custom-thead">
                <tr>
                    <th>AGENTS</th>
                    <th>SESSION</th>
                    <th>DATE DE FORMATION</th>
                    <th>ANALYSE</th>
                    <th>SUIVI QUALITE</th>
                    <th>N° DOSSIER</th>
                    <th>DATE DE TRAITEMENT </th>
                    <th>COMMENTAIRE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suiviqualite as $suivi)
                <tr>
                    <td>{{ $suivi->agent->nom ?? '' }} {{ $suivi->agent->prenom ?? '' }}</td>
                    <td>{{ $suivi->module->titre ?? '' }}</td>
                    <td>
                        @if($suivi->session && $suivi->session->date_formation)
                            {{ \Carbon\Carbon::parse($suivi->session->date_formation)->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span class="badge {{
                            $suivi->analyse == 'Conforme' ? 'bg-success' :
                            ($suivi->analyse == 'Passable' ? 'bg-warning' :
                            ($suivi->analyse == 'Non conforme' ? 'bg-danger' : 'bg-secondary'))
                        }}">
                            {{ $suivi->analyse ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $suivi->suiviQualite->name ?? '-' }}</td>
                    <td>{{ $suivi->numero_dossier ?? '-' }}</td>
                    <td>{{ $suivi->date_traitement_dossier ? $suivi->date_traitement_dossier->format('d/m/Y') : '-' }}</td>
                    <td>{{ $suivi->commentaire ?? '-' }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('suivi-qualite.edit', $suivi->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('suivi-qualite.destroy', $suivi->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce suivi?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection