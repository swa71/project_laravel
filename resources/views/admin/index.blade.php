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

                @if($post->images && count($post->images) > 0)
                    <div class="mb-2">
                        <strong>Images :</strong>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            @foreach($post->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Image" style="height: 100px; object-fit: cover; border-radius: 5px;">
                            @endforeach
                        </div>
                    </div>
                @elseif($post->videos && count($post->videos) > 0)
                    <div class="mb-2">
                        <strong>Vidéos :</strong>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            @foreach($post->videos as $video)
                                <div class="border rounded p-2">
                                    <video width="200" height="150" controls>
                                        <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                        Votre navigateur ne supporte pas la lecture de vidéos.
                                    </video>
                                    <div class="text-center mt-1">
                                        <small class="text-muted">{{ basename($video) }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($post->images && count($post->images) > 0 && $post->videos && count($post->videos) > 0)
                    <div class="mb-2">
                        <strong>Vidéos :</strong>
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            @foreach($post->videos as $video)
                                <div class="border rounded p-2">
                                    <video width="150" height="100" controls>
                                        <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                        Votre navigateur ne supporte pas la lecture de vidéos.
                                    </video>
                                    <div class="text-center mt-1">
                                        <small class="text-muted">{{ basename($video) }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-3">
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Supprimer ce post ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p>Aucun post trouvé.</p>
    @endforelse
</div>
@endsection
