<?php
use system\Session;
use libraries\Redirect;


$secondSeg = Redirect::getUrlSegment(2);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?=$this->title?></title>
  <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <?php if(!empty($this->css)):?>
	  <?php foreach($this->css as $css):?>
		<link rel="stylesheet" type="text/css" href="<?=$css?>">
	  <?php endforeach;?>
    <?php endif;?>
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/theme.css">
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/admin-forms.css">
  <link rel="shortcut icon" href="<?php echo URL; ?>public/img/favicon.ico">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

</head>

<body class="tables-basic-page" data-spy="scroll" data-target="#nav-spy" data-offset="300">
  <div id="main">
    <header class="navbar navbar-fixed-top">
      <div class="navbar-branding">
        <a class="navbar-brand" href="dashboard.html">
          <b>Mintos Task</b>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
		<a href="javascript:void(0);" onclick="openLogout(this)" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> 
		  <?= Session::get('userInfo')['fname'].' '.Session::get('userInfo')['lname']?>
            <span class="caret caret-tp hidden-xs"></span>
          </a>
          <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
            <li class="list-group-item">
		    <a href="<?=URL?>login/logout" id="logoutDropDown"  class="dropdown-toggle fw600 p15">
                <span class="fa fa-power-off"></span> Logout </a>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <aside id="sidebar_left" class="nano nano-primary affix">
      <div class="sidebar-left-content nano-content">
        <ul class="nav sidebar-menu">
		<li <?php if($secondSeg == ''):?>class="active"<?php endif;?>>
		  <a href="<?=URL?>home">
              <span class="fa fa-calendar"></span>
              <span class="sidebar-title">Words</span>
            </a>
          </li>
          <li <?php if($secondSeg == 'feedInfo'):?>class="active"<?php endif;?>>
		  <a href="<?=URL?>home/feedInfo">
              <span class="fa fa-calendar"></span>
              <span class="sidebar-title">Feed Info</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>
    <section id="content_wrapper">
      