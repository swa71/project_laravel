@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Créer un Post</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" name="title" id="title" placeholder="Titre" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Contenu</label>
                            <textarea name="content" id="content" placeholder="Contenu" class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*" class="form-control">
                            <small class="form-text text-muted">Formats acceptés: JPG, JPEG, PNG. Taille max: 2MB par image</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="videos" class="form-label">Vidéos</label>
                            <input type="file" name="videos[]" id="videos" multiple accept="video/*" class="form-control">
                            <small class="form-text text-muted">Formats acceptés: MP4, AVI, MOV, WMV, FLV, WEBM. Taille max: 100MB par vidéo</small>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Créer le Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
