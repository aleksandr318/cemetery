@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    .portfolio-item img{
        width: 100%;
        height: 250px;
    }
    .confirm-main{
      padding:100px 0px 200px 0px;
    }
    .confirm-main h1{
      text-align: center; 
      color:green; 
      font-size: 100px;
    }
    .confirm-main p{
      text-align: center; 
      font-size: 20px;
    }
    .confirm-main div{
      padding-top: 50px;
      text-align: center;
    }
    .confirm-main div a{
      display: inline-block;
      background: #f03c02;
      color: #fff;
      padding: 6px 20px;
      transition: 0.3s;
      font-size: 14px;
      border-radius: 4px;
    }
</style>
@endsection

@section('content')
<main id="main">

    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Confirm Submit</h2>
          <ol>
            <li>Lead Submit</li>
            <li>Confirm</li>
          </ol>
        </div>

      </div>
    </section>

    <section id="portfolio-details" class="portfolio-details cta">

      <div class="container">
        
        <div class="confirm-main">
          <h1><i class="fa fa-check"></i></h1>
          <p>
            You have submit service request successfully.<br/>Some of our company will be assigned. It don't take long time.
          </p>
          <div>
            <a href="{{url('services')}}">View Service</a>
          </div>
        </div>

      </div>
    </section>  
</main>
@endsection

@section('js')

@endsection
