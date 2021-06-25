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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">User Edit</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Elements -->
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit User</h3>
        </div>
        <form action="{{url('/admin/EditUserPost')}}" method="post">
            @csrf
            <input name="id" value="{{$user->id}}" hidden="" />
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="example-text-input">Photo</label>
                            <p style="margin-bottom: 0px;">
                                <?php
                                    $photo = $user->photo;
                                    if ($errors->any() && old("photo")) $photo = asset(old("photo"));
                                ?>
                                <img class="photo" src="{{asset($photo)}}" onclick="$('#uploadfile').trigger('click')"/>
                                <input type="text" id="photo" name="photo" value="{{$photo}}" hidden="">
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-text-input">User Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$errors->any()?old('name'):$user->name}}" placeholder="Worker Name">
                                    @if ($errors->has('name'))
                                        <span class="error-note">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$errors->any()?old('email'):$user->email}}" placeholder="Email">
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
                                        <input type="text" class="form-control" name="phone" value="{{$errors->any()?old('phone'):$user->phone}}" onkeypress="return onlyNumberKey(event)" placeholder="Mobile Number">
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
                                    <input type="password" class="form-control" id="password" name="password" value="******" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="error-note">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="******" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input">Status</label>
                                    <div class="custom-control custom-switch custom-control-lg mb-2">
                                        <input type="checkbox" class="custom-control-input" id="account-status" name="status" @if($user->status=="active")checked=""@endif>
                                        <label class="custom-control-label" for="account-status"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="text-align: right; padding-top: 20px;">
                    <a href="{{url('admin/UserManagementView')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END Elements -->
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
