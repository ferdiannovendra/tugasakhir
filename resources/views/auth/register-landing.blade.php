<!-- =========

	Template Name: Play
	Author: UIdeck
	Author URI: https://uideck.com/
	Support: https://uideck.com/support/
	Version: 1.1

========== -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Play | Open source Project by UIdeck</title>

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="{{asset('assets-landing/images/favicon.svg')}}"
      type="image/svg"
    />

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{asset('assets-landing/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-landing/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-landing/css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets-landing/css/ud-styles.css')}}" />
  </head>
  <body>
    <!-- ====== Header Start ====== -->
    <header class="ud-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
              <button class="navbar-toggler">
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
              </button>

              <div class="navbar-collapse">
                <ul id="nav" class="navbar-nav mx-auto">
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#home">Home</a>
                  </li>

                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#about">About</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#pricing">Pricing</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#team">Team</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#contact">Contact</a>
                  </li>
                  <li class="nav-item nav-item-has-children">
                    <a href="javascript:void(0)"> Pages </a>
                    <ul class="ud-submenu">
                      <li class="ud-submenu-item">
                        <a href="about.html" class="ud-submenu-link">
                          About Page
                        </a>
                      </li>
                      <li class="ud-submenu-item">
                        <a href="pricing.html" class="ud-submenu-link">
                          Pricing Page
                        </a>
                      </li>
                      <li class="ud-submenu-item">
                        <a href="contact.html" class="ud-submenu-link">
                          Contact Page
                        </a>
                      </li>
                      <li class="ud-submenu-item">
                        <a href="blog.html" class="ud-submenu-link">
                          Blog Grid Page
                        </a>
                      </li>
                      <li class="ud-submenu-item">
                        <a href="blog-details.html" class="ud-submenu-link">
                          Blog Details Page
                        </a>
                      </li>
                      <li class="ud-submenu-item">
                        <a href="login.html" class="ud-submenu-link">
                          Sign In Page
                        </a>
                      </li>
                      <li class="ud-submenu-item">
                        <a href="404.html" class="ud-submenu-link">404 Page</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>

              <div class="navbar-btn d-none d-sm-inline-block">
                <a href="login.html" class="ud-main-btn ud-login-btn">
                  Sign In
                </a>
                <a class="ud-main-btn ud-white-btn" href="javascript:void(0)">
                  Sign Up
                </a>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ====== Header End ====== -->

    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>Register</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Login Start ====== -->
    <section class="ud-login">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-login-wrapper">
              <div class="ud-login-logo">
                <img src="{{asset('assets-landing/images/logo/logo-2.svg')}}" alt="logo" />
              </div>
              <form class="ud-login-form" method="POST" action="{{route('register')}}">
                <div class="ud-form-group">
                  <input
                    type="email"
                    name="email"
                    placeholder="Email"
                  />
                </div>
                <div class="ud-form-group">
                  <input
                    type="password"
                    name="password"
                    placeholder="*********"
                  />
                </div>
                <div class="ud-form-group">
                  <button type="submit" class="ud-main-btn w-100">Login</button>
                </div>
              </form>


              <p class="signup-option">
                Not a member yet? <a href="javascript:void(0)"> Sign Up </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Login End ====== -->

    <!-- ====== Footer Start ====== -->
    <footer class="ud-footer wow fadeInUp" data-wow-delay=".15s">
      <div class="shape shape-1">
        <img src="{{asset('assets-landing/images/footer/shape-1.svg')}}" alt="shape" />
      </div>
      <div class="shape shape-2">
        <img src="{{asset('assets-landing/images/footer/shape-2.svg')}}" alt="shape" />
      </div>
      <div class="shape shape-3">
        <img src="{{asset('assets-landing/images/footer/shape-3.svg')}}" alt="shape" />
      </div>
      <div class="ud-footer-widgets">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="ud-widget">
                <a href="index.html" class="ud-footer-logo">
                  <img src="{{asset('assets-landing/images/logo/logo.svg')}}" alt="logo" />
                </a>
                <p class="ud-widget-desc">
                  We create digital experiences for brands and companies by
                  using technology.
                </p>
                <ul class="ud-widget-socials">
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-facebook-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-twitter-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-instagram-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/MusharofChy">
                      <i class="lni lni-linkedin-original"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">About Us</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="javascript:void(0)">Home</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Features</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">About</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Testimonial</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Features</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="javascript:void(0)">How it works</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Privacy policy</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Terms of service</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Refund policy</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Our Products</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a
                      href="https://lineicons.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Lineicons
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://ecommercehtml.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Ecommerce HTML</a
                    >
                  </li>
                  <li>
                    <a
                      href="https://ayroui.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Ayro UI</a
                    >
                  </li>
                  <li>
                    <a
                      href="https://graygrids.com/"
                      rel="nofollow noopner"
                      target="_blank"
                      >Plain Admin</a
                    >
                  </li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="ud-footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <ul class="ud-footer-bottom-left">
                <li>
                  <a href="javascript:void(0)">Privacy policy</a>
                </li>
                <li>
                  <a href="javascript:void(0)">Support policy</a>
                </li>
                <li>
                  <a href="javascript:void(0)">Terms of service</a>
                </li>
              </ul>
            </div>
            <div class="col-md-4">
              <p class="ud-footer-bottom-right">
                Designed and Developed by
                <a href="https://uideck.com" rel="nofollow">UIdeck</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top">
      <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->
    <script src="{{asset('assets-landing/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets-landing/js/wow.min.js')}}"></script>
    <script src="{{asset('assets-landing/js/main.js')}}"></script>
  </body>
</html>