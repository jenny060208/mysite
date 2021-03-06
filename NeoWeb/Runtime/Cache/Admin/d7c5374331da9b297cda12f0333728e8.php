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
#merchantAccountCreateModal {
	margin: 100px 0 0 0px;
	/* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}

#merchantAccountUpdateModal {
  margin: 100px 0 0 0px;
  /* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}

</style>

<script type="text/javascript">
      jQuery(function($)
      {
        // Tag account report refresh 
        $("#merchant_acnt_report_refresh_id").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["mAcntTotal"] = document.getElementById('merchant_report_total_id');
          objArray["mAcntInitial"] = document.getElementById('merchant_report_initial_id');
          objArray["mAcntEnable"] = document.getElementById('merchant_report_enable_id');
          objArray["mAcntDisable"] = document.getElementById('merchant_report_disable_id');
          objArray["action"] = "<?php echo U('Admin/merchant_acnt_report_refresh_process');?>";
          merchantAcntReportRefreshProcessInAdmin(objArray);
        });  

        // Preset create merchat account modal 
        $("#merchant_account_create_modal").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["first_name"] = document.getElementById('n_first_name');
          objArray["last_name"] = document.getElementById('n_last_name');
          objArray["merchant_name"] = document.getElementById('n_merchant_name');
          objArray["email"] = document.getElementById('n_email');
          objArray["phone"] = document.getElementById('n_phone');
          objArray["mobile"] = document.getElementById('n_mobile');
        
          merchantAccountCreatePresetProcess(objArray);
        });
     
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
        
        
        // Preload merchat account info 
        $("#merchant_account_update_modal").click(function ()
        {
          var objArray = [];　 // Create a new array

          objArray["mid"] = document.getElementById('u_mid');
          objArray["currentMerchant"] = document.getElementById('merchant_acnt_current');
          objArray["totalMerchant"] = document.getElementById('merchant_acnt_total');
          objArray["first_name"] = document.getElementById('u_first_name');
          objArray["last_name"] = document.getElementById('u_last_name');
          objArray["merchant_name"] = document.getElementById('u_merchant_name');
          objArray["merchant_status"] = document.getElementById('u_merchant_status');
          objArray["web_page"] = document.getElementById('u_web_page');
          objArray["email"] = document.getElementById('u_email');
          objArray["phone"] = document.getElementById('u_phone');
          objArray["mobile"] = document.getElementById('u_mobile');
          objArray["address"] = document.getElementById('u_address');
          objArray["city"] = document.getElementById('u_city');
          objArray["province"] = document.getElementById('u_province');
          objArray["country"] = document.getElementById('u_country');
          objArray["postal_code"] = document.getElementById('u_postal_code');
          objArray["fb_id"] = document.getElementById('u_fb_id');
          objArray["twitter_id"] = document.getElementById('u_twitter_id');
          objArray["reward_msg"] = document.getElementById('u_reward_msg');
          objArray["success_msg"] = document.getElementById('u_success_msg');
          objArray["note"] = document.getElementById('u_note');

          objArray["action"] = "<?php echo U('Admin/merchant_account_load');?>";
          merchantAccountInfoLoadInAdmin(objArray, 1);
        });
        
        // Load previous merchant account
        $("#merchant_load_previous").click(function ()
        {
          var objArray = [];　 // Create a new array

          objArray["mid"] = document.getElementById('u_mid');
          objArray["currentMerchant"] = document.getElementById('merchant_acnt_current');
          objArray["totalMerchant"] = document.getElementById('merchant_acnt_total');
          objArray["first_name"] = document.getElementById('u_first_name');
          objArray["last_name"] = document.getElementById('u_last_name');
          objArray["merchant_name"] = document.getElementById('u_merchant_name');
          objArray["merchant_status"] = document.getElementById('u_merchant_status');
          objArray["web_page"] = document.getElementById('u_web_page');
          objArray["email"] = document.getElementById('u_email');
          objArray["phone"] = document.getElementById('u_phone');
          objArray["mobile"] = document.getElementById('u_mobile');
          objArray["address"] = document.getElementById('u_address');
          objArray["city"] = document.getElementById('u_city');
          objArray["province"] = document.getElementById('u_province');
          objArray["country"] = document.getElementById('u_country');
          objArray["postal_code"] = document.getElementById('u_postal_code');
          objArray["fb_id"] = document.getElementById('u_fb_id');
          objArray["twitter_id"] = document.getElementById('u_twitter_id');
          objArray["reward_msg"] = document.getElementById('u_reward_msg');
          objArray["success_msg"] = document.getElementById('u_success_msg');
          objArray["note"] = document.getElementById('u_note');

          objArray["action"] = "<?php echo U('Admin/merchant_account_load');?>";
          merchantAccountInfoPreviousLoadInAdmin(objArray);
        });
        
        // Load next merchant account
        $("#merchant_load_next").click(function ()
        {
          var objArray = [];　 // Create a new array

          objArray["mid"] = document.getElementById('u_mid');
          objArray["currentMerchant"] = document.getElementById('merchant_acnt_current');
          objArray["totalMerchant"] = document.getElementById('merchant_acnt_total');
          objArray["first_name"] = document.getElementById('u_first_name');
          objArray["last_name"] = document.getElementById('u_last_name');
          objArray["merchant_name"] = document.getElementById('u_merchant_name');
          objArray["merchant_status"] = document.getElementById('u_merchant_status');
          objArray["web_page"] = document.getElementById('u_web_page');
          objArray["email"] = document.getElementById('u_email');
          objArray["phone"] = document.getElementById('u_phone');
          objArray["mobile"] = document.getElementById('u_mobile');
          objArray["address"] = document.getElementById('u_address');
          objArray["city"] = document.getElementById('u_city');
          objArray["province"] = document.getElementById('u_province');
          objArray["country"] = document.getElementById('u_country');
          objArray["postal_code"] = document.getElementById('u_postal_code');
          objArray["fb_id"] = document.getElementById('u_fb_id');
          objArray["twitter_id"] = document.getElementById('u_twitter_id');
          objArray["reward_msg"] = document.getElementById('u_reward_msg');
          objArray["success_msg"] = document.getElementById('u_success_msg');
          objArray["note"] = document.getElementById('u_note');

          objArray["action"] = "<?php echo U('Admin/merchant_account_load');?>";
          merchantAccountInfoNextLoadInAdmin(objArray);
        });
        
        // Delete Merchant account process
        $("#merchant_account_delete_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["mid"] = document.getElementById('u_mid');
          objArray["currentMerchant"] = document.getElementById('merchant_acnt_current');
          objArray["totalMerchant"] = document.getElementById('merchant_acnt_total');
          objArray["first_name"] = document.getElementById('u_first_name');
          objArray["last_name"] = document.getElementById('u_last_name');
          objArray["merchant_name"] = document.getElementById('u_merchant_name');
          objArray["merchant_status"] = document.getElementById('u_merchant_status');
          objArray["web_page"] = document.getElementById('u_web_page');
          objArray["email"] = document.getElementById('u_email');
          objArray["phone"] = document.getElementById('u_phone');
          objArray["mobile"] = document.getElementById('u_mobile');
          objArray["address"] = document.getElementById('u_address');
          objArray["city"] = document.getElementById('u_city');
          objArray["province"] = document.getElementById('u_province');
          objArray["country"] = document.getElementById('u_country');
          objArray["postal_code"] = document.getElementById('u_postal_code');
          objArray["fb_id"] = document.getElementById('u_fb_id');
          objArray["twitter_id"] = document.getElementById('u_twitter_id');
          objArray["reward_msg"] = document.getElementById('u_reward_msg');
          objArray["success_msg"] = document.getElementById('u_success_msg');
          objArray["note"] = document.getElementById('u_note');
          objArray["action"] = "<?php echo U('Admin/merchant_account_delete');?>";

          merchantAcntDeleteProcessInAdmin(objArray);
        });
        
        // Update Mercahnt account process
        $("#merchant_account_update_button").click(function ()
        {
            var objArray = [];　 // Create a new array
            objArray["mid"] = document.getElementById('u_mid');
            objArray["currentMerchant"] = document.getElementById('merchant_acnt_current');
            objArray["totalMerchant"] = document.getElementById('merchant_acnt_total');
            objArray["first_name"] = document.getElementById('u_first_name');
            objArray["last_name"] = document.getElementById('u_last_name');
            objArray["merchant_name"] = document.getElementById('u_merchant_name');
            objArray["merchant_status"] = document.getElementById('u_merchant_status');
            objArray["web_page"] = document.getElementById('u_web_page');
            objArray["email"] = document.getElementById('u_email');
            objArray["phone"] = document.getElementById('u_phone');
            objArray["mobile"] = document.getElementById('u_mobile');
            objArray["address"] = document.getElementById('u_address');
            objArray["city"] = document.getElementById('u_city');
            objArray["province"] = document.getElementById('u_province');
            objArray["country"] = document.getElementById('u_country');
            objArray["postal_code"] = document.getElementById('u_postal_code');
            objArray["fb_id"] = document.getElementById('u_fb_id');
            objArray["twitter_id"] = document.getElementById('u_twitter_id');
            objArray["reward_msg"] = document.getElementById('u_reward_msg');
            objArray["success_msg"] = document.getElementById('u_success_msg');
            objArray["note"] = document.getElementById('u_note');
            objArray["action"] = "<?php echo U('Admin/merchant_account_update');?>";

            merchantAcntUpdateProcessInAdmin(objArray);
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
				<a class="navbar-brand"> <img src="/neo1/Public/images/ic_title_1.png"
					alt="Company Logo" width="200" height="50"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><a>Admin Account Dashboard</a></li>
					<li class="btn-group">
						<button role="button" class="navi-btn-default dropdown-toggle"
							data-toggle="dropdown">
							<?php echo ($ProfileName); ?> <span class="caret"></span>
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
        <p style="color: #eee; font-family: sans-serif; font-size: 50px !important; font-weight:;">
					Merchant Account Information</p>
			</div>
		</div>
		<div class="row ">
			<div class="col-sm-offset-1 col-sm-10">
				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading" style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
              <a href="#" class="general_text_link_6_style" id="merchant_acnt_report_refresh_id">Merchant Account Report (Click to refresh)</a>
            </div>
            <div class="panel-body" style="height: 250px">
              <table class="col-sm-offset-1 col-sm-10">
                <tbody>
                  <tr>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;">
                      Total Account:</td>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;" id="merchant_report_total_id">
                      <?php echo ($merchantReportInfo["acnt_report_total"]); ?></td>
                  </tr>
                  <tr>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;">
                      Account Initial:</td>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;" id="merchant_report_initial_id">
                      <?php echo ($merchantReportInfo["acnt_report_initial"]); ?></td>
                  </tr>
                  <tr>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;">
                      Account Enable:</td>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;" id="merchant_report_enable_id">
                      <?php echo ($merchantReportInfo["acnt_report_enable"]); ?></td>
                  </tr>
                  <tr>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;">
                      Account Disable:</td>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;" id="merchant_report_disable_id">
                      <?php echo ($merchantReportInfo["acnt_report_disable"]); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
					</div>
				</div>
				<div class=" col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading"
							style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
							Merchant Account Management</div>
						<div class="panel-body" style="height: 250px">
                <button type="button" id="merchant_account_update_modal" class="btn btn-primary btn-lg btn-block" data-toggle="modal"
                data-target="#merchantAccountUpdateModal">Update Merchant Account</button>
						</div>
					</div>
				</div>

				<div class=" col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-heading" style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
							New Merchant Account</div>
						<div class="panel-body" style="height: 250px">
							<button type="button" id="merchant_account_create_modal" class="btn btn-primary btn-lg btn-block" data-toggle="modal"
								data-target="#merchantAccountCreateModal">Create Merchant Account</button>
							<hr style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Foot part define-->
  <br>
  <br>
  <footer class="container-fluid " style="background-color: #ca856a; color: #ffffff; font-family: Montserrat, sans-serif; font-weight: bold; font-size: 20px !important;">
    <p>Neo Loyalty -- Admin Account Dash Board Signed in</p>
  </footer>


  <!-- Create merchant account Modal part define-->
  <div class="modal fade" id="merchantAccountCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title">Create Merchant Account</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="form_merchant_account_create" name="merchant_account_create" method="post" action="/neo1/index.php/admin/admin/admin_board_merchant.html">
            <div class="form-group">
              <label class="control-label col-sm-3" for="n_first_name">First Name:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="n_first_name" id="n_first_name" placeholder="Enter first name">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="n_last_name">Last Name:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="n_last_name" id="n_last_name" placeholder="Enter last name">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="n_merchant_name">Merchant Name:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="n_merchant_name" id="n_merchant_name" placeholder="Enter merchant name">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="n_email">Email:</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="n_email" id="n_email" placeholder="Enter email">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="n_phone">Phone:</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="n_phone" id="n_phone" placeholder="Enter phone number">
              </div>
            </div>
  
            <div class="form-group">
              <label class="control-label col-sm-3" for="n_mobile">Mobile:</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="n_mobile" id="n_mobile" placeholder="Enter mobile number">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="merchant_account_create_button">Create</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  <!-- /.modal -->
  </div>

  <!-- Update merchant account Modal part define-->
  <div class="modal fade" id="merchantAccountUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title">Update Merchant Account</h4>
        </div>
        <div class="modal-body">
          <table class="col-sm-offset-2 col-sm-8">
            <tbody>
              <tr>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222;">
                  <button type="button" class="btn btn-primary" id="merchant_load_previous">Previous  </button>
                </td>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222; background-color: #ca856a">
                  <p id="merchant_acnt_current">1</p>
                </td>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222; background-color: #ca856a">
                  <p>of</p>
                </td>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222; background-color: #ca856a">
                  <p id="merchant_acnt_total">100</p>
                </td>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222;">
                  <button type="button" class="btn btn-primary" id="merchant_load_next">Next </button>
                </td>
              </tr>
            </tbody>
          </table>

          <form class="form-horizontal" id="form_merchant_account_update"
            name="merchant_account_update" method="post" action="/neo1/index.php/admin/admin/admin_board_merchant.html">
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_mid">Merchant ID:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_mid" id="u_mid" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_first_name">First
                Name:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_first_name"
                  id="u_first_name" placeholder="Enter first name">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_last_name">Last
                Name:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_last_name"
                  id="u_last_name" placeholder="Enter last name">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="u_merchant_name">Merchant
                Name:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_merchant_name" id="u_merchant_name" placeholder="Enter merchant name">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_merchant_status">Merchant Status:</label>
              <div class="col-sm-9">
                <select class="form-control" name="u_merchant_status" id="u_merchant_status">
                
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="u_web_page">Merchant Web Site:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_web_page" id="u_web_page" placeholder="Enter Merchant Web Site Here...">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_email">Email:</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="u_email" id="u_email" placeholder="Enter email">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="u_phone">Phone:</label>
              <div class="col-sm-9">
                <input type="tel" class="form-control" name="u_phone" id="u_phone" placeholder="Enter phone number">
              </div>
            </div>
  
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_mobile">Mobile:</label>
              <div class="col-sm-9">
                <input type="tel" class="form-control" name="u_mobile" id="u_mobile" placeholder="Enter mobile number">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_address">Address:</label>
              <div class="col-sm-9">
                <input type="tel" class="form-control" name="u_address" id="u_address" placeholder="Enter address here...">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_city">City:</label>
              <div class="col-sm-9">
                <input type="tel" class="form-control" name="u_city" id="u_city" placeholder="Enter city here...">
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_province">Province/State:</label>
              <div class="col-sm-9">
                <select class="form-control" name="u_province" id="u_province">
                
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_country">Country:</label>
              <div class="col-sm-9">
                <select class="form-control" name="u_country" id="u_country">
                
                </select>
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_postal_code">Postal Code:</label>
              <div class="col-sm-9">
                <input type="tel" class="form-control" name="u_postal_code" id="u_postal_code" placeholder="Enter postal code here...">
              </div>
            </div>
            
            
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_fb_id">Facebook Id:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_fb_id" id="u_fb_id" placeholder="Enter Facebook ID">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_twitter_id">Twitter Id:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_twitter_id" id="u_twitter_id" placeholder="Enter Twitter ID">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_reward_msg">Reward Message (Max 1000 Characters):</label>
              <div class="col-sm-9">
                <textarea class="form-control" rows="5" id="u_reward_msg" placeholder="Enter Reward Message Here..."></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_success_msg">Success Message (Max 1000 Characters):</label>
              <div class="col-sm-9">
                <textarea class="form-control" rows="5" id="u_success_msg" placeholder="Enter Register Success Message Here..."></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_note">Note (Max 2000 Characters):</label>
              <div class="col-sm-9">
                <textarea class="form-control" rows="10" id="u_note" placeholder="Enter Note Here..."></textarea>
              </div>
            </div>
            
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="merchant_account_delete_button">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="merchant_account_update_button">Update</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal -->
  </div>







</body>
</html>