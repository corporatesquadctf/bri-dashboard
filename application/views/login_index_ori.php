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
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
        <script src="<?= base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
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
        /* @import url(https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700);
      
         body, html {
           height: 100%;
         }*/
        html, body {
            height: 100%;
        }
        html{
            display: table;
            margin: auto;
        }
        body {
            /*font-family: 'Open Sans';*/
            background: #222D3A; 
            color: #000;   
            font-weight: 100;
            display: flex;
            overflow: hidden;
            height: 110%;
        }
        a{
            color: #353638;
        }
        input{
            color: #444;
        }
        .title{
            color: #fff;
            margin-top: 20px;
        }

        .login-form {
            background: #ecf0f1;
            box-shadow: 0 0 1rem rgba(0,0,0,0.3);
            /*background: #333;*/
            min-height: 10rem;
            margin: auto;
            margin-top: 35%;
            width: 350px;
            padding: .8rem;
        }
        .main-login{
            width: 250px;
            margin: 0 auto;
            color: #444;
        }
        .login-text {
            color: black;
            font-size: 1.5rem;
            margin: 0 auto;
            max-width: 50%;
            padding: .5rem;
            text-align: center;
            .fa-stack-1x {
                color: black;
            }
        }

        .login-username, .login-password {
            background: transparent;
            border: 0 solid;
            border-bottom: 1px solid rgba(white, .5);
            color: #444;
            display: block;
            margin: 1rem;
            padding: .5rem;
            transition: 250ms background ease-in;
            width: calc(100% - 3rem);
            &:focus {
                background: white;
                color: black;
                transition: 250ms background ease-in;
            }
        }

        .login-forgot-pass {
            bottom: 0;
            color: white;
            cursor: pointer;
            display: block;
            font-size: 75%;
            left: 0;
            opacity: 0.6;
            padding: .5rem;
            position: absolute;
            text-align: center;
            width: 100%;
            &:hover {
                opacity: 1;
            }
        }
        .login-submit {
            border: 1px solid white;
            background: transparent;
            color: white;
            display: block;
            margin: 1rem auto;
            min-width: 1px;
            padding: .25rem;
            transition: 250ms background ease-in;
            &:hover, &:focus {
                background: white;
                color: black;
                transition: 250ms background ease-in;
            }
        }

        [class*=underlay] {
            left: 0;
            min-height: 100%;
            min-width: 100%;
            position: fixed;
            top: 0;
        }
        .underlay-photo {
            animation: hue-rotate 6s infinite;
            background: url('<?= base_url(); ?>assets/images/gb.jpeg');
            background-size: cover;
            -webkit-filter: grayscale(30%);
            z-index: -1;
        }
        .underlay-black {
            background: rgba(0,0,0,0.7);
            z-index: -1;
        }
        .icon0{
            position: absolute;
            margin-top: -50px;
            text-align: center;
            z-index: 99;
        }

        .footer{
            position: absolute;
            bottom: 0;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
            color: #fff;
        }
        @keyframes hue-rotate {
            from {
                -webkit-filter: grayscale(30%) hue-rotate(0deg);
            }
            to {
                -webkit-filter: grayscale(30%) hue-rotate(360deg);
            }
        }
        .alerts{
            position: absolute; width: 350px; display: table-cell; vertical-align: middle; margin-top: 10px;
        }
    </style>


    <body class="s">
    <center>

        <div class="alerts">
            <?php if (validation_errors() || $this->session->flashdata('result_login')) { ?>
                <div class="alert alert-error">
                    <span class="close pull-right" data-dismiss="alert">&times;</span>
                    <strong>Warning!</strong>
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('result_login'); ?>

                </div>
            <?php } ?>
        </div>
    </center>

    <div style="margin: 0 auto">
        <form class="login-form" method="POST" action="<?php echo site_url('logins/process'); ?>">


            <div class="main-login">
                <p class="login-text">
                <div style="margin-top: -50px;">
                    <center> 
                        <img class="img-circle" width="75px" src="<?= base_url(); ?>assets/images/user_profile/default.png">
                    </center>
                </div>

                <div class="title" align="center">
                    <img width="100px" src="<?= base_url(); ?>assets/images/logo.png">
                </div>
                <div class="divider"></div>


                </p>
                <input type="text" id="personalnumber"  class="login-username form-control max_pn" name="personalnumber" value="" placeholder="Personal Number" required autofocus />
                <!--<input type="password" id="password" class="login-password form-control" name="password" placeholder="Password" required data-eye/>-->
                <input type="password" id="password" class="login-password form-control" name="password" placeholder="Password"  data-eye/>
                <!--<div style="padding: 10px;">
                    <center>
                        <div id="captImg" style="margin-right: 10px; margin-bottom: 10px;"> 
                            <?php echo $captchaImg; ?> 
                        </div>
                        <p style="font-size: 10px;">
                            Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.
                        </p>
                        <input class="form-control" type="text" name="captcha" value="" placeholder="Captcha" required/>
                    </center>
                </div>-->
                <div class="form-group no-margin" align="center" style="margin-top: 0px">
                    <button class="btn btn-warning btn-md submit" type="submit">
                        <i class="fa fa-lock"></i>&nbsp; <b>Log in</b>
                    </button>
                </div>
                <div style="font-size: 10px;">
                    <center>
                        <a href="https://bristars.bri.co.id/bristars/user/reset_password">Forgot Password ?</a>
                    </center>
                </div>
            </div>
        </form>
        <div class="footer pull-right">
            <center>
                © Copyright © 2018 Bank Rakyat Indonesia (Persero) Tbk.
            </center>
        </div>
    </div>


<!-- <form class="login-form" method="POST" action="<?php echo site_url('logins/process'); ?>">
    <p class="login-text">
    <div class="title" align="center">
        <b>Login With Bristar Account</b>
    </div>
    <?php if (validation_errors() || $this->session->flashdata('result_login')) { ?>
                    <div class="alert alert-error">
                        <strong>Warning!</strong>
        <?php echo validation_errors(); ?>
        <?php echo $this->session->flashdata('result_login'); ?>
                    </div>
    <?php } ?>

    </p>
    <input type="text" id="personalnumber"  class="login-username form-control max_pn" name="personalnumber" value="" placeholder="Personal Number" required autofocus />
    <input type="password" id="password" class="login-password form-control" name="password" placeholder="Password" required data-eye/>
    <div style="padding: 10px;">
        <center>
           <div id="captImg" style="margin-right: 10px; margin-bottom: 10px;"> <?php echo $captchaImg; ?> </div>
           <p>Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</p>
            <input class="form-control" type="text" name="captcha" value="" placeholder="Captcha" required/>
        </center>
    </div>
    <div class="form-group no-margin" align="center" style="margin-top: 20px">
        <button class="btn btn-primary btn-md submit" type="submit">
            <i class="fa fa-lock"></i>&nbsp; <b>Log in</b>
        </button>
    </div>
</form> -->
    <!-- <div class="underlay-photo"></div> -->
    <!-- <div class="underlay-black"></div>  -->

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
        $(document).ready(function () {
            $('.refreshCaptcha').on('click', function () {
                $.get('<?php echo base_url() . 'logins/refreshCaptcha'; ?>', function (data) {
                    $('#captImg').html(data);
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#success-alert").hide();
            $("#myWish").click(function showAlert() {
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
                    $("#success-alert").slideUp(500);
                });
            });
        });
    </script>
</body>
</html>
