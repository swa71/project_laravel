@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Connexion</h2>

    <form action="{{ route('login') }}" method="POST" class="w-50 mx-auto">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
</div>
@endsection
