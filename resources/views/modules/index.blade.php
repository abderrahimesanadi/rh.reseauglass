@extends('layouts.app')

@section('content')
<style>
    thead th {
        background-color:rgb(93, 102, 112)!important; /* Gris foncé élégant */
        color: #ffffff !important; /* Texte blanc */
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des Modules</h1>
        <a href="{{ route('modules.create') }}" class="btn btn-primary">Ajouter un module</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Ajout de la barre de recherche pour les modules -->
    <div class="search-container" style="margin: 20px 0; display: flex; gap: 15px;">
        <div style="flex: 1;">
            <input type="text" id="moduleSearchInput" placeholder="Rechercher un module..." 
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div>
            <select id="moduleServiceFilter" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">Tous les services</option>
                <option value="Verif">Verif</option>
                <option value="Courrier">Courrier</option>
                <option value="Qualité">Qualité</option>
                <option value="Recouvrement">Recouvrement</option>
                <option value="Relance">Relance</option>
            </select>
        </div>
    </div>

    <script>
    // Fonction de recherche et filtrage pour les modules
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('moduleSearchInput');
        const serviceFilter = document.getElementById('moduleServiceFilter');
        
        // Fonction pour filtrer le tableau des modules
        function filterModulesTable() {
            const searchValue = searchInput.value.toLowerCase();
            const serviceValue = serviceFilter.value;
            
            // Sélectionner tous les modules (lignes du tableau)
            const table = document.querySelector('table'); // Assurez-vous d'avoir une balise table
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                // Récupérer les colonnes pertinentes
                const service = row.querySelector('td:nth-child(1)').textContent.trim();
                const moduleTitle = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                
                // Vérifier si la ligne correspond aux critères de recherche
                const matchTitle = moduleTitle.includes(searchValue);
                const matchService = serviceValue === '' || service.includes(serviceValue);
                
                // Afficher ou masquer la ligne selon les résultats
                row.style.display = (matchTitle && matchService) ? '' : 'none';
            });
        }
        
        // Ajouter les écouteurs d'événements
        searchInput.addEventListener('input', filterModulesTable);
        serviceFilter.addEventListener('change', filterModulesTable);
    });
    </script>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Titre du Module</th>
                    <th>Compétences</th>
                    <th>Objectifs</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($modules as $module)
                <tr>
                    <td>
                        <?php
                            $couleur = '';
                            $textColor = '#fff';
                            
                            switch($module->service) {
                                case 'Verif':
                                    $couleur = '#90EE90';
                                    break;
                                case 'Courrier':
                                    $couleur = '#FFFF99';
                                    $textColor = '#212529';
                                    break;
                                case 'Relance':
                                    $couleur = '#DDA0DD';
                                    break;
                                case 'Qualité':
                                    $couleur = '#FFA07A';
                                    break;
                                case 'Recouvrement':
                                    $couleur = '#87CEFA';
                                    break;
                                default:
                                    $couleur = '#6c757d';
                            }
                        ?>
                        <span class="badge" style="background-color: {{ $couleur }}; color: {{ $textColor }};">
                            {{ $module->service }}
                        </span>
                    </td>
                    <td>{{ $module->titre }}</td>
                    <td>{{ $module->competences }}</td>
                    <td>{{ $module->objectifs }}</td>
                    
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('modules.destroy', $module->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun module trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection