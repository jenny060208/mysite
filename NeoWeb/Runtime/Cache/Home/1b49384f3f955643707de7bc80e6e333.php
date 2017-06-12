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
        var objSubmitBut = document.getElementById("sign_in_submit");
     
        $(objSubmitBut).click(function ()
        {
          var objForm = document.getElementById("form_sign_in");
          var objEmail  = document.getElementById("user_email");
          var objPassword  = document.getElementById("user_password");
          var strAction = "<?php echo U('User/signInProc');?>";
   
          userSignInFormProcess(objForm, objEmail, objPassword, strAction);
        });
      });
    </script>

</head>


<body id="userSignInPage" data-spy="scroll" data-target=".navbar"
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

	<!-- Content container part define-->

	<!-- Container (Contact info Section) -->
	<div class="container-fluid" style="margin-top: 100px;">
		<div class="row text-center">
			<div class="col-sm-offset-4 col-sm-4">
				<div class="panel panel-default text-center"
					style="border: 2px solid #c3c3c3; box-shadow: 5px 5px 5px grey;">
					<div class="panel-body">
						<p
							style="font-size: 30px; font-weight: bold; letter-spacing: 2px;">Welcome
							Back</p>
						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />

						<a href="http://www.facebook.com"> <img border="0"
							src="/neo1/Public/images/btn_signinfb.png"
							alt="Facebook Register" width="350" height="40">
						</a>
						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />

						<form class="form-horizontal" id="form_sign_in"
							name="form_sign_in" method="post"
							action="/neo1/index.php/home/user/signin.html">
							<div class="form-group">
								<label class="control-label col-sm-2" for="user_email">Email:</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="user_email"
										name="user_email" placeholder="Enter email">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="user_password">Password:</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="user_password"
										name="user_password" placeholder="Enter password">
								</div>
							</div>
							<div class="form-group">
								<div>
									<button type="button" id="sign_in_submit"
										class="submit_button_style">Sign in with Email</button>
								</div>
							</div>
						</form>
						<br>
						<table class="table">
							<tr>
								<td style="font-size: 20px; font-weight: bold;"><a
									href="<?php echo U('User/passwd_recover');?>"
									class="general_text_link_3_style">Forget password?</a></td>
								<td style="font-size: 20px; font-weight: bold;"><a
									href="<?php echo U('User/register');?>"
									class="general_text_link_3_style">New user? Register--> </a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="row text-center">
			<div class="col-sm-offset-4 col-sm-4">
				<br>
				<br>
				<p style="color: grey; font-size: 25px;">
					Are you a business? <a
						href="<?php echo U('Business/business_main');?>"
						class="general_text_link_3_style">Visit your dashboard.</a>
				</p>
				<br>
				<br>
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