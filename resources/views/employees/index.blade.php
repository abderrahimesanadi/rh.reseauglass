@extends('employees.layout')

@section('employee-content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Suivi des congés payés</h4>
        <div>
            <div class="btn-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    {{ $displayMonth}}/{{ $currentYear }}
                </button>
                <ul class="dropdown-menu">
                    @foreach($availableMonths as $month => $name)
                        <li><a class="dropdown-item" href="{{ route('employees.index', ['month' => $month, 'year' => $currentYear]) }}">{{ $name }} {{ $currentYear }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <head>
    <!-- Vos balises meta et autres liens CSS existants -->
    <style>
        .table-striped th, .table thead th {
            background-color:rgb(93, 102, 112); /* Vert ou couleur de votre choix */
            color: white;
        }
    </style>
</head>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date d'embauche</th>
                        <th>Ancienneté</th>
                        <th>Congés acquis</th>
                        <th>Congés pris</th>
                        <th>CP {{ $currentMonth }}/{{ $currentYear }}</th>
                        <th>Congés restants</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($employees->count() > 0)
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->nom }}</td>
                            <td>{{ $employee->prenom }}</td>
                            <td>{{ $employee->date_embauche->format('d/m/Y') }}</td>
                            <td>{{ $employee->anciennete }}</td>
                            <td>{{ $employee->conges_acquis_value ?? 0 }}</td>
                            <td>{{ $employee->conges_pris }}</td>
                            <td>{{ $employee->monthlyLeaves->where('month_key', sprintf("%02d/%d", $displayMonth, $currentYear))->first()->leave_value ?? 0 }}</td>
                            <td>{{ $employee->conges_restants }}</td>
                            <td>
                            <div class="btn-group" role="group">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary" title="Éditer">
    <i class="fas fa-edit"></i>
</a>

    <button type="button" class="btn btn-sm btn-danger" title="Supprimer" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $employee->id }}">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>


                                
                                <!-- Modal de confirmation de suppression -->
                                <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmer la suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer {{ $employee->prenom }} {{ $employee->nom }} ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">Aucun employé trouvé</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection