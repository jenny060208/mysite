<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
<link rel="stylesheet" href="/neo1/Public/css/mainpage.css" type="text/css">
<!-- Script files definition -->
<script type="text/javascript" src="/neo1/Public/js/form_utilities.js"></script>

<style>
#adminAccountCreateModal {
	margin: 100px 0 0 0px;
	/* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}
</style>

<script type="text/javascript">
      jQuery(function($)
      {
        // Process the Create root account
        var objLink = document.getElementById("create_all_tables_id");
        $(objLink).click(function ()
        {
          var objArray = [];　 // Create a new array
          //Load Link process action
          objArray["action"]   = "<?php echo U('Admin/create_all_tables');?>";
          linkActionProcess1(objArray);
        });
        
        // Process the basic info update
        $("#admin_account_create_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('form_admin_account_create');
          objArray["first_name"] = document.getElementById('aa_first_name');
          objArray["last_name"] = document.getElementById('aa_last_name');
          objArray["email"] = document.getElementById('aa_email');
          objArray["phone"] = document.getElementById('aa_phone');
          objArray["mobile"] = document.getElementById('aa_mobile');
          objArray["action"] = "<?php echo U('Admin/admin_account_create');?>";
        
          adminAccountCreateProcess(objArray);
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
				<a class="navbar-brand"> <img src="/neo1/Public/images/ic_title_1.png"
					alt="Company Logo" width="200" height="50"></a>
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
							style="font-size: 30px; font-weight: bold; letter-spacing: 2px;">Installation</p>
						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />
						<a href="#" class="general_text_link_3_style"
							id="create_all_tables_id"
							style="font-size: 20px; font-weight: bold; letter-spacing: 2px;">Create
							All Tables</a>
						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />
						<button type="button" id="admin_account_create_modal"
							class="btn btn-primary btn-lg btn-block" data-toggle="modal"
							data-target="#adminAccountCreateModal">Create Admin
							Account</button>
						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />

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
		<p>Neo Loyalty -- Admin Control Panel Owner Signed in</p>
	</footer>

	<!-- Create admin info Modal part define-->
	<div class="modal fade" id="adminAccountCreateModal" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title">Create Admin Account</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="form_admin_account_create"
						name="form_admin_account" method="post" action="/neo1/index.php/admin/admin/admin_main_panel.html">
						<div class="form-group">
							<label class="control-label col-sm-3" for="aa_first_name">First
								Name:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="aa_first_name"
									id="aa_first_name" placeholder="Enter first name">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="aa_last_name">Last
								Name:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="aa_last_name"
									id="aa_last_name" placeholder="Enter last name">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="aa_email">Email:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="aa_email"
									id="aa_email" placeholder="Enter email">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="aa_phone">Phone:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="aa_phone"
									id="aa_phone" placeholder="Enter phone number">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="aa_mobile">Mobile:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="aa_mobile"
									id="aa_mobile" placeholder="Enter mobile number">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary"
						id="admin_account_create_button">Create</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>



</body>
</html>