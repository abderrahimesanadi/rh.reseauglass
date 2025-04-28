@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>Bienvenue dans votre interface RH</h2>
                    <p>Utilisez le menu pour naviguer.</p>
                    
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <h3 class="card-title">Gestion des employés</h3>
                                        <p class="card-text">Ajouter, modifier et supprimer les informations des employés</p>
                                        <a href="{{ route('employees.index') }}" class="btn btn-success">Accéder</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <h3 class="card-title">Ajouter un employé</h3>
                                        <p class="card-text">Créer une nouvelle fiche pour un employé</p>
                                        <a href="{{ route('employees.create') }}" class="btn btn-primary">Ajouter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection