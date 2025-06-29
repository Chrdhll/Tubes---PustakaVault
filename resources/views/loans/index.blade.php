@extends('layouts.template')

@section('title', 'Buku Pinjaman Saya')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Riwayat Peminjaman Buku {{ auth()->user()->name }}</h2>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Cover</th>
                                        <th scope="col">Judul Buku</th>
                                        <th scope="col">Tanggal Pinjam</th>
                                        <th scope="col">Tanggal Kembali</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($loans as $loan)
                                        <tr class="{{ $loan->is_overdue ? 'table-danger' : '' }}">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <img src="{{ asset('storage/' . $loan->book->image) }}" alt="Cover"
                                                    width="50" class="rounded">
                                            </td>
                                            <td>
                                                {{ $loan->book->title }}
                                                {{-- Tampilkan badge jika terlambat --}}
                                                @if ($loan->is_overdue)
                                                    <span class="badge bg-danger ms-2">Terlambat</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</td>
                                            {{-- Tampilkan Due Date --}}
                                            <td>
                                                @if ($loan->status == 'borrowed')
                                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                                @else
                                                    <span class="badge bg-success">Dikembalikan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($loan->status == 'borrowed')
                                                    {{-- Tampilkan Denda jika ada --}}
                                                    @if ($loan->is_overdue)
                                                        <div class="text-danger fw-bold mb-2">
                                                            Rp {{ number_format($loan->current_fine, 0, ',', '.') }}
                                                        </div>
                                                    @endif

                                                    <form action="{{ route('pinjam.return', $loan) }}" method="POST"
                                                       >
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success">Kembalikan</button>
                                                    </form>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Anda belum pernah meminjam buku.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
