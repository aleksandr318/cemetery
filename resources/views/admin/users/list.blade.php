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
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">All Users</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active" aria-current="page">All user lists</li>
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
            <h3 class="block-title">All users</h3>
            <div class="block-options">
                <a href="{{url('admin/AddUserView')}}" class="btn btn-hero-sm btn-hero-primary" data-toggle="tooltip" title="Add new"><i class="fa fa-plus"></i> &nbsp;New user</a>
            </div>
        </div>
        <div class="block-content">
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons" id="request-table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 15%;">Name</th>
                            <th style="width: 15%;">Logo</th>
                            <th style="width: 15%;">Email</th>
                            <th style="width: 15%;">Phone</th>
                            <th style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($users as $user) {
                        ?>
                        <tr data-id="{{$user->id}}">
                            <td>
                                {{$user->id}}
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                <img src="{{asset($user->photo)}}" style="height: 50px; width: 50px; border-radius: 50%;"/>
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                +{{$user->phone}}
                            </td>
                            <td class="text-center">
                                <a href="{{url('admin/UserDetailView/'.$user->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-circle-right"></i></a>
                                <button type="button" class="btn btn-sm btn-primary deletebutton" data-toggle="modal" data-target="#remove-user-modal"><i class="fa fa-trash"></i></button>
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
<div class="modal" id="remove-user-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/RemoveUserPost')}}" method="post">
                    @csrf
                    <input type="text" name="id" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Remove user</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure to remove this user?</p>
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
        $("#remove-user-modal input[name=id]").val(id);

    });
</script>
@endsection
