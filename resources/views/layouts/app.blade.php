<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>@yield('title', 'test')</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <!-- Favicons -->
 
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Questrial:wght@400&display=swap" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('easyfolio/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('easyfolio/assets/vendor/aos/aos.css') }}" rel="stylesheet" />
  <link href="{{ asset('easyfolio/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('easyfolio/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('easyfolio/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="{{ asset('easyfolio/assets/css/main.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">

  @yield('head') {{-- section pour insérer des styles/scripts additionnels dans d’autres vues --}}
</head>

<body class="@yield('body-class', 'index-page')">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">

        <h1 class="sitename">test</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}#hero" class="{{ request()->is('portfolio') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ url('/postss') }}" class="{{ request()->is('/postss') ? 'active' : '' }}">Posts</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  {{-- Scripts JS à placer en fin de body --}}
  @yield('scripts')

</body>

</html>
