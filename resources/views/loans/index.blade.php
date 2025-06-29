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
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <img src="{{ asset('storage/' . $loan->book->image) }}" alt="Cover"
                                                    width="50" class="rounded">
                                            </td>
                                            <td>{{ $loan->book->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</td>
                                            <td>
                                                @if ($loan->return_date)
                                                    {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($loan->status == 'borrowed')
                                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                                @else
                                                    <span class="badge bg-success">Dikembalikan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($loan->status == 'borrowed')
                                                    <form action="{{ route('pinjam.return', $loan) }}" method="POST">
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
