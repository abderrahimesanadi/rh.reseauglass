@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="login-container">
    <h2 class="text-center mb-4">Inscription</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf
        
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        
        <div class="form-group">
            <button type="submit">S'inscrire</button>
        </div>
        
        <div class="text-center mt-3">
            <p>Vous avez déjà un compte ? <a href="{{ route('login.show') }}">Connexion</a></p>
        </div>
    </form>
</div>
@endsection