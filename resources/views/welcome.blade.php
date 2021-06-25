@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/select2/css/select2.min.css')}}">
<link href="{{asset('front-assets/custom-assets/css/home.css')}}" rel="stylesheet">
<style type="text/css">
    
</style>
@endsection

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(front-assets/assets/img/background/1.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
                <form action="{{url('findservice')}}" method="post">
                    @csrf
                    <h2>Find <span>Service</span></h2>
                    <div class="sidebar-item search-form">
                        <div class="service-search-bar">
                          <select name="keyword" class="select2">
                              <?php
                                $services = DB::table("services")->orderBy("name", "asc")->get();
                                foreach ($services as $service) {
                              ?>
                                <option value="{{$service->id}}">{{$service->name}}</option>
                              <?php
                                }
                              ?>
                          </select>
                          <button type="button"><i class="icofont-search"></i></button>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit" class="btn-get-started">Find</button></div>
                </form>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(front-assets/assets/img/background/2.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
                <form action="{{url('findservice')}}" method="post">
                    @csrf
                    <h2>Find <span>Service</span></h2>
                    <div class="sidebar-item search-form">
                        <div class="service-search-bar">
                          <select name="keyword" class="select2" style="width: 100%;">
                              <?php
                                $services = DB::table("services")->orderBy("name", "asc")->get();
                                foreach ($services as $service) {
                              ?>
                                <option value="{{$service->id}}">{{$service->name}}</option>
                              <?php
                                }
                              ?>
                          </select>
                          <button type="button"><i class="icofont-search"></i></button>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit" class="btn-get-started">Find</button></div>
                </form>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(front-assets/assets/img/background/3.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
                <form action="{{url('findservice')}}" method="post">
                    @csrf
                    <h2>Find <span>Service</span></h2>
                    <div class="sidebar-item search-form">
                        <div class="service-search-bar">
                          <select name="keyword" class="select2" style="width: 100%;">
                              <?php
                                $services = DB::table("services")->orderBy("name", "asc")->get();
                                foreach ($services as $service) {
                              ?>
                                <option value="{{$service->id}}">{{$service->name}}</option>
                              <?php
                                }
                              ?>
                          </select>
                          <button type="button"><i class="icofont-search"></i></button>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit" class="btn-get-started">Find</button></div>
                </form>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3>We've provided more than <span>20k services</span> this year!</h3>
            <p>We have offered various services for all client's request near us. Client are much appreciate for our working. Please feel free to touch us.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Request a service</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Portfolio Section ======= -->
    <div style="height: 100px;"></div>
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Check out <strong>our categories</strong></h2>
        </div>

        <div style="height: 50px;"></div>

        <div class="row portfolio-container" data-aos="fade-up">

          <?php
            $categories = DB::table("service_categories")->get();
          ?>
          @foreach ($categories as $category)
          <div class="col-lg-4 col-md-6 portfolio-item">
            <img src="{{asset($category->image)}}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>{{$category->name}}</h4>
              <p>{{substr($category->description, 0, 30)}}..</p>
              <a href="{{url('services?category='.$category->id)}}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Portfolio Section -->
    <div style="height: 100px;"></div>
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><strong>How it works</strong></h2>
        </div>
        <div style="height: 50px;"></div>
        <div class="row">
          <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-right">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#tab-1">
                  <h4>Find desired service</h4>
                  <p>You can search desired service in home page. Also you can view all services by category.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-toggle="tab" href="#tab-2">
                  <h4>Submit request</h4>
                  <p>Once you find the servies and you can submit with zipcode after fill some necessary questiosn.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-toggle="tab" href="#tab-3">
                  <h4>Company get alerts</h4>
                  <p>All companies which is connected with this system will be get alert and they will be assigned by site manager immediately.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-toggle="tab" href="#tab-4">
                  <h4>Get service.</h4>
                  <p>Assigned company will provide you service at the time.</p>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-7 ml-auto" data-aos="fade-left" data-aos-delay="100">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <figure>
                  <img src="{{asset('front-assets/assets/img/features-1.png')}}" alt="" class="img-fluid">
                </figure>
              </div>
              <div class="tab-pane" id="tab-2">
                <figure>
                  <img src="{{asset('front-assets/assets/img/features-2.png')}}" alt="" class="img-fluid">
                </figure>
              </div>
              <div class="tab-pane" id="tab-3">
                <figure>
                  <img src="{{asset('front-assets/assets/img/features-3.png')}}" alt="" class="img-fluid">
                </figure>
              </div>
              <div class="tab-pane" id="tab-4">
                <figure>
                  <img src="{{asset('front-assets/assets/img/features-4.png')}}" alt="" class="img-fluid">
                </figure>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section id="testimonials" class="testimonials" style="background-color: #f6f6f7;">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><strong>Testimonials</strong></h2>
        </div>

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up">
            <div class="testimonial-item">
              <img src="{{asset('front-assets/assets/img/testimonials/testimonials-1.jpg')}}" class="testimonial-img" alt="">
              <h3>Saul Goodman</h3>
              <h4>Cleaning &amp; Painting</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Very clean and colorful work.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonial-item mt-4 mt-lg-0">
              <img src="{{asset('front-assets/assets/img/testimonials/testimonials-2.jpg')}}" class="testimonial-img" alt="">
              <h3>Sara Wilsson</h3>
              <h4>Electrical</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Fixed electical problems perfectly. Happy.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonial-item mt-4">
              <img src="{{asset('front-assets/assets/img/testimonials/testimonials-3.jpg')}}" class="testimonial-img" alt="">
              <h3>Jena Karlis</h3>
              <h4>Plumbing</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                High technology! All are fixed quickly.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="testimonial-item mt-4">
              <img src="{{asset('front-assets/assets/img/testimonials/testimonials-4.jpg')}}" class="testimonial-img" alt="">
              <h3>Matt Brandon</h3>
              <h4>Handyman</h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Quality service and fast. Much appreciate.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Our <strong>Companies</strong></h2>
          <p>These companies will be get the alerts once you submit your desired service request. It will be assigned by site admin immediately.</p>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

          <?php
            $companies = DB::table("users")->where("role", "company")->get();
          ?>
          @foreach ($companies as $company)
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{asset($company->logo)}}" class="img-fluid" alt="">
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Our Clients Section -->

</main><!-- End #main -->
@endsection

@section('js')
<script src="{{asset('admin-assets/assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $(".select2").select2();
</script>
@endsection

