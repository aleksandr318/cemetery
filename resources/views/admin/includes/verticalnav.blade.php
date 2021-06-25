<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-10">
            <!-- Logo -->
            <a class="link-fx font-w600 font-size-lg text-white" href="{{url('admin/')}}">
                <span class="smini-visible">
                    <span class="text-white-75">D</span><span class="text-white">x</span>
                </span>
                <span class="smini-hidden">
                    <span class="text-white">Cemetery</span><span class="text-white-75"></span> <span class="text-white font-size-base font-w400">Admin</span>
                </span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                <!-- Toggle Sidebar Style -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" data-toggle="layout" data-action="sidebar_style_toggle" href="javascript:void(0)">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </a>
                <!-- END Toggle Sidebar Style -->

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                    <i class="fa fa-times-circle"></i>
                </a>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/home')?'active':'' }}" href="{{url('admin/home')}}">
                    <i class="nav-main-link-icon si si-cursor"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-heading">Account</li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/WorkerManagementView')?'active':'' }}" href="{{url('admin/WorkerManagementView')}}">
                    <i class="far fa-address-book"></i> &nbsp;&nbsp;&nbsp;
                    <span class="nav-main-link-name">Workers</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/UserManagementView')?'active':'' }}" href="{{url('admin/UserManagementView')}}">
                    <i class="si si-users"></i> &nbsp;&nbsp;&nbsp;
                    <span class="nav-main-link-name">Users</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-heading">Plot</li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/MountManagementView')?'active':'' }}" href="{{url('admin/MountManagementView')}}">
                    <span class="nav-main-link-name">Segmentation</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/PlotsView')?'active':'' }}" href="{{url('admin/PlotsView')}}">
                    <span class="nav-main-link-name">All Plots</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/AllPlotMapView')?'active':'' }}" href="{{url('admin/AllPlotMapView')}}">
                    <span class="nav-main-link-name">Map</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-heading">Burial Records</li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/BurialManagementView')?'active':'' }}" href="{{url('admin/BurialManagementView')}}">
                    <span class="nav-main-link-name">Burials</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/RequestedBurialsView')?'active':'' }}" href="{{url('admin/RequestedBurialsView')}}">
                    <span class="nav-main-link-name">Requested Burials</span>
                </a>
            </li>
            <li class="nav-main-heading">Settings</li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('admin/ViewProfile')?'active':'' }}" href="{{url('admin/ViewProfile')}}">
                    <span class="nav-main-link-name">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>