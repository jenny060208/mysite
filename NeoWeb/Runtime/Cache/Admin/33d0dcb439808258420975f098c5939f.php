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

<style>
#pwRecoverModal {
	margin: 100px 0 0 0px;
	/* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}

#accountCreateModal {
	margin: 100px 0 0 0px;
	/* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}
</style>

<script type="text/javascript">
      jQuery(function($)
      {
        // Process the admin account sign in 
        $("#sign_in_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          
          objArray["form"]    = document.getElementById('form_sign_in');
          objArray["email"]    = document.getElementById('email');
          objArray["code"]    = document.getElementById('password');
          objArray["action"] = "<?php echo U('Admin/admin_account_signin');?>";
         
          adminAccountSignIn(objArray);
        });
        
        // Process the Create root account
        $("#account_create_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          
          objArray["form"]    = document.getElementById('form_account_create');
          objArray["email"]    = document.getElementById('create_acnt_email');
          objArray["code"]    = document.getElementById('create_acnt_code');
          objArray["action"] = "<?php echo U('Admin/create_root_account');?>";
         
          createRootAccount(objArray);
        });
        
        // Process the admin account password recover 
        $("#password_recover_button").click(function ()
        {
          var objArray = [];　 // Create a new array

          objArray["form"]    = document.getElementById('form_pw_recover');
          objArray["email"]    = document.getElementById('pu_recover_email');
          objArray["action"] = "<?php echo U('Admin/password_recover');?>";
             
          adminPasswordRecover(objArray);
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
				<a class="navbar-brand"> <img
					src="/neo1/Public/images/ic_title_1.png" alt="Company Logo"
					width="200" height="50"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li
						style="font-size: 30px !important; font-weight: bold; color: #eeeeee;">Engage
						Your Customers</li>
				</ul>
			</div>
		</div>
	</nav>





	<!-- Container (Contact info Section) -->
	<div class="container-fluid" style="margin-top: 100px;">
		<div class="row text-center">
			<div class="col-sm-offset-4 col-sm-4">
				<div class="panel panel-default text-center"
					style="border: 2px solid #c3c3c3; box-shadow: 5px 5px 5px grey;">
					<div class="panel-body" style="background-color: #E9967A;">
						<p
							style="font-size: 30px; font-weight: bold; letter-spacing: 2px;">Neo
							Loyalty</p>
						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />

						<p
							style="font-size: 30px; font-weight: bold; letter-spacing: 2px;">Control
							Panel Portal</p>
						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />

						<form class="form-horizontal" id="form_sign_in"
							name="form_sign_in" method="post" action="/neo1/admin">
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email:</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="email"
										name="email" placeholder="Enter email">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="password">Password:</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="password"
										name="password" placeholder="Enter password">
								</div>
							</div>
							<div class="form-group">
								<div>
									<button type="button" id="sign_in_button"
										class="submit_button_style">Sign in to Control Panel</button>
								</div>
							</div>
						</form>
						<br>
					</div>
				</div>
			</div>
		</div>

	</div>


	<!-- Foot part define-->
	<br>
	<br>
	<footer class="container-fluid "
		style="background-color: #ca856a; color: #ffffff; font-family: Montserrat, sans-serif; font-weight: bold; font-size: 20px !important;">
		<p>Neo Loyalty -- Control Panel</p>
	</footer>


	<!-- Create account Modal part define-->
	<div class="modal fade" id="accountCreateModal" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title">Create Adminstration Account</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="form_account_create"
						name="form_account_create" method="post" action="/neo1/admin">
						<div class="form-group">
							<label class="control-label col-sm-3" for="create_acnt_email">Email:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="create_acnt_email"
									id="create_acnt_email" placeholder="Enter Email...">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="create_acnt_code">Code:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="create_acnt_code"
									id="create_acnt_code" placeholder="Enter Code...">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary"
						id="account_create_button">Create Account</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>

	<!-- Password Recover Modal part define-->
	<div class="modal fade" id="pwRecoverModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title">Password Recover</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="form_pw_recover"
						name="form_pw_recover" method="post" action="/neo1/admin">
						<div class="form-group">
							<label class="control-label col-sm-3" for="pu_recover_email">Email:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="pu_recover_email"
									id="pu_recover_email" placeholder="Enter Email...">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary"
						id="password_recover_button">Send</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>



</body>
</html>