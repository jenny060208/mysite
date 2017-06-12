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
#creditCardPayProcessModal {
	margin: 100px 0 0 0px;
	/* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}

#etPayProcessModal {
	margin: 100px 0 0 0px;
	/* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}
</style>




<script type="text/javascript">
      jQuery(function($)
      {
        $(document).ready(function()
        {
          var objArray = [];　 // Create a new array
          
          //Highlight the active button
          // First one is hightlighted as active button
          objArray.push(document.getElementById("button_product_id")); 
          objArray.push(document.getElementById("button_profile_id")); 
          objArray.push(document.getElementById("button_general_id")); 
          objArray.push(document.getElementById("button_status_id")); 
          db1ToolButtonHighlight(objArray);
          
          //Clear array
          while(objArray.length > 0) {objArray.pop();}
          //Load product information
          objArray["productName"] = document.getElementById("product_name_id");
          objArray["productDetail"] = document.getElementById("product_detail_id");

          objArray["setUpFee"] = document.getElementById("set_up_fee_id");
          objArray["monthlyFee"] = document.getElementById("monthly_fee_id");
 
          objArray["serviceTerm"] = document.getElementById("service_term_id");
          objArray["store"] = document.getElementById("store_quantity_id");
          objArray["amount"] = document.getElementById("amount_id");
          objArray["amountTax"] = document.getElementById("amount_tax_id");
          
          db1ProductInfoPreload(objArray, <?php echo ($productInfoJson); ?>);

          //Clear array
          while(objArray.length > 0) {objArray.pop();}
          //Preload Order information
          objArray["currentOrder"] = document.getElementById("order_indication_current_id");
          objArray["totalOrder"] = document.getElementById("order_indication_total_id");
          objArray["orderId"] = document.getElementById("order_id");
          objArray["orderStatus"] = document.getElementById("order_status_id");
          objArray["orderProductName"] = document.getElementById("order_product_name_id");
          objArray["orderProductDetail"] = document.getElementById("order_product_detail_id");
          objArray["orderSetUpFee"] = document.getElementById("order_set_up_fee_id");
          objArray["orderMonthlyFee"] = document.getElementById("order_monthly_fee_id");
          objArray["orderServiceTerm"] = document.getElementById("order_month_id");
          objArray["orderStore"] = document.getElementById("order_store_id");
          objArray["orderAmount"] = document.getElementById("order_amount_id");
          objArray["orderAmountTax"] = document.getElementById("order_total_amount_id");
          objArray["orderPaymentMethod"] = document.getElementById("order_payment_method_id");
          objArray["orderPaymentInfo"] = document.getElementById("order_payment_info_id");
          objArray["orderPayment"] = document.getElementById("order_amount_paid_id");
          objArray["orderNote"] = document.getElementById("order_note_id");
          db1OrderInfoPreload(objArray, <?php echo ($orderInfoJson); ?>);

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
        
        // Process the product name change
        var objProductName = document.getElementById("product_name_id");
        $(objProductName).change(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["productName"] = document.getElementById("product_name_id");
          objArray["productDetail"] = document.getElementById("product_detail_id");
          objArray["setUpFee"] = document.getElementById("set_up_fee_id");
          objArray["monthlyFee"] = document.getElementById("monthly_fee_id");
        
          objArray["serviceTerm"] = document.getElementById("service_term_id");
          objArray["store"] = document.getElementById("store_quantity_id");
          objArray["amount"] = document.getElementById("amount_id");
          objArray["amountTax"] = document.getElementById("amount_tax_id");
          
          db1ProductNameChange(objArray);
        }); 
        
        // Process the monthly term change
        var objServiceTerm = document.getElementById("service_term_id");
        $(objServiceTerm).change(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["productName"] = document.getElementById("product_name_id");
          objArray["productDetail"] = document.getElementById("product_detail_id");
          objArray["setUpFee"] = document.getElementById("set_up_fee_id");
          objArray["monthlyFee"] = document.getElementById("monthly_fee_id");
          
          objArray["serviceTerm"] = document.getElementById("service_term_id");
          objArray["store"] = document.getElementById("store_quantity_id");
          objArray["amount"] = document.getElementById("amount_id");
          objArray["amountTax"] = document.getElementById("amount_tax_id");

          db1ProductNameChange(objArray);
        }); 
        
        // Process the Store quantity change
        var objStoreQuantity = document.getElementById("store_quantity_id");
        $(objStoreQuantity).change(function ()
        {
          var objArray = [];　 // Create a new array
          
          objArray["productName"] = document.getElementById("product_name_id");
          objArray["productDetail"] = document.getElementById("product_detail_id");
          objArray["setUpFee"] = document.getElementById("set_up_fee_id");
          objArray["monthlyFee"] = document.getElementById("monthly_fee_id");
        
          objArray["serviceTerm"] = document.getElementById("service_term_id");
          objArray["store"] = document.getElementById("store_quantity_id");
          objArray["amount"] = document.getElementById("amount_id");
          objArray["amountTax"] = document.getElementById("amount_tax_id");
          
          db1ProductNameChange(objArray);
        }); 
        
        // My order previous one process
        var objOrderPrevoius = document.getElementById("order_previous_process_id");
        $(objOrderPrevoius).click(function ()
        {
          var objArray = [];　 // Create a new array
          //Load previous Order information
          objArray["currentOrder"] = document.getElementById("order_indication_current_id");
          objArray["totalOrder"] = document.getElementById("order_indication_total_id");
          objArray["orderId"] = document.getElementById("order_id");
          objArray["orderStatus"] = document.getElementById("order_status_id");
          objArray["orderProductName"] = document.getElementById("order_product_name_id");
          objArray["orderProductDetail"] = document.getElementById("order_product_detail_id");
          objArray["orderSetUpFee"] = document.getElementById("order_set_up_fee_id");
          objArray["orderMonthlyFee"] = document.getElementById("order_monthly_fee_id");
          objArray["orderServiceTerm"] = document.getElementById("order_month_id");
          objArray["orderStore"] = document.getElementById("order_store_id");
          objArray["orderAmount"] = document.getElementById("order_amount_id");
          objArray["orderAmountTax"] = document.getElementById("order_total_amount_id");
          objArray["orderPaymentMethod"] = document.getElementById("order_payment_method_id");
          objArray["orderPaymentInfo"] = document.getElementById("order_payment_info_id");
          objArray["orderPayment"] = document.getElementById("order_amount_paid_id");
          objArray["orderNote"] = document.getElementById("order_note_id");
          objArray["action"]   = "<?php echo U('Business/db1PreviousOrderProcess');?>";
          db1ProviousOrderProcess(objArray);
        });
        // My order next one process
        var objOrderNext = document.getElementById("order_next_process_id");
        $(objOrderNext).click(function ()
        {
          var objArray = [];　 // Create a new array
          //Load previous Order information
          objArray["currentOrder"] = document.getElementById("order_indication_current_id");
          objArray["totalOrder"] = document.getElementById("order_indication_total_id");
          objArray["orderId"] = document.getElementById("order_id");
          objArray["orderStatus"] = document.getElementById("order_status_id");
          objArray["orderProductName"] = document.getElementById("order_product_name_id");
          objArray["orderProductDetail"] = document.getElementById("order_product_detail_id");
          objArray["orderSetUpFee"] = document.getElementById("order_set_up_fee_id");
          objArray["orderMonthlyFee"] = document.getElementById("order_monthly_fee_id");
          objArray["orderServiceTerm"] = document.getElementById("order_month_id");
          objArray["orderStore"] = document.getElementById("order_store_id");
          objArray["orderAmount"] = document.getElementById("order_amount_id");
          objArray["orderAmountTax"] = document.getElementById("order_total_amount_id");
          objArray["orderPaymentMethod"] = document.getElementById("order_payment_method_id");
          objArray["orderPaymentInfo"] = document.getElementById("order_payment_info_id");
          objArray["orderPayment"] = document.getElementById("order_amount_paid_id");
          objArray["orderNote"] = document.getElementById("order_note_id");
          objArray["action"]   = "<?php echo U('Business/db1NextOrderProcess');?>";
          db1NextOrderProcess(objArray);
        });
        
        $("#et_pay_modal").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["totalAmount"]   = document.getElementById("amount_tax_id");
          objArray["payEmail"] = document.getElementById("et_pay_email_info_id");
          objArray["etPayTotalAmount"] = document.getElementById("et_pay_amount_id");
          objArray["etPayEmail"]   =  document.getElementById("et_pay_email_id");

          loadEtPayInfo(objArray);
        });
        
        $("#cc_pay_modal").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["totalAmount"]   = document.getElementById("amount_tax_id");
          objArray["payEmail"] = document.getElementById("cc_pay_email_info_id");
          objArray["paypalTotalAmount"] = document.getElementById("cc_pay_amount_id");
          objArray["paypalEmail"]   =  document.getElementById("cc_pay_email_id");

          loadCreditCardPayInfo(objArray);
        });
        
        //Et pay button process
        $("#et_payment_process_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          //Load product information
          objArray["form"] = document.getElementById("form_product_info");
          objArray["action"] = "<?php echo U('Business/db1_order_commit_et');?>";
          db1OrderCommitProcess(objArray);

          // Clear array
          while(objArray.length > 0) {objArray.pop();}
            
          objArray["currentOrder"] = document.getElementById("order_indication_current_id");
          objArray["totalOrder"] = document.getElementById("order_indication_total_id");
          objArray["orderId"] = document.getElementById("order_id");
          objArray["orderStatus"] = document.getElementById("order_status_id");
          objArray["orderProductName"] = document.getElementById("order_product_name_id");
          objArray["orderProductDetail"] = document.getElementById("order_product_detail_id");
          objArray["orderSetUpFee"] = document.getElementById("order_set_up_fee_id");
          objArray["orderMonthlyFee"] = document.getElementById("order_monthly_fee_id");
          objArray["orderServiceTerm"] = document.getElementById("order_month_id");
          objArray["orderStore"] = document.getElementById("order_store_id");
          objArray["orderAmount"] = document.getElementById("order_amount_id");
          objArray["orderAmountTax"] = document.getElementById("order_total_amount_id");
          objArray["orderPaymentMethod"] = document.getElementById("order_payment_method_id");
          objArray["orderPaymentInfo"] = document.getElementById("order_payment_info_id");
          objArray["orderPayment"] = document.getElementById("order_amount_paid_id");
          objArray["orderNote"] = document.getElementById("order_note_id");
         
          objArray["action"]   = "<?php echo U('Business/db1LastOrderProcess');?>";
            
          db1LastOrderProcess(objArray);
        });
        
        //Credit card / paypal pay button process
        $("#cc_payment_process_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          //Load product information
          objArray["form"] = document.getElementById("form_product_info");
          objArray["action"] = "<?php echo U('Business/db1_order_commit_cc');?>";

          db1OrderCommitProcess(objArray);

          // Clear array
          while(objArray.length > 0) {objArray.pop();}
            
          objArray["currentOrder"] = document.getElementById("order_indication_current_id");
          objArray["totalOrder"] = document.getElementById("order_indication_total_id");
          objArray["orderId"] = document.getElementById("order_id");
          objArray["orderStatus"] = document.getElementById("order_status_id");
          objArray["orderProductName"] = document.getElementById("order_product_name_id");
          objArray["orderProductDetail"] = document.getElementById("order_product_detail_id");
          objArray["orderSetUpFee"] = document.getElementById("order_set_up_fee_id");
          objArray["orderMonthlyFee"] = document.getElementById("order_monthly_fee_id");
          objArray["orderServiceTerm"] = document.getElementById("order_month_id");
          objArray["orderStore"] = document.getElementById("order_store_id");
          objArray["orderAmount"] = document.getElementById("order_amount_id");
          objArray["orderAmountTax"] = document.getElementById("order_total_amount_id");
          objArray["orderPaymentMethod"] = document.getElementById("order_payment_method_id");
          objArray["orderPaymentInfo"] = document.getElementById("order_payment_info_id");
          objArray["orderPayment"] = document.getElementById("order_amount_paid_id");
          objArray["orderNote"] = document.getElementById("order_note_id");
         
          objArray["action"]   = "<?php echo U('Business/db1LastOrderProcess');?>";
            
          db1LastOrderProcess(objArray);
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

		<div class="row" style="margin-top: 50px;">
			<div class="col-sm-offset-1 col-sm-5">
				<!-- Account Profile table-->
				<div class="panel panel-default">
					<div class="panel-heading"
						style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
						Neo Service Type</div>
					<div class="panel-body">
						<form class="form-horizontal" id="form_product_info"
							name="form_product_info" method="post"
							action="/neo1/index.php/home/business/business_db1_product.html">
							<div class="form-group">
								<label class="control-label col-sm-3" for="product_name_id">Product
									Name:</label>
								<div class="col-sm-9">
									<select class="form-control" name="product_name_id"
										id="product_name_id">

									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="product_detail_id">Product
									Detail:</label>
								<div class="col-sm-9">
									<select class="form-control" name="product_detail_id"
										id="product_detail_id" disabled>

									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="set_up_fee_id">Set Up
									Fee:</label>
								<div class="col-sm-9">
									<select class="form-control" name="set_up_fee_id"
										id="set_up_fee_id" disabled>

									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="monthly_fee_id">Monthly
									Fee:</label>
								<div class="col-sm-9">
									<select class="form-control" name="monthly_fee_id"
										id="monthly_fee_id" disabled>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="service_term_id">Service
									Term (Months):</label>
								<div class="col-sm-9">
									<input type="number" class="form-control"
										name="service_term_id" id="service_term_id" min="1" max="12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3" for="store_quantity_id">Quantity
									of Stores :</label>
								<div class="col-sm-9">
									<input type="number" class="form-control"
										name="store_quantity_id" id="store_quantity_id" min="1"
										max="32">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="amount_id">Total
									Amount ($):</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="amount_id"
										id="amount_id" readonly="readonly">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-3" for="amount_tax_id">Total
									amount include tax ($):</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="amount_tax_id"
										id="amount_tax_id" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<table class="col-sm-offset-1 col-sm-10">
									<tbody>
										<tr>
											<td style="vertical-align: middle; padding: 10px">
												<button type="button" id="cc_pay_modal"
													class="submit_button_style" data-toggle="modal"
													data-target="#creditCardPayProcessModal">Pay by Credit Card
													/ Paypal</button>
											</td>
											<td style="vertical-align: middle; padding: 10px">
												<button type="button" id="et_pay_modal"
													class="submit_button_style" data-toggle="modal"
													data-target="#etPayProcessModal">Pay by Bank Email Transfer</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-5">
				<!-- Account Status table-->
				<table class="table table-bordered">
					<caption class="bn_db1_payment_style_1">
						My Order <a href="#" class="general_text_link_6_style"
							id="order_previous_process_id"><span
							class="glyphicon glyphicon-menu-left"></span></a> <a
							class="general_text_link_7_style"
							id="order_indication_current_id"> </a>of <a
							class="general_text_link_7_style" id="order_indication_total_id">
						</a> <a href="#" class="general_text_link_6_style"
							id="order_next_process_id"><span
							class="glyphicon glyphicon-menu-right"></span></a>
					</caption>
					<tbody>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Order
								ID:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Order
								Status:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_status_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Product
								Name:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_product_name_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Product
								Detail:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_product_detail_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Set
								Up Fee:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_set_up_fee_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Monthly
								Fee:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_monthly_fee_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Months:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_month_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Store
								Quantity:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_store_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Total
								Amount ($):</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_amount_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Total
								Amount include tax($):</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_total_amount_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Amount
								Paid ($):</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_amount_paid_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Payment
								Method:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_payment_method_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Payment
								Info:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_payment_info_id"></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold;">Order
								Note:</td>
							<td style="vertical-align: middle; text-align: left;"
								id="order_note_id"></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered" style="margin-top: 50px;">
					<caption class="bn_db1_payment_style_1">Payment Method</caption>
					<tbody>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold; vertical-align: middle; text-align: left">Email-Transfer:</td>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold"
								id="et_pay_email_info_id"><?php echo ($paymentMethodInfo["ETransfer"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold; vertical-align: middle; text-align: left">Paypal:</td>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold"
								id="cc_pay_email_info_id"><?php echo ($paymentMethodInfo["paypal"]); ?></td>
						</tr>
						<tr>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold; vertical-align: middle; text-align: left">Note:</td>
							<td
								style="vertical-align: middle; text-align: left; font-weight: bold"><?php echo ($paymentMethodInfo["note"]); ?></td>
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
							action="/neo1/index.php/home/business/business_db1_product.html">
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
		<div class="row">
			<div class="col-sm-offset-1 col-sm-5">
				<p>Neo Reward -- Get Your Clients Connected</p>
			</div>
		</div>
	</footer>

	<!-- Pay by E-transfer Modal part define-->
	<div class="modal fade" id="etPayProcessModal" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center"
					style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
					<h4 class="modal-title">Pay by Bank Email Transfer</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td
									style="vertical-align: middle; text-align: left; font-weight: bold;">Total
									Amount:</td>
								<td style="vertical-align: middle; text-align: left;"
									id="et_pay_amount_id"></td>
							</tr>
							<tr>
								<td
									style="vertical-align: middle; text-align: left; font-weight: bold;">Pay
									to This Email:</td>
								<td style="vertical-align: middle; text-align: left;"
									id="et_pay_email_id"></td>
							</tr>
							<tr>
								<td
									style="vertical-align: middle; text-align: left; font-weight: bold;">Note:</td>
								<td style="vertical-align: middle; text-align: left;"
									id="et_pay_note_id">Please send us a notice with the payment
									info and we will contact you ASAP Thanks!</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary"
						id="et_payment_process_button">Pay Order</button>

				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>

	<!-- Pay by Credit card Modal part define-->
	<div class="modal fade" id="creditCardPayProcessModal" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center"
					style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
					<h4 class="modal-title">Pay by Credit Card</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td
									style="vertical-align: middle; text-align: left; font-weight: bold;">Total
									Amount:</td>
								<td style="vertical-align: middle; text-align: left;"
									id="cc_pay_amount_id"></td>
							</tr>
							<tr>
								<td
									style="vertical-align: middle; text-align: left; font-weight: bold;">Pay
									to This Email:</td>
								<td style="vertical-align: middle; text-align: left;"
									id="cc_pay_email_id"></td>
							</tr>
							<tr>
								<td
									style="vertical-align: middle; text-align: left; font-weight: bold;">Note:</td>
								<td style="vertical-align: middle; text-align: left;"
									id="cc_pay_note_id">Please send us a notice with the payment
									info and we will contact you ASAP Thanks!</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary"
						id="cc_payment_process_button">Pay Order</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal -->
	</div>
</body>
</html>