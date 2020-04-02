<?php error_reporting(E_ALL); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BRI Dashboard Segment Korporasi</title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url('assets/nprogress/nprogress.css'); ?>" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?php echo base_url('assets/animate.css/animate.min.css'); ?>" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url('assets/custom/css/custom.css'); ?>" rel="stylesheet">
    </head>
    <style type="text/css">
        .login{
            background: #173650;
        }
        .login_form{
            background: #f9f9f9;
            padding: 20px;
        }
    </style>

    <body class="login">
        <div>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form method="POST" action="<?php echo site_url('logins/process'); ?>">
                            <!-- <h1>Login </h1> -->
                            <?php if (validation_errors() || $this->session->flashdata('result_login')) { ?>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Warning!</strong>
                                    <?php echo validation_errors(); ?>
                                    <?php echo $this->session->flashdata('result_login'); ?>
                                </div>
                            <?php } ?>
                            <div>
                                <input id="personalnumber" type="text" class="form-control max_pn" name="personalnumber" value="" placeholder="Personal Number" required autofocus>
                            </div>
                            <div>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required data-eye>
                            </div>
                            <div class="form-group no-margin">
                                <button class="btn btn-success btn-sm submit form-control" type="submit">
                                    <i class="fa fa-lock"></i>&nbsp; <b>Log in</b>
                                </button>
                                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <!-- <div class="x_content bs-example-popovers">
                                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                                        Untuk dapat menggunakan aplikasi ini, Silahkan Login dengan menggunakan akun dan password BRISTAR Anda.
                                    </div>
                                </div>
                                </p>
           
                                <div class="clearfix"></div>
                                <br /> -->

                                <div>
                                    <p>&copy; Copyright © 2018 <b>Bank Rakyat Indonesia</b> (Persero) Tbk.</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <form>
                            <h1>Create Account</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <a class="btn btn-default submit" href="index.html">Submit</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Already a member ?
                                    <a href="#signin" class="to_register"> Log in </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <p>&copy; Copyright © 2018 <b>Bank Rakyat Indonesia</b> (Persero) Tbk.</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <!-- JQuery -->
        <script type="text/javascript" src="<?php echo base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>
        <script>
            $('.max_pn').on('keydown', function (e) {
                let a = $(this).val();
                if (a.length >= 8) {
                    if (e.keyCode >= 48 && e.keyCode <= 57) {
                        e.preventDefault();
                    }
                }
            })
        </script>
    </body>
</html>
