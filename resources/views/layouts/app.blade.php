<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> Luisa Pharmaceutical PVT LTD </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">        
        <!--<link href="{{ asset('aos/aos.css') }}" rel="stylesheet">-->
        <link href="{{ asset('animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ asset('remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon//site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <!-- ======= Top Bar ======= -->
        <div id="topbar" class="fixed-top d-flex align-items-center topbar-inner-pages">
            <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope-fill"></i><a href="mailto:info@luisapharma.com">info@luisapharma.com</a>
                    <i class="bi bi-phone-fill phone-icon"></i>7982828503
                </div>
            </div>
        </div>
        <header id="header" class="fixed-top d-flex align-items-center header-inner-pages">
            <div class="container d-flex align-items-center justify-content-between">

                <h1 class="logo"><a href="/"><img src="{{ asset('favicon/apple-touch-icon.png') }}" alt="" srcset="">&nbsp; Luisa Pharma</a></h1>
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto " href="{{ route('pages.home') }}">Home</a></li>
                        <li><a class="nav-link scrollto" href="{{ route('pages.about') }}">About</a></li>
                        <li><a class="nav-link scrollto" href="{{ route('pages.contact')}}">Contact</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->


        <main id="main">   
            <section class="main_container">
                @yield('content')
            </section>
        </main>

        <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>Luisa Pharmaceutical PVT LTD</span></strong>. All Rights Reserved
                </div>
            </div>
        </footer><!-- End Footer -->


        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        <script src="{{ asset('jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('aos/aos.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        @yield('scripts')

    </body>
</html>
