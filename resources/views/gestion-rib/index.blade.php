{{-- Modification du fichier index.blade.php pour gérer les relations null --}}

@extends('layouts.app')

@section('title', 'Gestion RIB')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1>Gestion des RIB</h1>
            <a href="{{ route('gestion-rib.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un nouveau RIB
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- Barre de recherche --}}
    <div class="row mb-4">
        <div class="col-12">
            <form action="{{ route('gestion-rib.index') }}" method="GET">
                <div class="input-group w-100">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher par nom d'agent..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table RIB --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-black">
                    <h5 class="mb-0">Liste des RIB</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <thead>
                                <tr style="background-color:rgb(93, 102, 112); color: white;">
                                    <th width="40">#</th>
                                    <th>Nom et Prénom</th>
                                    <th>RIB</th>
                                    <th width="150">Statut</th>
                                    <th width="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agentRibs as $index => $agentRib)
                                <tr class="{{ $agentRib->status === 'new rib' ? 'table-danger' : '' }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if($agentRib->agent)
                                            {{ $agentRib->agent->nom }} {{ $agentRib->agent->prenom }}
                                        @else
                                            <span class="text-danger">Agent non trouvé</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span id="rib-{{ $agentRib->id }}">{{ $agentRib->rib }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('rib-{{ $agentRib->id }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </td>
                                    <td>{{ $agentRib->status }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $agentRib->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('gestion-rib.destroy', $agentRib->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce RIB?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edition -->
                                <div class="modal fade" id="editModal{{ $agentRib->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="editModalLabel">Modifier le RIB</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('gestion-rib.update', $agentRib->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="agent_name" class="form-label">Agent</label>
                                                        <input type="text" class="form-control" id="agent_name" value="{{ $agentRib->agent ? $agentRib->agent->nom . ' ' . $agentRib->agent->prenom : 'Agent non trouvé' }}" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="rib" class="form-label">RIB</label>
                                                        <input type="text" class="form-control" id="rib" name="rib" value="{{ $agentRib->rib }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Statut</label>
                                                        <select class="form-select" id="status" name="status" required>
                                                            <option value="new" {{ $agentRib->status === 'new' ? 'selected' : '' }}>Nouvel agent</option>
                                                            <option value="new rib" {{ $agentRib->status === 'new rib' ? 'selected' : '' }}>Nouveau RIB</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucun RIB trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function copyToClipboard(elementId) {
        const text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(() => {
            // Feedback utilisateur
            const originalElement = document.getElementById(elementId).nextElementSibling;
            const originalIcon = originalElement.innerHTML;
            originalElement.innerHTML = '<i class="fas fa-check"></i>';
            originalElement.classList.remove('btn-outline-secondary');
            originalElement.classList.add('btn-success');
            
            setTimeout(() => {
                originalElement.innerHTML = originalIcon;
                originalElement.classList.remove('btn-success');
                originalElement.classList.add('btn-outline-secondary');
            }, 2000);
        }).catch(err => {
            console.error('Erreur lors de la copie :', err);
        });
    }
</script>

@endsection