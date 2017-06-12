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
        $(document).ready(function()
        {
          var objArray = [];　 // Create a new array
        
          //Highlight the active button
          // First one is hightlighted as active button
          objArray.push(document.getElementById("button_profile_id")); 
          objArray.push(document.getElementById("button_general_id")); 
          objArray.push(document.getElementById("button_status_id")); 
          objArray.push(document.getElementById("button_product_id")); 
          db1ToolButtonHighlight(objArray);
          
          // clear the array before use
          while(objArray.length > 0) {objArray.pop();}
          
          //Preload the user profile information
          objArray["full_name"] = document.getElementById("full_name");
          objArray["company_name"] = document.getElementById("company_name");
          objArray["email"] = document.getElementById("email");
          objArray["phone"] = document.getElementById("phone");
          objArray["mobile"] = document.getElementById("mobile");
          objArray["type"] = document.getElementById("type");
          objArray["address"] = document.getElementById("address");
          objArray["city"] = document.getElementById("city");
          objArray["province"] = document.getElementById("province");
          objArray["country"] = document.getElementById("country");
          objArray["postalCode"] = document.getElementById("postal_code");
          objArray["regInfo"] = document.getElementById("id_account_reg_date");
          objArray["action"]   = "<?php echo U('Business/loadDashBoard1BnProfile');?>";
          loadDashboard1ProfileInfo(objArray);
        });
   
        $("#profile_update_submit").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById("form_profile");
          objArray["full_name"] = document.getElementById("full_name");
          objArray["company_name"] = document.getElementById("company_name");
          objArray["email"] = document.getElementById("email");
          objArray["phone"] = document.getElementById("phone");
          objArray["mobile"] = document.getElementById("mobile");
          objArray["type"] = document.getElementById("type");
          objArray["address"] = document.getElementById("address");
          objArray["city"] = document.getElementById("city");
          objArray["province"] = document.getElementById("province");
          objArray["country"] = document.getElementById("country");
          objArray["postalCode"] = document.getElementById("postal_code");
          objArray["action"]   = "<?php echo U('Business/updateDashBoard1BnProfile');?>";

          updateDashboard1ProfileInfo(objArray);
        });
        
        // Preset the input box format
        $("#button_pw_modal").click(function ()
        {
            var objArray = [];　 // Create a new array
            objArray["oldPw"]    = document.getElementById("pu_old_password");
            objArray["newPw"]    = document.getElementById("pu_new_password");
            objArray["newPwCfm"] = document.getElementById("pu_cfm_new_password");
            presetAccountPwData(objArray)
        });
        
        // Dashboard 1 password update
        $("#password_update_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"]    = document.getElementById('form_pw_update');
          objArray["oldPw"]    = document.getElementById("pu_old_password");
          objArray["newPw"]    = document.getElementById("pu_new_password");
          objArray["newPwCfm"] = document.getElementById("pu_cfm_new_password");
          objArray["action"] = "<?php echo U('Business/db1_password_update');?>";
          accountPwUpdate(objArray)
        });
       
        //Message form process
        var objSubmitBut = document.getElementById("button_msg_form");
        $(objSubmitBut).click(function ()
        {
          var objForm = document.getElementById("bn_temp_msg_form");
          var objSubject = document.getElementById("fm_subject");
          var objMsgBody = document.getElementById("fm_message");
          var strAction = "<?php echo U('Business/business_db1_msg_form');?>";
          db1FormProcess(objForm, objSubject, objMsgBody, strAction);
        });

      });
    </script>

<style>
/* Set black background color, white text and some padding */
footer {
	background-color: #555;
	color: white;
	padding: 15px;
}

#pwUpdateModal {
	margin: 100px 0 0 0px;
	/* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}
</style>

</head>


<body data-spy="scroll" data-target=".navbar" data-offset="60">

	<!--Top part define-->
	<!-- Business dashboard header-->


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
					<li><a>My Dashboard</a></li>
					<li class="btn-group">
						<button role="button" class="navi-btn-default dropdown-toggle"
							data-toggle="dropdown"><?php echo ($bnInfo['bName']); ?> 
            <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li class="navi-drop-down-btn"><a
								href="<?php echo U('Business/signOutProc');?>">Sign out</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Content container part define-->
	<div class="container-fluid" style="margin-top: 50px;">
		<div class="row text-center" style="margin-top: 50px;">
			<div class="col-sm-offset-2 col-sm-8">
				<div class="btn-group btn-group-justified">
					<a href="<?php echo U('Business/business_db1_profile');?>"
						class="button button-royal button-rounded button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_profile_id">Account
						Profile</a> <a
						href="<?php echo U('Business/business_db1_status');?>"
						class="button button-royal button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_status_id">Account
						Status</a> <a
						href="<?php echo U('Business/business_db1_product');?>"
						class="button button-royal button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_product_id">Product
						Info</a> <a
						href="<?php echo U('Business/business_db1_general');?>"
						class="button button-royal button-rounded button-raised general_text_link_5_style"
						style="font-size: 20px; font-weight: bold" id="button_general_id">General
						Info</a>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 50px;">
			<div class="col-sm-offset-1 col-sm-5">
				<div class="panel panel-default">
					<div class="panel-heading"
						style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
						Account Profile</div>
					<div class="panel-body">
						<form class="form-horizontal" id="form_profile"
							name="form_profile" method="post"
							action="/neo1/index.php/home/business/business_db1_profile.html">
							<div class="form-group">
								<label class="control-label col-sm-3" for="full_name">Full Name:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="full_name"
										id="full_name" placeholder="Enter your name...">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="company_name">Company
									Name:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="company_name"
										id="company_name" placeholder="Enter company name...">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="email">Email:</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" name="email"
										id="email" placeholder="Enter email...">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="phone">Phone:</label>
								<div class="col-sm-9">
									<input type="tel" class="form-control" name="phone" id="phone"
										placeholder="Enter phone number...">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="mobile">Mobile:</label>
								<div class="col-sm-9">
									<input type="tel" class="form-control" name="mobile"
										id="mobile" placeholder="Enter mobile number...">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="type">Business Type:</label>
								<div class="col-sm-9">
									<select class="form-control" name="type" id="type">
										<option>Restaurant</option>
										<option>Retail</option>
										<option>Spa</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="address">Address:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="address"
										id="address" placeholder="Enter address...">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="city">City:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="city" id="city"
										placeholder="Enter City name...">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="province">Province/State:</label>
								<div class="col-sm-9">
									<select class="form-control" name="province" id="province">
										<option>ON -- Ontario</option>
										<option>QC -- Quebec</option>
										<option>BC -- British Columbia</option>
										<option>AB -- Alberta</option>
										<option>MB -- Manitoba</option>
										<option>SK -- Saskatchewan</option>
										<option>NB -- New Brunswick</option>
										<option>NL -- Newfoundland and Labrador</option>
										<option>NS -- Nova Scotia</option>
										<option>PE -- Prince Edward Island</option>
										<option>NT -- Northwest Territories</option>
										<option>NU -- Nunavut</option>
										<option>YT -- Yukon</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="postal_code">Postal
									Code:</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="postal_code"
										id="postal_code" placeholder="Enter postal code...">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="country">Country:</label>
								<div class="col-sm-9">
									<select class="form-control" name="country" id="country">
										<option>CANADA</option>
										<option>UNITED STATES</option>
									</select>
								</div>
							</div>
							<br> <br>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-4">
									<button type="button" id="profile_update_submit"
										class="submit_button_style">Update Profile</button>
								</div>
							</div>
						</form>
					</div>

					<div class="panel-footer"
						style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9;">
						<div class="row">
							<div class="col-sm-6" id="id_account_reg_date"
								style="text-align: left;">Account Create:</div>
							<div class="col-sm-6" style="text-align: right;">
								<a id="button_pw_modal" class="general_text_link_6_style"
									data-toggle="modal" data-target="#pwUpdateModal"> Update
									Password --> </a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="row" style="margin-top: 50px;">
			<div class="col-sm-offset-3 col-sm-6">
				<div class="panel panel-default text-center"
					style="border: 2px solid #c3c3c3; box-shadow: 5px 5px 5px grey;">
					<div class="panel-body">
						<p style="font-size: 30px; font-weight: bold; text-align: left;">Contact
							Neo:</p>
						<hr
							style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 1px 0;" />
						<form class="form-horizontal" id="bn_temp_msg_form"
							name="bn_temp_msg_form" method="post"
							action="/neo1/index.php/home/business/business_db1_profile.html">
							<div class="form-group">
								<label class="control-label col-sm-2" for="fm_subject">Subject:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="fm_subject"
										name="fm_subject" placeholder="Enter subject">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="fm_message">Message:</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="fm_message"
										name="fm_message" placeholder="Enter Your message here..."
										rows="5"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div>
									<button type="button" id="button_msg_form"
										class="demo_button_style">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<br>
	<br>
	<footer class="container-fluid"
		style="font-weight: bold; font-size: 20px !important;">
		<p>Neo Reward -- Get Your Clients Connected</p>
	</footer>


	<!-- Password update Modal part define-->
	<div class="modal fade" id="pwUpdateModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title">Password Update</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="form_pw_update"
						name="form_pw_update" method="post"
						action="/neo1/index.php/home/business/business_db1_profile.html">
						<div class="form-group">
							<label class="control-label col-sm-3" for="pu_old_password">Old
								Password:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="pu_old_password"
									id="pu_old_password" placeholder="Enter old password">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="pu_new_password">New
								Password:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="pu_new_password"
									id="pu_new_password" placeholder="Enter new password">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="pu_cfm_new_password">Confirm
								New Password:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control"
									name="pu_cfm_new_password" id="pu_cfm_new_password"
									placeholder="Re-enter new email">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary"
						id="password_update_button">Update</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>


</body>
</html>