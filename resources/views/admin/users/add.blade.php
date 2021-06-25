@extends('admin.layout.default')
@section('css')
<style type="text/css">
    .error-note{
        color:red;
    }
    .photo{
        height: 200px; 
        width: 200px; 
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Add Users</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<form action="{{url('admin/AddUserPost')}}" method="post">
    @csrf
<div class="content">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add User</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="example-text-input">Photo</label>
                        <p style="margin-bottom: 0px;">
                            <?php
                                $photo = asset("admin-assets/assets/images/logo-default.jpg");
                                if ($errors->any() && old("photo")) $photo = asset(old("photo"));
                            ?>
                            <img class="photo" src="{{$photo}}" onclick="$('#uploadfile').trigger('click')"/>
                            <input type="text" id="photo" name="photo" value="{{old('photo')}}" hidden="">
                        </p>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="example-text-input">User Name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="User Name">
                                @if ($errors->has('name'))
                                    <span class="error-note">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Email</label>
                                <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="error-note">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Mobile Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}" onkeypress="return onlyNumberKey(event)" placeholder="Mobile Number">
                                </div>
                                @if ($errors->has('phone'))
                                    <span class="error-note">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="example-text-input">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="error-note">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="example-text-input">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" style="text-align: right;">
                <a href="{{url('admin/UserManagementView')}}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- END Page Content -->
<form id="uploadform" method="POST" action="{{URL::to('/UploadFile')}}" enctype="multipart/form-data">
    @csrf
    <input type="file" id="uploadfile" name="files" hidden>
</form>
@endsection

@section('js')
<script src="{{asset('Gplugin/js/ajax-file-form.min.js')}}"></script>
<script type="text/javascript">
    // ====== Begin upload function
    $("#uploadfile").change(function(){
        $("#uploadform").submit();
    });
    $('#uploadform').ajaxForm(function(datas) {
        var data = JSON.parse(datas);
        $("#photo").val(data.path);
        $(".photo").attr("src", data.full_path);
    });
    /// ===== End upload function

    function onlyNumberKey(evt) { 
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
</script>
@endsection
