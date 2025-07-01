@extends('layouts.template')

@section('content')
<div class="container" style="margin-top: 80px; margin-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header border-0 text-center py-4" style="background-color: white;">
                    <h3 class="fw-bold my-2">Selamat Datang Kembali</h3>
                    <p class="text-muted">Login untuk melanjutkan</p>
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger" style="font-size: 0.9rem;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                            <label for="email">Alamat Email</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                            <label for="password">Password</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg fw-bold" style="background-color: var(--primary-color); color: white;">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3 border-0" style="background-color: white;">
                    <div class="small" >
                        Belum punya akun? <a href="{{ route('register') }}" style="color: var(--primary-color);">Daftar di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection