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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2" id="mtpos" data-lat="{{$mount->lat}}" data-long="{{$mount->long}}">Add Section on Mt {{$mount->name}}</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Section</li>
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
        <div class="block-header block-header-default">
            <h3 class="block-title">Section Information</h3>
            <div class="block-options">
                <button type="button" class="btn btn-hero-sm btn-hero-primary" id="save-button" data-toggle="tooltip" title="Save">Save</button>
                <a href="{{url('admin/MountManagementView')}}" class="btn btn-hero-sm btn-hero-secondary" data-toggle="tooltip" title="Cancel">Cancel</a>
            </div>
        </div>
        <form action="{{url('admin/AddSectionPost')}}" id="save-form" method="post">
            @csrf
            <input name="mtId" value="{{$mount->id}}" hidden="">
            <input name="shape_type" id="shape_type" hidden="">
            <input name="shape_value" id="shape_value" hidden="">
            <div class="block-content">
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Section ...">
                            </div>
                        </div>
                        <div class="col-md-8" style="padding-top: 29px; text-align: right;">
                            <button type="button" class="btn btn-outline-secondary" id="delete-button">Delete Selection</button>
                        </div>
                    </div>
                    <div id="map" style="height: 45vh;"></div>
                </div>
            </div>
        </form>
    </div>
    <!-- END Full Table -->
</div>

<div class="modal" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Alert</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p id="description"></p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Got it</button>
                </div>
            </div>
        </div>
    </div>
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
<script src="{{asset('admin-assets/custom-assets/js/mapeditor/library.js')}}"></script>
<script type="text/javascript">
    function initMap(){
        var mtId = $("input[name=mtId]").val();
        var lat = -34.397;
        var lng = 150.644;

        if ($("#mtpos").data('lat') != null) lat = parseFloat($("#mtpos").data('lat'));
        if ($("#mtpos").data('long') != null) lng = parseFloat($("#mtpos").data('long'));

        const myLatlng = { lat: lat, lng: lng };
        const map = new google.maps.Map(document.getElementById("map"), {
          center: myLatlng,
          zoom: 14,
        });

        let marker = new google.maps.Marker({
            position: myLatlng,
            draggable: true,
            map: map,
        });

        drawSections(map, mtId, 0);

        
        const drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [
                    google.maps.drawing.OverlayType.POLYGON,
                ],
            },
            polygonOptions: {
              fillColor: "#FF0000",
              fillOpacity: 0.7,
              strokeWeight: 2,
              clickable: true,
              editable: true,
              zIndex: 1,
              draggable: true,
            },
        });
        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
            drawingManager.setDrawingMode(null);
            shapes.add(e);
        });


        google.maps.event.addListener(drawingManager, 
                                      'drawingmode_changed', 
                                      function(){shapes.clearSelection();});
        google.maps.event.addListener(map, 
                                      'click', 
                                      function(){shapes.clearSelection();});
        google.maps.event.addDomListener(document.getElementById('delete-button'), 
                                      'click', 
                                      function(){shapes.deleteSelected();});
        google.maps.event.addDomListener(document.getElementById('save-button'), 
                                      'click', 
                                      function(){shapes.save();});        
    }
</script>
@endsection
