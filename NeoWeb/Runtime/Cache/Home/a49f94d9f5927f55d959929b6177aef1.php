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
      $("#reg_submit").click(function ()
      {
        var objArray = [];　 // Create a new array
        objArray["form"] = document.getElementById("form_register");
        objArray["name"] = document.getElementById("name");
        objArray["email"]  = document.getElementById("email");
        objArray["phone"]  = document.getElementById("phone");
        objArray["companyName"]   = document.getElementById("company_name");
        objArray["action"]   = "<?php echo U('Business/registerProc');?>";
      
        bnRegistFormProcess(objArray);
      });
    });
    </script>

</head>

<body id="brPage" data-spy="scroll" data-target=".navbar"
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
					<li><a style="font-size: 30px !important; font-weight: bold;">Get
							your customers engage and retain</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Content container part define-->
	<!-- Container (Contact info Section) -->
	<div class="container-fluid"
		style="margin-top: 0px; background-color: #666666;">
		<div class="row text-center">
			<div class="col-sm-offset-4 col-sm-4" style="margin-top: 100px;">
				<div class="panel panel-default text-center"
					style="border: 2px solid #c3c3c3; box-shadow: 5px 5px 5px grey;">
					<div class="panel-body">

						<p
							style="color: #334488; font-family: sans-serif; font-size: 25px !important; font-weight: bold;">
							Merchant Account Sign Up</p>

						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />

						<form class="form-horizontal" id="form_register"
							name="form_register" method="post"
							action="/neo1/index.php/home/business/business_register.html">
							<div class="form-group">
								<label class="control-label col-sm-2" for="name">Name:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" id="name"
										placeholder="Enter name">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email:</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" name="email"
										id="email" placeholder="Enter email">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="phone">Phone:</label>
								<div class="col-sm-10">
									<input type="tel" class="form-control" name="phone" id="phone"
										placeholder="Enter phone number">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="company_name">Company
									Name:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="company_name"
										id="company_name" placeholder="Enter Company Name">
								</div>
							</div>
							<div class="form-group">
								<div>
									<button type="button" id="reg_submit"
										class="submit_button_style">Sign Up Merchant Account</button>
								</div>
							</div>
						</form>

						<p style="font-size: 20px">
							By clicking Register, you confirm that you accept the <a
								href="http://www.google.com" class="general_text_link_3_style">Terms
								of Service.</a> <br>
						</p>
						<p style="font-size: 20px">
							<a href="<?php echo U('Business/business_sign_in');?>"
								class="general_text_link_3_style">Already registered? Login →</a>
						</p>
					</div>
				</div>

				<br> <br>

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