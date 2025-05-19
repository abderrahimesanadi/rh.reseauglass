@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="login-container">
    <h2 class="text-center mb-4">Connexion</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        
        
        <div class="form-group">
            <button type="submit">Connexion</button>
        </div>
        
        <div class="text-center mt-3">
            <p>Vous n'avez pas de compte ? <a href="{{ route('register.show') }}">Inscription</a></p>
        </div>
    </form>
</div>
@endsection