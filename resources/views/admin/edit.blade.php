@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Modifier le Post</h2>

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control"
                   value="{{ old('title', $post->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenu</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        @if($post->images)
            <div class="mb-3">
                <label>Images actuelles :</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($post->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Image" style="height: 100px; object-fit: cover; border-radius: 5px;">
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-3">
            <label for="images" class="form-label">Ajouter / Remplacer les images</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
            <small class="text-muted">Laisser vide pour garder les images actuelles.</small>
            @error('images.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success" type="submit">Mettre à jour</button>
        <a href="{{ route('posts.admin') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
