@extends('layouts.template') {{-- Sesuaikan dengan layout utamamu --}}

@section('title', 'Konfirmasi Peminjaman')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header">
                    <h4 class="mb-0">Konfirmasi Peminjaman Buku</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Kolom Gambar Buku --}}
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid rounded" alt="Cover buku {{ $book->title }}" style="max-height: 300px; object-fit: cover; border-radius: 0.5rem;">
                        </div>

                        {{-- Kolom Detail Buku dan Form --}}
                        <div class="col-md-8">
                            <h3 class="fw-bold mb-3">{{ $book->title }}</h3>
                            <p class="text-muted">oleh {{ $book->author }}</p>
                            <hr class="my-4">
                            <p class="text-muted">{{ $book->description }}</p>
                            <ul class="list-unstyled mb-4">
                                <li><strong>Kategori:</strong> {{ $book->category->name ?? 'Tidak ada kategori' }}</li>
                                <li><strong>Stok Tersedia:</strong> {{ $book->stock }}</li>
                            </ul>

                            <div class="alert alert-info alert-dismissible fade show" role="alert" style="background-color: var(--secondary-color); color: var(--primary-color);">
                                <p class="mb-0">Anda akan meminjam buku ini. Peminjaman berlaku selama 14 hari. Pastikan Anda mengembalikannya tepat waktu.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            {{-- Form untuk konfirmasi akhir --}}
                            <form action="{{ route('loans.borrow', $book) }}" method="POST">
                                @csrf
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Batal</a>
                                    <button type="submit" class="btn" style="background-color: var(--primary-color); color: white;">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Ya, Konfirmasi & Pinjam
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
