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
#tagUpdateModal {
  margin: 100px 0 0 0px;
  /* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}

#tagCreateModal {
  margin: 100px 0 0 0px;
  /* PLAY THE WITH THE VALUES TO SEE GET THE DESIRED EFFECT */
}
</style>

<script type="text/javascript">
      jQuery(function($)
      {
        
        // Tag update modal preload process
        $("#tag_report_refresh_id").click(function ()
        {
          var objArray = [];　 // Create a new array

          objArray["tagTotal"] = document.getElementById('tag_report_total_id');
          objArray["tagInitial"] = document.getElementById('tag_report_initial_id');
          objArray["tagEnable"] = document.getElementById('tag_report_enable_id');
          objArray["tagDisable"] = document.getElementById('tag_report_disable_id');
          objArray["action"] = "<?php echo U('Admin/tag_report_refresh_process');?>";
          tagReportRefreshProcess(objArray);
        });

        // Tag update modal preload process
        $("#tag_update_modal").click(function ()
        {
          var objArray = [];　 // Create a new array
          // Highlight the active button
          // First one is hightlighted as active button
          //Clear array
          //Load product information
          objArray["currentTag"] = document.getElementById('tag_current');
          objArray["totalTag"] = document.getElementById('tag_total');
          objArray["tagId"] = document.getElementById('u_tag_id');
          objArray["tagStatus"] = document.getElementById('u_tag_status');
          objArray["tagIndex"] = document.getElementById('u_tag_index');
          objArray["tagType"] = document.getElementById('u_tag_type');
          objArray["tagNumber"] = document.getElementById('u_tag_number');
          objArray["tagBid"] = document.getElementById('u_tag_bid');
          objArray["tagLabel"] = document.getElementById('u_tag_label');
          objArray["tagWebPage"] = document.getElementById('u_tag_web_page');
          objArray["action"] = "<?php echo U('Admin/tag_load_first_process');?>";
          tagInfoPreload(objArray, <?php echo ($tagInfoJson); ?>);
        });
        
        
        
        // Create tag process
        $("#tag_create_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('form_tag_create');
          objArray["tagType"] = document.getElementById('c_tag_type');
          objArray["action"] = "<?php echo U('Admin/tag_create_process');?>";
        
          tagCreateProcess(objArray);
        });

        $("#tag_load_previous").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('form_tag_update');
          objArray["currentTag"] = document.getElementById('tag_current');
          objArray["totalTag"] = document.getElementById('tag_total');
          objArray["tagId"] = document.getElementById('u_tag_id');
          objArray["tagStatus"] = document.getElementById('u_tag_status');
          objArray["tagIndex"] = document.getElementById('u_tag_index');
          objArray["tagType"] = document.getElementById('u_tag_type');
          objArray["tagNumber"] = document.getElementById('u_tag_number');
          objArray["tagBid"] = document.getElementById('u_tag_bid');
          objArray["tagLabel"] = document.getElementById('u_tag_label');
          objArray["tagWebPage"] = document.getElementById('u_tag_web_page');
          objArray["action"] = "<?php echo U('Admin/tag_load_previous_process');?>";
          tagLoadPreviousProcess(objArray);
        });
        
        $("#tag_load_next").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('form_tag_update');
          objArray["currentTag"] = document.getElementById('tag_current');
          objArray["totalTag"] = document.getElementById('tag_total');
          objArray["tagId"] = document.getElementById('u_tag_id');
          objArray["tagStatus"] = document.getElementById('u_tag_status');
          objArray["tagIndex"] = document.getElementById('u_tag_index');
          objArray["tagType"] = document.getElementById('u_tag_type');
          objArray["tagNumber"] = document.getElementById('u_tag_number');
          objArray["tagBid"] = document.getElementById('u_tag_bid');
          objArray["tagLabel"] = document.getElementById('u_tag_label');
          objArray["tagWebPage"] = document.getElementById('u_tag_web_page');
          objArray["action"] = "<?php echo U('Admin/tag_load_next_process');?>";
          tagLoadNextProcess(objArray);
        });        
        
        $("#tag_update_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('form_tag_update');
          objArray["currentTag"] = document.getElementById('tag_current');
          objArray["totalTag"] = document.getElementById('tag_total');
          objArray["tagId"] = document.getElementById('u_tag_id');
          objArray["tagStatus"] = document.getElementById('u_tag_status');
          objArray["tagIndex"] = document.getElementById('u_tag_index');
          objArray["tagType"] = document.getElementById('u_tag_type');
          objArray["tagNumber"] = document.getElementById('u_tag_number');
          objArray["tagBid"] = document.getElementById('u_tag_bid');
          objArray["tagLabel"] = document.getElementById('u_tag_label');
          objArray["tagWebPage"] = document.getElementById('u_tag_web_page');
          objArray["action"] = "<?php echo U('Admin/tag_update_process');?>";
          tagUpdateProcess(objArray);
        });
        
        $("#tag_delete_button").click(function ()
        {
          var objArray = [];　 // Create a new array
          objArray["form"] = document.getElementById('form_tag_update');
          objArray["currentTag"] = document.getElementById('tag_current');
          objArray["totalTag"] = document.getElementById('tag_total');
          objArray["tagId"] = document.getElementById('u_tag_id');
          objArray["tagStatus"] = document.getElementById('u_tag_status');
          objArray["tagIndex"] = document.getElementById('u_tag_index');
          objArray["tagType"] = document.getElementById('u_tag_type');
          objArray["tagNumber"] = document.getElementById('u_tag_number');
          objArray["tagBid"] = document.getElementById('u_tag_bid');
          objArray["tagLabel"] = document.getElementById('u_tag_label');
          objArray["tagWebPage"] = document.getElementById('u_tag_web_page');
          objArray["action"] = "<?php echo U('Admin/tag_delete_process');?>";
          tagDeleteProcess(objArray);
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
  <div class="container-fluid" style="margin-top: 100px;">

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
            style="font-size: 20px; font-weight: bold" id="button_general_id">General
          </a>
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
          Tag Management</p>
      </div>
    </div>
    <div class="row ">
      <div class="col-sm-offset-1 col-sm-10">
        <div class="col-sm-4">
          <div class="panel panel-default" style="font-size: 25px">
            <div class="panel-heading"
              style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
              <a href="#" class="general_text_link_6_style" id="tag_report_refresh_id">Tag Report (Click to refresh)</a>
              </div>
            <div class="panel-body" style="height: 250px">
              <table class="col-sm-offset-1 col-sm-10">
                <tbody>
                  <tr>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;">
                      Total Tag:</td>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;" id="tag_report_total_id">
                      <?php echo ($tagReportInfo["tag_report_total"]); ?></td>
                  </tr>
                  <tr>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;">
                      Tag Initial:</td>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;" id="tag_report_initial_id">
                      <?php echo ($tagReportInfo["tag_report_initial"]); ?></td>
                  </tr>
                  <tr>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;">
                      Tag Enable:</td>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;" id="tag_report_enable_id">
                      <?php echo ($tagReportInfo["tag_report_enable"]); ?></td>
                  </tr>
                  <tr>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;">
                      Tag Disable:</td>
                    <td
                      style="vertical-align: middle; padding: 10px; color: #222222;" id="tag_report_disable_id">
                      <?php echo ($tagReportInfo["tag_report_disable"]); ?></td>
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
              Tag Management
            </div>
            <div class="panel-body" style="height: 250px">
              <button type="button" id="tag_update_modal"
                class="btn btn-primary btn-lg btn-block" data-toggle="modal"
                data-target="#tagUpdateModal">Update Tag</button>
              <hr
                style="border-color: -moz-use-text-color #FFFFFF; border-style: solid none; border-width: 3px 0;" />
            </div>
          </div>
        </div>

        <div class=" col-sm-4">
          <div class="panel panel-default" style="font-size: 25px">
            <div class="panel-heading"
              style="font-size: 20px; font-weight: bold; color: #ffffff; background-color: #7B72E9; vertical-align: middle; text-align: center">
              New Tag Info
            </div>
            <div class="panel-body" style="height: 250px">
              <button type="button" id="tag_create_modal"
                class="btn btn-primary btn-lg btn-block" data-toggle="modal"
                data-target="#tagCreateModal">Create New Tag</button>
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

  <!-- Create Tag Modal part define-->
  <div class="modal fade" id="tagCreateModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title">Create a Tag</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="form_tag_create"
            name="form_tag_create" method="post" action="/neo1/index.php/admin/admin/admin_board_tag.html">
            
            <div class="form-group">
              <label class="control-label col-sm-3" for="c_tag_type">Tag Type:</label>
              <div class="col-sm-9">
                <select class="form-control" name="c_tag_type" id="c_tag_type">
                  <option>QR Code</option>
                </select>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="tag_create_button">Create</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal -->
  </div>

  <!-- Manage Tag Modal part define-->
  <div class="modal fade" id="tagUpdateModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title">Update a Tag</h4>
        </div>
        <div class="modal-body">

          <table class="col-sm-offset-2 col-sm-8">
            <tbody>
              <tr>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222;">
                  <button type="button" class="btn btn-primary" id="tag_load_previous">Previous  </button>
                </td>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222; background-color: #ca856a">
                  <p id="tag_current">1</p>
                </td>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222; background-color: #ca856a">
                  <p>of</p>
                </td>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222; background-color: #ca856a">
                  <p id="tag_total">100</p>
                </td>
                <td style="vertical-align: middle; text-align: center; padding: 10px; color: #222222;">
                  <button type="button" class="btn btn-primary" id="tag_load_next">Next </button>
                </td>
              </tr>
            </tbody>
          </table>
          <form class="form-horizontal" id="form_tag_update"
            name="form_tag_update" method="post" action="/neo1/index.php/admin/admin/admin_board_tag.html">
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_tag_id">Tag Id:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_tag_id"
                  id="u_tag_id" disabled>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="u_tag_status">Tag Status:</label>
              <div class="col-sm-9">
                <select class="form-control" name="u_tag_status" id="u_tag_status">
                
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_tag_index">Tag Index:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_tag_index" id="u_tag_index" disabled
                  placeholder="Enter tag index with 5 Characters">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_tag_type">Tag Type:</label>
              <div class="col-sm-9">
                <select class="form-control" name="u_tag_type" id="u_tag_type" disabled>

                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_tag_number">Tag Number:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_tag_number" id="u_tag_number" disabled
                  placeholder="Enter tag number with 8 characters">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="u_tag_bid">Tag Bonded Business ID:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_tag_bid" id="u_tag_bid" placeholder="Business ID">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="u_tag_label">Tag Label:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_tag_label" id="u_tag_label"
                  placeholder="Enter tag label with 100 characters max">
              </div>
            </div>
   
            <div class="form-group">
              <label class="control-label col-sm-3" for="u_tag_web_page">Tag Web Page:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="u_tag_web_page" id="u_tag_web_page"
                  placeholder="Enter tag bonded web page with 200 characters max">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-danger" id="tag_delete_button">Delete</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" id="tag_update_button">Update</button>
         
        </div>
      </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal -->
  </div>

</body>
</html>