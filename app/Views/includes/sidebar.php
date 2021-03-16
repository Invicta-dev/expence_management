<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <!-- <a href="index.html">
                        <img src="./assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a> -->
                <!-- <p style="color: #fff;">Natures's CRM</p> -->
                <div class="menu-toggler sidebar-toggler"> </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="./assets/layouts/layout/img/avatar3_small.jpg" />
                            <span class="username username-hide-on-mobile"> <?= session()->get('logged_user'); ?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <!-- <li>
                                <a href="page_user_profile_1.html">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="app_calendar.html">
                                    <i class="icon-calendar"></i> My Calendar </a>
                            </li>
                            <li>
                                <a href="app_inbox.html">
                                    <i class="icon-envelope-open"></i> My Inbox
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li>
                                <a href="app_todo.html">
                                    <i class="icon-rocket"></i> My Tasks
                                    <span class="badge badge-success"> 7 </span>
                                </a>
                            </li> -->
                            <li class="divider"> </li>
                            <li>
                                <a href="<?= base_url(); ?>/logout">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="javascript:;" class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                    <li class="sidebar-toggler-wrapper hide">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler"> </div>
                        <!-- END SIDEBAR TOGGLER BUTTON -->
                    </li>
                    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                    <li class="nav-item <?= (current_url(true)->getSegment(3) == 'dashboard') ? 'active' : ''; ?>">
                        <a href="<?= base_url(); ?>/dashboard" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">Dashboard</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <!-- <li class="heading">
                            <h3 class="uppercase">Features</h3>
                        </li> -->
                    <?php if (session()->get('role') == 'Super admin') : ?>
                        <li class="nav-item start <?= (current_url(true)->getSegment(3) == 'user') ? 'active' : '' ?> ">
                            <a href="<?= base_url(); ?>/user" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Users</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item start <?= (current_url(true)->getSegment(3) == 'category') ? 'active' : '' ?> ">
                            <a href="<?= base_url(); ?>/category" class="nav-link nav-toggle">
                                <i class="icon-tag"></i>
                                <span class="title">Categories</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item start <?= (current_url(true)->getSegment(3) == 'process') ? 'active' : '' ?> ">
                            <a href="<?= base_url(); ?>/process" class="nav-link nav-toggle">
                                <i class="icon-basket"></i>
                                <span class="title">Process</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item start <?= (current_url(true)->getSegment(3) == 'vendor') ? 'active' : '' ?> ">
                            <a href="<?= base_url(); ?>/vendor" class="nav-link nav-toggle">
                                <i class="icon-user"></i>
                                <span class="title">Vendor</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <div class="logo text-center" style="position: relative;
                        top: 50%;">
                        <a href="index.html">
                            <img width="70%" src="<?= base_url(); ?>/assets/pages/img/Invicta.png" alt="logo" /> </a>
                    </div>

                </ul>
                <!-- END SIDEBAR MENU -->
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->