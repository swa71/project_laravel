@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Gestion des Posts</h2>

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Ajouter un Post</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($posts as $post)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5>{{ $post->title }}</h5>
                <p>{{ Str::limit($post->content, 200) }}</p>

                @if($post->images)
                    <div class="mb-2 d-flex flex-wrap gap-2">
                        @foreach($post->images as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Image" style="height: 100px; object-fit: cover; border-radius: 5px;">
                        @endforeach
                    </div>
                @endif

                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Modifier</a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Supprimer ce post ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </div>
        </div>
    @empty
        <p>Aucun post trouvé.</p>
    @endforelse
</div>
@endsection
