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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Leads</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Manage Lead</li>
                    <li class="breadcrumb-item active" aria-current="page">Lead list</li>
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
            <h3 class="block-title">Leads</h3>
            <div class="block-options">
                <a data-toggle="modal" data-target="#add-category-modal"><i class="fa fa-plus fa-2x" style="font-size: 20px;color:#0665d0;cursor: pointer;"></i></a>
            </div>
        </div>
        <div class="block-content">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons" id="lead-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 25%;">Service Name</th>
                            <th style="width: 15%;">Zip code</th>
                            <th style="width: 15%;">Create Date</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 15%;">Accepted Company</th>
                            <th class="text-center" style="width: 100px;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($leads as $lead) {
                                $service_obj = DB::table("services")->where("id", $lead->service_id)->first();
                        ?>
                        <tr>
                            <td>
                                {{$lead->id}}
                            </td>
                            <td>
                                @if ($service_obj)
                                    <a href="{{url('admin/ServiceDetailView/'.$lead->service_id)}}">{{$service_obj->name}}</a>
                                @endif
                            </td>
                            <td>
                                {{$lead->zipcode}}
                            </td>
                            <td>
                                {{date("Y-m-d", strtotime($lead->created_at))}}
                            </td>
                            <td>
                                @if ($lead->status == 1)
                                <span class="badge badge-info">Open</span>
                                @elseif ($lead->status == 2)
                                <span class="badge badge-primary">Accepted</span>
                                @elseif ($lead->status == 3)
                                <span class="badge badge-success">Completed</span>
                                @else
                                <span class="badge badge-secondary">Closed</span>
                                @endif
                            </td>
                            <td>
                                <?php
                                    if (!empty($lead->company_id)){
                                        $company_obj = DB::table("users")->where("id", $lead->company_id)->first();
                                        if ($company_obj)
                                            echo "<a href=".url('admin/CompanyDetailView/'.$lead->company_id).">".$company_obj->name."</a>";
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{url('admin/LeadDetail/'.$lead->id)}}"  title="detail">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
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

    $("#lead-table").dataTable({
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
