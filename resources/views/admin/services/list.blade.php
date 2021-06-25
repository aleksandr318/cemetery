@extends('admin.layout.default')
@section('css')
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
<style type="text/css">
    .row>div{
        padding-bottom: 5px;
    }
    .service-photo{
        border:2px dashed #d8dfed;
        border-radius: 3px;
        height:150px;
        text-align: center;
        display: table;
        width: 100%;
    }
    .service-photo:hover{
        border:2px dashed blue;
    }
    .service-photo>div{
        display: table-cell;
        vertical-align: middle;
    }
    .service-photo>img{
        display: table-cell;
        vertical-align: middle;
        display: none;
        width: 100%;
        height: auto;
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Services</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Manage Service</li>
                    <li class="breadcrumb-item active" aria-current="page">Service</li>
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
            <h3 class="block-title">Services</h3>
            <div class="block-options">
                <a data-toggle="modal" data-target="#add-service-modal"><i class="fa fa-plus fa-2x" style="font-size: 20px;color:#0665d0;cursor: pointer;"></i></a>
            </div>
        </div>
        <div class="block-content">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons" id="service-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Category</th>
                            <th style="width: 10%;">Name</th>
                            <th style="width: 35%;">Cover Image</th>
                            <th style="width: 30%;">Description</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($services as $service) {
                                $category_name = "";
                                if ($category_obj = DB::table("service_categories")->where("id", $service->category_id)->first())
                                    $category_name = $category_obj->name;
                        ?>
                        <tr data-id="{{$service->id}}" data-name="{{$service->name}}" data-path="{{$service->photo}}" data-full-path="{{asset($service->photo)}}" data-description="{{$service->description}}" data-category="{{$service->category_id}}" data-working_day="{{$service->working_day}}">
                            <td>
                                <a href="{{url('admin/ServiceDetailView/'.$service->id)}}">{{$service->id}}</a>
                            </td>
                            <td>
                                {{$category_name}}
                            </td>
                            <td>
                                {{$service->name}}
                            </td>
                            <td>
                                @if ($service->photo != "")
                                <img src="{{asset($service->photo)}}" style="width: 100%; height: auto;  border-radius: 3px;">
                                @endif
                            </td>
                            <td>
                                {{$service->description}}
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-service-modal" title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary remove" data-toggle="modal" data-target="#remove-service-modal" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
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


<div class="modal fade" id="add-service-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add Service</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{url('admin/AddServicePost')}}" method="post">
                    @csrf
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Category</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="category_id" required="">
                                <option value="" disabled selected>Please select</option>
                                <?php $categories = DB::table("service_categories")->get(); ?>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Description</label>
                        </div>
                        <div class="col-md-8">
                            <textarea type="text" class="form-control" name="description" style="height: 150px;" required=""></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Working day</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="working_day" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Cover Image</label>
                        </div>
                        <div class="col-md-8">
                            <div class="service-photo" onclick="$('#uploadfile-add').trigger('click');">
                                <div>
                                    Click here to upload
                                </div>
                                <img src=""/>
                            </div>
                            <input name="image" hidden="" />
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-service-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit Service</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{url('admin/EditServicePost')}}" method="post">
                    @csrf
                    <input name="id" hidden=""/>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Category</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control select2" name="category_id" required="">
                                <option value="" disabled selected>Please select</option>
                                <?php $categories = DB::table("service_categories")->get(); ?>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Description</label>
                        </div>
                        <div class="col-md-8">
                            <textarea type="text" class="form-control" name="description" style="height: 150px;" required=""></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Working day</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="working_day" required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Cover Image</label>
                        </div>
                        <div class="col-md-8">
                            <div class="service-photo" onclick="$('#uploadfile-edit').trigger('click');">
                                <div>
                                    Click here to upload
                                </div>
                                <img src=""/>
                            </div>
                            <input name="image" hidden="" />
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="remove-service-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Remove Service</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{url('admin/RemoveService')}}" method="post">
                    @csrf
                    <input name="id" hidden="" />
                <div class="block-content">
                    <p>Are you sure to remove this service?</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Done</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<form id="uploadform-add" method="POST" action="{{URL::to('/UploadFile')}}" enctype="multipart/form-data">
    @csrf
    <input type="file" id="uploadfile-add" name="files" hidden>
</form>
<form id="uploadform-edit" method="POST" action="{{URL::to('/UploadFile')}}" enctype="multipart/form-data">
    @csrf
    <input type="file" id="uploadfile-edit" name="files" hidden>
</form>

@endsection

@section('js')
<script src="{{asset('admin-assets/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<script src="{{asset('Gplugin/js/ajax-file-form.min.js')}}"></script>

<script type="text/javascript">
    $(".edit").click(function(){
        var id = $(this).parent().parent().parent().attr('data-id');
        var category_id = $(this).parent().parent().parent().attr('data-category');
        var name = $(this).parent().parent().parent().attr('data-name');
        var description = $(this).parent().parent().parent().attr('data-description');
        var working_day = $(this).parent().parent().parent().attr('data-working_day');
        var path = $(this).parent().parent().parent().attr('data-path');
        var full_path = $(this).parent().parent().parent().attr('data-full-path');

        $("#edit-service-modal input[name=id]").val(id);
        $("#edit-service-modal input[name=name]").val(name);
        $("#edit-service-modal textarea[name=description]").val(description);
        $("#edit-service-modal input[name=working_day]").val(working_day);
        $("#edit-service-modal select[name=category_id] option[value='"+category_id+"']").attr("selected", "");

        if (path == ""){
            $("#edit-service-modal .service-photo div").show();
            $("#edit-service-modal .service-photo img").hide();
        }else{

            $("#edit-service-modal .service-photo div").hide();
            $("#edit-service-modal .service-photo img").show();

            $("#edit-service-modal input[name=image]").val(path);
            $("#edit-service-modal img").attr("src",full_path);
        }
    });
    $(".remove").click(function(){
        var id = $(this).parent().parent().parent().attr("data-id");
        $("#remove-service-modal input[name=id]").val(id);
    });

    // ====== Begin upload function
    $("#uploadfile-add").change(function(){
        $("#uploadform-add").submit();
    });
    $('#uploadform-add').ajaxForm(function(datas) {
        var data = JSON.parse(datas);
        $("#add-service-modal .service-photo div").hide();
        $("#add-service-modal .service-photo img").show();
        $("#add-service-modal .service-photo img").attr("src",data.full_path);
        $("#add-service-modal input[name=image]").val(data.path);
    });
    /// ===== End upload function

    // ====== Begin upload function
    $("#uploadfile-edit").change(function(){
        $("#uploadform-edit").submit();
    });
    $('#uploadform-edit').ajaxForm(function(datas) {
        var data = JSON.parse(datas);
        $("#edit-service-modal .service-photo div").hide();
        $("#edit-service-modal .service-photo img").show();
        $("#edit-service-modal .service-photo img").attr("src",data.full_path);
        $("#edit-service-modal input[name=image]").val(data.path);
    });
    /// ===== End upload function

    $("#service-table").dataTable({
                        pageLength: 10,
                        lengthMenu: [
                            [5, 10, 20, 50],
                            [5, 10, 20, 50]
                        ],
                        autoWidth: !1,
                        order: [2,"asc"],
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
</script>
@endsection
