@extends('layouts.template')
@section('title', 'PustakaAvault')

@section('content')
    <div class="container mt-3">
        <h2 class="mb-4 text-center">
            {{ isset($category) ? 'Kategori: ' . $category->name : 'Daftar Buku' }}
        </h2>

        {{-- Search Form --}}
        <form action="{{ route('books.search') }}" method="GET" class="d-flex justify-content-center mb-4">
            <div class="input-group" style="max-width: 800px; box-shadow: 0 4px 4px rgba(134, 134, 134, 0.1);">
                <input type="text" name="query" class="form-control" placeholder="Cari Buku...."
                    value="{{ request('query') }}">
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
                    <div class="card d-flex flex-row h-100 shadow-sm overflow-hidden">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="Cover" class="card-img-left img-fluid"
                            style="max-width: 150px; object-fit: cover; height: 100%;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $book->title }}</h5>

                                {{-- Info Buku --}}
                                <div class="d-flex flex-column gap-1 small text-muted mb-2">
                                    <div>Penulis: {{ $book->author }}</div>
                                    <div>Penerbit: {{ $book->publisher }}</div>
                                    <div>Tahun: {{ $book->year }}</div>
                                    <div>Stok: {{ $book->stock }}</div>
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
                                <a href="javascript:void(0);" class="btn btn-sm text-white btn-detail"
                                    style="background-color: var(--primary-color); width: 100px;"
                                    data-id="{{ $book->id }}">
                                    Detail
                                </a>
                                <a href="{{ route('books.borrow', $book->id) }}" class="btn btn-sm text-white"
                                    style="background-color: var(--primary-color); width: 100px;">
                                    Pinjam Buku
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
                <div class="modal-header">
                    <h5 class="modal-title">Detail Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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

@endsection
