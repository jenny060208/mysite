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
          // Preset the status bar
          objArray.push(document.getElementById("step_1_id")); 
          objArray.push(document.getElementById("step_2_id")); 
          objArray.push(document.getElementById("step_3_id")); 
          objArray.push(document.getElementById("step_4_id")); 
          objArray.push(document.getElementById("step_5_id")); 
          objArray.push(document.getElementById("step_6_id")); 

          var statusData = <?php echo ($profile["status"]); ?>;
          
          presetDb1StatusBarProperty(objArray, statusData);
          
          while(objArray.length > 0) {objArray.pop();}
          
          //preset the profile click
          var obj = document.getElementById("profile_detail_id");
          setCellProperty1(obj, "<?php echo U('Business/business_db1_profile');?>");
                  
          // clear the array before use
          while(objArray.length > 0) {objArray.pop();}
                  
          //Highlight the active button
          // First one is hightlighted as active button
          objArray.push(document.getElementById("button_general_id")); 
          objArray.push(document.getElementById("button_profile_id")); 
          objArray.push(document.getElementById("button_status_id"));
          objArray.push(document.getElementById("button_product_id")); 
          db1ToolButtonHighlight(objArray);
        });
        
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

		<div class="row text-left" style="margin-top: 50px;">
			<div class="col-sm-offset-1 col-sm-10">
				<p style="font-size: 30px; font-weight: bold; color: #7B72E9">Welcome
					to Neo Reward -- Merchant Account Application Status:</p>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td id="step_1_id" class="bn_db1_status_bar_style_1">Step 1:
								Register Account >></td>
							<td id="step_2_id" class="bn_db1_status_bar_style_1">Step 2:
								Update Profile >></td>
							<td id="step_3_id" class="bn_db1_status_bar_style_1">Step 3:
								Monthly Fee >></td>
							<td id="step_4_id" class="bn_db1_status_bar_style_1">Step 4: Get
								My Tool Kit >></td>
							<td id="step_5_id" class="bn_db1_status_bar_style_1">Step 5:
								Training Session >></td>
							<td id="step_6_id" class="bn_db1_status_bar_style_1">Step 6:
								Ready To Go !!!</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" style="margin-top: 50px;">
			<div class="col-sm-offset-1 col-sm-5">
				<!-- Account Profile table-->
				<table class="table">
					<caption id="profile_detail_id"
						style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
						Account Profile (Click to edit)</caption>
					<tbody>
						<tr>
							<td class="col-sm-1"
								style="vertical-align: middle; text-align: left; font-weight: bold;">Full
								Name:</td>
							<td class="col-sm-2"
								style="vertical-align: middle; text-align: left;"><?php echo ($profile["full_name"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold">Company
								Name:</td>
							<td style="vertical-align: middle; text-align: left;"><?php echo ($profile["company_name"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold">Phone
								Num.:</td>
							<td style="vertical-align: middle; text-align: left;"><?php echo ($profile["phone"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold">Email:
							</td>
							<td style="vertical-align: middle; text-align: left;"><?php echo ($profile["email"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold">Address:
							</td>
							<td style="vertical-align: middle; text-align: left;"><?php echo ($profile["address"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold">Postal
								Code:</td>
							<td style="vertical-align: middle; text-align: left;"><?php echo ($profile["postal_code"]); ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-sm-5">
				<!-- Account Status table-->
				<table class="table table-bordered">
					<caption
						style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
						Account Status</caption>
					<tbody>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold; vertical-align: middle; text-align: left">Current
								Status:</td>
							<td style="vertical-align: middle; text-align: left;"><?php echo ($status); ?></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered" style="margin-top: 50px;">
					<caption
						style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
						Payment Method</caption>
					<tbody>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold; vertical-align: middle; text-align: left">E-Transfer:</td>
							<td style="vertical-align: middle; text-align: left;">Plase make payment to this email address: <?php echo ($payment["e_trans_email"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold; vertical-align: middle; text-align: left">Credit
								Card:</td>
							<td style="vertical-align: middle; text-align: left;">For credit card, please make payment with Paypal: <?php echo ($payment["paypal_id"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold; vertical-align: middle; text-align: left">Note:</td>
							<td style="vertical-align: middle; text-align: left;">Payment can
								be made with two methods above, please click for details.</td>
						</tr>
					</tbody>
				</table>
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
							action="/neo1/index.php/home/business/business_db1.html">
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




</body>
</html>