<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home Lead Generation</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('front-assets/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('front-assets/assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('front-assets/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('front-assets/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('front-assets/assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('front-assets/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('front-assets/assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('front-assets/assets/css/style.css')}}" rel="stylesheet">


  @yield('css')
  <!-- =======================================================
  * Template Name: Flattern - v2.2.0
  * Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <!--
  <section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com">contact@example.com</a>
        <i class="icofont-phone"></i> +1 5589 55488 55
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </section> 
  -->

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="{{url('/')}}">Home Leads</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="{{Request::is('/')?'active':''}}"><a href="{{url('/')}}">Home</a></li>
          <li class="drop-down {{strpos(request()->url(), 'services') !== false?'active':'' }}"><a href="{{url('/services')}}">Services</a>
            <ul>
              <?php
                $categories = DB::table("service_categories")->get();
              ?>
              @foreach ($categories as $category)
              <li><a href="{{url('services?category='.$category->id)}}">{{$category->name}}</a></li>
              @endforeach
            </ul>
          </li>
          <li class="{{Request::is('contact')?'active':''}}"><a href="{{url('contact')}}">Contact</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Home leads</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/')}}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/services')}}">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{url('/contact')}}">Contact us</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Other links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>You will get email if there is some updates or other news.</p>
            <form action="{{url('subscribe')}}" method="post">
              @csrf
              <input type="email" name="email" required=""><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('front-assets/assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/jquery-sticky/jquery.sticky.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('front-assets/assets/vendor/aos/aos.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('front-assets/assets/js/main.js')}}"></script>
  @yield('js')
</body>

</html>