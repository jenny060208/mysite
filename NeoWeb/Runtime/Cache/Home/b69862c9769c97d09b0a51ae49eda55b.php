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
<link rel="stylesheet" href="/neo1/Public/css/mainpage.css"
	type="text/css">
<!-- Script files definition -->
<script type="text/javascript" src="/neo1/Public/js/form_utilities.js"></script>

<script type="text/javascript">
      jQuery(function($)
      {
        var objRegBut = document.getElementById("business_reg_submit");
        $(objRegBut).click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById("form_register");
          objArray["fullName"] = document.getElementById("full_name");
          objArray["bnEmail"]  = document.getElementById("business_email");
          objArray["bnPhone"]  = document.getElementById("business_phone");
          objArray["bnName"]   = document.getElementById("company_name");
          objArray["action"]   = "<?php echo U('Business/registerProc');?>";
            
          bnRegistFormProcess(objArray);
        });
      });
    </script>


</head>

<body id="bmPage" data-spy="scroll" data-target=".navbar"
	data-offset="60">

	<!--Top part define-->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo U('Index/index');?>"> <img
					src="/neo1/Public/images/ic_title_1.png" alt="Company Logo"
					width="200" height="50"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://www.google.com">Find Locations</a></li>
					<li><a href="<?php echo U('Business/business_main');?>">For
							Businesses</a></li>
					<li><a class="btn btn-default navi-btn-default"
						href="<?php echo U('User/signIn');?>" role="button">Sign In</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Business main part -->
	<div class="jumbotron text-center"
		style="background-color: #333333; color: #fff; font-family: Montserrat, sans-serif; margin-top: 50px; padding: 100px 25px;">
		<br>
		<br> <br>
		<br>
		<p
			style="color: #fff; font-family: sans-serif; font-size: 50px !important; font-weight: bold;">
			Get your customers hooked.</p>

		<p
			style="color: #cccccc; font-family: sans-serif; font-size: 35px !important; font-weight: bold;">
			You sign them up. We bring them back.</p>
		<br> <a href="#business_contact" class="get_info_button_style"
			role="button">GET MORE INFORMATION</a> <br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<p
			style="color: #dddddd; font-family: sans-serif; font-size: 30px !important; font-weight: normal;">
			Have a question? Call 1-855-416-1234</p>
	</div>



	<!-- Business main part -->
	<div id="business_contact" class="jumbotron text-center"
		style="background-color: #A00DCA; color: #fff; font-family: Montserrat, sans-serif; padding: 5px 25px;">
		<br>
		<form class="form-inline" id="form_register" name="form_register">
			<div class="form-group">
				<input type="text" class="form-control" id="full_name"
					name="full_name" placeholder="Full Name">
			</div>
			<div class="form-group">
				<input type="email" class="form-control" id="business_email"
					name="business_email" placeholder="Email">
			</div>
			<div class="form-group">
				<input type="tel" class="form-control" id="business_phone"
					name="business_phone" placeholder="Contact Phone">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="company_name"
					name="company_name" placeholder="Company Name">
			</div>
		</form>
		<br>
		<button type="button" id="business_reg_submit"
			class="get_info_button_style" style="background-color: #A05555">GET
			MORE INFORMATION</button>
		<br>
		<br>
		<br>
		<p
			style="color: #dddddd; font-family: sans-serif; font-size: 25px !important; font-weight: normal;">
			Have a question? Call 1-855-416-1234</p>
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
					<img src="/neo1/Public/images/ic_title_1.png" alt="Company Logo"
						width="200" height="50">
				</div>

				<div class="col-sm-5">
					<a href="http://www.facebook.com" target="_blank"> <span><img
							border="0" src="/neo1/Public/images/facebook_icon.gif"
							alt="facebook icon" width="50" height="50"></span>
					</a> <a href="http://www.twitter.com" target="_blank"> <span><img
							border="0" src="/neo1/Public/images/Twitterbird_icon.png"
							alt="facebook icon" width="50" height="50"></span>
					</a> <a href="http://www.google.com" target="_blank"> <span><img
							border="0" src="/neo1/Public/images/google_plus_icon.png"
							alt="facebook icon" width="50" height="50"></span>
					</a> <a href="mailto:elecdesign8@gmail.com" target="_blank"> <span><img
							border="0" src="/neo1/Public/images/email_icon.png"
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