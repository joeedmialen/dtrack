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
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css'); ?>">
    <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> -->
    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js'); ?>"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed dark-mode hold-transition login-page">
    <style>
        /* login form input has a class 'login-input' */
        .login-input:-webkit-autofill,
        .login-input:-webkit-autofill:hover,
        .login-input:-webkit-autofill:focus,
        .login-input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            /* Adjust the shadow color to match  background */
            box-shadow: 0 0 0 30px white inset !important;
            /* Adjust the shadow color to match  background */
            -webkit-text-fill-color: #333 !important;
            /* Adjust the text color */
            color: #333 !important;
            /* Adjust the text color */
        }
    </style>

    <div class="d-flex justify-content-center" style="position:fixed;top:0;left:0;width:100%;height:100%;margin:auto;z-index:2000;backdrop-filter:blur(500px)">
        <div class="login-box " style="position:fixed;top:100px;">
            <div>
                <div class="login-logo">
                    <a href="/"><b>DTrack</b><br> </a>
                    <span class="text-sm">An Online Document Tracking System</span>

                </div>
                <!-- /.login-logo -->
                <div class="card border-0">
                    <div class="card-body border-0">
                        <p class="login-box-msg">Sign in to start your session</p>
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <div><?= $error; ?>. Please, try again.</div>
                            </div>

                            <script>
                                $(function() {
                                    Swal.fire(
                                        'Authentication Failed',
                                        '<?= $error; ?>',
                                        'error'
                                    )
                                });
                            </script>
                        <?php endif; ?>
                        <?= form_open('/auth/login') ?>
                        <div class="input-group mb-3">
                            <input type="email" name="username" class="form-control login-input" placeholder="Email" value="<?= set_value('username') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control  login-input" placeholder="Password" value="<?= set_value('password') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-12 mt-5 mb-5">
                                <button type="submit" value="Login" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <?= form_close() ?>


                        <div class="social-auth-links text-center mb-3 d-none">
                            <p>- OR -</p>
                            <a href="#" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                            </a>
                            <a href="#" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                            </a>
                        </div>
                        <!-- /.social-auth-links -->

                        <p class="mb-1">
                            <a href="forgot_password">I forgot my password</a>
                        </p>
                        <p class="mb-0">
                            <a href="signup" class="text-center">Register a new membership</a>
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
        <!-- /.login-box -->
    </div>

    <!-- REQUIRED SCRIPTS -->


    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
</body>

</html>