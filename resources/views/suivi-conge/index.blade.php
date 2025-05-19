@extends('layouts.app')

@section('content')
<script src="jquery-3.6.0.min.js"></script>
<script src="bootstrap.bundle.min.js"></script> <!-- Inclut les modals Bootstrap -->
<script src="select2.min.js"></script>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Suivi des absences {{ $currentDate->format('m/Y') }}</h1>

        
    </div>
</div>


    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liste des absences</h3>
        </div>
        <div class="card-body">
           <!-- Barre de recherche -->
<div class="row mb-3">
    <div class="col-md-4">
        <form action="{{ route('suivi-conge.index') }}" method="GET" class="form-inline">
            <div class="input-group">
                <input type="month" name="month_year" class="form-control" 
                       value="{{ $currentDate->format('Y-m') }}" onchange="this.form.submit()">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Filtrer</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-8">
        <form action="{{ route('suivi-conge.index') }}" method="GET" id="searchForm">
            <input type="hidden" name="month_year" value="{{ $currentDate->format('Y-m') }}">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou prénom" 
                       value="{{ request('search') }}">
                <select name="service" class="form-control">
                    <option value="">Tous les services</option>
                    @foreach($services as $service)
                        <option value="{{ $service->nom }}" {{ request('service') == $service->nom ? 'selected' : '' }}>
                            {{ $service->nom }}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                    <a href="{{ route('suivi-conge.index', ['month_year' => $currentDate->format('Y-m')]) }}" 
                       class="btn btn-secondary">Réinitialiser</a>
                </div>
            </div>
        </form>
    </div>
</div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th rowspan="2">Service</th>
                            <th rowspan="2">Nom</th>
                            <th rowspan="2">Prénom</th>
                            <th rowspan="2">CP {{ sprintf('%02d/%d', $month, $year % 100) }}</th>
                            <th rowspan="2">M {{ sprintf('%02d/%d', $month, $year % 100) }}</th>
                            <th rowspan="2">A {{ sprintf('%02d/%d', $month, $year % 100) }}</th>
                            @foreach($days as $day)
                                <th class="{{ $day['is_weekend'] ? 'bg-warning' : '' }}" style="width: 30px;">
                                    {{ $day['day'] }}
                                </th>
                            @endforeach
                        </tr>
                        <tr class="bg-light">
                            @foreach($days as $day)
                                <th class="{{ $day['is_weekend'] ? 'bg-warning' : '' }}" style="width: 30px;">
                                    {{ Str::substr($day['dayName'], 0, 1) }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agents as $agent)
                            @php
                                // Récupérer la couleur du service
                                $serviceColor = $services->where('nom', $agent->service)->first()->couleur ?? '#FFFFFF';
                            @endphp
                            <tr>
                            <td>
    <span class="badge" style="background-color: {{ $serviceColor }}; color: 
    @if(strtolower($agent->service) == 'courrier') #212529
    @else #fff
    @endif;">
        {{ $agent->service }}
    </span>
</td>
                                <td>{{ $agent->nom }}</td>
                                <td>{{ $agent->prenom }}</td>
                                <td class="bg-danger text-white">{{ $cpTotals[$agent->agent_id] ?? 0 }}</td>
                                <td class="bg-success text-white">{{ $maladeTotals[$agent->agent_id] ?? 0 }}</td>
                                <td class="bg-primary text-white">{{ $absentTotals[$agent->agent_id] ?? 0 }}</td>
                                
                                @foreach($days as $day)
                                    @php
                                        $congeDay = $conges[$agent->agent_id] ?? collect();
                                        $conge = $congeDay->firstWhere('date_suivi', $day['date']);
                                        $statusClass = '';
                                        
                                        if ($conge) {
                                            switch($conge->status) {
                                                case 'C':
                                                    $statusClass = 'bg-danger text-white';
                                                    break;
                                                case 'A':
                                                    $statusClass = 'bg-primary text-white';
                                                    break;
                                                case 'M':
                                                    $statusClass = 'bg-success text-white';
                                                    break;
                                            }
                                        }
                                    @endphp
                                    
                                    <td class="{{ $statusClass }}" 
                                        onclick="showCongeModal({{ $agent->agent_id }}, '{{ $day['date'] }}', '{{ $conge->status ?? '' }}')"
                                        style="cursor: pointer;">
                                        {{ $conge ? $conge->status : '' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal pour modifier/supprimer un congé -->
<div class="modal fade" id="congeModal" tabindex="-1" role="dialog" aria-labelledby="congeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="congeModalLabel">Modifier une absence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('suivi-conge.store') }}" method="POST" id="congeForm">
                @csrf
                <div class="modal-body">
                    <p><strong>Agent: </strong><span id="agent_name"></span></p>
                    <p><strong>Date: </strong><span id="formatted_date"></span></p>
                    
                    <input type="hidden" id="agent_id" name="agent_id">
                    <input type="hidden" id="conge_date" name="date">
                    
                    <div class="form-group">
                        <label>Statut:</label>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-outline-danger">
                                <input type="radio" name="status" value="C"> Congé (C)
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="status" value="A"> Absent (A)
                            </label>
                            <label class="btn btn-outline-success">
                                <input type="radio" name="status" value="M"> Malade (M)
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteCongeBtn">Supprimer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    /* Styles cohérents avec le template agents */
    .badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 600;
        display: inline-block;
    }
    
    thead th {
        background-color: rgb(93, 102, 112) !important; /* Gris foncé */
        color: #ffffff !important; /* Texte blanc */
        text-align: center;
        vertical-align: middle;
    }
    /* Solution pour un en-tête de tableau fixe */
.table-responsive {
    overflow-y: auto;
    max-height: 75vh; /* Hauteur maximale pour permettre le défilement */
}

/* S'assurer que thead est sticky par rapport au conteneur parent */
.table-responsive thead {
    position: sticky;
    top: 0;
    z-index: 100; /* Valeur plus élevée pour s'assurer qu'il reste au-dessus */
}



/* S'assurer que les deux rangées d'en-tête sont fixes */
.table-responsive thead tr:nth-child(1) th,
.table-responsive thead tr:nth-child(2) th {
    position: sticky;
    top: 0;
    z-index: 100;
}

/* Ajuster la position de la deuxième rangée d'en-tête */
.table-responsive thead tr:nth-child(2) th {
    top: 42px; /* Ajuster cette valeur selon la hauteur exacte de votre première ligne */
}
    
    /* Styles pour les indicateurs de statut */
    td.bg-danger, td.bg-primary, td.bg-success {
        text-align: center;
        font-weight: bold;
    }
    
    /* Amélioration visuelle des statistiques */
    .card-header {
        border-bottom: none;
    }
    
    /* Amélioration pour l'affichage des jours */
    .table th {
        font-size: 0.9rem;
    }
    h1 {
    font-size: 2.5rem;
    color: #212529;
    margin-top: 1rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0,0,0,0.125);
}

.card-header h3 {
    margin-bottom: 0;
    font-size: 1.5rem;
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a53be;
}

.btn-primary i {
    margin-right: 0.5rem;
}

/* Styles pour Select2 */
.select2-container--default .select2-selection--single {
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: normal;
    padding-left: 0;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: calc(1.5em + 0.75rem);
}

.select2-dropdown {
    border: 1px solid #ced4da;
}

.select2-search__field {
    padding: 0.375rem 0.75rem !important;
}

.select2-results__option {
    padding: 0.375rem 0.75rem;
}
</style>

@endsection

@section('scripts')
<script>
    // Ajoutez ceci dans votre document.ready
$('#congeModal').on('show.bs.modal', function() {
    console.log('Modal de modification ouverte');
});

$('#congeModal').on('hidden.bs.modal', function() {
    console.log('Modal de modification fermé');
});
$(document).ready(function() {
    // Charger la liste des agents via AJAX lors de l'ouverture du modal
    // Chargement initial des agents lors du chargement de la page
    function loadAgentsList() {
        return $.ajax({
            url: '/api/agents',
            type: 'GET',
            dataType: 'json',
            cache: false, // Désactiver le cache pour toujours obtenir les données fraîches
            beforeSend: function() {
                console.log('Chargement des agents en cours...');
            }
        });
    }
    
    // Stocker la liste des agents en mémoire
    let agentsList = [];
    
    // Charger la liste des agents une fois au démarrage
    loadAgentsList().done(function(data) {
        console.log('Agents chargés avec succès:', data.length, 'agents');
        agentsList = data.sort(function(a, b) {
            return a.nom.localeCompare(b.nom, 'fr', {sensitivity: 'base'}) || 
                   a.prenom.localeCompare(b.prenom, 'fr', {sensitivity: 'base'});
        });
    }).fail(function(xhr, status, error) {
        console.error('Erreur initiale lors du chargement des agents:', error);
    });
    
    // Configurer le modal lors de son ouverture
    $('#addCongeModal').on('show.bs.modal', function() {
        console.log('Ouverture du modal d\'ajout d\'absence');
        
        // Nettoyer l'ancien Select2 s'il existe
        if($('#agent_id').hasClass('select2-hidden-accessible')) {
            $('#agent_id').select2('destroy');
        }
        
        // Vider et réinitialiser la liste
        $('#agent_id').empty().append('<option value="">Sélectionner un agent</option>');
        
        if (agentsList.length > 0) {
            // Utiliser la liste en mémoire si elle existe déjà
            populateAgentsList(agentsList);
        } else {
            // Sinon, recharger depuis l'API
            loadAgentsList().done(function(data) {
                agentsList = data.sort(function(a, b) {
                    return a.nom.localeCompare(b.nom, 'fr', {sensitivity: 'base'}) || 
                           a.prenom.localeCompare(b.prenom, 'fr', {sensitivity: 'base'});
                });
                populateAgentsList(agentsList);
            }).fail(function(xhr, status, error) {
                console.error('Erreur lors du chargement des agents:', error);
                $('#agent_id').append('<option value="">Erreur de chargement des agents</option>');
                alert('Erreur lors du chargement des agents. Veuillez réessayer ou rafraîchir la page.');
            });
        }
    });
    
    // Fonction pour remplir la liste des agents
    function populateAgentsList(agents) {
        // Vérifier qu'on a bien des données
        if (!agents || agents.length === 0) {
            console.warn('Aucun agent à afficher');
            $('#agent_id').append('<option value="">Aucun agent disponible</option>');
            return;
        }
        
        console.log('Remplissage de la liste avec', agents.length, 'agents');
        
        // Ajouter chaque agent à la liste déroulante
        $.each(agents, function(index, agent) {
            $('#agent_id').append(
                $('<option></option>')
                    .attr('value', agent.agent_id)
                    .text(agent.nom + ' ' + agent.prenom + ' (' + agent.service + ')')
            );
        });
        
        // Initialiser Select2 après avoir chargé les données
        try {
            $('#agent_id').select2({
                placeholder: 'Sélectionner un agent',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#addCongeModal'),
                language: {
                    noResults: function() {
                        return "Aucun résultat trouvé";
                    },
                    searching: function() {
                        return "Recherche en cours...";
                    }
                }
            });
            console.log('Select2 initialisé avec succès');
        } catch (e) {
            console.error('Erreur lors de l\'initialisation de Select2:', e);
            alert('Erreur d\'affichage de la liste. Veuillez rafraîchir la page.');
        }
    }
    
    // Nettoyer lors de la fermeture du modal
    $('#addCongeModal').on('hidden.bs.modal', function() {
        if($('#agent_id').hasClass('select2-hidden-accessible')) {
            $('#agent_id').select2('destroy');
        }
    });
    
    // Définissez d'abord la fonction showCongeModal dans l'espace global
window.showCongeModal = function(agentId, date, status) {
    // Récupérer les informations de l'agent
    var agentRow = $('tr').filter(function() {
        return $(this).find('td:eq(0), td:eq(1), td:eq(2)').parent().get(0) === this &&
               $(this).find('td:eq(0)').length > 0;
    }).filter(function() {
        // Trouver la ligne qui correspond à l'agent_id
        var found = false;
        $(this).find('td').each(function() {
            if ($(this).attr('onclick') && $(this).attr('onclick').indexOf('showCongeModal(' + agentId) !== -1) {
                found = true;
                return false; // Sortir de la boucle each
            }
        });
        return found;
    });
    
    var agentService = agentRow.find('td:eq(0)').text().trim();
    var agentNom = agentRow.find('td:eq(1)').text().trim();
    var agentPrenom = agentRow.find('td:eq(2)').text().trim();
    
    // Formater la date pour l'affichage
    var formattedDate = new Date(date).toLocaleDateString('fr-FR', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    // Remplir le formulaire
    $('#congeModal #agent_id').val(agentId);
    $('#congeModal #conge_date').val(date);
    $('#congeModal #agent_name').text(agentNom + ' ' + agentPrenom + ' (' + agentService + ')');
    $('#congeModal #formatted_date').text(formattedDate);
    
    // Sélectionner le statut actuel
    $('#congeModal input[name="status"]').prop('checked', false);
    $('#congeModal .btn-group label').removeClass('active');
    if (status) {
        $('#congeModal input[name="status"][value="' + status + '"]').prop('checked', true);
        $('#congeModal .btn-group label:has(input[value="' + status + '"])').addClass('active');
    }
    
// Modification du formulaire de suppression pour pointer vers la bonne URL
$('#deleteCongeBtn').off('click').on('click', function() {
    if (confirm('Voulez-vous vraiment supprimer ce congé ?')) {
        // Créer un formulaire de suppression avec l'URL correcte
        var form = $('<form></form>')
            .attr('method', 'POST')
            .attr('action', '/suivi-conge/delete') // Changé de /destroy à /delete
            .append($('<input>').attr('type', 'hidden').attr('name', '_token').val($('meta[name="csrf-token"]').attr('content')))
            .append($('<input>').attr('type', 'hidden').attr('name', 'agent_id').val(agentId))
            .append($('<input>').attr('type', 'hidden').attr('name', 'date').val(date));
        
        $('body').append(form);
        form.submit();
    }
});
    
    // Afficher le modal
    $('#congeModal').modal('show');
};

// Le reste du code dans document.ready
$(document).ready(function() {
    // Vérifier si jQuery et Select2 sont bien chargés
    if (typeof $ === 'undefined') {
        console.error('jQuery n\'est pas chargé!');
        return;
    }
    
    if (typeof $.fn.select2 === 'undefined') {
        console.error('Select2 n\'est pas chargé!');
        // Charger Select2 dynamiquement si nécessaire
        var select2Script = document.createElement('script');
        select2Script.src = 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js';
        document.head.appendChild(select2Script);
        
        var select2Css = document.createElement('link');
        select2Css.rel = 'stylesheet';
        select2Css.href = 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css';
        document.head.appendChild(select2Css);
        
        // Attendre que Select2 soit chargé
        select2Script.onload = function() {
            console.log('Select2 chargé dynamiquement');
            initializeApp();
        };
    } else {
        initializeApp();
    }
    
    function initializeApp() {
        // Charger la liste des agents via AJAX lors de l'ouverture du modal
        let agentsList = [];
        
        function loadAgentsList() {
            return $.ajax({
                url: '/api/agents',
                type: 'GET',
                dataType: 'json',
                cache: false,
                beforeSend: function() {
                    console.log('Chargement des agents en cours...');
                }
            });
        }
        
        // Charger la liste des agents une fois au démarrage
        loadAgentsList().done(function(data) {
            console.log('Agents chargés avec succès:', data.length, 'agents');
            agentsList = data.sort(function(a, b) {
                return a.nom.localeCompare(b.nom, 'fr', {sensitivity: 'base'}) || 
                       a.prenom.localeCompare(b.prenom, 'fr', {sensitivity: 'base'});
            });
        }).fail(function(xhr, status, error) {
            console.error('Erreur initiale lors du chargement des agents:', error);
        });
        
        // Configurer le modal lors de son ouverture
        $('#addCongeModal').on('show.bs.modal', function() {
            console.log('Ouverture du modal d\'ajout d\'absence');
            
            // Nettoyer l'ancien Select2 s'il existe
            if($('#agent_id').hasClass('select2-hidden-accessible')) {
                $('#agent_id').select2('destroy');
            }
            
            // Vider et réinitialiser la liste
            $('#agent_id').empty().append('<option value="">Sélectionner un agent</option>');
            
            if (agentsList.length > 0) {
                // Utiliser la liste en mémoire si elle existe déjà
                populateAgentsList(agentsList);
            } else {
                // Sinon, recharger depuis l'API
                loadAgentsList().done(function(data) {
                    agentsList = data.sort(function(a, b) {
                        return a.nom.localeCompare(b.nom, 'fr', {sensitivity: 'base'}) || 
                               a.prenom.localeCompare(b.prenom, 'fr', {sensitivity: 'base'});
                    });
                    populateAgentsList(agentsList);
                }).fail(function(xhr, status, error) {
                    console.error('Erreur lors du chargement des agents:', error);
                    $('#agent_id').append('<option value="">Erreur de chargement des agents</option>');
                    alert('Erreur lors du chargement des agents. Veuillez réessayer ou rafraîchir la page.');
                });
            }
        });
        
        // Fonction pour remplir la liste des agents
        function populateAgentsList(agents) {
            // Vérifier qu'on a bien des données
            if (!agents || agents.length === 0) {
                console.warn('Aucun agent à afficher');
                $('#agent_id').append('<option value="">Aucun agent disponible</option>');
                return;
            }
            
            console.log('Remplissage de la liste avec', agents.length, 'agents');
            
            // Ajouter chaque agent à la liste déroulante
            $.each(agents, function(index, agent) {
                $('#agent_id').append(
                    $('<option></option>')
                        .attr('value', agent.agent_id)
                        .text(agent.nom + ' ' + agent.prenom + ' (' + agent.service + ')')
                );
            });
            
            // Initialiser Select2 après avoir chargé les données
            try {
                $('#agent_id').select2({
                    placeholder: 'Sélectionner un agent',
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $('#addCongeModal'),
                    language: {
                        noResults: function() {
                            return "Aucun résultat trouvé";
                        },
                        searching: function() {
                            return "Recherche en cours...";
                        }
                    }
                });
                console.log('Select2 initialisé avec succès');
            } catch (e) {
                console.error('Erreur lors de l\'initialisation de Select2:', e);
                alert('Erreur d\'affichage de la liste. Veuillez rafraîchir la page.');
            }
        }
        
        // Nettoyer lors de la fermeture du modal
        $('#addCongeModal').on('hidden.bs.modal', function() {
            if($('#agent_id').hasClass('select2-hidden-accessible')) {
                $('#agent_id').select2('destroy');
            }
        });
        
        // Validation du formulaire
        $('#addCongeForm, #congeForm').on('submit', function(e) {
            // Vérifier si un statut est sélectionné
            if (!$(this).find('input[name="status"]:checked').val()) {
                e.preventDefault();
                alert('Veuillez sélectionner un statut (Congé, Absent ou Malade)');
                return false;
            }
        });

        // JavaScript pour améliorer l'expérience utilisateur avec la recherche
        $('#searchForm').on('submit', function() {
            // Supprimer les champs vides pour avoir une URL plus propre
            $(this).find('input, select').each(function() {
                if ($(this).val() === '' || $(this).val() === null) {
                    $(this).prop('disabled', true);
                }
            });
        });

        // Réinitialisation des champs de recherche avec le bouton
        $('#resetSearch').on('click', function(e) {
            e.preventDefault();
            $('#searchForm input[name="search"]').val('');
            $('#searchForm select[name="service"]').val('');
            $('#searchForm').submit();
        });
    }
});
});
</script>
@endsection