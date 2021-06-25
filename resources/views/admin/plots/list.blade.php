@extends('admin.layout.default')
@section('css')
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">All Plots</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Plots</li>
                    <li class="breadcrumb-item active" aria-current="page">lists</li>
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
            <h3 class="block-title">All Plots</h3>
            <div class="block-options">
                <a href="{{url('admin/AddPlotView')}}" class="btn btn-hero-sm btn-hero-primary" data-toggle="tooltip" title="Add new"><i class="fa fa-plus"></i> &nbsp;New plot</a>
            </div>
        </div>
        <div class="block-content">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons" id="request-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 25%;">Position</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($plots as $plot) {
                                $mtName = "";
                                $sectionName = "";
                                $lotName = "";

                                if ($mtObj = DB::table("mounts")->where("id", $plot->mtId)->first()) $mtName = $mtObj->name;
                                if ($sectionObj = DB::table("sections")->where("id", $plot->sectionId)->first()) $sectionName = $sectionObj->name;
                                if ($lotObj = DB::table("lots")->where("id", $plot->lotId)->first()) $lotName = $lotObj->name;
                        ?>
                        <tr data-id="{{$plot->id}}">
                            <td>
                                {{$plot->id}}
                            </td>
                            <td>
                                {{$mtName}}/{{$sectionName}}/{{$lotName}}/{{$plot->grave_name}}
                            </td>
                            <td>
                                {{$plot->status}}
                            </td>
                            <td class="text-center">
                                <a href="{{url('admin/PlotDetail/'.$plot->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-circle-right"></i></a>
                                <!-- <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> -->
                                <button type="button" class="btn btn-sm btn-primary deletebutton" data-toggle="modal" data-target="#remove-plot-modal"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Full Table -->
</div>
<div class="modal" id="remove-plot-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/RemovePlotPost')}}" method="post">
                    @csrf
                    <input type="text" name="id" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Remove plot</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure to remove this plot?</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary">Sure</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{{asset('admin-assets/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script>
jQuery(function(){ Dashmix.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'rangeslider', 'masked-inputs', 'pw-strength']); });
</script>
<script type="text/javascript">
    $(".filter-head").click(function(){
        if ( $(".filter-content:visible").length == 1) 
            $(".filter-content").slideUp();
        else $(".filter-content").slideDown();
    });

    $("#request-table").dataTable({
                        pageLength: 20,
                        lengthMenu: [
                            [5, 10, 20, 50, 100],
                            [5, 10, 20, 50, 100]
                        ],
                        autoWidth: !1,
                        buttons: [{
                            extend: "copy",
                            className: "btn btn-sm btn-primary"
                        }, {
                            extend: "csv",
                            className: "btn btn-sm btn-primary"
                        }, {
                            extend: "print",
                            className: "btn btn-sm btn-primary"
                        }],
                        dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
                    });
    $(document).on('click', '.deletebutton', function(){
        var id = $(this).parent().parent().data('id');
        $("#remove-plot-modal input[name=id]").val(id);

    });
</script>
@endsection
