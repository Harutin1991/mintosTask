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
		    <!-- Begin: Content -->
		    <section id="content" class="pn animated fadeIn">
			  <div class="center-block mt50 mw800">
				<h1 class="error-title"> 404! </h1>
				<h2 class="error-subtitle">Page Not Found.</h2>
			  </div>
			  <div class="mid-section">
				<div class="mid-content clearfix">
				    <input type="text" class="form-control" placeholder="Ask me a question!" value="Let Me Help You Search!">
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


    </body>

</html>
