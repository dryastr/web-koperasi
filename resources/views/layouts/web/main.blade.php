<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <link rel="stylesheet" href="{{ asset('assets-web/css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/collection/components/icon/icon.min.css">

    <link rel="preload" as="image" href="{{ asset('assets-web/images/hero-banner.png') }}">
    <link rel="preload" as="image" href="{{ asset('assets-web/images/hero-abs-1.png') }}" media="min-width(768px)">
    <link rel="preload" as="image" href="{{ asset('assets-web/images/hero-abs-2.png') }}" media="min-width(768px)">
    @stack('header-styles')
    <style>
        .navbar-center {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .navbar-center .navbar-list {
            display: flex;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .sub-navbar {
            background-color: #f8f9fa;
            padding: 5px 0;
            text-align: center;
        }

        .sub-navbar p {
            margin: 0;
            font-size: 14px;
        }

        .sub-navbar a {
            color: #007bff;
            text-decoration: none;
        }

        .sub-navbar a:hover {
            text-decoration: underline;
        }

        .btn-contact {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-contact:hover {
            background-color: #0056b3;
        }

        .d-flex{
            display: flex;
        }

        .contact-social {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: #fff;
        }

        .social-icons a {
            margin-left: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: #0056b3;
        }

        .contact-container {
            padding: 10px 30px;
            background-color: #fff;
        }

        .contact-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contact-details p {
            margin-bottom: 0;
        }

        .contact-icons a {
            margin-left: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .contact-icons a:hover {
            color: #0056b3;
        }

        .contact-container {
            padding: 10px 30px;
            background-color: #fff;
        }

        .contact-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contact-details p {
            margin-bottom: 0;
        }

        .contact-icons a {
            margin-left: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .contact-icons a:hover {
            color: #0056b3;
        }
    </style>


</head>

<body id="top">

    <header class="header" data-header style="padding-block: 0; z-index: 999;">
        @include('layouts.web.navbar')
    </header>

    <div class="search-container" data-search-box>
        <div class="container">

            <button class="search-close-btn" aria-label="Close search" data-search-toggler>
                <ion-icon name="close-outline"></ion-icon>
            </button>

            <div class="search-wrapper">
                <input type="search" name="search" placeholder="Search Here..." aria-label="Search"
                    class="search-field">

                <button class="search-submit" aria-label="Submit" data-search-toggler>
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </div>

        </div>
    </div>

    <main>
        <article>

            @yield('content')

        </article>
    </main>

    <footer class="footer">

        @include('layouts.web.footer')

    </footer>

    <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
        <ion-icon name="arrow-up"></ion-icon>
    </a>


    <script src="{{ asset('assets-web/js/script.js') }}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/ionicons.min.js"></script>
    <script>
        // Toggle navbar
        document.querySelectorAll('[data-nav-toggler]').forEach(toggler => {
            toggler.addEventListener('click', () => {
                document.querySelector('[data-navbar]').classList.toggle('active');
                document.querySelector('[data-overlay]').classList.toggle('active');
            });
        });
    </script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>

    @stack('scripts')

</body>

</html>
