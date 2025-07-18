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

        .hero-background-section {
            position: relative;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            height: 400px;
            background: url('{{ asset('storage/banners/background_foto_2.jpg') }}') center/cover no-repeat;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 3rem;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Base overlay - transparan di awal */
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(var(--primary-color-rgb, 139, 92, 246), 0.1),
                    rgba(var(--secondary-color-rgb, 236, 72, 153), 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s ease;
        }

        /* Overlay saat hover/focus */
        .hero-background-section:hover .hero-overlay,
        .hero-background-section:focus .hero-overlay {
            background: linear-gradient(135deg,
                    rgba(var(--primary-color-rgb, 139, 92, 246), 0.3),
                    rgba(var(--secondary-color-rgb, 236, 72, 153), 0.3));
        }

        /* Dark overlay untuk readability text */
        .hero-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
            transition: opacity 0.5s ease;
        }

        .hero-background-section:hover .hero-overlay::before,
        .hero-background-section:focus .hero-overlay::before {
            opacity: 0.4;
        }

        .hero-content {
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 0 2rem;
            animation: fadeInUp 1s ease-out;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .hero-background-section:hover .hero-content,
        .hero-background-section:focus .hero-content {
            transform: translateY(-10px);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            line-height: 1.6;
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .hero-background-section:hover .hero-subtitle,
        .hero-background-section:focus .hero-subtitle {
            opacity: 1;
            font-weight: 400;
        }

        .hero-features {
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
            opacity: 0.7;
            transition: all 0.5s ease;
        }

        .hero-background-section:hover .hero-features,
        .hero-background-section:focus .hero-features {
            opacity: 1;
            transform: translateY(-5px);
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .hero-background-section:hover .feature-item,
        .hero-background-section:focus .feature-item {
            transform: translateY(-8px);
        }

        .feature-item:hover {
            transform: translateY(-12px) scale(1.05);
        }

        .feature-item i {
            font-size: 1.5rem;
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .hero-background-section:hover .feature-item i,
        .hero-background-section:focus .feature-item i {
            opacity: 1;
            transform: scale(1.1);
        }

        /* Animasi */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Parallax effect untuk desktop */
        @media (min-width: 768px) {
            .hero-background-section {
                background-attachment: fixed;
            }
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .hero-background-section {
                height: 300px;
                background-attachment: scroll;
            }

            .hero-subtitle {
                font-size: 1.2rem;
                margin-bottom: 1.5rem;
            }

            .hero-features {
                gap: 2rem;
            }

            .feature-item {
                font-size: 0.8rem;
            }

            .feature-item i {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-background-section {
                height: 250px;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-features {
                gap: 1.5rem;
            }
        }

        .active {
            color: var(--primary-color) !important;
        }

        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(75, 0, 130, 0.25);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand" href="/"
                style="font-weight: 700; font-size: 1.8rem; color: var(--primary-color);">PustakaVault</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Buku</a>
                    <a href="/categories" class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">Kategori</a>
                    @if (!Auth::check() || Auth::user()->role !== 'admin')
                        <a href="{{ route('pinjam.index') }}"
                            class="nav-link {{ Request::is('pinjam*') ? 'active' : '' }}">Pinjaman Saya</a>
                    @endif
                </div>

                <div class="navbar-nav ms-lg-auto">
                    <div class="auth-buttons d-flex align-items-center gap-1">
                        @guest
                            <a href="{{ route('login') }}" class="sign-in nav-link">Masuk</a>
                            <a href="{{ route('register') }}" class="sign-up nav-link text-white">Daftar</a>
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
                                    @if (Auth::check() && auth()->user()->role === 'member')
                                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profil</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    @endif
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
            </div>
        </div>
    </nav>

    <main class="mt-8">
        @yield('content')
    </main>

    <footer class="py-3">
        copyright &copy; PustakaVault. All rights reserved.
    </footer>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="appToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i id="toast-icon" class="bi rounded me-2"></i>
                <strong id="toast-title" class="me-auto"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="toast-body" class="toast-body">
                {{-- Pesan akan muncul di sini --}}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success') || session('error'))
                const toastEl = document.getElementById('appToast');
                const toastTitleEl = document.getElementById('toast-title');
                const toastBodyEl = document.getElementById('toast-body');
                const toastIconEl = document.getElementById('toast-icon');

                @if (session('success'))
                    toastEl.classList.add('text-bg-success');
                    toastTitleEl.innerText = 'Sukses!';
                    toastIconEl.classList.add('bi-check-circle-fill');
                    toastBodyEl.innerHTML = "{{ session('success') }}";
                @elseif (session('error'))
                    toastEl.classList.add('text-bg-danger');
                    toastTitleEl.innerText = 'Error!';
                    toastIconEl.classList.add('bi-x-circle-fill');
                    toastBodyEl.innerText = "{{ session('error') }}";
                @endif

                const toast = new bootstrap.Toast(toastEl, {
                    delay: 5000
                });
                toast.show();
            @endif
        });
    </script>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
