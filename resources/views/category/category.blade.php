@extends('layouts.template')
@section('title', 'Kategori Buku')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold text-dark mb-3" style="color: var(--black-color);">Jelajahi Kategori Buku</h2>
        <p class="lead text-muted">Temukan buku berdasarkan kategori favorit Anda</p>
    </div>

    <!-- Categories Grid -->
    <div class="row g-4 justify-content-center">
        @forelse ($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="category-card h-100">
                    <a href="{{ route('books.category', $category->id) }}" class="text-decoration-none">
                        <div class="card border-1 shadow-sm rounded-3 overflow-hidden h-100 hover-effect">
                            <div class="card-body text-center p-4 d-flex flex-column justify-content-center">
                                <div class="icon-wrapper mb-3 mx-auto" style="width: 60px; height: 60px;">
                                    <i class="fas fa-book-open fa-2x" style="color: var(--primary-color);"></i>
                                </div>
                                <h3 class="h5 fw-bold mb-0 text-dark">{{ $category->name }}</h3>
                                <small class="text-muted mt-1">
                                    {{ $category->books()->count() ?? 0}} buku tersedia
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state text-center py-5">
                    <i class="fas fa-inbox fa-4x mb-3" style="color: #e9ecef;"></i>
                    <h4 class="text-muted">Belum ada kategori tersedia</h4>
                    <p class="text-muted">Silakan kembali lagi nanti</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    /* Custom Styles */
    .hover-effect {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        border-color: var(--primary-color);
    }
    
    .category-card .card-body {
        transition: background-color 0.3s ease;
    }
    
    .category-card:hover .card-body {
        background-color: #f8f9fa;
    }
    
    .icon-wrapper {
        background-color: rgba(var(--primary-rgb), 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>


@endsection