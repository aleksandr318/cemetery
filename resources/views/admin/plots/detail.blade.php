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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Plot Detail</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Plots</li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
            <h3 class="block-title">Details</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input">Grave Name</label>
                        <p>{{$plot->grave_name}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input">Position</label>
                        <p>{{$position}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Burials</h3>
            <div class="block-options">
                <button  data-toggle="modal" data-target="#add-burial-modal" class="btn btn-hero-sm btn-hero-primary" data-toggle="tooltip"><i class="fa fa-plus"></i> &nbsp;Add Burial</a>
            </div>
        </div>
        <div class="block-content">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons" id="request-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 35%;">Burial</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $index = 0;
                            foreach ($burialDetails as $detail) {
                                $burial_obj = DB::table("burials")->where("id", $detail->burialId)->first();
                        ?>
                        <tr data-id="{{$detail->id}}">
                            <td>
                                {{++$index}}
                            </td>
                            <td>
                                {{isset($burial_obj)?$burial_obj->name:""}}
                            </td><!-- 
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" id="dropdown-default-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dropdown
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-default-outline-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                        <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                    </div>
                                </div>
                            </td> -->
                            <td class="text-center">
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
<div class="modal" id="add-burial-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/AddBurialInPlot')}}" method="post">
                    @csrf
                    <input type="text" name="plotId" value="{{$plot->id}}" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Add Burial</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-text-input">Burial</label>
                        <select class="js-select2 form-control" name="burialId" style="width: 100%;" data-placeholder="Choose mount..">
                            <option>Select Burial</option>
                            <?php
                                $burials = DB::table("burials")->get();
                            ?>
                            @foreach ($burials as $burial)
                            <option value="{{$burial->id}}">{{$burial->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Sure</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="remove-plot-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/RemoveBurialInPost')}}" method="post">
                    @csrf
                    <input type="text" name="id" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Remove Burial</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure to remove this burial?</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Sure</button>
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
