<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PustakaVault - @yield('title', 'PustakaVault')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (required for AJAX and Bootstrap 4) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: {{ $primaryColor ?? '#4B0082' }};
            --secondary-color: {{ $secondaryColor ?? '#F7EDFF' }};
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
            box-shadow: 0px -4px 4px rgba(134, 134, 134, 0.2);
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
                    style="font-size: 1.5rem; font-weight: bold; color: var(--primary-color);">PustakaVault</a>
            </div>
            <div>
                <a href="/" class="{{ Request::is('/*') ? 'active' : '' }}">Buku</a>
                <a href="/categories" class="{{ Request::is('categories*') ? 'active' : '' }}">Kategori</a>
                <a href="/borrowings" class="{{ Request::is('borrowings*') ? 'active' : '' }}">Pinjam Buku</a>

            </div>
            <div class="auth-buttons">
                <a href="/login" class="sign-in">Sign In</a>
                <a href="/register" class="sign-up text-white">Sign Up</a>
            </div>
        </div>
    </nav>

    <div class="mt-8">
        @yield('content')
    </div>

    <footer class="py-2">
        copyright &copy; 2025 by fadhil
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

