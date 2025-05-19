@extends('employees.layout')

@section('employee-content')

<div class="card">
    <div class="card-header">
        <h3>Modifier l'employé: {{ $employee->prenom }} {{ $employee->nom }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $employee->nom) }}" required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom', $employee->prenom) }}" required>
                    @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="date_embauche" class="form-label">Date d'embauche</label>
                <input type="date" class="form-control @error('date_embauche') is-invalid @enderror" id="date_embauche" name="date_embauche" value="{{ old('date_embauche', $employee->date_embauche->format('Y-m-d')) }}" required>
                <div class="form-text">La date d'embauche est utilisée pour calculer l'ancienneté et les congés acquis.</div>
                @error('date_embauche')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="conges_pris" class="form-label">Congés pris</label>
                <input type="number" step="0.5" class="form-control @error('conges_pris') is-invalid @enderror" id="conges_pris" name="conges_pris" value="{{ old('conges_pris', $employee->conges_pris) }}" required>
                @error('conges_pris')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
          <!-- Dans la section "Mois spécifiques" de votre formulaire d'édition -->
<div class="card mb-3">
    <div class="card-header">
        <h5>Congés de ce Mois</h5>
    </div>
    <div class="card-body">
        @php
            // Récupérer les mois disponibles pour tous les employés
            $availableMonths = App\Models\MonthlyLeave::select('month_key')
                ->distinct()
                ->orderBy('month_key', 'desc')
                ->pluck('month_key')
                ->toArray();

            // Si aucun mois n'est disponible, ajouter le mois en cours
            if (empty($availableMonths)) {
                $availableMonths[] = date('m/Y');
            }

            // Récupérer les congés mensuels de l'employé
            $monthlyLeaves = $employee->monthlyLeaves->pluck('leave_value', 'month_key')->toArray();
        @endphp
        
        <div class="row row-cols-1 row-cols-md-3 g-2">
            @foreach($availableMonths as $month)
                <div class="col">
                    <div class="mb-3">
                        <label for="monthly_leaves_{{ $month }}" class="form-label">CP {{ $month }}</label>
                        <input type="number" step="0.5" class="form-control" id="monthly_leaves_{{ $month }}" 
                               name="monthly_leaves[{{ $month }}]" 
                               value="{{ old('monthly_leaves.'.$month, $monthlyLeaves[$month] ?? 0) }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header bg-info text-white">
        <h5>Informations calculées (non modifiables)</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Ancienneté (mois)</label>
                    <p>{{ $employee->anciennete }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Congés acquis</label>
                    <p>{{ $employee->conges_aquis }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Congés restants</label>
                    <p>{{ $employee->conges_restants }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection