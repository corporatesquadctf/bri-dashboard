<?php error_reporting(E_ALL); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Segment Dashboard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/favicon.ico'); ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts/iconic/css/material-design-iconic-font.min.css'); ?>">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/util.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>">
<!--===============================================================================================-->
	<script src="<?= base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <link href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url('assets/animate.css/animate.min.css'); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/custom/css/custom.css'); ?>" rel="stylesheet">
</head>
	<style type="text/css">
		
        .alerts{
            position: absolute; width: 400px; top: 5px; display: table-cell; vertical-align: top; margin-top: 10px;
        }

    </style>
<body>
	<div class="limiter">
			
		<div class="container-login100" style="background-image: url('<?= base_url(); ?>assets/images/building01.jpg');">
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

			<div class="wrap-login100">
				<form autocomplete="off" class="login100-form validate-form" method="POST" action="<?php echo site_url('logins/process'); ?>">
					<span class="login100-form-logo">
						<img src="<?= base_url(); ?>assets/images/bri_logo.png" width="60px" height="auto" />
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter personal number">
						<input class="input100" type="text" name="personalnumber" placeholder="Personal Number">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div style="padding: 10px;">
	                    <center>
	                        <div id="captImg" style="margin-right: 10px; margin-bottom: 10px;"> 
	                            <?php echo $captchaImg; ?> 
	                        </div>
	                        <p style="font-size: 10px;color: white">
	                            Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha" style="color:orange">here</a> to refresh.
	                        </p>
	                        <input class="form-control" type="text" name="captcha" value="" placeholder="Captcha" required/>
	                    </center>
	                </div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					
				</form>
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