@extends('layouts.template')
@section('title', 'Pinjaman Saya')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Pinjaman Buku</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($loans->isEmpty())
        <p class="text-center">Belum ada buku yang dipinjam.</p>
    @else
        <table class="table table-bordered shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</td>
                        <td>
                            @if ($loan->status === 'borrowed')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
