@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">SERVICES</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('services.create') }}" class="btn btn-primary">
            Ajouter un service
        </a>
    </div>

    <div class="list-group">
        @foreach($services as $service)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <span class="badge p-2 mr-3" style="background-color:  '#6c757d' ; color: yellow">
                    {{ $service->nom }}
                </span>
            </div>
            <div>
                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-info mr-2">
                    Modifier
                </a>
                <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection