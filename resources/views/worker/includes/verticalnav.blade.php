<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-10">
            <!-- Logo -->
            <a class="link-fx font-w600 font-size-lg text-white" href="{{url('company/')}}">
                <span class="smini-visible">
                    <span class="text-white-75">D</span><span class="text-white">x</span>
                </span>
                <span class="smini-hidden">
                    <span class="text-white">H-Leads</span><span class="text-white-75"></span> <span class="text-white font-size-base font-w400">Company</span>
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
                <a class="nav-main-link {{Request::is('company/home')?'active':'' }}" href="{{url('company/home')}}">
                    <i class="nav-main-link-icon si si-cursor"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('company/openleadlistview')?'active':'' }}" href="{{url('company/openleadlistview')}}">
                    <i class="nav-main-link-icon fa fa-grip-horizontal"></i> &nbsp;&nbsp;&nbsp;
                    <span class="nav-main-link-name">Open Leads</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('company/acceptedleadlistview')?'active':'' }}" href="{{url('company/acceptedleadlistview')}}">
                    <i class="nav-main-link-icon fa fa-check"></i> &nbsp;&nbsp;&nbsp;
                    <span class="nav-main-link-name">Accepted Leads</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-heading">Settings</li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('company/ViewProfile')?'active':'' }}" href="{{url('company/ViewProfile')}}">
                    <i class="far fa-fw fa-user mr-1"></i> &nbsp;&nbsp;&nbsp;
                    <span class="nav-main-link-name">Profile</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Request::is('company/ViewPayment')?'active':'' }}" href="{{url('company/ViewPayment')}}">
                    &nbsp;<i class="fab fa-stripe-s"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="nav-main-link-name">Payment</span>
                    <!-- <span class="nav-main-link-badge badge badge-pill badge-success">5</span> -->
                </a>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</nav>