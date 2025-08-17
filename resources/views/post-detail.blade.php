@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="post-card">
                @if($post->images && count($post->images) > 0)
                    <div class="post-images {{ count($post->images) > 1 ? 'multiple' : '' }}"
                         @if(count($post->images) > 5) data-count="{{ count($post->images) - 4 }}" @endif>
                        @foreach($post->images as $i => $image)
                            @if($i < 4)
                                <img src="{{ asset('storage/' . $image) }}" alt="Image">
                            @else
                                <!-- Hidden images for lightbox gallery -->
                                <img src="{{ asset('storage/' . $image) }}" alt="Image" style="display: none;">
                            @endif
                        @endforeach
                    </div>
                @elseif($post->videos && count($post->videos) > 0)
                    <div class="post-videos main-content">
                        <div class="row">
                            @foreach($post->videos as $video)
                                <div class="col-md-6">
                                    <video controls>
                                        <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                        Votre navigateur ne supporte pas la lecture de vidéos.
                                    </video>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <img src="https://via.placeholder.com/700x400?text=Pas+Image+ni+Vidéo" alt="No image or video">
                @endif

                @if($post->images && count($post->images) > 0 && $post->videos && count($post->videos) > 0)
                    <div class="post-videos mb-3">
                        <h6 class="text-muted mb-2">Vidéos :</h6>
                        <div class="row">
                            @foreach($post->videos as $video)
                                <div class="col-md-6 mb-2">
                                    <video width="100%" height="250" controls class="rounded">
                                        <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                        Votre navigateur ne supporte pas la lecture de vidéos.
                                    </video>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="post-body">
                    <div class="post-title">{{ $post->title }}</div>
                    <div class="post-text">{{ $post->content }}</div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('posts.main') }}" class="btn btn-outline-secondary btn-sm">
                            ← Retour aux posts
                        </a>
                        @if($post->images && count($post->images) > 0)
                            <a href="{{ route('posts.videos') }}" class="btn btn-outline-primary btn-sm">
                                Voir les vidéos
                            </a>
                        @endif
                        <button class="love-button" data-post-id="{{ $post->id }}">
                            ❤️ J'adore <span class="count">0</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Love Button Functionality
        const loveButtons = document.querySelectorAll('.love-button');

        loveButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const countSpan = this.querySelector('.count');
                let currentCount = parseInt(countSpan.textContent) || 0;

                // Increment count
                currentCount++;
                countSpan.textContent = currentCount;

                // Add liked class for animation
                this.classList.add('liked');

                // Remove liked class after animation
                setTimeout(() => {
                    this.classList.remove('liked');
                }, 600);

                // Optional: Save to localStorage to persist the count
                const postId = this.getAttribute('data-post-id');
                localStorage.setItem(`love-count-${postId}`, currentCount);
            });

            // Load saved count from localStorage
            const postId = button.getAttribute('data-post-id');
            const savedCount = localStorage.getItem(`love-count-${postId}`);
            if (savedCount) {
                const countSpan = button.querySelector('.count');
                countSpan.textContent = savedCount;
            }
        });
    });
</script>
@endsection
