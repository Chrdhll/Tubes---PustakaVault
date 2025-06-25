<div class="row">
    <div class="col-md-4">
        <img src="{{ asset('storage/' . $book->image) }}" alt="Cover" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-8">
        <h4>{{ $book->title }}</h4>
        <p><strong>Penulis:</strong> {{ $book->author }}</p>
        <p><strong>Penerbit:</strong> {{ $book->publisher }}</p>
        <p><strong>Tahun:</strong> {{ $book->year }}</p>
        <p><strong>Kategori:</strong> {{ $book->category->name ?? '-' }}</p>
        <p><strong>Stok:</strong> {{ $book->stock }}</p>
        <p><strong>Deskripsi:</strong><br> {{ $book->blurb }}</p>
    </div>
</div>
