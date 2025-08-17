@extends('layouts.app')

@section('content')
<h2>Créer un Post</h2>

<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Titre" class="form-control mb-2">
    <textarea name="content" placeholder="Contenu" class="form-control mb-2"></textarea>
   <input type="file" name="images[]" multiple accept="image/*">
    <button class="btn btn-primary">Créer</button>
</form>
@endsection
