@extends('admin.layout.default')
@section('css')
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/nestable2/jquery.nestable.min.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin-assets/assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
<style type="text/css">
    .row>div{
        padding-bottom: 5px;
    }

    .dd-div {
        height: 2.25rem;
        padding: .5rem .75rem;
        color: #495057;
        background: #f9fafc;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 5px;
    }

</style>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Segments</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Plot</li>
                    <li class="breadcrumb-item active" aria-current="page">Plot place segment</li>
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
            <h3 class="block-title">Mount & Section & Lot</h3>
            <div class="block-options">
                <a href="{{url('admin/AddMountView')}}" class="btn btn-hero-sm btn-hero-primary" data-toggle="tooltip" title="Add new"><i class="fa fa-plus"></i> &nbsp;Add mount</a>
            </div>
        </div>
        <div class="block-content">
            <div class="block-content block-content-full">
                <div class="js-nestable-connected-simple">
                    <ol class="dd-list">
                        @foreach ($mounts as $mount)
                        <li class="dd-item" data-id="{{$mount->id}}">
                            <div class="dd-div">
                                <b>Mt.</b> {{$mount->name}}
                                <a href="#" data-toggle="modal" class="B-MtRemove" data-target="#remove-mount-modal" style="float: right; margin-left: 5px;"><i class="fa fa-trash"></i></a>
                                <a href="{{url('admin/EditMountView/'.$mount->id)}}" style="float: right; margin-left: 5px;"><i class="fa fa-edit"></i></a>
                                <a href="{{url('admin/AddSectionView/'.$mount->id)}}" style="float: right;"><i class="fa fa-plus"></i></a>
                            </div>
                            <?php
                                $sections = DB::table("sections")->where("mtId", $mount->id)->get();
                            ?>
                            @if (count($sections) != 0)
                            <ol class="dd-list">
                                @foreach($sections as $section)
                                <li class="dd-item" data-id="{{$section->id}}">
                                    <div class="dd-div">
                                        <b>Section.</b> {{$section->name}}
                                        <a href="#" data-toggle="modal" class="B-SectionRemove" data-target="#remove-section-modal" style="float: right; margin-left: 5px;"><i class="fa fa-trash"></i></a>
                                        <a href="{{url('admin/EditSectionView/'.$section->id)}}" style="float: right; margin-left: 5px;"><i class="fa fa-edit"></i></a>
                                        <a href="{{url('admin/AddLotView/'.$section->id)}}" style="float: right;"><i class="fa fa-plus"></i></a>
                                    </div>
                                    <?php
                                        $lots = DB::table("lots")->where("sectionId", $section->id)->get();
                                    ?>
                                    @if (count($lots) != 0)
                                    <ol class="dd-list">
                                        @foreach($lots as $lot)
                                        <li class="dd-item" data-id="{{$lot->id}}">
                                            <div class="dd-div">
                                                <b>Lot.</b> {{$lot->name}}
                                                <a href="#" data-toggle="modal" class="B-LotRemove" data-target="#remove-lot-modal" style="float: right; margin-left: 5px;"><i class="fa fa-trash"></i></a>
                                                <a href="{{url('admin/EditLotView/'.$lot->id)}}" style="float: right; margin-left: 5px;"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ol>
                                    @endif
                                </li>
                                @endforeach
                            </ol>
                            @endif
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- END Full Table -->
</div>
<div class="modal" id="remove-mount-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/RemoveMountPost')}}" method="post">
                    @csrf
                    <input type="text" name="mtId" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Remove Mount</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure to remove this mount? <br> If you remove this, then all sections, lots, graves and plots which is included on this place will be removed.</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Sure</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="remove-section-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/RemoveSectionPost')}}" method="post">
                    @csrf
                    <input type="text" name="sectionId" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Remove Section</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure to remove this section? <br> If you remove this, then all lots ,graves and plots which is included on this place will be removed.</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Sure</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="remove-lot-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <form action="{{url('admin/RemoveLotPost')}}" method="post">
                    @csrf
                    <input type="text" name="lotId" hidden="">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title" style="color:white;">Remove Lot</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Are you sure to remove this lot? <br> If you remove this, then graves and plots which is included on this place will be removed.</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Sure</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('admin-assets/assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/plugins/nestable2/jquery.nestable.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/js/pages/be_comp_nestable.min.js')}}"></script>
<script>
</script>
<script type="text/javascript">
    $(".B-MtRemove").click(function(){
        var mtId = $(this).parent().parent().data('id');
        $('#remove-mount-modal input[name=mtId]').val(mtId);
    });
    $(".B-SectionRemove").click(function(){
        var sectionId = $(this).parent().parent().data('id');
        $('#remove-section-modal input[name=sectionId]').val(sectionId);
    });
    $(".B-LotRemove").click(function(){
        var lotId = $(this).parent().parent().data('id');
        $('#remove-lot-modal input[name=lotId]').val(lotId);
    });
</script>
@endsection
