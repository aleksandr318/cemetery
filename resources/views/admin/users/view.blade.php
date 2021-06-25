@extends('admin.layout.default')
@section('css')
    <style type="text/css">
        .text-muted span{
            font-weight: bold;
        }
        .photo{
            border:1px solid rgb(220,220,220);
            width: 150px;
            height: 150px;
        }
    </style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">User Detail View</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active" aria-current="page">Detail view</li>
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
            <h3 class="block-title">User View <a href="{{url('admin/EditUserView/'.$user->id)}}" style="float: right;"><i class="fa fa-user-edit fa-2x" style="font-size: 19px;"></i></a></h3>
        </div>
        <div class="block-content">
            <div class="row push">
                <div class="col-lg-4">
                    <div class="form-group">
                        <img src="{{asset($user->photo)}}" class="photo"/>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="text-muted">
                                <span>User name :</span> {{$user->name}}
                            </p>
                        </div>
                        <div class="col-lg-6">
                        	<p class="text-muted">
                        		<span>Email :</span> {{$user->email}}
                        	</p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-muted">
                                <span>Mobile Number :</span> +{{$user->phone}}
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-muted">
                                <span>Balance :</span> $ {{$user->balance}}
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-muted">
                                <span>Account Status :</span> {{$user->status}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Elements -->
</div>
<!-- END Page Content -->
@endsection

@section('js')
@endsection
