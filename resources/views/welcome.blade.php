<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pinjam Barang UNS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}
        ">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

        <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

        <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">

        
        <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>
          <div class="container">
            <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
              <div class="col-lg-8 ftco-animate">
                <div class="text w-100 text-center mb-md-5 pb-md-5">
                  <h1 class="mb-4">Pinjam Barang Cepat &amp; Mudah</h1>
                  <p style="font-size: 18px;">Web Pinjam Barang merupakan sebuah sistem yang memfasilitasi peminjaman barang bagi civitas akademika UNS.</p>
                  <div style="margin: 20px;">
                  @if (Route::has('login'))
                    @auth
                        @if (auth()->user()->role === 'user')
                            <a href="{{ url('/home') }}">
                                <input type="submit" value="Home" class="btn btn-secondary py-3 px-4" style="margin: 20px;">
                            </a>
                        @elseif (auth()->user()->role === 'adminunit')
                            <a href="{{ route('adminunit.dashboard', ['unit_id' => auth()->user()->unit_id]) }}">
                                <input type="submit" value="Admin Unit Dashboard" class="btn btn-secondary py-3 px-4" style="margin: 20px;">
                            </a>
                        @elseif (auth()->user()->role === 'administrator')
                            <a href="{{ route('admin.dashboard') }}">
                                <input type="submit" value="Administrator Dashboard" class="btn btn-secondary py-3 px-4" style="margin: 20px;">
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}">
                            <input type="submit" value="Login" class="btn btn-secondary py-3 px-4" style="margin: 20px;">
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <input type="submit" value="User Sign Up" class="btn btn-secondary py-3 px-4" style="margin: 20px;">
                        </a>

                        <a href="{{ route('register.adminunit') }}">
                            <input type="submit" value="Admin Unit Sign Up" class="btn btn-secondary py-3 px-4" style="margin: 20px;">
                        </a>
                        @endif
                    @endauth
                  @endif
                  </div>
                  <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0" style="color: white;">
                        &copy; {{ date('Y') }} Pinjam Barang UNS
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <script src="{{ asset('js/jquery.min.js') }}"></script>
      <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
      <script src="{{ asset('js/popper.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
      <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
      <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
      <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ asset('js/aos.js') }}"></script>
      <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
      <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
      <script src="{{ asset('js/scrollax.min.js') }}"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
      <script src="{{ asset('js/google-map.js') }}"></script>
      <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
