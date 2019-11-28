<?php 
use libraries\Form;

$form = new Form();
?>
<!DOCTYPE html>
<html>

    <head>
	  <meta charset="utf-8">
	  <title>Login</title>
	  <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
	  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/theme.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/admin-forms.css">
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
						<a href="<?php echo URL; ?>/login" class="active" title="Sign In">Sign In</a>
						<span class="text-white"> | </span>
						<a href="<?php echo URL; ?>/login/register" class="" title="Register">Register</a>
					  </div>
				    </div>
				</div>
				<div class="panel panel-info mt10 br-n">
				    <!-- end .form-header section -->
				    <?=$form->open(['method'=>'post','action'=>URL.'login/validate','id'=>'login'])?>
					  <div class="panel-body bg-light p30">
						<div class="row">
						    <div class="col-sm-12 pr30">
							  <div class="section">
								<label for="email" class="field-label text-muted fs18 mb10">Email</label>
								<label for="email" class="field prepend-icon">
								    <?=$form->Input(['type'=>'text','name'=>'email','id'=>'email','class'=>'gui-input','placeholder'=>'Enter email'])?>
								    <label for="username" class="field-icon">
									  <i class="fa fa-user"></i>
								    </label>
								</label>
							  </div>
							  <!-- end section -->

							  <div class="section">
								<label for="password" class="field-label text-muted fs18 mb10">Password</label>
								<label for="password" class="field prepend-icon">
								    <?=$form->Password(['name'=>'password','id'=>'password','class'=>'gui-input','placeholder'=>'Enter password'])?>
								    <label for="password" class="field-icon">
									  <i class="fa fa-lock"></i>
								    </label>
								</label>
							  </div>
							  <!-- end section -->
						    </div>
						</div>
					  </div>
					  <!-- end .form-body section -->
					  <div class="panel-footer clearfix p10 ph15">
						<button type="submit" class="button btn-primary mr10 pull-right">Sign In</button>
					  </div>
					  <!-- end .form-footer section -->
				    <?=$form->Close();?>
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
