@extends('admin.layout.default')
@section('css')
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/nestable2/jquery.nestable.min.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
<style type="text/css">
    .row>div{
        padding-bottom: 5px;
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add Mount</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Mount</li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <!-- Full Table -->
    <div class="block block-rounded block-bordered">
        <form action="{{url('admin/AddMountPost')}}" method="post">
            @csrf
        <div class="block-header block-header-default">
            <h3 class="block-title">Mount Information</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-hero-sm btn-hero-primary" data-toggle="tooltip" title="Save">Save</button>
                <a href="{{url('admin/MountManagementView')}}" class="btn btn-hero-sm btn-hero-secondary" data-toggle="tooltip" title="Cancel">Cancel</a>
            </div>
        </div>
        <div class="block-content">
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Mt...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input">Latitude</label>
                            <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude value">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="example-text-input">Longitude</label>
                            <input type="text" class="form-control" id="long" name="long" placeholder="Longitude value">
                        </div>
                    </div>
                </div>
                <div id="map" style="height: 45vh;"></div>
            </div>
        </div>
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
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD1SToLwZlpQK8KgGZCl0e9uSBlisdv0U&callback=initMap&libraries=&v=weekly"
      async
    ></script>
<script type="text/javascript">
    function initMap() {
        const myLatlng = { lat: -34.397, lng: 150.644 };
        const map = new google.maps.Map(document.getElementById("map"), {
          center: myLatlng,
          zoom: 10,
        });
        
        let marker = new google.maps.Marker({
            position: myLatlng,
            icon: {
                scale: 10,
            },
            draggable: true,
            map: map,
        });

        map.addListener("click", (mapsMouseEvent) => {
            marker.setPosition(mapsMouseEvent.latLng);

            $("#lat").val(mapsMouseEvent.latLng.toJSON().lat);
            $("#long").val(mapsMouseEvent.latLng.toJSON().lng);
        });
    }
</script>
@endsection
