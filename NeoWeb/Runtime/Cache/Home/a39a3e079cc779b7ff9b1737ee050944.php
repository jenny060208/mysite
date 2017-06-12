<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
<link rel="stylesheet" href="/neo1/Public/css/mainpage.css" type="text/css">
<!-- Script files definition -->
<script type="text/javascript" src="/neo1/Public/js/form_utilities.js"></script>
<script src="https://use.fontawesome.com/12eb9f213d.js"></script>

<script type="text/javascript">
      jQuery(function($)
      {
        <!-- Process the get in touch form -->
        $("#button_general_enquiry_msg_form").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('general_enquiry_msg_form');
          objArray["name"] = document.getElementById('general_enquiry_name');
          objArray["email"] = document.getElementById('general_enquiry_email');
          objArray["msg"] = document.getElementById('general_enquiry_fm_message');
          objArray["action"] = "<?php echo U('Index/getInTouchProc');?>";
          generalEnquiryFormProcess(objArray);
        });
        
        <!-- Process the get more info form -->
        $("#button_get_more_info").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('get_more_info_form');
          objArray["name"] = document.getElementById('more_name');
          objArray["email"] = document.getElementById('more_email');
          objArray["phone"] = document.getElementById('more_phone');
          objArray["company_name"] = document.getElementById('more_company_name');
          objArray["action"] = "<?php echo U('Index/getMoreServiceInfoProc');?>";
          getMoreInfoFormProcess(objArray);
          
          
      
          
          
          
        });
        
      });
    </script>




<style>
.fa-vc {
	line-height: inherit !important;
}
</style>


</head>

<body id="mainPage" data-spy="scroll" data-target=".navbar"
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
				src="/neo1/Public/images/ic_title_1.png" alt="Company Logo" width="200"
				height="50"></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#home">Home</a></li>
				<li><a href="#services">Services</a></li>
				<li><a href="#features">Features</a></li>
				<li><a href="#solution">Solutions</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a class="btn btn-default navi-btn-default"
					href="<?php echo U('Business/business_register');?>" role="button">Merchant
						Sign Up</a></li>
			</ul>
		</div>
	</div>
</nav>

	<!-- user part -->
	<div id="home" class="container-fluid text-center"
		style="background-color: #ca856a; color: #fff; font-family: Montserrat, sans-serif; padding: 100px 25px;">
		<br>
		<br> <br>
		<br>
		<p
			style="color: #fff; font-family: sans-serif; font-size: 55px !important;">
			Know Your Customer to Make Marketing Easy</p>

		<p
			style="color: #cccccc; font-family: sans-serif; font-size: 35px !important;">Get
			your customers engage and retain.</p>
		<br> <a href="#more_info" class="get_info_button_style">GET
			MORE INFORMATION</a> <br>
		<br>
		<br>
		<p
			style="color: #dddddd; font-family: sans-serif; font-size: 25px !important; font-weight: bold;">Give
			your customers more personalized experiences - both in and out of
			store</p>
		<p
			style="color: #dddddd; font-family: sans-serif; font-size: 25px !important; font-weight: bold;">
			- and increase your revenue from returning customers.</p>
	</div>

	<!-- Service part -->
	<div id="services" class="container-fluid text-center"
		style="background-color: #eeeeee; color: #222222; font-family: Montserrat, sans-serif; padding: 50px 25px; margin-top: 0px;">


		<p
			style="color: #444444; font-family: sans-serif; font-size: 25px !important;">
			THE EASIEST DIGITAL LOYALTY SYSTEM FOR INDEPENDENT BUSINESSES</p>
		<p
			style="color: #444444; font-family: sans-serif; font-size: 25px !important;">
			Create and launch your own in-store loyalty program in just 3 minutes
		</p>

		<p
			style="color: #222222; font-family: sans-serif; font-size: 35px !important; font-weight: bold;">
			Find out how you can drive more repeat customers automatically with a
			quick demo.</p>
		<br>

		<div class="row ">
			<div class="col-sm-offset-2 col-sm-8">
				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<img src="/neo1/Public/images/customerAttraction.jpg" alt="Merchant Logo"
								class="img-rounded img-responsive center-block">
						</div>
						<div class="panel-footer text-center">
							<p class="text-center"
								style="font-size: 25px; font-weight: bold;">Attract More
								Customers</p>
							<p class="text-center" style="font-size: 20px">Turn your
								store front traffic to potential customer</p>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<img src="/neo1/Public/images/WorkFlow_3.jpg" alt="Merchant Logo"
								class="img-rounded img-responsive center-block">
						</div>
						<div class="panel-footer text-center">
							<p class="text-center"
								style="font-size: 25px; font-weight: bold;">Personalized
								Marketing Campaigns</p>
							<p class="text-center" style="font-size: 20px">Send the right
								SMS message to the right customer at the right time and watch
								your revenue skyrocket</p>
						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<img src="/neo1/Public/images/customerLoyalty.jpg" alt="Merchant Logo"
								class="img-rounded img-responsive center-block">
						</div>
						<div class="panel-footer text-center">
							<p class="text-center"
								style="font-size: 25px; font-weight: bold;">Build Customer
								Database</p>
							<p class="text-center" style="font-size: 20px">Segment your
								customers and deploy targeted promotion message right from your
								dashboard</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br> <br>
	</div>

	<!-- feature part -->
	<div id="features" class="container-fluid text-center"
		style="background-color: #777777; color: #fff; font-family: Montserrat, sans-serif; padding: 0px 25px;">
		<p
			style="color: #eee; font-family: sans-serif; font-size: 50px !important; font-weight:;">
			Amazing Feature For Your Business</p>
		<br>
		<div class="row ">
			<div class="col-sm-offset-2 col-sm-8">
				<img src="/neo1/Public/images/NeoFeature.jpg" alt="Neo Features"
					class="img-rounded img-responsive center-block">
			</div>
		</div>
		<br>
		<br>
		<div class="row ">
			<div class="col-sm-offset-2 col-sm-8">
				<p
					style="color: #eee; font-family: sans-serif; font-size: 50px !important; font-weight:;">
					Here's how it works</p>
			</div>
		</div>
		<div class="row ">
			<div class="col-sm-offset-3 col-sm-6">
				<div class="col-sm-offset-2 col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<img src="/neo1/Public/images/WorkFlow_1.jpg" alt="Neo Work Flow 1"
								class="img-rounded img-responsive center-block">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-default" style="font-size: 25px">
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
			</div>
		</div>
		<br> <br>

		<div class="row ">
			<div class="col-sm-offset-3 col-sm-6">
				<div class="col-sm-offset-2 col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<img src="/neo1/Public/images/WorkFlow_2.jpg" alt="Neo Work Flow 2"
								class="img-rounded img-responsive center-block">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<p class="text-left"
								style="color: #555555; font-family: sans-serif; font-size: 30px !important;">
								Customers sign up easily by scan the QR code</p>
							<p class="text-left"
								style="color: #555555; font-family: sans-serif; font-size: 20px !important; font-weight:;">
								Easy sign up by scan the QR code logo hanging up in your store
								or store front. No in store service is required.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br> <br>

		<div class="row ">
			<div class="col-sm-offset-3 col-sm-6">
				<div class="col-sm-offset-2 col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<img src="/neo1/Public/images/WorkFlow_3.jpg" alt="Neo Work Flow 3"
								class="img-rounded img-responsive center-block">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<p class="text-left"
								style="color: #555555; font-family: sans-serif; font-size: 30px !important;">
								Run your marketing & promotion campaign from your dashboard</p>
							<p class="text-left"
								style="color: #555555; font-family: sans-serif; font-size: 20px !important; font-weight:;">
								Neo enables you run customized marketing or promotion campaign
								to sign up customers with SMS texting and email.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br> <br>

		<div class="row ">
			<div class="col-sm-offset-3 col-sm-6">
				<div class="col-sm-offset-2 col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<img src="/neo1/Public/images/WorkFlow_4.jpg" alt="Neo Work Flow 4"
								class="img-rounded img-responsive center-block">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 250px">
							<p class="text-left"
								style="color: #555555; font-family: sans-serif; font-size: 30px !important;">
								Know more about your customer and data</p>
							<p class="text-left"
								style="color: #555555; font-family: sans-serif; font-size: 20px !important; font-weight:;">
								Powered by Neo, you will know more about your customers and own
								all of the data, including contact information and notes.
								Attract more customers and keep them engaged.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br> <br>

	</div>

	<!-- Solution part -->
	<div id="solution" class="container-fluid text-center"
		style="background-color: #eeeeee; color: #222222; font-family: Montserrat, sans-serif; padding: 50px 25px; margin-top: 0px;">

		<div class="row ">
			<div class="col-sm-offset-2 col-sm-8">
				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 170px; color: #0055aa;">
							<i class="fa fa-bullhorn fa-4x fa-align-center fa-vc"></i>
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 25px; color: #0055aa;">Ad
								/ Marketing Agencies</p>

						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 170px; color: #0055aa;">
							<i class="fa fa-shopping-bag fa-4x fa-align-center fa-vc"></i>
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 25px; color: #0055aa;">Super
								Stores / Shops</p>

						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 170px; color: #0055aa;">
							<i class="fa fa-cutlery fa-4x fa-align-center fa-vc"></i>
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 25px; color: #0055aa;">Restaurants</p>

						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row ">
			<div class="col-sm-offset-2 col-sm-8">
				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 170px; color: #0055aa;">
							<i class="fa fa-beer fa-4x fa-align-center fa-vc"></i>
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 25px; color: #0055aa;">Bars</p>

						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 170px; color: #0055aa;">
							<i class="fa fa-newspaper-o fa-4x fa-align-center fa-vc"></i>
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 25px; color: #0055aa;">Media</p>

						</div>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="panel panel-default" style="font-size: 25px">
						<div class="panel-body" style="height: 170px; color: #0055aa;">
							<i class="fa fa-university fa-4x fa-align-center fa-vc"></i>
						</div>
						<div class="panel-footer text-center">
							<p class="text-center" style="font-size: 25px; color: #0055aa;">Trads
								Shows / Exhibitions</p>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- More info part -->
	<div id="more_info" class="container-fluid text-center"
		style="background-color: #ca856a; color: #fff; font-family: Montserrat, sans-serif; padding: 0px 25px;">
		<br> <br>
		<form class="form-inline" id="get_more_info_form"
	name="get_more_info_form" method="post" action="/neo1/">
	<div class="form-group">
		<label for="more_name"></label> <input type="text"
			class="form-control" id="more_name" placeholder="Your Name">
	</div>
	<div class="form-group">
		<label for="more_email"></label> <input type="email"
			class="form-control" id="more_email" placeholder="Email">
	</div>
	<div class="form-group">
		<label for="more_phone"></label> <input type="tel"
			class="form-control" id="more_phone" placeholder="Phone">
	</div>
	<div class="form-group">
		<label for="more_company_name"></label> <input type="text"
			class="form-control" id="more_company_name"
			placeholder="Company Name">
	</div>
	<button type="submit" class="demo_button_style"
		id="button_get_more_info">Get More Information</button>
</form>
		<br>
	</div>

	<!-- business part -->
	<div id="contact" class="container-fluid text-center"
		style="background-color: #eeeeee; color: #fff; font-family: Montserrat, sans-serif; padding: 0px 25px;">
		<br>
		<p
	style="color: #333333; font-family: sans-serif; font-size: 35px !important;">Get
	In Touch</p>

<div class="row" style="margin-top: 20px;">
	<div class="col-sm-offset-3 col-sm-6">
		<div class="panel panel-default text-center"
			style="border: 2px solid #c3c3c3; box-shadow: 5px 5px 5px grey;">
			<div class="panel-body">
				<form class="form-horizontal" id="general_enquiry_msg_form"
					name="general_enquiry_msg_form" method="post" action="/neo1/">
					<div class="form-group">
						<label class="control-label col-sm-2"
							style="color: #222222; font-weight: bold"
							for="general_enquiry_name">Full Name:</label>
						<div class="col-sm-10">
							<input type="email" class="form-control"
								id="general_enquiry_name" name="general_enquiry_name"
								placeholder="Enter full name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"
							style="color: #222222; font-weight: bold"
							for="general_enquiry_email">Email:</label>
						<div class="col-sm-10">
							<input type="email" class="form-control"
								id="general_enquiry_email" name="general_enquiry_email"
								placeholder="Enter email">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"
							style="color: #222222; font-weight: bold"
							for="general_enquiry_fm_message">Message: (Maximum 300
							characters)</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="general_enquiry_fm_message"
								name="general_enquiry_fm_message"
								placeholder="Enter Your message here..." rows="5"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div>
							<button type="button" id="button_general_enquiry_msg_form"
								class="demo_button_style">SEND MESSAGE</button>
						</div>
					</div>
				</form>
			</div>
		</div>
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
				<img src="/neo1/Public/images/ic_title_1.png" alt="Company Logo" width="200"
					height="50">
			</div>

			<div class="col-sm-5">
				<a href="http://www.facebook.com" target="_blank"> <span><img
						border="0" src="/neo1/Public/images/facebook_icon.gif" alt="facebook icon"
						width="50" height="50"></span>
				</a> <a href="http://www.twitter.com" target="_blank"> <span><img
						border="0" src="/neo1/Public/images/Twitterbird_icon.png" alt="facebook icon"
						width="50" height="50"></span>
				</a> <a href="http://www.google.com" target="_blank"> <span><img
						border="0" src="/neo1/Public/images/google_plus_icon.png" alt="facebook icon"
						width="50" height="50"></span>
				</a> <a href="mailto:elecdesign8@gmail.com" target="_blank"> <span><img
						border="0" src="/neo1/Public/images/email_icon.png" alt="facebook icon"
						width="50" height="50"></span>
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
						<a href="<?php echo U('Index/index');?>" class="general_text_link_2_style">FOR
							CONSUMERS</a>
					</p>

					<p style="font-size: 22px; font-weight: bold;">
						<a href="<?php echo U('User/insert');?>" class="general_text_link_style">FIND
							LOCATIONS</a>
					</p>

					<p style="font-size: 22px; font-weight: bold;">
						<a href="<?php echo U('User/signIn');?>" class="general_text_link_style">SIGN
							IN</a>
					</p>

					<p style="font-size: 22px; font-weight: bold;">
						<a href="http://www.neoloyalty.com"
							class="general_text_link_style">CONSUMER BLOG</a>
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
						<a href="http://www.neoloyalty.com"
							class="general_text_link_style">SMALL BUSINESS BLOG</a>
					</p>

					<p style="font-size: 22px; font-weight: bold;">&nbsp;</p>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="panel panel-primary text-left"
					style="background-color: rgba(255, 255, 255, 0); border: 0;">
					<p style="font-size: 22px; font-weight: bold;">
						<a href="http://www.neoloyalty.com"
							class="general_text_link_2_style">ABOUT US</a>
					</p>

					<p style="font-size: 22px; font-weight: bold;">
						<a href="http://www.neoloyalty.com"
							class="general_text_link_style">CAREERS</a>
					</p>

					<p style="font-size: 22px; font-weight: bold;">
						<a href="http://www.neoloyalty.com"
							class="general_text_link_style">FAQ</a>
					</p>

					<p style="font-size: 22px; font-weight: bold;">
						<a href="http://www.neoloyalty.com"
							class="general_text_link_style">LEGAL</a>
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
					Loyalty ©2017</p>
			</div>
		</div>
	</div>

</div>


</body>
</html>