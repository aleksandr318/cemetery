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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2" id="mtpos" data-lat="" data-long="">Add Plot</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Plot</li>
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
        <form action="{{url('admin/AddPlotPost')}}" id="save-form" method="post">
            @csrf
            <input name="shape_type" id="shape_type" hidden="">
            <input name="shape_value" id="shape_value" hidden="">
        <div class="block-header block-header-default">
            <h3 class="block-title">Plot Information</h3>
            <div class="block-options">
                <button type="button" class="btn btn-hero-sm btn-hero-warning" id="delete-button">Delete Selection</button>
                <button type="button" class="btn btn-hero-sm btn-hero-primary" data-toggle="tooltip" title="Save" id="save-button">Save</button>
                <a href="{{url('admin/PlotsView')}}" class="btn btn-hero-sm btn-hero-secondary" data-toggle="tooltip" title="Cancel">Cancel</a>
            </div>
        </div>
        <div class="block-content">
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-text-input">Mount</label>
                                    <select class="js-select2 form-control" id="mtId" name="mtId" style="width: 100%;" data-placeholder="Choose mount..">
                                        <option></option>
                                        <?php
                                            $mounts = DB::table("mounts")->get();
                                        ?>
                                        @foreach ($mounts as $mount)
                                        <option value="{{$mount->id}}">{{$mount->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-text-input">Section</label>
                                    <select class="js-select2 form-control" id="sectionId" name="sectionId" style="width: 100%;" data-placeholder="Choose section..">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-text-input">Lot</label>
                                    <select class="js-select2 form-control" id="lotId" name="lotId" style="width: 100%;" data-placeholder="Choose lot..">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="example-text-input">Grave name</label>
                                    <input type="text" class="form-control" id="grave_name" name="grave_name" placeholder="Grave ...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding-top: 30px;">
                        <button type="button" class="btn btn-outline-primary" id="seemap" style="width: 100%;">Go</button>
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


<script src="{{asset('admin-assets/custom-assets/js/mapeditor/library.js')}}"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD1SToLwZlpQK8KgGZCl0e9uSBlisdv0U&callback=initMap&libraries=drawing,geometry&v=weekly"
      async
    ></script>
<script type="text/javascript">
    function initMap(){
        var lat = -34.397;
        var lng = 150.644;

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
        google.maps.event.addDomListener(document.getElementById('seemap'), 'click', function(){
            var lotId = $("#lotId").val();
            if (lotId == "" || lotId == undefined) alert("Please select lot!");
            else {
                $.ajax({
                    url:"/admin/getPlotInfos",
                    type:'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {id:lotId},
                    success:function(req) {
                        data = JSON.parse(req);
                        var centerP = getCenterPosition(data.sectionPath);
                        var myLatlng = { lat: centerP.lat(), lng: centerP.lng() };
                        map.setCenter(myLatlng);
                        map.setZoom(15);
                        drawPlots(map, data.sectionPath, data.sectionName, data.sectionId, lotId, lotId);
                    },
                    error: function(ts) {
                        console.log(ts);
                    }
                });
            }
        });      
    }

    $("#mtId").select2();
    $("#sectionId").select2();
    $("#lotId").select2();

    $("#mtId").change(function(){
        var mtId = $(this).val();
        var sectionObj = $("#sectionId");
        var lotObj = $("#lotId");

        sectionObj.empty();
        lotObj.empty();

        $.ajax({
            url:"/admin/GetSectionPost",
            type:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {mtId:mtId},
            success:function(req) {
                var data = JSON.parse(req);
                var appendStr = "<option></option>";
                data.forEach(function(section){
                    appendStr += '<option value="'+section.id+'">'+section.name+'</option>';
                });
                
                sectionObj.html(appendStr);
            },
            error: function(ts) {
                console.log(ts);
            }
        });
    });

    $("#sectionId").change(function(){
        var sectionId = $(this).val();
        var lotObj = $("#lotId");

        lotObj.empty();

        $.ajax({
            url:"/admin/GetLotPost",
            type:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {sectionId:sectionId},
            success:function(req) {
                var data = JSON.parse(req);
                var appendStr = "<option></option>";
                data.forEach(function(lot){
                    appendStr += '<option value="'+lot.id+'">'+lot.name+'</option>';
                });
                
                lotObj.html(appendStr);
            },
            error: function(ts) {
                console.log(ts);
            }
        });
    });
</script>
@endsection
