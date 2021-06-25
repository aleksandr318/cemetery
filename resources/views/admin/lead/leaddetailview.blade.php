@extends('admin.layout.default')
@section('css')
<style type="text/css">
    .error-note{
        color:red;
    }
</style>
@endsection

@section('content')

<?php
    $service = DB::table("services")->where("id", $lead->service_id)->first();
    $company_obj = DB::table("users")->where("id", $lead->company_id)->first();
?>
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Lead Detail View</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Lead</li>
                    <li class="breadcrumb-item active" aria-current="page">Detail View</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Lead detail <a href="{{url()->previous()}}" style="float: right;" class="btn btn-sm btn-secondary"><i class="fa fa-backspace"></i> Back</a></h3>
        </div>
        <div class="block-content" style="padding-bottom: 50px;">
            @if ($service)
            <div class="row push">
                <div class="col-lg-5">
                    <img src="{{asset($service->photo)}}" style="width: 100%; height: auto;"/>
                </div>
                <div class="col-lg-7">
                    <div class="form-group">
                        <?php
                            $category_name = "";
                            if ($category_obj = DB::table("service_categories")->where("id", $service->category_id)->first())
                                $category_name = $category_obj->name;
                        ?>
                        <h4>{{$category_name}}<span style="font-size: 15px;"> - category</span></h4>
                        <p style="font-weight: bold;">{{$service->name}}</p>
                        <p>{{$service->description}}</p>
                        <p style="margin-bottom: 0px;"><i class="far fa-clock"></i> &nbsp;{{$service->working_day}}</p>
                        <p><i class="fa fa-phone-alt"></i> &nbsp;{{$service->contacted_time}} - (number of contacts)</p>
                        <p>This lead is created at {{date("Y-m-d", strtotime($lead->created_at))}}</p>
                    </div>
                    <hr/>
                    <h3>Customer's answer</h3>
                    <div class="row">
                        <div class="col-md-5">
                            <p style="font-weight: bold; margin-bottom: 5px; font-size: 18px;">ZipCode</p>
                        </div>
                        <div class="col-md-7">
                            <p style="margin-bottom: 5px; font-size: 16px;">{{$lead->zipcode}}</p>
                        </div>
                    </div>
                    <?php
                        $answers = DB::table("lead_contacts")->where("lead_id", $lead->id)->get();
                        foreach ($answers as $answer) {
                            $question = DB::table("questions")->where("id", $answer->id)->first();
                            if ($question){
                    ?>
                    <div class="row">
                        <div class="col-md-5">
                            <p style="font-weight: bold; margin-bottom: 5px; font-size: 18px;">{{$question->content}}</p>
                        </div>
                        <div class="col-md-7">
                            <p style="margin-bottom: 5px; font-size: 16px;">{{$answer->answer}}</p>
                        </div>
                    </div>
                    <?php 
                            }
                        }
                    ?>
                    @if ($lead->status == 1)
                    <div style="padding-top: 20px;">
                        This lead is open.
                    </div>
                    @elseif ($lead->status == 2)
                    <div style="padding-top: 20px;">
                        The Lead is already accepted by <a href="{{url('admin/CompanyDetailView/'.$lead->company_id)}}">{{$company_obj->name}}</a> and progressing.
                    </div>
                    @else
                    <div style="padding-top: 20px;">
                        The Lead is completed by <a href="{{url('admin/CompanyDetailView/'.$lead->company_id)}}">{{$company_obj->name}}</a>.
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('Gplugin/js/ajax-file-form.min.js')}}"></script>
<script type="text/javascript">

</script>
@endsection
