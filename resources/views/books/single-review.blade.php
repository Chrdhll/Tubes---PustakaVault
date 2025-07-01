<div class="d-flex mb-3">
    <div class="flex-shrink-0">
         <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=random&color=fff" 
                 alt="Avatar" width="40" height="40" class="rounded-circle">
    </div>
    <div class="ms-3">
        <h6 class="mt-0 mb-1 fw-bold">{{ $review->user->name }}</h6>
        <div class="text-warning mb-1">
            @for ($i = 1; $i <= 5; $i++)
                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
            @endfor
        </div>
        <p class="mb-1" style="font-size: 0.9rem;">{{ $review->comment }}</p>
        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
    </div>
</div>