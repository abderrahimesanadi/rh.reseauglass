@extends('layouts.app')

@section('title', 'Suivi Congés')

@section('styles')
<style>
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 123, 255, 0.1);
    }
    .table th {
        background-color: #4a89dc;
        color: white;
        text-align: center;
    }
    .highlight {
        background-color: #ffdddd !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Suivi Congés</h2>
        
        <div>
            <a href="{{ route('employees.index') }}" class="btn btn-outline-primary me-2">Liste des employés</a>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Ajouter un employé</a>
        </div>
    </div>
    <form method="GET" action="{{ route('employees.index') }}" class="mb-4">
    <div class="row">
        <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou prénom" value="{{ request('search') }}">
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Réinitialiser</a>
        </div>
    </div>
</form>

   
</form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('employee-content')
</div>
@endsection