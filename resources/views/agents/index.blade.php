@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Titre déplacé hors de la card -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Liste des Agents</h1>
                <a href="{{ route('agents.create') }}" class="btn btn-primary">Ajouter un agent</a>
            </div>

            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Stats Container -->
                    <div class="stats-container mb-4">
                        @foreach($services as $service)
                            <div class="stat-card" style="background-color: {{ $service->couleur }}">
                                <h5>{{ $service->nom }}</h5>
                                <p>{{ $service->agents_count }} agents</p>
                            </div>
                        @endforeach
                        </div>
                    <!-- Search and Filter -->
                    <div class="search-container mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" id="searchInput" placeholder="Rechercher un agent..." 
                                       class="form-control">
                            </div>
                            <div class="col-md-4">
                                <select id="serviceFilter" class="form-control">
                                    <option value="">Tous les services</option>
                                    <option value="Qualité">Qualité</option>
                                    <option value="Relance">Relance</option>
                                    <option value="Verif">Verif</option>
                                    <option value="Recouvrement">Recouvrement</option>
                                    <option value="Courrier">Courrier</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Agents Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NOM</th>
                                    <th>PRENOM</th>
                                    <th>SERVICE</th>
                                    <th>Nombre de formation suivi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agents as $agent)
                                <tr>
                                    <td>{{ $agent->nom }}</td>
                                    <td>{{ $agent->prenom }}</td>
                                    <td> 
                                        <span class="badge" style="background-color: {{ $agent->service->couleur }}; color: 
                                        @if(strtolower($agent->service->nom) == 'courrier') #212529
                                        @else #fff
                                        @endif;">
                                            {{ $agent->service->nom }}  
                                        </span>
                                    </td>
                                    <td>{{ $agent->nombre_formation_suivi }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-info" style="padding: 0.375rem 0.75rem;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('agents.destroy', $agent->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="padding: 0.375rem 0.75rem;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agent?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-container">
    <div class="pagination-info">
        Affichage de {{ $agents->firstItem() }} à {{ $agents->lastItem() }} sur {{ $agents->total() }} agents
    </div>
    
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($agents->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">&laquo; Précédent</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $agents->previousPageUrl() }}" rel="prev">&laquo; Précédent</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($agents->getUrlRange(1, $agents->lastPage()) as $page => $url)
            @if ($page == $agents->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($agents->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $agents->nextPageUrl() }}" rel="next">Suivant &raquo;</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Suivant &raquo;</span>
            </li>
        @endif
    </ul>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stats-container {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .stat-card {
        border-radius: 8px;
        padding: 12px 16px;
        text-align: center;
        flex: 1 1 18%;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        min-width: 150px;
    }

    .stat-card:hover {
        transform: scale(1.03);
    }

    .stat-card h5 {
        margin: 0;
        font-size: 16px;
        color: #343a40;
    }

    .stat-card p {
        margin: 4px 0 0;
        font-size: 14px;
        color: #6c757d;
    }

    .search-container {
        margin-bottom: 20px;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 600;
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .page-item {
        margin: 0 5px;
    }
    
    .page-link {
        color: #495057;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 8px 16px;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }
    
    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #f8f9fa;
    }
    
    .pagination-info {
        text-align: center;
        margin: 15px 0;
        color: #6c757d;
        font-size: 14px;
    }
    thead th {
        background-color:rgb(93, 102, 112) !important; /* Gris foncé */
        color: #ffffff !important; /* Texte blanc */
        text-align: center;
        vertical-align: middle;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const serviceFilter = document.getElementById('serviceFilter');
    
    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const serviceValue = serviceFilter.value;
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const nom = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const prenom = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const service = row.querySelector('td:nth-child(3)').textContent.trim();
            
            const matchSearch = nom.includes(searchValue) || prenom.includes(searchValue);
            const matchService = serviceValue === '' || service === serviceValue;
            
            row.style.display = (matchSearch && matchService) ? '' : 'none';
        });
    }
    
    searchInput.addEventListener('input', filterTable);
    serviceFilter.addEventListener('change', filterTable);
});
</script>
@endsection