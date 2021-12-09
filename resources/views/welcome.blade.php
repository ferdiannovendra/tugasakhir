<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>
    @if(\Spatie\Multitenancy\Models\Tenant::checkCurrent())
    SaaS - {{app('currentTenant')->name}}
    @else
    SaaS - Sistem Informasi Akademik
    @endif
    </title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="{{ asset('asset_front/img/favicon.png') }}"
    />
    <!-- Place favicon.ico in the root directory -->

    <!-- ======== CSS here ======== -->
    <link rel="stylesheet" href="{{ asset('asset_front/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset_front/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset_front/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset_front/css/main.css') }}" />
  </head>
  <body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ======== preloader start ======== -->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- preloader end -->

    <!-- ======== header start ======== -->
    <header class="header">
      <div class="navbar-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/">
                  <img src="{{ asset('asset_front/img/logo/logo.svg') }}" alt="Logo" />
                </a>
                <button
                  class="navbar-toggler"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                </button>

                <div
                  class="collapse navbar-collapse sub-menu-bar"
                  id="navbarSupportedContent"
                >
                  <ul id="nav" class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="page-scroll active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="" href="{{ route('login') }}">Login</a>
                    </li>
                  </ul>
                </div>
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ======== header end ======== -->

    <!-- ======== hero-section start ======== -->
    <section id="home" class="hero-section">
      <div class="container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6">
            <div class="hero-content">
              <h1 class="wow fadeInUp" data-wow-delay=".4s">
                @if(\Spatie\Multitenancy\Models\Tenant::checkCurrent())
                <h1 class="wow fadeInUp" data-wow-delay=".4s">
                    {{app('currentTenant')->name}}
                </h1>
                @else
                <h1 class="wow fadeInUp" data-wow-delay=".4s">
                    Your using free lite version
                </h1>
                @endif
              </h1>
              <p class="wow fadeInUp" data-wow-delay=".6s">
                Sistem Informasi Akademik.
              </p>
              <a
                href="{{ route('login') }}"
                class="main-btn border-btn btn-hover wow fadeInUp"
                data-wow-delay=".6s"
                >Masuk</a
              >

            </div>
          </div>
          <div class="col-lg-6">
            <div class="hero-img wow fadeInUp" data-wow-delay=".5s">
                @php
                $masterweb = App\Models\MasterWeb::all();
                @endphp
                <img width="500px" height="500px" src="{{ asset('fileupload/'.$masterweb[0]->logo) }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======== hero-section end ======== -->

    <!-- ======== footer start ======== -->
    <footer class="footer">
      <div class="container">
        <div class="widget-wrapper">
          <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-6">
              <div class="footer-widget text-center">
                <div class="logo mb-30">
                  <a href="index.html">
                    <img width="100px" height="100px" src="{{ asset('fileupload/'.$masterweb[0]->logo) }}" alt="" />
                  </a>
                </div>
                <div class="row justify-content-center">
                    <p class="desc mb-30 text-white">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    dinonumy eirmod tempor invidunt.
                    </p>
                </div>
                <div class="row justify-content-center">
                    <ul class="socials" style="align-items: center;justify-content: center;">
                    <li>
                        <a href="{{$masterweb[0]->facebook}}">
                        <i class="lni lni-facebook-filled"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{$masterweb[0]->twitter}}">
                        <i class="lni lni-twitter-filled"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{$masterweb[0]->instagram}}">
                        <i class="lni lni-instagram-filled"></i>
                        </a>
                    </li>
                    </ul>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </footer>
    <!-- ======== footer end ======== -->

    <!-- ======== scroll-top ======== -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ======== JS here ======== -->
    <script src="{{ asset('asset_front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset_front/js/wow.min.js') }}"></script>
    <script src="{{ asset('asset_front/js/main.js') }}"></script>
  </body>
</html>
