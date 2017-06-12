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
        var objSubmitBut = document.getElementById("pw_recover_submit");

        $(objSubmitBut).click(function ()
        {
          var objForm = document.getElementById("form_bn_db1_pw_recover");
          var objEmail  = document.getElementById("email");
          var strAction = "<?php echo U('Business/pwRecoverProcess');?>";
          db1PwRecoverFormProcess(objForm, objEmail, strAction);
        });
      });
    </script>
</head>


<body id="bPRPage" data-spy="scroll" data-target=".navbar_bn"
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
				<a class="navbar-brand"> <img
					src="/neo1/Public/images/ic_title_1.png" alt="Company Logo"
					width="200" height="50"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a style="font-size: 30px !important; font-weight: bold;">Get
							your customers connected</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Content container part define-->

	<!-- Container (Contact info Section) -->
	<div class="container-fluid"
		style="margin-top: 0px; background-color: #666666;">
		<div class="row text-center">
			<div class="col-sm-offset-4 col-sm-4" style="margin-top: 200px;">
				<div class="panel panel-default text-center"
					style="border: 2px solid #c3c3c3; box-shadow: 5px 5px 5px grey;">
					<div class="panel-body" style="background-color: #666666;">
						<p
							style="font-size: 30px; font-weight: bold; letter-spacing: 2px; color: #eeeeee;">Password
							Recover</p>

						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />
						<p
							style="font-size: 20px; font-weight: bold; letter-spacing: 2px; color: #eeeeee;">
							Enter your email for instructions on how to reset your password.
						</p>

						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />

						<form class="form-horizontal" id="form_bn_db1_pw_recover"
							name="form_bn_db1_pw_recover" method="post"
							action="/neo1/index.php/home/business/business_pw_recover.html">
							<div class="form-group">
								<label class="control-label col-sm-2"
									style="color: #eeeeee; font-weight: bold" for="email">Email:</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="email"
										name="email" placeholder="Enter email">
								</div>
							</div>

							<div class="form-group">
								<div>
									<button type="button" id="pw_recover_submit"
										class="bn_sign_button_style">Reset Password</button>
								</div>
							</div>
						</form>
						<br> <a href="<?php echo U('Business/business_sign_in');?>"
							class="general_text_link_4_style">Back to Sign-in</a>
					</div>
				</div>
			</div>
		</div>


	</div>


</body>
</html>