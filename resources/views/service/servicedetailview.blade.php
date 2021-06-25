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

    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Service Detail</h2>
          <ol>
            <li><a href="{{url('services')}}">Service</a></li>
            <li>{{$service->name}}</li>
          </ol>
        </div>

      </div>
    </section>

    <section id="portfolio-details" class="portfolio-details cta">

      <?php

        $category = "Undefined";
        $category_obj = DB::table("service_categories")->where("id", $service->category_id)->first();
        if ($category_obj) $category = $category_obj->name;
      ?>

      <div class="container">
        <h2 class="portfolio-title">This is {{$service->name}} service detail</h2>
        <div class="row">

          <div class="col-lg-8" data-aos="fade-right">
            <div class="owl-carousel portfolio-details-carousel">
              <img src="{{asset($service->photo)}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-4 portfolio-info" data-aos="fade-left">
            <h3>{{$service->name}}</h3>
            <ul>
              <li><strong>Category</strong>: {{$category}}</li>
              <li><strong>Working Day</strong>: {{$service->working_day}}</li>
              <li><strong>Number of contacts</strong>: {{$service->contacted_time}}</li>
            </ul>

            <p>
              {{$service->description}}
            </p>
            <br/>
            <a href="{{url('servicesubmitview/'.$service->id)}}" class="cta-btn" style="margin-left: 0px;">Submit</a>
          </div>

        </div>

      </div>
    </section>  
</main>
@endsection

@section('js')

@endsection
