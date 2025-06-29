<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PustakaVault - @yield('title', 'PustakaVault')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: {{ $primaryColor ?? '#4B0082' }};
            --secondary-color: {{ $secondaryColor ?? '#E6D8F3' }};
            --black-color: {{ $blackColor ?? '#191919' }};
        }

        body,
        .navbar,
        .navbar a,
        .navbar .auth-buttons a,
        footer {
            font-family: Poppins, sans-serif;
        }

        .navbar {
            box-shadow: 0 4px 4px rgba(134, 134, 134, 0.1);
            background: #fff;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            margin-right: 1.5rem;
            text-decoration: none;
            color: var(--black-color);
            font-size: medium;
            position: relative;
            transition: color 0.3s;
        }

        .navbar a:not(.sign-in, .sign-up, .navbar-brand) {
            font-weight: 600;
        }

        .navbar a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            left: 50%;
            bottom: -2px;
            transition: width 0.3s, left 0.3s;
        }

        .navbar a:hover:not(.sign-in, .sign-up, .navbar-brand) {
            color: var(--primary-color);
        }

        .navbar a:hover:not(.sign-in, .sign-up, .navbar-brand)::after {
            width: 100%;
            left: 0;
        }

        .navbar .auth-buttons a {
            padding: 0.5rem 0.75rem;
            margin-right: 0.2rem;
            border-radius: 6px;
            text-decoration: none;
        }

        .sign-in {
            background: var(--secondary-color);
            color: var(--primary-color);
        }

        .sign-up {
            background: var(--primary-color);
        }

        .navbar .navbar-brand a:hover::after {
            width: 0 !important;
        }

        footer {
            box-shadow: 0px -4px 4px rgba(134, 134, 134, 0.1);
            background: var(--secondary-color);
            color: var(--primary-color);
            text-align: center;
            font-size: 0.9rem;
            margin-top: 4rem;
        }

        .active {
            color: var(--primary-color) !important;
        }
    </style>
</head>

<body>

    <nav class="navbar sticky-top py-3">
        <div class="container">
            <div class="navbar-brand">
                <a href="/"
                    style="font-weight: 700; font-size: 1.8rem; color: var(--primary-color);">PustakaVault</a>
            </div>
            <div>
                <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Buku</a>
                <a href="/categories" class="{{ Request::is('categories*') ? 'active' : '' }}">Kategori</a>
                <a href="{{ route('pinjam.index') }}" class="{{ Request::is('pinjam*') ? 'active' : '' }}">Pinjam Buku</a>
            </div>

            <div class="auth-buttons d-flex align-items-center gap-1">

                @guest
                    <a href="{{ route('login') }}" class="sign-in">Masuk</a>
                    <a href="{{ route('register') }}" class="sign-up text-white">Daftar</a>
                @endguest

                @auth
                    <div class="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff"
                            alt="User Avatar" class="rounded-circle" style="width: 40px; height: 40px;"
                            data-bs-toggle="dropdown" aria-expanded="false">

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <h6 class="dropdown-header text-center">
                                    <strong>{{ Auth::user()->name }}</strong>
                                    <div class="small text-muted">{{ Auth::user()->email }}</div>
                                </h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i> Profil
                                    Saya</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-history me-2"></i> Riwayat
                                    Pinjaman</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

            </div>
        </div>
    </nav>

    <main class="mt-8">

        {{-- notifikasi success  --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- notifikasi error  --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="py-3">
        copyright &copy; PustakaVault. All rights reserved.
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
