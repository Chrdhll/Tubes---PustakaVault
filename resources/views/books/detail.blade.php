<div class="row">
    <div class="col-md-4">
        <img src="{{ asset('storage/' . $book->image) }}" alt="Cover" class="img-fluid rounded shadow-sm">
    </div>
    <div class="col-md-8">
        <h4>{{ $book->title }}</h4>
        <p class="text-muted mb-2">oleh {{ $book->author }}</p>
        <span class="badge mb-3"
            style="background-color: var(--secondary-color); color: var(--primary-color);">{{ $book->category->name ?? '-' }}</span>
        <ul class="list-unstyled">
            <li><strong>Penerbit:</strong> {{ $book->publisher }}</li>
            <li><strong>Tahun:</strong> {{ $book->year }}</li>
            <li><strong>Stok:</strong> {{ $book->stock }}</li>
            <p><strong>Deskripsi:</strong><br>{{ $book->blurb }}</p>
            @if (Auth::check() && auth()->user()->role === 'member')
                <div class="mt-4 d-grid">
                    <a href="{{ route('pinjam.create', $book) }}"
                        style="background-color: var(--primary-color); color: white;"
                        class="btn btn-lg {{ $book->stock <= 0 ? 'disabled' : '' }}">
                        <i class="bi bi-bookmark-plus me-1"></i> Pinjam Buku Ini
                    </a>
                </div>
            @endif
        </ul>
    </div>
</div>

@if (Auth::check() && auth()->user()->role === 'member')
    <hr class="my-4">

    <div class="row">
        <div class="col-md-7">
            @auth
                @if ($userHasReviewed)
                    <div class="alert alert-success"
                        style="background-color: var(--secondary-color); color: var(--primary-color);"><i
                            class="bi bi-check-circle-fill"></i> Anda sudah memberikan ulasan untuk buku ini.</div>
                @else
                    <h5 class="mb-3">Tulis Ulasan Anda</h5>
                    <form id="review-form" action="{{ route('reviews.store', $book->id) }}" method="POST">
                        @csrf
                        <div id="review-errors" class="alert alert-danger" style="display: none;"></div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select" id="rating" name="rating" required
                                style="background-color: white; border-color: var(--primary-color); color: var(--primary-color);">
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="1">★☆☆☆☆</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Ulasan (Opsional)</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Bagaimana pendapatmu?"
                                style="background-color: white; border-color: var(--primary-color); color: var(--primary-color);"></textarea>
                        </div>
                        <button type="submit" class="btn text-white"
                            style="background-color: var(--primary-color); color: var(--white-color);">Kirim Ulasan</button>
                    </form>
                @endif
            @endauth
            @guest
                <div class="alert alert-secondary" role="alert"
                    style="background-color: var(--secondary-color); color: var(--white-color);"><a
                        href="{{ route('login') }}" style="color: var(--primary-color);">Login</a> untuk memberikan ulasan.
                </div>
            @endguest
        </div>

        <div class="col-md-5">
            <h5 class="mb-3">Ulasan Pengguna (<span id="review-count">{{ $book->reviews->count() }}</span>)</h5>
            <div id="review-list" style="max-height: 300px; overflow-y: auto;">
                @forelse ($book->reviews as $review)
                    @include('books.single-review', ['review' => $review])
                @empty
                    <p id="no-reviews-message">Belum ada ulasan. Jadilah yang pertama!</p>
                @endforelse
            </div>
        </div>
    </div>

@endif
