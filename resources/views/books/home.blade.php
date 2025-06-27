@extends('layouts.template')
@section('title', 'PustakaVault')

@section('content')
    <div class="container py-5">
        <h1 class="mb-3 text-center display-5 fw-bold " style="color: var(--black-color);">
            {{ isset($category) ? 'Kategori : ' . $category->name : 'Koleksi Buku PustakaVault' }}
        </h1>

        <p class="lead text-muted text-center mb-5">Temukan buku terbaik untuk menambah wawasan Anda</p>

        {{-- Search Form --}}
        <form action="{{ route('books.search') }}" method="GET" class="d-flex justify-content-center mb-5">
            <div class="input-group" style="max-width: 800px; box-shadow: 0 4px 4px rgba(134, 134, 134, 0.1);">
                <input type="text" name="query" class="form-control ps-4 py-2"
                    placeholder="Cari judul, penulis, atau kategori..." value="{{ request('query') }}">
                <button type="submit" class="btn text-white"
                    style="background-color: var(--primary-color); box-shadow: 0 4px 4px rgba(134, 134, 134, 0.1);">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>

        {{-- Books --}}
        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-4 col-lg-4 mb-4">
                    <div class="card d-flex flex-row h-100 shadow-sm overflow-hidden hover-card">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="Cover" class="card-img-left img-fluid"
                            style="max-width: 150px; object-fit: cover; height: 100%;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title" style="font-weight: 550; color: var(--black-color);">{{ $book->title }}</h5>

                                {{-- Info Buku --}}
                                <div class="d-flex flex-column gap-1 small text-muted mb-2">
                                    <div>Penulis: {{ $book->author }}</div>
                                    <div>Penerbit: {{ $book->publisher }}</div>
                                    <div>Tahun: {{ $book->year }}</div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2"
                                            style="width: 20px; height: 20px; border-radius: 50%; background-color:
                                            {{ $book->stock > 0 ? '#28a745' : '#dc3545' }}">
                                        </div>
                                        <div>
                                            {{ $book->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Kategori --}}
                                @if ($book->category)
                                    <a href="{{ route('books.category', $book->category->id) }}"
                                        class="badge rounded-pill text-decoration-none"
                                        style="background-color: var(--secondary-color); color: var(--primary-color); font-size: 0.75rem;">
                                        {{ $book->category->name }}
                                    </a>
                                @endif
                            </div>

                            {{-- Tombol --}}
                            <div class="mt-3 d-flex gap-2">
                                <button class="btn btn-outline-indigo btn-sm btn-detail flex-grow-1"
                                    style="border-color: var(--primary-color); transition: all 0.3s;"
                                    onmouseover="this.style.backgroundColor = 'var(--primary-color)'; this.style.color = 'white';"
                                    onmouseout="this.style.backgroundColor = 'white'; this.style.color = 'var(--primary-color)';"
                                    data-id="{{ $book->id }}">
                                    <i class="bi bi-info-circle me-1"></i> Detail
                                </button>
                                <a href="{{ route('loans.borrow', $book->id) }}"
                                    class="btn text-white btn-sm flex-grow-1 {{ $book->stock <= 0 ? 'disabled' : '' }}"
                                    style="background-color: var(--primary-color);">
                                    <i class="bi bi-bookmark-plus me-1"></i> Pinjam
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <p class="text-center">Tidak ada buku ditemukan.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $books->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <!-- Modal Detail Buku -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: var(--primary-color); color: white;">
                    <h5 class="modal-title">Detail Buku</h5>
                    <button type="button" class="btn-close" style="background-color: white; color: red;" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" id="modalContent" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                    Loading...
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-detail').click(function(e) {
                e.preventDefault();
                var bookId = $(this).data('id');
                $('#modalContent').html('Loading...');
                $('#detailModal').modal('show');

                $.ajax({
                    url: '/books/' + bookId + '/detail',
                    method: 'GET',
                    success: function(data) {
                        $('#modalContent').html(data);
                    },
                    error: function() {
                        $('#modalContent').html(
                            '<p class="text-danger">Gagal mengambil data buku.</p>');
                    }
                });
            });

            $('#detailModal').on('hidden.bs.modal', function() {
                $('#modalContent').html('Loading...');
            });
        });
    </script>

    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination .page-link {
            color: var(--primary-color);
        }
    </style>

@endsection
