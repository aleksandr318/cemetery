@extends('admin.layout.default')
@section('css')
<style type="text/css">
    .error-note{
        color:red;
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Service Detail View</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Service</li>
                    <li class="breadcrumb-item active" aria-current="page">Detail View</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Elements -->
    @if ( session()->get('msg') != null )
        <div class="alert alert-info alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <p class="mb-0"><i class="fa fa-fw fa-check"></i> {{session()->get('msg')}}</p>
        </div>
    @endif
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Service detail <a href="{{url('admin/ServiceManagementView')}}" style="float: right;" class="btn btn-sm btn-secondary"><i class="fa fa-backspace"></i> Back</a></h3>
        </div>
        <div class="block-content">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Questions<button style="float: right;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-question-modal"><i class="fa fa-fw fa-plus mr-1"></i> Add Question</button></h3>
        </div>
        <div class="block-content">
            <table class="table table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 10%;">#</th>
                        <th style="width: 70%;">Content</th>
                        <th style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $p = 0; ?>
                    @foreach ($questions as $question)
                    <tr data-id="{{$question->id}}">
                        <th scope="row">{{ ++ $p}}</th>
                        <td>{{$question->content}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled editbutton" data-toggle="modal" data-target="#edit-question-modal">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary js-tooltip-enabled deletebutton" data-toggle="modal" data-target="#remove-question-modal">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Elements -->
</div>
<div class="modal" id="add-question-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/AddQuestionPost')}}" method="post">
                    @csrf
                    <input name="id" value="{{$service->id}}" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Add Question</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-text-input">Question</label>
                        <textarea type="text" class="form-control" name="content" placeholder="Write Question." required=""></textarea>
                    </div>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="edit-question-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/EditQuestionPost')}}" method="post">
                    @csrf
                    <input type="text" name="id" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Edit Question</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group">
                        <label for="example-text-input">Question</label>
                        <textarea type="text" class="form-control" name="content" placeholder="Write Question." required=""></textarea>
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
<div class="modal" id="remove-question-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/RemoveQuestionPost')}}" method="post">
                    @csrf
                    <input type="text" name="id" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Remove Question</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure to remove this question?</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Remove</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
<form id="uploadform" method="POST" action="{{URL::to('/UploadFile')}}" enctype="multipart/form-data">
    @csrf
    <input type="file" id="uploadfile" name="files" hidden>
</form>
@endsection

@section('js')
<script src="{{asset('Gplugin/js/ajax-file-form.min.js')}}"></script>
<script type="text/javascript">
    $(".editbutton").click(function(){
        var id = $(this).parent().parent().parent().data('id');
        var content = $(this).parent().parent().parent().find("td:nth-child(2)").text();

        $("#edit-question-modal input[name=id]").val(id);
        $("#edit-question-modal textarea[name=content]").val(content);

    });
    $(".deletebutton").click(function(){
        var id = $(this).parent().parent().parent().data('id');
        $("#remove-question-modal input[name=id]").val(id);
    });
</script>
@endsection
