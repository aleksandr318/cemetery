@extends('admin.layout.default')
@section('css')
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/nestable2/jquery.nestable.min.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
<style type="text/css">
    .row>div{
        padding-bottom: 5px;
    }

    .dd-div {
        height: 2.25rem;
        padding: .5rem .75rem;
        color: #495057;
        background: #f9fafc;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 5px;
    }

</style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Map</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Plot</li>
                    <li class="breadcrumb-item active" aria-current="page">Map</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <!-- Full Table -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title" id="mtpos" data-lat="{{isset($mount)?$mount->lat:''}}" data-long="{{isset($mount)?$mount->long:''}}">Map</h3>
        </div>
        <form action="{{url('admin/AllPlotMapView')}}" method="get">
        <div class="block-content">
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input">Mount</label>
                            <select class="js-select2 form-control" id="mtId" name="mtId" style="width: 100%;" data-placeholder="Choose mount..">
                                <option></option>
                                <?php
                                    $mounts = DB::table("mounts")->get();
                                ?>
                                @foreach ($mounts as $mt)
                                <option value="{{$mt->id}}" @if( isset($mount) && $mount->id == $mt->id ) selected="" @endif>{{$mt->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding-top: 29px; text-align: right;">
                        <button type="submit" class="btn btn-outline-secondary">Go</button>
                    </div>
                </div>
                <div id="map" style="height: 45vh;"></div>
            </div>
        </div>
        </form>
    </div>
    <!-- END Full Table -->
</div>
@endsection

@section('js')
<script src="{{asset('admin-assets/assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/nestable2/jquery.nestable.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/pages/be_comp_nestable.min.js')}}"></script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD1SToLwZlpQK8KgGZCl0e9uSBlisdv0U&callback=initMap&libraries=drawing,geometry&v=weekly"
  async
></script>
    <!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArBFeEW8ZpCLv2qOTUBA8aC5vSDgWgpU8&callback=initMap&libraries=drawing,geometry&v=weekly"
      async
    ></script> -->
    
<script src="{{asset('admin-assets/custom-assets/js/mapeditor/library.js')}}"></script>
<script type="text/javascript">
    $("#mtId").select2();
    function initMap(){

        var mtId = $("#mtId").val();
        var lat = -34.397;
        var lng = 150.644;

        if ($("#mtpos").data('lat') != null && $("#mtpos").data('lat') != "") lat = parseFloat($("#mtpos").data('lat'));
        if ($("#mtpos").data('long') != null && $("#mtpos").data('long') != "") lng = parseFloat($("#mtpos").data('long'));

        const myLatlng = { lat: lat, lng: lng };
        console.log(myLatlng);
        const map = new google.maps.Map(document.getElementById("map"), {
          center: myLatlng,
          zoom: 14,
        });

        let marker = new google.maps.Marker({
            position: myLatlng,
            draggable: true,
            map: map,
        });

        drawMount(map, mtId, 0);      
    }
</script>
@endsection
