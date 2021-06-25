@extends('layouts.app')
@section('css')
<style type="text/css">
    .portfolio-item img{
        width: 100%;
        height: 250px;
    }
    .question{
      padding-bottom: 15px;
    }
    .submit{
        background: #f03c02;
        border: 0;
        padding: 10px 24px;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<main id="main">

    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Service Submit</h2>
          <ol>
            <li><a href="{{url('services')}}">Service</a></li>
            <li>{{$service->name}}</li>
          </ol>
        </div>

      </div>
    </section>

    <section id="portfolio-details" class="portfolio-details cta" style="padding-bottom: 100px;">
      <form action="{{url('servicesubmitpost')}}" method="post">
        @csrf
        <input name="service_id" value="{{$service->id}}" hidden=""/>
      <div class="container">
        <h2 class="portfolio-title">Submit {{$service->name}} service.</h2>
        @foreach ($questions as $question)
        <div class="question">
            <label>{{$question->content}}</label>
            <input type="text" name="name{{$question->id}}" class="form-control" required="" />
        </div>
        @endforeach
        <div class="question">
            <label>Your Zipcode</label>
            <input type="text" name="zipcode" class="form-control"required="" />
        </div>
        <button class="submit" type="submit">Submit</button>
      </div>
      </form>
    </section>  

</main>
@endsection

@section('js')

@endsection
