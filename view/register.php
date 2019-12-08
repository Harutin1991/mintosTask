<?php

use libraries\Form;
use system\Session;

$form = new Form();
?>
<!DOCTYPE html>
<html>
    <head>
	  <meta charset="utf-8">
	  <title>Register</title>
	  <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
	  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/theme.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/admin-forms.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/styles.css">
	  <link rel="shortcut icon" href="<?php echo URL; ?>public/img/favicon.ico">
	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!--[if lt IE 9]>
	   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	   <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	   <![endif]-->
    </head>

    <body class="external-page sb-l-c sb-r-c">
	  <!-- Start: Main -->
	  <div id="main" class="animated fadeIn">
		<!-- Start: Content-Wrapper -->
		<section id="content_wrapper">
		    <!-- begin canvas animation bg -->
		    <div id="canvas-wrapper">
			  <canvas id="demo-canvas"></canvas>
		    </div>
		    <!-- Begin: Content -->
		    <section id="content">
			  <div class="admin-form theme-info" id="login1">
				<div class="row mb15 table-layout">
				    <div class="col-xs-12 text-right va-b pr5">
					  <div class="login-links">
						<a href="<?php echo URL; ?>login" title="Sign In">Sign In</a>
						<span class="text-white"> | </span>
						<a href="<?php echo URL; ?>login/register" class="active" title="Register">Register</a>
					  </div>
				    </div>
				</div>
				<div class="panel panel-info mt10 br-n">
				    <!-- end .form-header section -->
				    <?= $form->open(['method' => 'post', 'action' => URL . 'login/register', 'id' => 'register']) ?>
				    <input type="hidden" value="<?= URL ?>" id="urlInfo">
				    <div class="panel-body p25 bg-light">
					  <div class="section-divider mt10 mb40">
						<span>Set up your account</span>
					  </div>
					  <!-- .section-divider -->

					  <div class="section row">
						<div class="col-md-6">
						    <label for="firstname" class="field prepend-icon">
							  <input type="text" name="fname" id="firstname" class="gui-input" placeholder="First name...">
							  <label for="firstname" class="field-icon">
								<i class="fa fa-user"></i>
							  </label>
							  <div id="fnameError" class="error <?php if (!Session::get('fname')): ?>hidden<?php endif; ?>">
								<?php if (Session::get('fname')): ?>
								    <?= Session::get('fname') ?>
								<?php Session::remove('fname'); endif; ?>
							  </div>
						    </label>
						</div>
						<!-- end section -->

						<div class="col-md-6">
						    <label for="lastname" class="field prepend-icon">
							  <input type="text" name="lname" id="lastname" class="gui-input" placeholder="Last name...">
							  <label for="lastname" class="field-icon">
								<i class="fa fa-user"></i>
							  </label>
							  <div id="lnameError" class="error <?php if (!Session::get('lname')): ?>hidden<?php endif; ?>">
								<?php if (Session::get('lname')): ?>
								    <?= Session::get('lname') ?>
								<?php Session::remove('lname'); endif; ?>
							  </div>
						    </label>
						</div>
						<!-- end section -->
					  </div>
					  <!-- end .section row section -->

					  <div class="section">
						<label for="email" class="field prepend-icon">
						    <input type="email" name="email" id="email" class="gui-input" placeholder="Email address">
						    <label for="email" class="field-icon">
							  <i class="fa fa-envelope"></i>
						    </label>
						    <div id="emailError" class="error <?php if (!Session::get('email')): ?>hidden<?php endif; ?>">
							  <?php if (Session::get('email')): ?>
								<?= Session::get('email') ?>
							  <?php Session::remove('email'); endif; ?>
						    </div>
						</label>
					  </div>
					  <!-- end section -->

					  <div class="section">
						<label for="password" class="field prepend-icon">
						    <input type="password" name="password" id="password" class="gui-input" placeholder="Create a password">
						    <label for="password" class="field-icon">
							  <i class="fa fa-unlock-alt"></i>
						    </label>
						    <div id="passwordError" class="error <?php if (!Session::get('password')): ?>hidden<?php endif; ?>">
							  <?php if (Session::get('password')): ?>
								<?= Session::get('password') ?>
							  <?php Session::remove('password'); endif; ?>
						    </div>
						</label>
					  </div>
					  <!-- end section -->

					  <div class="section">
						<label for="confirmPassword" class="field prepend-icon">
						    <input type="password" name="confirmPassword" id="confirmPassword" class="gui-input" placeholder="Retype your password">
						    <label for="confirmPassword" class="field-icon">
							  <i class="fa fa-lock"></i>
						    </label>
						    <div id="confirmPasswordError" class="error <?php if (!Session::get('confirmPassword')): ?>hidden<?php endif; ?>">
							  <?php if (Session::get('confirmPassword')): ?>
								<?= Session::get('confirmPassword') ?>
							  <?php Session::remove('confirmPassword'); endif; ?>
						    </div>
						</label>
					  </div>
					  <!-- end section -->
				    </div>
				    <!-- end .form-body section -->
				    <div class="panel-footer clearfix">
					  <button type="submit" id="submitForm" class="button btn-primary pull-right">Create Account</button>
				    </div>
				    <!-- end .form-footer section -->
				    <?= $form->Close(); ?>
				</div>
			  </div>
		    </section>
		    <!-- End: Content -->
		</section>
		<!-- End: Content-Wrapper -->
	  </div>
	  <!-- End: Main -->

	  <!-- BEGIN: PAGE SCRIPTS -->

	  <!-- jQuery -->
	  <script src="<?php echo URL; ?>public/vendor/jquery/jquery-1.11.1.min.js"></script>
	  <script src="<?php echo URL; ?>public/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>

	  <!-- CanvasBG Plugin(creates mousehover effect) -->
	  <script src="<?php echo URL; ?>public/vendor/plugins/canvasbg/canvasbg.js"></script>
	  <script src="<?php echo URL; ?>public/js/custom.js"></script>

	  <!-- Page Javascript -->
	  <script type="text/javascript">
		jQuery(document).ready(function () {
		    "use strict";
		    // Init CanvasBG and pass target starting location
		    CanvasBG.init({
			  Loc: {
				x: window.innerWidth / 2,
				y: window.innerHeight / 3.3
			  },
		    });

		});
	  </script>

	  <!-- END: PAGE SCRIPTS -->

    </body>

</html>