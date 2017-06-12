<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
<TITLE>Neo Reward System</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--Bootstrap CSS definition-->
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.bootcss.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Montserrat"
	rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato"
	rel="stylesheet" type="text/css">

<!-- main page style CSS definition -->
<link rel="stylesheet" href="/neo1/Public/Home/css/mainpage.css"
	type="text/css">
<!-- Script files definition -->
<script type="text/javascript"
	src="/neo1/Public/Home/js/form_utilities.js"></script>

</head>


<body id="userMainPage" data-spy="scroll" data-target=".navbar"
	data-offset="60">
	<!--Top Navigation part define-->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo U('Index/index');?>"> <img
					src="/neo1/Public/Home/images/ic_title_1.png" alt="Company Logo"
					width="200" height="50"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://www.google.com">Find Locations</a></li>
					<li><a href="<?php echo U('Business/business_main');?>">For
							Businesses</a></li>
					<li class="btn-group">
						<button role="button" class="navi-btn-default dropdown-toggle"
							data-toggle="dropdown"><?php echo ($storeInfo['user_name']); ?> 
            <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li class="navi-drop-down-btn"><a
								href="<?php echo U('User/user_profile');?>">Edit Profile</a></li>
							<li class="navi-drop-down-btn"><a
								href="<?php echo U('User/signOutProc');?>">Sign out</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- User points information part define-->
	<div class="container-fluid" style="margin-top: 100px;">




 <?php $__FOR_START_2511__=1;$__FOR_END_2511__=$storeInfo['storeCount'];for($i=$__FOR_START_2511__;$i < $__FOR_END_2511__;$i+=1){ ?><div
			class="row ">
			<div class="col-sm-offset-1 col-sm-10">
				<p style="font-size: 45px; color: #888888">My Memberships</p>
				<hr
					style="border-color: -moz-use-text-color #888888; border-style: solid none; border-width: 3px 0;" />
				<div class="col-sm-3">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading">
							<p class="text-center" style="font-size: 20px">Kenny's Restaurant
								& Dairy Bar</p>
						</div>
						<div class="panel-body" style="padding: 20px; height: 250px">
							<img src="/neo1/Public/Home/images/sf_300.jpg"
								alt="Merchant Logo" class="img-rounded img-responsive">
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 20px">Store Info</p>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading">
							<p class="text-center" style="font-size: 25px">I have <?php echo ($storeInfo['points']); ?> bonus points!</p>
						</div>
						<div class="panel-body" style="height: 250px">
							<div id="total" class="img-circle">
								<div class="text-center money-txt">
									<p> <?php echo ($storeInfo['points']); ?> </p>
								</div>
							</div>
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 20px">My Gift Bags</p>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading">
							<p class="text-center" style="font-size: 25px">My Rewards</p>
						</div>
						<div class="panel-body" style="height: 250px">
							<br>
							<br>
							<p class="text-center" style="font-size: 25px">No current
								rewards.</p>
							<br>
							<p class="text-center" style="font-size: 25px">Visit more
								participating locations to earn points toward free rewards.</p>
							<br>
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 20px">Rewards Program
								Info</p>
						</div>
					</div>

				</div>

			</div>

		</div><?php } ?>
  
  <div class="row ">
			<div class="col-sm-offset-1 col-sm-10">
				<hr
					style="border-color: -moz-use-text-color #888888; border-style: solid none; border-width: 3px 0;" />
			</div>

		</div>

	</div>


	<!-- Foot part define-->

	<!-- Foot part define-->
	<div class="container-fluid" style="padding: 0px 0px;">
		<div
			style="background-color: #ca856a; color: #ffffff; font-family: Montserrat, sans-serif">
			<br> <br>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-6">
					<img src="/neo1/Public/Home/images/ic_title_1.png"
						alt="Company Logo" width="200" height="50">
				</div>

				<div class="col-sm-5">
					<a href="http://www.facebook.com" target="_blank"> <span><img
							border="0" src="/neo1/Public/Home/images/facebook_icon.gif"
							alt="facebook icon" width="50" height="50"></span>
					</a> <a href="http://www.twitter.com" target="_blank"> <span><img
							border="0" src="/neo1/Public/Home/images/Twitterbird_icon.png"
							alt="facebook icon" width="50" height="50"></span>
					</a> <a href="http://www.google.com" target="_blank"> <span><img
							border="0" src="/neo1/Public/Home/images/google_plus_icon.png"
							alt="facebook icon" width="50" height="50"></span>
					</a> <a href="mailto:elecdesign8@gmail.com" target="_blank"> <span><img
							border="0" src="/neo1/Public/Home/images/email_icon.png"
							alt="facebook icon" width="50" height="50"></span>
					</a>
				</div>
			</div>
			<br> <br>

			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-3">
					<div class="panel panel-primary text-left"
						style="background-color: rgba(255, 255, 255, 0); border: 0;">
						<p style="font-size: 22px; font-weight: bold;">
							<a href="<?php echo U('Index/index');?>"
								class="general_text_link_2_style">FOR CONSUMERS</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">
							<a href="<?php echo U('User/insert');?>"
								class="general_text_link_style">FIND LOCATIONS</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">
							<a href="<?php echo U('User/signIn');?>"
								class="general_text_link_style">SIGN IN</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">
							<a href="http://www.google.com" class="general_text_link_style">CONSUMER
								BLOG</a>
						</p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="panel panel-primary text-left"
						style="background-color: rgba(255, 255, 255, 0); border: 0;">
						<p style="font-size: 22px; font-weight: bold;">
							<a href="<?php echo U('Business/business_main');?>"
								class="general_text_link_2_style">FOR MERCHANTS</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">
							<a href="<?php echo U('Business/business_sign_in');?>"
								class="general_text_link_style">DASHBOARD</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">
							<a href="http://www.google.com" class="general_text_link_style">SMALL
								BUSINESS BLOG</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">&nbsp;</p>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="panel panel-primary text-left"
						style="background-color: rgba(255, 255, 255, 0); border: 0;">
						<p style="font-size: 22px; font-weight: bold;">
							<a href="http://www.google.com" class="general_text_link_2_style">ABOUT
								US</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">
							<a href="http://www.google.com" class="general_text_link_style">CAREERS</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">
							<a href="http://www.google.com" class="general_text_link_style">FAQ</a>
						</p>

						<p style="font-size: 22px; font-weight: bold;">
							<a href="http://www.google.com" class="general_text_link_style">LEGAL</a>
						</p>
					</div>
				</div>
			</div>
			<br> <br>
			<div class="row" style="margin-bottom: 1px;">
				<div class="col-sm-1"></div>
				<div class="col-sm-6">
					<p
						style="font-size: 24px; text-transform: uppercase; font-weight: bold; color: #D3D3D3;">™Neo
						Reward ©2016</p>
				</div>
			</div>
		</div>

	</div>


</body>
</html>