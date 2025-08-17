@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">

<!-- Lightbox CSS -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container py-5">
        <h2 class="text-center fw-bold text-primary mb-5">Derniers Posts & Vidéos</h2>

    @forelse($posts as $index => $post)
        <div class="post-card">
            @if($post->images && count($post->images) > 0)
                <div class="post-images {{ count($post->images) > 1 ? 'multiple' : '' }}"
                     @if(count($post->images) > 5) data-count="{{ count($post->images) - 4 }}" @endif>
                    @foreach($post->images as $i => $image)
                        @if($i < 4)
                            <a href="{{ asset('storage/' . $image) }}"
                               class="glightbox{{ $index }}"
                               data-gallery="gallery{{ $index }}"
                               @if($i == 3 && count($post->images) > 4) data-remaining="{{ count($post->images) - 4 }}" @endif>
                                <img src="{{ asset('storage/' . $image) }}" alt="Image">
                            </a>
                        @else
                            <!-- Hidden images for lightbox gallery -->
                            <a href="{{ asset('storage/' . $image) }}"
                               class="glightbox{{ $index }} hidden-image"
                               data-gallery="gallery{{ $index }}"
                               style="display: none;">
                            </a>
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
                                <video width="100%" height="200" controls class="rounded">
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
                <div class="post-text">{{ wordwrap($post->content, 100, "\n", true) }}</div>
                @if($post->images && count($post->images) > 0)
                    <button class="love-button" data-post-id="{{ $post->id ?? $index }}">
                        ❤️ J'adore <span class="count">0</span>
                    </button>
                @else
                    <button class="love-button" data-post-id="{{ $post->id ?? $index }}">
                        ❤️ J'adore <span class="count">0</span>
                    </button>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Aucun post disponible.</p>
    @endforelse
</div>
@endsection

@section('scripts')
<!-- Lightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize Lightbox
        @foreach($posts as $index => $post)
            GLightbox({ selector: '.glightbox{{ $index }}' });
        @endforeach

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
