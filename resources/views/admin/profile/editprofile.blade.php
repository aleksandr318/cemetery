@extends('admin.layout.default')
@section('css')
<style type="text/css">
    .block-content>div{
        padding-top: 10px;
    }
    .block-content{
        padding-bottom: 30px;
    }
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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Profile Edit</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Profile</li>
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
    <form action="{{url('admin/EditProfilePost')}}" method="post">
        @csrf
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Profile Edit</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-md-4">
                    Name
                </div>
                <div class="col-md-8">
                    <?php
                        $name = Auth::user()->name;
                        if ($errors->has('name'))
                            $name = old('name');
                    ?>

                    <input type="text" class="form-control" id="name" name="name" placeholder="Write name." value="{{ $name }}">
                    @if ($errors->has('name'))
                        <span class="error-note">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Email
                </div>
                <div class="col-md-8">
                    <?php
                        $email = Auth::user()->email;
                        if ($errors->has('email'))
                            $email = old('email');
                    ?>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $email }}" placeholder="Write email.">
                    @if ($errors->has('email'))
                        <span class="error-note">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Password
                </div>
                <div class="col-md-8">
                    <input type="password" class="form-control" id="password" name="password" value="******" placeholder="Write password.">
                    @if ($errors->has('password'))
                        <span class="error-note">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Password Confirmation
                </div>
                <div class="col-md-8">
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" value="******" placeholder="Password Confirmation.">
                </div>
            </div>
            <div class="row push">
                <div class="col-md-12" style="text-align: right;">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{url('admin/ViewProfile')}}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- END Elements -->
</div>
<!-- END Page Content -->
@endsection

@section('js')
@endsection
