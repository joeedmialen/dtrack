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

    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>DTrack</b><br> </a>
            <span class="text-sm">An Online Document Tracking System</span>

        </div>
        <!-- /.login-logo -->
        <div class="card-body register-card-body">
            <p class="login-box-msg">Recover Account</p>

            <form id="register-form" method="post" novalidate="novalidate">
                <div class="input-group mb-3 form-group">
                    <input id="input-email" name="email" type="email" class="form-control login-input" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 form-group">
                    <input id="password" name="password" type="password" class="form-control login-input" placeholder="New password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3 form-group">
                    <input name="repeatpassword" type="password" class="form-control login-input" placeholder="Retype new password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
    </div>
    <!-- /.login-box -->


    <!-- REQUIRED SCRIPTS -->


    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

    <script src="<?= base_url('plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/jquery-validation/additional-methods.min.js'); ?>"></script>

    <!-- <script>
        $(document).ready(function() {
            $('form button').click(function(e) {
                e.preventDefault();
                var formData = new FormData();
                formData.append();



            });
        });
    </script> -->
    <script>
        $(function() {
            // validation script
            $.validator.setDefaults({
                submitHandler: function() {
                    var formData = new FormData($('#register-form')[0]);
                    var url = "<?= base_url('forgot_password_submit'); ?>";
                    var input_email = $('#input-email').val();

                    $.ajax({
                        type: "post",
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var data = JSON.parse(response);
                            if (data.is_error !== true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Successfully recovered. Please login to start your session..',
                                    footer: ''
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "<?= base_url('login'); ?>";
                                    }
                                });
                            } else {
                                if (!data.is_email_exist) {
                                    // if email do not exists
                                    Swal.fire(
                                        'Email does not exist!',
                                        data.error_msg,
                                        'error'
                                    )
                                } else if (!data.email_verified) {
                                    Swal.fire({
                                        title: 'Unverified Email!',
                                        text: data.error_msg + ' We need to verify your email with a verification code.',
                                        icon: 'info',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Send me a verification code.',
                                        cancelButtonText: 'I have verification code already.',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'post',
                                                url: "<?= base_url('send_email_verification_code'); ?>",
                                                data: {
                                                    email: $('input[name=email]').val()
                                                },
                                                success: function(send_email_response) {
                                                    var data_verify_email = JSON.parse(send_email_response);
                                                    if (data_verify_email.is_success) {
                                                        async function input_verification_code() {
                                                            const {
                                                                value: inputverificationcode
                                                            } = await Swal.fire({
                                                                title: 'Verification Code',
                                                                input: 'text',
                                                                inputLabel: 'Enter email verification code.',
                                                                inputPlaceholder: 'Verification code',
                                                                confirmButtonText: 'Confirm',
                                                            });

                                                            if (inputverificationcode) {
                                                                // Verify in the server if the verification code is correct
                                                                $.ajax({
                                                                    type: "post",
                                                                    url: "<?= base_url('verify_verification_code'); ?>",
                                                                    data: {
                                                                        input_verification_code: inputverificationcode,
                                                                        input_email: input_email

                                                                    },
                                                                    success: function(response) {
                                                                        var res_data = JSON.parse(response);
                                                                        if (!res_data.is_error) {
                                                                            Swal.fire(
                                                                                'Verified!',
                                                                                'You have successfully verified your email. Please click "submit" button to continue recover your account.',
                                                                                'success'
                                                                            );
                                                                        } else {
                                                                            Swal.fire(
                                                                                'Incorrect!',
                                                                                'Your veryfication code is incorrect.',
                                                                                'error'
                                                                            );
                                                                        }

                                                                    },
                                                                    error: function(xhr, status, error) {
                                                                        Swal.fire(
                                                                            'Oops!',
                                                                            'Something went wrong!',
                                                                            'error'
                                                                        );
                                                                    }
                                                                });
                                                            }
                                                        }
                                                        input_verification_code();
                                                    } else if (!data_verify_email.is_success) {
                                                        Swal.fire(
                                                            'Failed',
                                                            'Sending verification code to your email has failed!',
                                                            'error'
                                                        );
                                                    } else {
                                                        Swal.fire(
                                                            'Error',
                                                            'Something went wrong',
                                                            'error'
                                                        );
                                                    }
                                                }
                                            });
                                        } else {

                                            async function input_verification_code() {
                                                const {
                                                    value: inputverificationcode
                                                } = await Swal.fire({
                                                    title: 'Verification Code',
                                                    input: 'text',
                                                    inputLabel: 'Enter email verification code.',
                                                    inputPlaceholder: 'Verification code',
                                                    confirmButtonText: 'Confirm',
                                                });

                                                if (inputverificationcode) {
                                                    // Verify in the server if the verification code is correct
                                                    $.ajax({
                                                        type: "post",
                                                        url: "<?= base_url('verify_verification_code'); ?>",
                                                        data: {
                                                            input_verification_code: inputverificationcode,
                                                            input_email: input_email

                                                        },
                                                        success: function(response) {
                                                            var res_data = JSON.parse(response);
                                                            if (!res_data.is_error) {
                                                                Swal.fire(
                                                                    'Verified!',
                                                                    res_data.error_msg,
                                                                    'success'
                                                                );
                                                            } else {
                                                                Swal.fire(
                                                                    'Incorrect!',
                                                                    res_data.error_msg,
                                                                    'error'
                                                                );
                                                            }

                                                        },
                                                        error: function(xhr, status, error) {
                                                            Swal.fire(
                                                                'Oops!',
                                                                'Something went wrong!',
                                                                'error'
                                                            );
                                                        }
                                                    });
                                                }
                                            }
                                            input_verification_code();



                                        }
                                    });
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error',
                                error,
                                'error'
                            );
                        }
                    });
                }
            });

            $('#register-form').validate({
                rules: {
                    firstname: {
                        required: true,
                    },
                    lastname: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    repeatpassword: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    firstname: {
                        required: "Please enter a firstname",
                    },
                    lastname: {
                        required: "Please enter a lastname",
                    },
                    email: {
                        required: "Please enter an email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    repeatpassword: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Passwords do not match"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

</body>

</html>