<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
<TITLE>Neo Loyalty System</TITLE>
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
#merchantAccountCreateModal {
	margin: 100px 0 0 0px;
	/* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}
</style>

<script type="text/javascript">
      jQuery(function($)
      {
        // Create Mercahnt account process
        $("#merchant_account_create_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('form_merchant_account_create');
          objArray["first_name"] = document.getElementById('n_first_name');
          objArray["last_name"] = document.getElementById('n_last_name');
          objArray["merchant_name"] = document.getElementById('n_merchant_name');
          objArray["email"] = document.getElementById('n_email');
          objArray["phone"] = document.getElementById('n_phone');
          objArray["mobile"] = document.getElementById('n_mobile');
          objArray["action"] = "<?php echo U('Admin/merchant_account_create');?>";
        
          merchantAccountCreateProcess(objArray);
        });
        
    
      });
    </script>
</head>

<body id="bmPage" data-spy="scroll" data-target=".navbar"
	data-offset="60">

	<!--Top part define-->


<body data-spy="scroll" data-target=".navbar" data-offset="60">
	<!--Top Navigation part define-->
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
					<li><a>Admin Account Dashboard</a></li>
					<li class="btn-group">
						<button role="button" class="navi-btn-default dropdown-toggle"
							data-toggle="dropdown"><?php echo ($ProfileName); ?>
              <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li class="navi-drop-down-btn"><a
								href="<?php echo U('Admin/signOutProc');?>">Sign out</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>


	<!-- Container (Contact info Section) -->
	<div class="container-fluid" style="margin-top: 50px;">
		<div class="row text-center" style="margin-top: 50px;">
			<div class="col-sm-offset-2 col-sm-8">
				<div class="btn-group btn-group-justified">
					<a href="<?php echo U('Admin/admin_board_merchant');?>"
						class="button button-royal button-rounded button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_profile_id">Merchant
						Account</a> <a href="<?php echo U('Admin/admin_board_user');?>"
						class="button button-royal button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_status_id">User
						Account</a> <a href="<?php echo U('Admin/admin_board_product');?>"
						class="button button-royal button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_product_id">Product
						Info</a> <a href="<?php echo U('Admin/admin_board_tag');?>"
						class="button button-royal button-rounded button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_general_id">Tag
						Info</a> <a href="<?php echo U('Admin/admin_dash_board');?>"
						class="button button-royal button-rounded button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_general_id">General</a>
				</div>
			</div>
		</div>

	</div>

	<!-- feature part -->
	<div class="container-fluid text-center"
		style="background-color: #777777; color: #fff; font-family: Montserrat, sans-serif; padding: 0px 25px; margin-top: 50px;">


		<div class="row ">
			<div class="col-sm-offset-2 col-sm-8">
				<p
					style="color: #eee; font-family: sans-serif; font-size: 50px !important; font-weight:;">
					Merchant Account Information</p>
			</div>
		</div>
		<div class="row ">
			<div class="col-sm-offset-1 col-sm-10">
				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading"
							style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
							Merchant Accounts Report</div>
						<div class="panel-body" style="height: 250px">
							<img src="/neo1/Public/images/WorkFlow_1.jpg"
								alt="Neo Work Flow 1"
								class="img-rounded img-responsive center-block">
						</div>
					</div>
				</div>
				<div class=" col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading"
							style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
							Merchant Account Management</div>
						<div class="panel-body" style="height: 250px">
							<p class="text-left"
								style="color: #555555; font-family: sans-serif; font-size: 30px !important;">
								Neo helps you create a custom loyalty program</p>
							<p class="text-left"
								style="color: #555555; font-family: sans-serif; font-size: 20px !important; font-weight:;">
								To fit your requirements from simple to complex, Neo will help
								you craft the perfect program for your business</p>
						</div>
					</div>
				</div>

				<div class=" col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading"
							style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
							New Merchant Account</div>
						<div class="panel-body" style="height: 250px">
							<button type="button" id="merchant_account_create_modal"
								class="btn btn-primary btn-lg btn-block" data-toggle="modal"
								data-target="#merchantAccountCreateModal">Create Merchant
								Account</button>
							<hr
								style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />
						</div>
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
		<p>Neo Loyalty -- Admin Account Dash Board Signed in</p>
	</footer>


	<!-- Create admin info Modal part define-->
	<div class="modal fade" id="merchantAccountCreateModal" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title">Create Merchant Account</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="form_merchant_account_create"
						name="form_admin_account" method="post"
						action="/neo1/index.php/admin/admin/admin_board_merchant.html">
						<div class="form-group">
							<label class="control-label col-sm-3" for="n_first_name">First
								Name:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="n_first_name"
									id="n_first_name" placeholder="Enter first name">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="n_last_name">Last
								Name:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="n_last_name"
									id="n_last_name" placeholder="Enter last name">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="n_merchant_name">Merchant
								Name:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="n_merchant_name"
									id="n_merchant_name" placeholder="Enter merchant name">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="n_email">Email:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="n_email"
									id="n_email" placeholder="Enter email">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="n_phone">Phone:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="n_phone"
									id="n_phone" placeholder="Enter phone number">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="n_mobile">Mobile:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="n_mobile"
									id="n_mobile" placeholder="Enter mobile number">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary"
						id="merchant_account_create_button">Create</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>


</body>
</html>