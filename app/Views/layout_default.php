<?php $session = session() ?>
<?php
// $sidebarCollapse = FALSE;

// if (isset($_COOKIE['sidebarCollapse'])) {
//     $sidebarCollapse = $_COOKIE['sidebarCollapse'];
// }

$user =  $session->get('userData');

// print_r($user );

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DTrack</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/toastr/toastr.min.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">



    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">

    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- qrcode -->
    <script src="<?= base_url('plugins/jsqr/jsqr.js'); ?>"></script>
    <!-- qrcode -->
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

    <!-- custom functions  -->
    <script src="<?= base_url('js.js'); ?>" defer></script>
    <script src="<?= base_url('MyClasses.js'); ?>" defer></script>

    <!-- inputmask requred plugins -->
    <script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/inputmask/jquery.inputmask.min.js'); ?>"></script>


</head>

<body class="hold-transition sidebar-mini layout-fixed  
    <?= $user['user_dark_mode'] == '' ? '' : 'dark-mode'; ?>
    <?= $user['user_header_fixed'] == '' ? '' : 'layout-navbar-fixed'; ?>
    <?= $user['user_sidebar_collapsed'] == '' ? '' : 'sidebar-collapse'; ?>
    <?= $user['user_sidebar_fixed'] == '' ? '' : 'sidebar-fixed'; ?>
    <?= $user['user_footer_fixed'] == '' ? '' : 'layout-footer-fixed'; ?>">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-<?= $user['user_dark_mode'] == '' ? 'light' : 'dark'; ?>">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="pushmenu" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item  d-sm-inline-block">
                    <a href="<?= base_url(); ?>" class="nav-link"><i class="nav-icon fas fa-home"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item d-none">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown d-none">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="#" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="#" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="#" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('messages'); ?>" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span id="total-notification" class="badge badge-warning navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-height:90vh;overflow-y:auto;">
                        <span class="dropdown-header" id="dropdown-header">Nothing to see here</span>
                        <div class="dropdown-divider"></div>
                        <div id="dropdown-items-container" class="small">
                            <!-- <a href="#" class="dropdown-item">
                                <i class="fas fa-bullhorn mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a> -->

                        </div>
                        <div class="dropdown-divider"></div>
                        <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
                    </div>
                </li>
                <li class="nav-item  d-lg-block d-md-block d-sm-none d-none ">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                <li class="nav-item d-md-none d-lg-none">
                    <a class="nav-link p-0" data-widget="fullscreen" href="#" role="button">
                        <div class="shadow-none ">
                            <?php if (session()->get('user_pic') !== "") : ?>
                                <img style="object-fit: cover; height: 35px; width:35px; overflow:hidden" src="<?= base_url('uploads/' . session()->get('user_pic')); ?>" class="logged-user-profile-pic-img img-circle elevation-2 border-light border" alt="">
                            <?php else : ?>
                                <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle border-light border" style=" height: 40px; width:40px;">
                                    <?= substr(session()->get('userData')['user_firstname'], 0, 1); ?><?= substr(session()->get('userData')['user_lastname'], 0, 1); ?>
                                </span>

                                <!-- <img style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="logged-user-profile-pic-img img-circle elevation-2" alt=""> -->
                            <?php endif; ?>
                        </div>
                    </a>
                </li>



            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?= base_url(); ?>dist/img/logo.png" alt="" class="brand-image img-circle" style="opacity: .8;">
                <span class="brand-text font-weight-light">DTrack</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if (session()->get('user_pic') !== "") : ?>
                            <img style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="<?= base_url('uploads/' . session()->get('user_pic')); ?>" class="logged-user-profile-pic-img img-circle elevation-2" alt="">
                        <?php else : ?>
                            <span class="bg-dark overflow-hidden font-weight-bold d-flex border border-light justify-content-center  align-items-center shadow-sm img-circle" style=" height: 40px; width:40px;">
                                <?= substr(session()->get('userData')['user_firstname'], 0, 1); ?><?= substr(session()->get('userData')['user_lastname'], 0, 1); ?>
                            </span>

                            <!-- <img style="object-fit: cover; height: 30px; width:30px; overflow:hidden" src="<?= base_url('img/default_user_pic.png'); ?>" class="logged-user-profile-pic-img img-circle elevation-2" alt=""> -->
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-uppercase"><?= $session->get('userData')['user_firstname'] . " " . $session->get('userData')['user_lastname'] ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline d-none">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>" class="nav-link <?= ($active_tab == 'Home') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        <li class="nav-item d-none">
                            <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= ($active_tab == 'Dashboard') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('group'); ?>" class="nav-link <?= ($active_tab == 'Group') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Group
                                    <!-- <span class="right badge badge-danger">New</span> -->
                                </p>
                            </a>
                        </li>

                        <li class="nav-item d-none"> <!-- add class menu-open to open the menu  -->
                            <a href="#" class="nav-link <?= ($active_tab == 'Profile') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Administration
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Personnel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Office</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('my_profile'); ?>" class="nav-link  <?= ($active_tab == 'My Profile') ? 'active' : ''; ?>">
                                <i class="nav-icon fas  fa-user-tie"></i>
                                <p>
                                    My Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link  <?= ($active_tab == 'Logout') ? 'active' : ''; ?>" id="log-out-nav-tab-btn">
                                <i class="nav-icon fas fa-sign-out-alt"></i> <!--fas fa-sign-out-alt  -->

                                <p>
                                    <!-- login/logout -->
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content ------------------------->
        <div id="content-wrapper" class="content-wrapper">

            <?= $this->renderSection('content') ?>

        </div>
        <!-- /.content-wrapper ------------------------------------>



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-<?= $user['user_dark_mode'] == '' ? 'light' : 'dark'; ?> shadow-lg" style="display: block; top: 56.8px; height: 673.2px;">
            <!-- Control sidebar content goes here -->
            <div class="p-3 control-sidebar-content" style="height: 673.2px;">
                <h5>DTrack Options</h5>
                <hr class="mb-2">
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-secondary custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="darkmode-switch" <?= $user['user_dark_mode'] == '' ? '' : 'checked'; ?>>
                        <label class="custom-control-label text-muted font-weight-lighter" for="darkmode-switch">Dark Mode</label>
                    </div>
                </div>
                <h6>Header Options</h6>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-secondary custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="headerfixed-switch" <?= $user['user_header_fixed'] == '' ? '' : 'checked'; ?>>
                        <label class="custom-control-label text-muted font-weight-lighter" for="headerfixed-switch">Fixed</label>
                    </div>
                </div>


                <h6>Sidebar Options</h6>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-secondary custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="sidebarcollapsed-switch" <?= $user['user_sidebar_collapsed'] == '' ? '' : 'checked'; ?>>
                        <label class="custom-control-label text-muted font-weight-lighter" for="sidebarcollapsed-switch">Collapsed</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-secondary custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="sidebarfixed-switch" <?= $user['user_sidebar_fixed'] == '' ? '' : 'checked'; ?>>
                        <label class="custom-control-label text-muted font-weight-lighter" for="sidebarfixed-switch">Fixed</label>
                    </div>
                </div>

                <h6>Footer Options</h6>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-secondary custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="footerfixed-switch" <?= $user['user_footer_fixed'] == '' ? '' : 'checked'; ?>>
                        <label class="custom-control-label text-muted font-weight-lighter" for="footerfixed-switch">Fixed</label>
                    </div>
                </div>

            </div>

        </aside>
        <!-- /.control-sidebar -->

        <!-- direct chat floating container -->
        <style>
            .floating-chat-container {

                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
                width: fit-content;
                max-height: fit-content;
                overflow-y: auto;
            }

            .floating-chat-container>div {
                position: relative;
                width: 300px;
                max-height: 400px;
                overflow-y: auto;
            }
        </style>
        <div class="floating-chat-container d-flex flex-row py-3  d-none">
            <div class="floating-chat shadow card card-primary card-outline direct-chat direct-chat-primary m-1 d-none">
                <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>

                    <div class="card-tools">
                        <span title="3 New Messages" class="badge bg-primary">3</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fas fa-comments"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">Alexander Pierce</span>
                                <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="#" alt="Message User Image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Is this template really for free? That's unbelievable!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->

                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="#" alt="Message User Image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                You better believe it!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="#" alt="User Avatar">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Count Dracula
                                            <small class="contacts-list-date float-right">2/28/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>

        <!-- Main Footer -->
        <footer id="app-footer" class="main-footer d-print-none d-none">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <img src="<?= base_url('img/deped-matatag-logos.png'); ?>" alt="DepEd Matatag Logos" width="70px">
            </div>
            <!-- Default to the left -->
            <strong>&copy; 2024 District of La Castellana I</a>.</strong> All rights reserved.
        </footer>
    </div>


    <!--modal -->
    <div id="my-modal" class="modal fade" style="min-height: 500px;" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="false">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="my-modal-title">
                        <!-- Title -->
                    </h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body" class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <!-- Footer -->
                </div>
            </div>
        </div>
    </div>

    <!-- /.modal -->


    </script>

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.min.js'); ?>"></script>


    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/qrcode/html5_qr_code_generator.js'); ?>"></script>
    <script src="<?= base_url('plugins/toastr/toastr.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/select2/js/select2.full.min.js'); ?>"></script>


    <style>
        /* Sweet alert overrides for changing of color modes */
        .swal2-title,
        .swal2-html-container {
            color: black !important;
        }

        .swal2-container {
            /* background-color: whitesmoke !important; */
            z-index: 3000 !important;
        }

        .swal2-modal {
            background-color: whitesmoke !important;

        }
    </style>
    <style>
        .main-sidebar {
            background: rgb(52, 58, 64);
            background: linear-gradient(344deg, rgba(52, 58, 64, 1) 0%, rgba(78, 95, 113, 1) 44%, rgba(48, 54, 59, 1) 100%);
        }
    </style>
    <style>
        .blob {
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
            transform: scale(1);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            }
        }
    </style>





    <style>
        /* Define print-specific styles */
        @media print {

            /* Hide the body when printing */
            .content-wrapper,
            body>*,
            html {
                background-color: white !important;
            }
        }
    </style>

    <style>
        /* animation style for removing element */
        @keyframes scaleDownFadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }
  
            to {
                opacity: 0;
                transform: scale(0.1);
                /* Adjust the scale */
                display: none;
            }
        }

        .disappearing-element-scale-down {
            animation: scaleDownFadeOut 0.8s ease-in-out forwards;
        }
    </style>

    <script>
        // Function to set a cookie
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
        // Function to get the value of a cookie by name
        function getCookie(name) {
            var nameEQ = name + "=";
            var cookies = document.cookie.split(";"); // Get all cookies as an array
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                while (cookie.charAt(0) === " ") {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(nameEQ) === 0) {
                    return cookie.substring(nameEQ.length, cookie.length);
                }
            }
            return null; // Cookie not found
        }
    </script>
    <script>
        $(document).ready(function() {
            var pushmenubtn = document.getElementById('pushmenu');
            var sidebarCollapse = getCookie('sidebarCollapse');
            $(pushmenubtn).click(function(e) {
                e.preventDefault();

                if (sidebarCollapse) {
                    setCookie("sidebarCollapse", false);

                } else {
                    setCookie("sidebarCollapse", true);

                }

            });
        });
    </script>
    <script>
        $('#log-out-nav-tab-btn').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Logout?',
                text: 'Are you sure you want to logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('logout'); ?>";
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

    <script>
        $(function() {

            function applySetting(setting_name, setting_value) {
                if (setting_name == "user_dark_mode") {
                    if (setting_value === "checked") {
                        $('body').addClass('dark-mode');
                        $('.main-header').addClass('navbar-dark');
                        $('.main-header').removeClass('navbar-light');

                        $('.control-sidebar').addClass('control-sidebar-dark');
                        $('.control-sidebar').removeClass('control-sidebar-light');



                    } else {
                        $('body').removeClass('dark-mode');

                        $('.main-header').removeClass('navbar-dark');
                        $('.main-header').addClass('navbar-light');

                        $('.control-sidebar').removeClass('control-sidebar-dark');
                        $('.control-sidebar').addClass('control-sidebar-light');
                    }
                }
                if (setting_name == "user_header_fixed") {
                    if (setting_value === "checked") {
                        $('body').addClass('layout-navbar-fixed');
                    } else {
                        $('body').removeClass('layout-navbar-fixed');
                    }
                }
                if (setting_name == "user_sidebar_collapsed") {
                    if (setting_value === "checked") {
                        $('body').addClass('sidebar-collapse');
                    } else {
                        $('body').removeClass('sidebar-collapse');
                    }
                }
                if (setting_name == "user_sidebar_fixed") {
                    if (setting_value === "checked") {
                        $('body').addClass('sidebar-fixed');
                    } else {
                        $('body').removeClass('sidebar-fixed');
                    }
                }

                if (setting_name == "user_footer_fixed") {
                    if (setting_value === "checked") {
                        $('body').addClass('layout-footer-fixed');
                    } else {
                        $('body').removeClass('layout-footer-fixed');
                    }
                }



            }

            function requestUpdateSetting(switch_id, setting_name, value) {
                $.ajax({
                    url: '<?= base_url('update_user_setting') ?>',
                    type: 'post',
                    data: {
                        setting_name: setting_name,
                        setting_value: value
                    },
                    success: function(response) {
                        var jsonData = JSON.parse(response);

                        applySetting(setting_name, value);
                        toggleCheckedValueCustomSwitch(switch_id);

                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching search results:', error);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            background: '#ffa851',
                            color: '#1e1e1e',
                            timer: '5000',
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'error',
                            title: error
                        })

                        $('#searchResults').html('<i class="text-danger">' + error + '</i>');


                    }
                });
            }


            function newSwitchCheckedValue(selector) {
                if ($(selector).attr('checked') === undefined) {

                    return 'checked';
                } else {

                    return '';
                }
            }

            $("#darkmode-switch").change(function(e) {
                e.preventDefault();
                var setting_value = newSwitchCheckedValue("#darkmode-switch");
                requestUpdateSetting("#darkmode-switch", 'user_dark_mode', setting_value);
            });

            $("#headerfixed-switch").change(function(e) {
                e.preventDefault();
                var setting_value = newSwitchCheckedValue("#headerfixed-switch");
                requestUpdateSetting("#headerfixed-switch", 'user_header_fixed', setting_value);
            });

            $("#sidebarcollapsed-switch").change(function(e) {
                e.preventDefault();
                var setting_value = newSwitchCheckedValue("#sidebarcollapsed-switch");
                requestUpdateSetting("#sidebarcollapsed-switch", 'user_sidebar_collapsed', setting_value);
            });

            $("#sidebarfixed-switch").change(function(e) {
                e.preventDefault();
                var setting_value = newSwitchCheckedValue("#sidebarfixed-switch");
                requestUpdateSetting("#sidebarfixed-switch", 'user_sidebar_fixed', setting_value);
            });

            $("#footerfixed-switch").change(function(e) {
                e.preventDefault();
                var setting_value = newSwitchCheckedValue("#footerfixed-switch");
                requestUpdateSetting("#footerfixed-switch", 'user_footer_fixed', setting_value);
            });
        });
    </script>
    <script>
        function toggleFullHeight(element) {
            if ($(element).hasClass('full-height')) {
                $(element).removeClass('full-height');
            } else {
                $(element).addClass('full-height');
            }
        }

        function onDoubleClick(e) {
            e.preventDefault();
            toggleFullHeight(e.currentTarget);
        }
    </script>

    <script>
        // load latest messages
        var notificationIds = []
        var totalNotification = 0;

        function loadAllUserUnreadNotification() {
            var url = "<?= base_url('/get_all_unread_notification'); ?>";

            $.ajax({
                type: "post",
                url: url,
                data: '',
                success: function(response) {
                    var data = JSON.parse(response);


                    $.each(data.unread_notifications, function(indexInArray, valueOfElement) {
                        var notification_id = valueOfElement.notification_id;
                        var msg = valueOfElement.notification_message;
                        var type = valueOfElement.notification_type;
                        var trackingCode = valueOfElement.notification_link_data;
                        if (!notificationIds.includes(notification_id)) {
                            notificationIds.push(notification_id);
                            if (type == "alert") {
                                totalNotification++;
                                var newAlert = ` <div  data-toggle="modal" data-target="#my-modal" onclick="onclick_details(event)" class="dropdown-item  text-wrap bg-warning" data-notification_id="` + valueOfElement.notification_id + `" data-doc_code="` + valueOfElement.notification_link_data + `">
                                                <i class="fas fa-bullhorn mr-2"></i> ` + String(msg).substring(0, 100) + `
                                                <span class="float-right text-muted text-sm">3 mins</span>
                                            </div>`;
                                $('#dropdown-items-container').append(newAlert);
                                var link = "<?= base_url(); ?>timeline_view/" + trackingCode + "/" + notification_id;
                                functionShowNotificationToApp("New document to workout", msg, link);

                            }
                        }



                    });
                    $("#total-notification").addClass('d-none');
                    if (totalNotification >= 100) {
                        $("#total-notification").text('99+');
                        $("#total-notification").removeClass('d-none');

                    } else if (totalNotification == 0) {
                        $("#total-notification").text(totalNotification);
                        $("#total-notification").addClass('d-none');

                    } else {
                        $("#total-notification").text(totalNotification);
                        $("#total-notification").removeClass('d-none');

                    }



                    $("#dropdown-header").text(totalNotification + " Notifications");


                },
                error: function(xhr, status, error) {

                    if ($("#chat-loader") !== undefined) {
                        $("#chat-loader").remove();
                    }
                    $("#send-loader").remove();
                    $('#msg-input').val('');

                }
            });


        }

        function functionShowNotificationToApp(header, message, link) {
            console.log("showNotification::" + header + "::" + removeHtmlTags(message) + "::" + link); //trigger notification to mobile app
        }
        $(document).ready(function() {
            loadAllUserUnreadNotification();
        });

        $(document).ready(function() {
            $('.datemask').inputmask('yyyy-mm-dd');
        });

        function applyInputMask(e) {
            inputMask(e.currentTarget);
        }

        function onclick_details(e) {

            var doc_code = e.currentTarget.dataset.doc_code;
            var url = "<?= base_url('document_details'); ?>"
            var notification_id = e.currentTarget.dataset.notification_id;
            $('#modal-body').html('');
            var spinner = new Spinner('modal-body', 'loading...');
            setTimeout(function() {
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        code: doc_code,
                        _active_group_id: 0
                    },
                    success: function(response) {
                        var res_html = `<div class="small smaller-font">` + response + `<div>`;
                        $('#modal-body').html(res_html);
                        markedReadNotification(notification_id);

                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error',
                            error,
                            'error'
                        )

                    }
                });
            }, 2000);
        }

        function markedReadNotification(notification_id) {
            $.ajax({
                type: "post",
                url: "<?= base_url(); ?>/mark_read_notification",
                data: {
                    notification_id: notification_id
                },
                dataType: "dataType",
                success: function(response) {

                }
            });

        }

        function removeHtmlTags(str) {
            // Remove HTML tags
            let cleanStr = str.replace(/<[^>]*>?/gm, '');

            // Remove &nbsp; entities
            cleanStr = cleanStr.replace(/&nbsp;/g, ' ');

            // Remove newline characters
            cleanStr = cleanStr.replace(/\n/g, '');

            // Remove extra spaces (optional)
            cleanStr = cleanStr.replace(/\s+/g, ' ').trim();

            return cleanStr;
        }

        function goBackOrDefault() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '<?= base_url() ?>';
            }
        }

        function toggleFormViewExpansion(e, containerId) {
            var elementToExpand = document.getElementById(containerId);
            if (elementToExpand.classList.contains('fix-full')) {
                elementToExpand.classList.remove('fix-full');
            } else {
                elementToExpand.classList.add('fix-full');

            }
        }
    </script>


</body>
<style>
    * {
        transition: ease;
    }

    .fix-full {
        height: 100% !important;
        min-width: 100% !important;
        position: fixed;
        min-width: 100% !important;
        min-height: 100% !important;
        top: 0;
        left: 0;
        z-index: 10000;

    }

    .rounded-pill {
        border-radius: 5px;
    }

    .full-height {
        height: 100% !important;
        position: fixed;
        top: 0;
        right: 0;
        z-index: 1040;
        width: 800px;
        margin: 0;
    }


    /* global styling */
    @media only screen and (max-width: 768px) {

        .container-fluid,
        .container,
        .content {
            padding-left: 0 !important;
            padding-right: 0 !important;

            margin-left: 0 !important;
            margin-right: 0 !important;


        }

        .content-header,
        #app-footer {
            display: none !important;
        }

        .mobile-absolute-full {
            --header-height: 56px;
            height: calc(100vh - var(--header-height)) !important;
            min-height: calc(100vh - var(--header-height)) !important;
            /* position: fixed; */
            min-width: 100% !important;
            /* top:var(--header-height); */
            left: 0;
            padding-top: 0 !important;
            overflow-y: auto;
            z-index: 0 !important;
        }

        .mobile-fixed-full {
            height: 100vh !important;
            position: fixed;
            /* min-width: 100vh !important; */
            width: 100% !important;

            /* left: 0; */
            top: 0;
            padding-top: 0 !important;
            overflow-y: auto;
            /* overflow-x: auto; */
            z-index: 1041;
        }

        .mobile-fixed-full .form-group-input {

            min-width: 100% !important;
            width: 400px;

        }

        .mobile-sticky-header {
            position: sticky;
            top: 0;
            z-index: 1051 !important;
            background-color: inherit;

        }


    }
</style>

</html>