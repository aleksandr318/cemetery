@extends('admin.layout.default')
@section('css')
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
<style type="text/css">
    .row>div{
        padding-bottom: 5px;
    }
    .category-photo{
        border:2px dashed #d8dfed;
        border-radius: 3px;
        height:150px;
        text-align: center;
        display: table;
        width: 100%;
    }
    .category-photo:hover{
        border:2px dashed blue;
    }
    .category-photo>div{
        display: table-cell;
        vertical-align: middle;
    }
    .category-photo>img{
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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Categories</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Manage Category</li>
                    <li class="breadcrumb-item active" aria-current="page">Service Category</li>
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
            <h3 class="block-title">Categories</h3>
            <div class="block-options">
                <a data-toggle="modal" data-target="#add-category-modal"><i class="fa fa-plus fa-2x" style="font-size: 20px;color:#0665d0;cursor: pointer;"></i></a>
            </div>
        </div>
        <div class="block-content">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons" id="category-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 15%;">Name</th>
                            <th style="width: 20%;">Cover Image</th>
                            <th style="width: 40%;">Description</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($categories as $category) {
                        ?>
                        <tr data-id="{{$category->id}}" data-name="{{$category->name}}" data-path="{{$category->image}}" data-full-path="{{asset($category->image)}}" data-description="{{$category->description}}">
                            <td>
                                {{$category->id}}
                            </td>
                            <td>
                                {{$category->name}}
                            </td>
                            <td>
                                @if ($category->image != "")
                                <img src="{{asset($category->image)}}" style="width: 100%; height: auto; border-radius: 3px;">
                                @endif
                            </td>
                            <td>
                                {{$category->description}}
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-category-modal" title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary remove" data-toggle="modal" data-target="#remove-category-modal" title="Delete">
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


<div class="modal fade" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{url('admin/AddCategoryPost')}}" method="post">
                    @csrf
                <div class="block-content">
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
                            <label>Cover Image</label>
                        </div>
                        <div class="col-md-8">
                            <div class="category-photo" onclick="$('#uploadfile-add').trigger('click');">
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

<div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{url('admin/EditCategoryPost')}}" method="post">
                    @csrf
                    <input name="id" hidden=""/>
                <div class="block-content">
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
                            <label>Cover Image</label>
                        </div>
                        <div class="col-md-8">
                            <div class="category-photo" onclick="$('#uploadfile-edit').trigger('click');">
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



<div class="modal" id="remove-category-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Remove Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{url('admin/RemoveCategory')}}" method="post">
                    @csrf
                    <input name="id" hidden="" />
                <div class="block-content">
                    <p>Are you sure to remove this category?</p>
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
        var name = $(this).parent().parent().parent().attr('data-name');
        var description = $(this).parent().parent().parent().attr('data-description');
        var path = $(this).parent().parent().parent().attr('data-path');
        var full_path = $(this).parent().parent().parent().attr('data-full-path');

        $("#edit-category-modal input[name=id]").val(id);
        $("#edit-category-modal input[name=name]").val(name);
        $("#edit-category-modal textarea[name=description]").val(description);

        if (path == ""){
            $("#edit-category-modal .category-photo div").show();
            $("#edit-category-modal .category-photo img").hide();
        }else{

            $("#edit-category-modal .category-photo div").hide();
            $("#edit-category-modal .category-photo img").show();

            $("#edit-category-modal input[name=image]").val(path);
            $("#edit-category-modal img").attr("src",full_path);
        }
    });
    $(".remove").click(function(){
        var id = $(this).parent().parent().parent().attr("data-id");
        $("#remove-category-modal input[name=id]").val(id);
    });

    // ====== Begin upload function
    $("#uploadfile-add").change(function(){
        $("#uploadform-add").submit();
    });
    $('#uploadform-add').ajaxForm(function(datas) {
        var data = JSON.parse(datas);
        $("#add-category-modal .category-photo div").hide();
        $("#add-category-modal .category-photo img").show();
        $("#add-category-modal .category-photo img").attr("src",data.full_path);
        $("#add-category-modal input[name=image]").val(data.path);
    });
    /// ===== End upload function

    // ====== Begin upload function
    $("#uploadfile-edit").change(function(){
        $("#uploadform-edit").submit();
    });
    $('#uploadform-edit').ajaxForm(function(datas) {
        var data = JSON.parse(datas);
        $("#edit-category-modal .category-photo div").hide();
        $("#edit-category-modal .category-photo img").show();
        $("#edit-category-modal .category-photo img").attr("src",data.full_path);
        $("#edit-category-modal input[name=image]").val(data.path);
    });
    /// ===== End upload function

    $("#category-table").dataTable({
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
