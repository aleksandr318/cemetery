@extends('layouts.app')
@section('css')
<style type="text/css">
    .portfolio-item img{
        width: 100%;
        height: 250px;
    }
</style>
@endsection

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <?php
            $category_name = "All";
            if ($category_filter != "*")
            {
                $category_obj = DB::table("service_categories")->where("id", $category_filter)->first();
                if ($category_obj) $category_name = $category_obj->name;
                else $category_name = "undefined";
            }
        ?>
        <div class="d-flex justify-content-between align-items-center">
          <h2>Services</h2>
          <ol>
            <li><a href="{{url('services')}}">Service</a></li>
            <li>{{$category_name}}</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li @if ($category_filter=="*") class="filter-active" @endif onclick="window.location.replace('services')">All
              </li>
              <?php
                $categories = DB::table("service_categories")->get();
              ?>
              @foreach ($categories as $category)
              <li @if ($category_filter==$category->id) class="filter-active" @endif onclick="window.location.replace('services?category='+'<?php echo $category->id ?>')">{{$category->name}}</li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">
          @foreach ($services as $service)
          <div class="col-lg-4 col-md-6 portfolio-item">
            <img src="{{$service->photo}}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>{{$service->name}}</h4>
              <p>{{substr($service->description, 0, 30)}}..</p>
              <a href="{{$service->photo}}" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="{{url('service-detail/'.$service->id)}}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Portfolio Section -->
</main><!-- End #main -->
@endsection

@section('js')

@endsection
