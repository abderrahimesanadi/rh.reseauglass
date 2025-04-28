@extends('layouts.app')

@section('content')
<style>
    .custom-header {
        background-color:rgb(93, 102, 112) ; /* 💡 Remplace cette couleur par celle que tu veux */
        color: white;
    }

    .custom-header th {
        color: white;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des Sessions de Formation</h1>
        <a href="{{ route('session.create') }}" class="btn btn-primary">Ajouter une session</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Ajout de la barre de recherche pour les sessions de formation -->
    <div class="search-container" style="margin: 20px 0; display: flex; gap: 15px;">
        <div style="flex: 1;">
            <input type="text" id="sessionSearchInput" placeholder="Rechercher un module..." 
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div>
            <input type="date" id="dateFilter" 
                style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div>
            <button id="resetFilters" style="padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">
                Réinitialiser
            </button>
        </div>
    </div>

    <script>
    // Fonction de recherche et filtrage pour les sessions
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('sessionSearchInput');
        const dateFilter = document.getElementById('dateFilter');
        const resetButton = document.getElementById('resetFilters');
        
        // Fonction pour filtrer le tableau des sessions
        function filterSessionsTable() {
            const searchValue = searchInput.value.toLowerCase();
            const dateValue = dateFilter.value ? new Date(dateFilter.value) : null;
            
            // Sélectionner toutes les sessions (lignes du tableau)
            const table = document.querySelector('table'); // Assurez-vous d'avoir une balise table
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                // Récupérer les colonnes pertinentes
                const dateText = row.querySelector('td:nth-child(1)').textContent.trim();
                const moduleText = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                
                // Convertir le texte de date en objet Date pour la comparaison
                const dateParts = dateText.split('/');
                const rowDate = dateParts.length === 3 ? 
                                new Date(dateParts[2], dateParts[1] - 1, dateParts[0]) : null;
                
                // Vérifier si la ligne correspond aux critères de recherche
                const matchModule = moduleText.includes(searchValue);
                const matchDate = !dateValue || 
                                (rowDate && rowDate.toDateString() === dateValue.toDateString());
                
                // Afficher ou masquer la ligne selon les résultats
                row.style.display = (matchModule && matchDate) ? '' : 'none';
            });
        }
        
        // Fonction pour réinitialiser les filtres
        function resetFilters() {
            searchInput.value = '';
            dateFilter.value = '';
            
            // Réafficher toutes les lignes
            const table = document.querySelector('table');
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.style.display = '';
            });
        }
        
        // Ajouter les écouteurs d'événements
        searchInput.addEventListener('input', filterSessionsTable);
        dateFilter.addEventListener('change', filterSessionsTable);
        resetButton.addEventListener('click', resetFilters);
    });
    </script>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="custom-header">
                <tr>
                    <th>Date de la formation</th>
                    <th>Choix du Module</th>
                    <th>Choix des Agents</th>
                    <th>Nombre d'Agent INSCRIT</th>
                    <th>Actions</th>
                </tr>
</thead>
            </thead>
            <tbody>
                @forelse($sessions as $session)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($session->date_formation)->format('d/m/Y') }}</td>
                    <td>
                        {{ $session->module->titre ?? 'Non défini' }}
                    </td>
                    <td class="text-center">
                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#agentsModal{{ $session->id }}">+</a>
                        
                        <!-- Modal pour voir/ajouter des agents -->
                        <div class="modal fade" id="agentsModal{{ $session->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Agents inscrits à cette session</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if($session->agents->count() > 0)
                                            <ul class="list-group mb-3">
                                                @foreach($session->agents as $agent)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $agent->nom }} {{ $agent->prenom }}
                                                        <form action="{{ route('session.remove-agent', $session->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                                                            <button type="submit" class="btn btn-sm btn-danger">Retirer</button>
                                                        </form>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Aucun agent inscrit à cette session.</p>
                                        @endif
                                        
                                        <hr>
                                        <h6>Ajouter un agent</h6>
                                        <form action="{{ route('session.add-agent', $session->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <select name="agent_id" class="form-control" required>
                                                    <option value="">Sélectionner un agent</option>
                                                    @foreach(App\Models\Agent::whereNotIn('id', $session->agents->pluck('id')->toArray())->get() as $agent)
                                                        <option value="{{ $agent->id }}">{{ $agent->nom }} {{ $agent->prenom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">{{ $session->nombre_agents }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('session.edit', $session->id) }}" class="btn btn-sm btn-info me-2">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('session.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette session?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune session trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection