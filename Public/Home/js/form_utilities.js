$.fn.serializeObject = function()    
{    
   var o = {};    
   var a = this.serializeArray();    
   $.each(a, function() {    
       if (o[this.name]) {    
           if (!o[this.name].push) {    
               o[this.name] = [o[this.name]];    
           }    
           o[this.name].push(this.value || '');    
       } else {    
           o[this.name] = this.value || '';    
       }    
   });    
   return o;
};

// 我们这一生都太匆匆了，没有时间欣赏美，没有时间思考什么是好，看到一点光就扑过去了。
// 一只浪漫激情又匆匆的飞蛾

/** 
 * Check user name format
 * Return true if user name is valid
 *        false if user name is not valid
 */  
function usernameCheck(user_name)
{  
   var pattern = /^([a-zA-Z ])/;  

   if(user_name == "")
   {
      return false;  //return due to empty input
   }

   if(!pattern.test(user_name)) 
   {  
      return false;
   }
   else
   {
      return true;
   }
}

/** 
 * Check buiness name format
 * Return true if user name is valid
 *        false if user name is not valid
 */  
function businessNameCheck(business_name)
{  
   var pattern = /^([a-zA-Z ])/;  

   if(business_name == "")
   {
      return false;  //return due to empty input
   }

   if(!pattern.test(business_name)) 
   {  
      return false;
   }
   else
   {
      return true;
   }
}

/** 
 * Check email format
 * Return true if email is valid
 *        false if email is not valid
 */  
function emailCheck(email)
{  
   var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;  
   if (!pattern.test(email)) 
   {  
      return false;
   }
   else
   {
      return true;
   }
}

/** 
 * Check mobile number format
 * Return true if mobile number is valid
 *        false if mobile number is not valid
 */  
function mobileNumberCheck(mobile_number)
{  
   var pattern = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
   
   if((mobile_number.length < 10) || (mobile_number.length > 15))
   {  
      return false;
   }

   if(!pattern.test(mobile_number)) 
   {  
      return false;
   }
   else
   {
      return true;
   }
}

/** 
 * Check postalCodeCheck format
 * Return true if postal code is valid
 *        false if postal code is not valid
 */  
function postalCodeCheck(postal_code)
{  
   var pattern_ca = /([ABCEGHJKLMNPRSTVWXYZ]\d){3}/i;
   var pattern_usa = /^[0-9]{5}(?:-[0-9]{4})?$/;

   if((postal_code.length < 5) || (postal_code.length > 12))
   {  
      return false;
   }

   if(pattern_ca.test(postal_code))
   {  
      return true;
   }
   else if (pattern_usa.test(postal_code))
   {  
      return true;
   }   
   else
   {
      return false;
   }
}

/** 
 * Name: emptyCheck
 * Description: Check input message empty or not
 * Return true if input message is empty
 *        false if input message is not empty
 */  
function emptyCheck(message)
{  
  if (message.length >= 1)
  {  
    return false;
  }
  else
  {
    return true;
  }
}

/** 
 * Check password format
 * Return true if password is valid
 *        false if password is not valid
 */  
function passwordCheck(password)
{  
   if ((password.length <4) || (password.length > 10))
   {  
      return false;
   }
   else
   {
      return true;
   }
}
/** 
 * Is number check
 * Return true  if number
 *        false if not number
 */  
function IsNumeric(input)
{
    var RE = /^-{0,1}\d*\.{0,1}\d+$/;
    return (RE.test(input));
}

/** 
 * Remove all space in string
 * Return string with space removed
 *
 */
function removeSpace(strInput)
{
   var pattern = /[ ]/g;

   var strOutput = strInput.replace(pattern,""); 
   return strOutput;
}

/** 
 * Trim space ahead and tail of string
 * Return string with space trimmed
 *
 */
function trimSpace(str)
{ 
   return str.replace(/(^\s*)|(\s*$)/g, ""); 
}

/** 
 * Change object background color to the specific one
 * Return:   None
 *
 */
function changeBgColor(obj, value)
{
   if(value == true)
   {
   //   obj.style.background = "#fbfbfb"; //back ground color changed to white
      $(obj).css('background', "#fbfbfb");
   }
   else if (value == false)
   {
   //   obj.style.background = "red"; //back ground color changed to red due to false
      $(obj).css('background', "red");
   }
   
   return;
}

/** 
 * Name: changeBorderColor
 * Change object border color to the specific one
 * Return:   None
 *
 */
function changeBorderColor(obj, value)
{
  if(value == true)
  {
    $(obj).css('border-color', 'black');
  }
  else
  {
   //   obj.style.border-color = "red";   // border color color changed to red due to false
    $(obj).css('border-color', 'red');
  }
   
  return;
}

/** 
 * Check substring existence
 * Return:   TRUE  -- if sub string exists
 *           FALSE -- if sub string does not exist
 */
function isSubStringExist(mainString, substring)
{
  if (mainString.indexOf(substring) != -1)
  {
    return true;
  }
  else
  {
    return false;
  }
}

/** 
 * Name: setCellProperty1
 * Set the cell property as this:
 *    Mouse over -- text color to #eeeeee
 *    Mouse Out  -- text color to #ffffff
 *    Link as desired
 * Return None
 *       
 */  
function setCellProperty1(obj, strLink)
{
  $(obj).on("click", function() {location.href = strLink;});
  $(obj).mouseover(function(){ $(obj).css("color","#eeeeee"); });
  $(obj).mouseout(function(){ $(obj).css("color","#ffffff"); });
}

/** 
 * Name: changeBgColor2
 * Set the cell background color as this:
 *  true  -- green color  #22d30e
 *  false -- yellow color d3a90e
 * Return None
 */
function changeBgColor2(obj, value)
{
  if(value == true)
  {
    obj.style.background = "#22d30e"; //back ground color changed to green
  }
  else if (value == false)
  {
    obj.style.background = "#d3a90e"; //back ground color changed to yellow
  }
   
  return;
}

/** 
 * Name: db1FormProcess
 * Process the dashboard 1 form message
 * Object of elements in the form:
 *  objSubject -- form subject
 *  objMsgBody -- form message body
 *  objForm    -- form 
 *  strAction  -- action page to process
 * Return None
 */
function db1FormProcess(objForm, objSubject, objMsgBody, strAction)
{
  var elementVerify = true;
  var subjectValue = $(objSubject).val();
  var msgValue = $(objMsgBody).val();

  // remove space
  subjectValue = trimSpace(subjectValue);
  msgValue = trimSpace(msgValue); 
      
  // Verify the input form item first
  // Verify Subject
  if(emptyCheck(subjectValue))
  {
    // change the error cell background color to red
    changeBorderColor(objSubject, false);
    objSubject.focus();
    elementVerify = false;
  }
  else
  {
    changeBorderColor(objSubject, true);
  }
       
  // Verify message body
  if(emptyCheck(msgValue))
  {
    // change the error cell background color to red
    changeBorderColor(objMsgBody, false);
    objMsgBody.focus();
    elementVerify = false;
  }
  else
  {
    changeBorderColor(objMsgBody, true);
  }
        
  if(!elementVerify)
  {
    return;
  }
               
  var jsonMsgInfo = $(objForm).serializeObject();  
  console.log(JSON.stringify(jsonMsgInfo));
            
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", strAction, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
               
  xmlhttp.send(JSON.stringify(jsonMsgInfo));
                
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      if(respData.status == 0)
      {
        alert(respData.info);
        changeBorderColor(objSubject, true);
        $(objSubject).val(null);
        changeBorderColor(objMsgBody, true);
        $(objMsgBody).val(null);
      }
      else
      {
        alert(respData.info);
      }
    } 
  }
   
  return;
}
/** 
 * Name: presetDb1StatusBarProperty
 * Process the dashboard 1 status bar prperty
 * objarray -- status bar id
 *  activeStatus -- current status 
 * Return None
 */
function presetDb1StatusBarProperty(objArray, activeStatus)
{
  var count;

  for (count = 0; count < objArray.length; count++)
  {
    if((count + 1) <= activeStatus)
    {
      objArray[count].style.background = "#22d30e"; //back ground color changed to green
    }
    else
    {
      objArray[count].style.background = "#d3a90e"; //back ground color changed to yellow
    }
  }
  return;
}

/** 
 * Name: loadDb1StatusResult
 * Process the dashboard 1 detail status info
 * 	objArray -- status bar id array
 *  statusResultArray -- status result id array
 *  statusData -- active status
 * Return None
 */
function loadDb1StatusResult(objArray, statusResultArray, statusData)
{
  presetDb1StatusBarProperty(objArray, statusData);
  presetDb1StatusBarProperty(statusResultArray, statusData);
  //TODO: more add later


}



/** 
 * Name: db1ToolButtonHighlight
 * Process the dashboard 1 toolbar active button highlighted
 * Object of button elements:
 *  objArray -- tool button object
 * Return None
 */
function db1ToolButtonHighlight(objArray)
{
  var count;
  //First one is the highlighted
  objArray[0].style.color = "#c1ce08"; 
  
  for (count = 1; count < objArray.length; count++)
  {
    objArray[count].style.color = "white";
  }
  return;
}

/** 
 * Name: db1PwRecoverFormProcess
 * Description: Business account Dashboard 1 password recover form process
 * Object of elements in the form:
 *  objForm -- form object
 *  objEmail -- form email object
 *  strAction  -- action page to process
 * Return None
 */
function db1PwRecoverFormProcess(objForm, objEmail, strAction)
{
  var  elementVerify = true;
  // Verify the input form item first
  var business_email_value = $(objEmail).val();
  
  // remove space
  business_email_value = trimSpace(business_email_value); 

  if(!emailCheck(business_email_value))
  {
    // change the error cell background color to red
    changeBgColor(objEmail, false);
    $(objEmail).focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objEmail, true);
  }
     
  if(!elementVerify)
  {
    return;
  }

  var jsonBusinessInfo = $(objForm).serializeObject();  
  //TODO: For debug purpose, should be remove later
  console.log(JSON.stringify(jsonBusinessInfo));
     
  // alert(JSON.stringify(jsonuserinfo));  
     
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", strAction, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
     
  xmlhttp.send(JSON.stringify(jsonBusinessInfo));
     
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      $data = xmlhttp.responseText;
      console.log($data);
 
      // $respData = $.parseJSON($data);
      alert($data);
    }
  }
  return;
}

/** 
 * Name: bnSignInFormProcess
 * Description: Business account sign in form process
 * Object of elements in the form:
 *  objForm -- form object
 *  objEmail -- form email object
 *  objPassword -- form password object
 *  strAction  -- action page to process
 * Return None
 */
function bnSignInFormProcess(objForm, objEmail, objPassword, strAction)
{
  var jsonBnInfo = $(objForm).serializeObject();  
  //TODO: For debug purpose, should be remove later
  console.log(JSON.stringify(jsonBnInfo));
         
  // send form data in Json string to server
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", strAction, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        
  xmlhttp.send(JSON.stringify(jsonBnInfo));
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);

      //get the json data
      var respData = $.parseJSON(data);
      if(respData.status == 0)
      {
        // Response success
        alert(respData.info);
        //jump to new dashboard page
        location.href = respData.url;
      }
      else if(respData.status == 500)
      {
        // Check field error process
        var strResp = respData.info;
        //   console.log(strResp);
            
        // Process email
        if(isSubStringExist(strResp, "EMAIL"))
        {
          // change the error cell background color to red
          changeBorderColor(objEmail, false);
          $(objEmail).focus();
        }
        else
        {
          changeBorderColor(objEmail, true);
        }
            
        // Process password
        if(isSubStringExist(strResp, "PASSWORD"))
        {
          // change the error cell background color to red
          changeBorderColor(objPassword, false);
          $(objPassword).focus();
        }
        else
        {
          changeBorderColor(objPassword, true);
        }
        alert("Sorry, you don't have access to this page!!!");
      }
      else
      {
        alert(respData.info);
      }
    }
  }
}

/** 
 * Name: bnRegistFormProcess
 * Description: Business account register form process
 * Object of elements in the form:
 *  objArray -- Contains form ID, email, phone, name, action page
 * Return None
 */
function bnRegistFormProcess(objArray)
{
  var jsonBusinessInfo = $(objArray["form"]).serializeObject();  
  console.log(JSON.stringify(jsonBusinessInfo));
         
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonBusinessInfo));
  
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        alert(respData.info);
        changeBorderColor(objArray["fullName"], true);
        $(objArray["fullName"]).val(null);
       
        changeBorderColor(objArray["bnEmail"], true);
        $(objArray["bnEmail"]).val(null);
        
        changeBorderColor(objArray["bnPhone"], true);
        $(objArray["bnPhone"]).val(null);
       
        changeBorderColor(objArray["bnName"], true);
        $(objArray["bnName"]).val(null);
      }
      else if (respData.status == 500)
      {
        // Check field error process
        var strResp = respData.info;
        console.log(strResp);
          
        // Process full name
        if(isSubStringExist(strResp, "FULL_NAME"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["fullName"], false);
          $(objArray["fullName"]).focus();
        }
        else
        {
          changeBorderColor(objArray["fullName"], true);
        }
          
        // Process email
        if(isSubStringExist(strResp, "EMAIL"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["bnEmail"], false);
          $(objArray["bnEmail"]).focus();
        }
        else
        {
          changeBorderColor(objArray["bnEmail"], true);
        }
          
        // Process mobile
        if(isSubStringExist(strResp, "PHONE"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["bnPhone"], false);
          $(objArray["bnPhone"]).focus();
        }
        else
        {
          changeBorderColor(objArray["bnPhone"], true);
        }
      
        // Process Company name
        if(isSubStringExist(strResp, "BUSINESS_NAME"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["bnName"], false);
          $(objArray["bnName"]).focus();
        }
        else
        {
          changeBorderColor(objArray["bnName"], true);
        }
        alert(respData.info);
      }
    }
  }
}

//====================================================================
//====================================================================
// User related js function listed here
//====================================================================
//====================================================================
/** 
 * Name: userSignInFormProcess
 * Description: user account sign in form process
 * Object of elements in the form:
 *  objForm -- form object
 *  objEmail -- form email object
 *  objPassword -- form password object
 *  strAction  -- action page to process
 * Return None
 */
function userSignInFormProcess(objForm, objEmail, objPassword, strAction)
{
  var  elementVerify = true;
  var user_email_value = $(objEmail).val();
  var user_pw_value    = $(objPassword).val();
           
  // remove space
  user_email_value = trimSpace(user_email_value); 
  user_pw_value = removeSpace(user_pw_value); 
        
  //Verify the input form item first
  // Verify user email
  if(!emailCheck(user_email_value))
  {
    // change the error cell background color to red
    changeBgColor(objEmail, false);
    objEmail.focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objEmail, true);
  }

  // Verify password
  if(!passwordCheck(user_pw_value))
  {
    // change the error cell background color to red
    changeBgColor(objPassword, false);
    objPassword.focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objPassword, true);
  }
        
  if(!elementVerify)
  {
    return;
  }
           
  var jsonUserInfo = $(objForm).serializeObject();  
  console.log(JSON.stringify(jsonUserInfo));

  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", strAction, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonUserInfo));

  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;

      console.log(data);

      //get the json data
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        alert(respData.info);
        //jump to new sign in page
        location.href = respData.url;
      }
      else
      {
        alert(respData.info);
      }
    }
  }
}

/** 
 * Name: userRegistFormProcess
 * Description: user account register form process
 * Object of elements in the form:
 *  objArray -- Contains form ID, email, phone, name, action page
 * Return None
 */
function userRegistFormProcess(objArray)
{
  //Verify the input form item first
  // 1 -- verify user name
  // 2 -- verify user email
  // 3 -- verify mobile number
  // 5 -- verify password
  var elementVerify = true;
  var nameValue   = $(objArray["name"]).val();
  var emailValue  = $(objArray["email"]).val();
  var mobileValue = $(objArray["mobile"]).val();
  var pwValue     = $(objArray["pw"]).val();

  // remove space
  nameValue = trimSpace(nameValue); 
  emailValue = trimSpace(emailValue); 
  mobileValue = trimSpace(mobileValue); 
  pwValue = removeSpace(pwValue); 
    
  // Verify the user name
  if(!usernameCheck(nameValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["name"], false);
    objArray["name"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["name"], true);
  }
         
  // Verify the user email
  if(!emailCheck(emailValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["email"], false);
    objArray["email"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["email"], true);
  }
    
  // Verify the user mobile
  if(!mobileNumberCheck(mobileValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["mobile"], false);
    objArray["mobile"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["mobile"], true);
  }

  // Verify the user password
  if(!passwordCheck(pwValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["pw"], false);
    objArray["pw"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["pw"], true);
  }
  
  if(!elementVerify)
  {
    return;
  }
    
  var jsonUserInfo = $(objArray["form"]).serializeObject();  
  console.log(JSON.stringify(jsonUserInfo));
       
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonUserInfo));
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        alert(respData.info);
        //jump to new sign in page
        location.href = respData.url;
      }
      else
      {
        alert(respData.info);
      }
    }
  }
}

/** 
 * Name: userPwRecoverFormProcess
 * Description: user account password recover form process
 * Object of elements in the form:
 *  objForm   -- form
 *  objEmail  -- email
 *  strAction -- action PHP page
 * Return None
 */
function userPwRecoverFormProcess(objForm, objEmail, strAction)
{
  //Verify the input form item first
  var emailValue = $(objEmail).val();
  // remove space
  emailValue = trimSpace(emailValue); 
         
  if(!emailCheck(emailValue))
  {
      // change the error cell background color to red
      changeBgColor(objEmail, false);
      objEmail.focus();
      return;
  }
  else
  {
    changeBgColor(objEmail, true);
  }

  var jsonUserInfo = $(objForm).serializeObject();  
  console.log(JSON.stringify(jsonUserInfo));
       
  //    alert(JSON.stringify(jsonuserinfo));  
       
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", strAction, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonUserInfo));
       
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
              
      //      $respData = $.parseJSON($data);
              
      alert(data);
    }
  }
}

/** 
 * Name: loadUserBasicInfo
 * Description: load user account basic info
 * Object of elements in the form:
 * objArray -- object needs to be processed
 * Return None
 */
function loadUserBasicInfo(objArray)
{
  //Preset the input item back ground to white
  changeBgColor(objArray["name"], true);
  changeBgColor(objArray["email"], true);
  changeBgColor(objArray["mobile"], true);
  changeBgColor(objArray["address1"], true);
  changeBgColor(objArray["address2"], true);
  changeBgColor(objArray["city"], true);
  changeBgColor(objArray["province"], true);
  changeBgColor(objArray["country"], true);
  changeBgColor(objArray["postalCode"], true);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

  xmlhttp.send();   //This is necessary even if no data sent to server
  
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
      //get the json data
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        //Preset the stored value
        $(objArray["name"]).val(respData.info.Name);
        $(objArray["email"]).val(respData.info.Email);
        $(objArray["mobile"]).val(respData.info.Mobile);
        $(objArray["address1"]).val(respData.info.Address1);
        $(objArray["address2"]).val(respData.info.Address2);
        $(objArray["city"]).val(respData.info.City);
        $(objArray["province"]).val(respData.info.Province);
        $(objArray["country"]).val(respData.info.Country);
        $(objArray["postalCode"]).val(respData.info.PostalCode);
        $(objArray["birthday"]).val(respData.info.Birthday);
        $(objArray["birthMonth"]).val(respData.info.Month);
      }
      else
      {
      //  console.log("ERROR data!!!");
      }
    }
  }
}

/** 
 * Name: userBasicInfoUpdate
 * Description: user account basic info update
 * Object of elements in the form:
 * objArray -- object needs to be processed
 * Return None
 */
function userBasicInfoUpdate(objArray)
{
  var jsonBasicInfo = $(objArray["form"]).serializeObject();  
  // console.log(JSON.stringify(jsonBasicInfo));
     
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonBasicInfo));

  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
    //  console.log(data);
      //get the json data
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        // Update the basic information successfully
      //  console.log(respData.info);
        alert("Success to update my basic info!!!");
        
      }
      else if(respData.status == 501)
      {
        alert(respData.info);
      }
      else if(respData.status == 500)
      {
        // Check field error process
        var strResp = respData.info;
     //   console.log(strResp);
        
        // Process user name
        if(isSubStringExist(strResp, "NAME"))
        {
          // change the error cell background color to red
          changeBgColor(objArray["name"], false);
          objArray["name"].focus();
        }
        else
        {
          changeBgColor(objArray["name"], true);
        }
        
        // Process user email
        if(isSubStringExist(strResp, "EMAIL"))
        {
          // change the error cell background color to red
          changeBgColor(objArray["email"], false);
          objArray["email"].focus();
        }
        else
        {
          changeBgColor(objArray["email"], true);
        }
        
        // Process user mobile
        if(isSubStringExist(strResp, "MOBILE"))
        {
          // change the error cell background color to red
          changeBgColor(objArray["mobile"], false);
          objArray["mobile"].focus();
        }
        else
        {
          changeBgColor(objArray["mobile"], true);
        }
        
        // Process user postal code
        if(isSubStringExist(strResp, "POSTAL_CODE"))
        {
          // change the error cell background color to red
          changeBgColor(objArray["postalCode"], false);
          objArray["postalCode"].focus();
        }
        else
        {
          changeBgColor(objArray["postalCode"], true);
        }
        
        // Process user Birthday
        if(isSubStringExist(strResp, "BIRTHDAY"))
        {
          // change the error cell background color to red
          changeBgColor(objArray["birthday"], false);
          objArray["birthday"].focus();
        }
        else
        {
          changeBgColor(objArray["birthday"], true);
        }
        
        alert("ERROR: Invalid Name, Email, Mobile, Postal Code or Birthday!!!");
      }
    }
  }
}

/** 
 * Name: presetAccountPwData
 * Description: user account password modal clear
 * Object of elements in the form:
 * objArray -- object needs to be processed
 * Return None
 */
function presetAccountPwData(objArray)
{
  //Preset the input item back ground to white
  changeBorderColor(objArray["oldPw"], true);
  $(objArray["oldPw"]).val(null);
  changeBorderColor(objArray["newPw"], true);
  $(objArray["newPw"]).val(null);
  changeBorderColor(objArray["newPwCfm"], true);
  $(objArray["newPwCfm"]).val(null);
}

/** 
 * Name: accountPwUpdate
 * Description: user account password update process
 * Object of elements in the form:
 * objArray -- object needs to be processed
 * Return None
 */
function accountPwUpdate(objArray)
{
  var jsonPwInfo = $(objArray["form"]).serializeObject();
  console.log(JSON.stringify(jsonPwInfo));

  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonPwInfo));

  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
      //get the json data
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        // Update the password successfully
        // console.log(respData.info);
        // Clear the input item back ground to white
        changeBorderColor(objArray["oldPw"], true);
        $(objArray["oldPw"]).val(null);
        changeBorderColor(objArray["newPw"], true);
        $(objArray["newPw"]).val(null);
        changeBorderColor(objArray["newPwCfm"], true);
        $(objArray["newPwCfm"]).val(null);
        
        alert(respData.info);
      }
      else if(respData.status == 500)
      {
        // Check field error process
        var strResp = respData.info;
     //   console.log(strResp);
        
        // Process old password
        if(isSubStringExist(strResp, "OLD_PW"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["oldPw"], false);
          $(objArray["oldPw"]).focus();
        }
        else
        {
          changeBorderColor(objArray["oldPw"], true);
        }
        
        // Process new password
        if(isSubStringExist(strResp, "NEW_PW"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["newPw"], false);
          $(objArray["newPw"]).focus();
        }
        else
        {
          changeBorderColor(objArray["newPw"], true);
        }
        
        // Process confirm new password
        if(isSubStringExist(strResp, "CFM_PW"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["newPwCfm"], false);
          $(objArray["newPwCfm"]).focus();
        }
        else
        {
        	changeBorderColor(objArray["newPwCfm"], true);
        }
        alert("ERROR: Invalid Password!!!");
      }
      else
      {
        alert(respData.info);
      }
    }
  }
}

/** 
 * Name: loadUserPrefNotice
 * Description: user account notice preference preload
 * Object of elements in the form:
 * objArray -- object needs to be processed
 * Return None
 */
function loadUserPrefNotice(objArray)
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send();   //This is necessary even if no data sent to server
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
      //get the json data
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        //Preset the stored SMS value
        if(respData.info.storeSmsCheckbox == 1)
        {
          objArray["chkStoreSms"].checked = true;
        }
        else
        {
          objArray["chkStoreSms"].checked = false;
        }
        
        //Preset the stored Email value
        if(respData.info.storeEmailCheckbox == 1)
        {
          objArray["chkStoreEmail"].checked = true;
        }
        else
        {
          objArray["chkStoreEmail"].checked = false;
        }
        
        //Preset the Neo SMS value
        if(respData.info.neoSmsCheckbox == 1)
        {
          objArray["chkNeoSms"].checked = true;
        }
        else
        {
          objArray["chkNeoSms"].checked = false;
        }
        
        //Preset the Neo Email value
        if(respData.info.neoEmailCheckbox == 1)
        {
          objArray["chkNeoEmail"].checked = true;
        }
        else
        {
          objArray["chkNeoEmail"].checked = false;
        }
      }
      else
      {
        alert(respData.info);
      }
    }
  }
  return;
}

/** 
 * Name: userPrefNoticeUpdate
 * Description: user account notice preference update
 * Object of elements in the form:
 * objArray -- object needs to be processed
 * Return None
 */
function userPrefNoticeUpdate(objArray)
{
  var jsonPrefInfo = $(objArray["form"]).serializeObject();  
  console.log(JSON.stringify(jsonPrefInfo));

  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonPrefInfo));

  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      alert(respData.info);
    }
  }
  
  return;
}

/** 
 * Name: loadDashboard1ProfileInfo
 * Description: load Temp Business account profile info
 * Object of elements in the form:
 * objArray -- object needs to be processed
 * Return None
 */
function loadDashboard1ProfileInfo(objArray)
{
  //Preset the input item back ground to white
  changeBorderColor(objArray["full_name"], true);
  changeBorderColor(objArray["company_name"], true);
  changeBorderColor(objArray["email"], true);
  changeBorderColor(objArray["alt_email"], true);
  changeBorderColor(objArray["phone"], true);
  changeBorderColor(objArray["mobile"], true);
  changeBorderColor(objArray["type"], true);
  changeBorderColor(objArray["address"], true);
  changeBorderColor(objArray["city"], true);
  changeBorderColor(objArray["province"], true);
  changeBorderColor(objArray["postalCode"], true);
  changeBorderColor(objArray["country"], true);
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

  xmlhttp.send();   //This is necessary even if no data sent to server
  
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
      //get the json data
      console.log(data);
      
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        //Preset the stored value
        $(objArray["full_name"]).val(respData.info.fullName);
        $(objArray["company_name"]).val(respData.info.companyName);
        $(objArray["email"]).val(respData.info.email);
        $(objArray["phone"]).val(respData.info.phone);
        $(objArray["mobile"]).val(respData.info.mobile);
        $(objArray["type"]).val(respData.info.type);
        $(objArray["address"]).val(respData.info.address);
        $(objArray["city"]).val(respData.info.city);
        $(objArray["province"]).val(respData.info.province);
        $(objArray["country"]).val(respData.info.country);
        $(objArray["postalCode"]).val(respData.info.postalCode);
        objArray["regInfo"].innerHTML += " ";
        objArray["regInfo"].innerHTML += respData.info.regDate;
      }
      else
      {
      //  console.log("ERROR data!!!");
      }
    }
  }
}

/** 
 * Name: updateDashboard1ProfileInfo
 * Description: update Temp Business account profile info
 * Object of elements in the form:
 * objArray -- object needs to be processed
 * Return None
 */
function updateDashboard1ProfileInfo(objArray)
{
  var jsonProfileInfo = $(objArray["form"]).serializeObject();  
  console.log(JSON.stringify(jsonProfileInfo));
     
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonProfileInfo));

  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
        console.log(data);
      //get the json data
      var respData = $.parseJSON(data);

      if(respData.status == 0)
      {
        // Update the basic information successfully
        //  console.log(respData.info);
        //Preset the input item back ground to white
        changeBorderColor(objArray["full_name"], true);
        changeBorderColor(objArray["company_name"], true);
        changeBorderColor(objArray["email"], true);
        changeBorderColor(objArray["alt_email"], true);
        changeBorderColor(objArray["phone"], true);
        changeBorderColor(objArray["mobile"], true);
        changeBorderColor(objArray["type"], true);
        changeBorderColor(objArray["address"], true);
        changeBorderColor(objArray["city"], true);
        changeBorderColor(objArray["province"], true);
        changeBorderColor(objArray["postalCode"], true);
        changeBorderColor(objArray["country"], true);
        alert("Success to update my profile info!!!");
        
      }
      else if((respData.status == 501) || (respData.status == 530))
      {
        alert(respData.info);
      }
      else if(respData.status == 500)
      {
        // Check field error process
        var strResp = respData.info;
     //   console.log(strResp);
        
        // Process full name
        if(isSubStringExist(strResp, "FULL_NAME"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["full_name"], false);
          objArray["full_name"].focus();
        }
        else
        {
          changeBorderColor(objArray["full_name"], true);
        }
        // Process company name
        if(isSubStringExist(strResp, "COMPANY_NAME"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["company_name"], false);
          objArray["company_name"].focus();
        }
        else
        {
          changeBorderColor(objArray["company_name"], true);
        }   
        
        // Process user email
        if(isSubStringExist(strResp, "EMAIL"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["email"], false);
          objArray["email"].focus();
        }
        else
        {
          changeBorderColor(objArray["email"], true);
        }
        
        // Process phone
        if(isSubStringExist(strResp, "PHONE"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["phpne"], false);
          objArray["phpne"].focus();
        }
        else
        {
          changeBorderColor(objArray["phpne"], true);
        }
        
        // Process mobile
        if(isSubStringExist(strResp, "MOBILE"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["mobile"], false);
          objArray["mobile"].focus();
        }
        else
        {
          changeBorderColor(objArray["mobile"], true);
        }
        
        // Process postal code
        if(isSubStringExist(strResp, "POSTAL_CODE"))
        {
          // change the error cell background color to red
          changeBorderColor(objArray["postalCode"], false);
          objArray["postalCode"].focus();
        }
        else
        {
          changeBorderColor(objArray["postalCode"], true);
        }
        alert("ERROR: Invalid Name, Email, Mobile, Postal Code or Birthday!!!");
      }
    }
  }
}

/** 
 * Name: addSelectOptions1
 * Description: Add option items include value in select
 * selectId -- Select ID
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function addSelectOptions1(selectId, optionJsonObj)
{
  var arrayOptions = [];
  var optionName;
  var optionValue;
  var optionItem;
  
  // Convert the json object to array
  for (elem in optionJsonObj) 
  {
    arrayOptions.push(optionJsonObj[elem]);  
  }

  for(var count = 0; count < arrayOptions.length; count++)
  {
    optionName = arrayOptions[count][0];
    optionValue = arrayOptions[count][1];
    optionItem = new Option(optionName, optionValue);
    selectId.options.add(optionItem);
  }
}

/** 
 * Name: addSelectOptions2
 * Description: Add option items not include value in select
 * selectId -- Select ID
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function addSelectOptions2(selectId, optionJsonObj)
{
  var arrayOptions = [];
  var optionName;
  var optionValue;
  var optionItem;
  
  // Convert the json object to array
  for (elem in optionJsonObj) 
  {
    arrayOptions.push(optionJsonObj[elem]);  
  }

  for(var count = 0; count < arrayOptions.length; count++)
  {
    optionName = arrayOptions[count];
    optionValue = arrayOptions[count];
    optionItem = new Option(optionName, optionValue);
    selectId.options.add(optionItem);
  }
  //Set first item as default selected 
  selectId.selectedIndex = 0;

}

/** 
 * Name: getSelectedOptionValue
 * Description: get selected option's value
 * selectId -- Select ID
 * 
 * Return selected item name
 */
function getSelectedOptionValue(selectId)
{
  var index = selectId.selectedIndex;       //get the selected item index number  
  var value = selectId.options[index].value;
  return (value);
}

/** 
 * Name: db1ProductInfoPreload
 * Description: preload dashboard 1 product info
 * objArray -- object array
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function db1ProductInfoPreload(objArray, optionJsonObj)
{
  var setUpFee;
  var monthlyFee;
  var monthsTerm;
  var storeQuantity;
  var amount;
  var amountWithTax;
  
  console.log(optionJsonObj);
  
//==========================================================
  $(objArray["serviceTerm"]).val(optionJsonObj.service_term);
  $(objArray["store"]).val(optionJsonObj.store_quantity);

  // Load product name options
  addSelectOptions2(objArray["productName"], optionJsonObj.productName);
  // Load product detail options
  addSelectOptions2(objArray["productDetail"], optionJsonObj.productDetail);
  
  //Load set up fee options
  addSelectOptions2(objArray["setUpFee"], optionJsonObj.setUpFee);
  //Load monthly fee options
  addSelectOptions2(objArray["monthlyFee"], optionJsonObj.monthlyFee);

  setUpFee = Number(getSelectedOptionValue(objArray["setUpFee"]));
  monthlyFee = Number(getSelectedOptionValue(objArray["monthlyFee"]));

  monthsTerm = Number(objArray["serviceTerm"].value);
  storeQuantity = Number(objArray["store"].value);

  amount = (setUpFee + (monthlyFee * monthsTerm)) * storeQuantity;
  console.log(amount);
  
  amountWithTax = amount * 1.13;
  
  var strTotalAmount = amountWithTax.toFixed(2); 

  console.log(strTotalAmount);
  $(objArray["amount"]).val(amount);
  $(objArray["amountTax"]).val(strTotalAmount);
}

/** 
 * Name: db1ProductNameChange
 * Description: preload dashboard 1 product info
 * objArray -- object array
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function db1ProductNameChange(objArray)
{
  var setUpFee;
  var monthlyFee;
  var monthsTerm;
  var storeQuantity;
  var amount;
  var amountWithTax;

  var productSelectedIndex = objArray["productName"].selectedIndex;
  
  objArray["productDetail"].selectedIndex = productSelectedIndex;
  objArray["setUpFee"].selectedIndex = productSelectedIndex;
  objArray["monthlyFee"].selectedIndex = productSelectedIndex;

  setUpFee = Number(getSelectedOptionValue(objArray["setUpFee"]));
  monthlyFee = Number(getSelectedOptionValue(objArray["monthlyFee"]));

  monthsTerm = Number(objArray["serviceTerm"].value);
  storeQuantity = Number(objArray["store"].value);

  if(monthsTerm < 1)
  {
  //  alert ("Month must be more than 1 month");
    monthsTerm = 1;	  
    $(objArray["serviceTerm"]).val(1);
   // return;
  }
  
  if(storeQuantity < 1)
  {
    storeQuantity = 1;
//  alert ("Store quantity must be al least 1!");
    $(objArray["store"]).val(1);
    
 //   return;
  }
  
  
//  console.log(setUpFee);
//  console.log(monthlyFee);
//  console.log(monthsTerm);
//  console.log(storeQuantity);

  amount = (setUpFee + (monthlyFee * monthsTerm)) * storeQuantity;
//  console.log(amount);
  
  amountWithTax = amount * 1.13;
  amountWithTax = Math.round(amountWithTax);
  
//  console.log(amountWithTax);
  $(objArray["amount"]).val(amount);
  $(objArray["amountTax"]).val(amountWithTax);
}

/** 
 * Name: db1OrderInfoPreload
 * Description: preload dashboard 1 order info
 * objArray -- object array
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function db1OrderInfoPreload(objArray, optionJsonObj)
{
  var currentOrder;
  var totalOrder;

  console.log(optionJsonObj);
//==========================================================
  totalOrder = Number(optionJsonObj.totalOrder);
  
  if(totalOrder == 0)
  {
    objArray["totalOrder"].innerHTML = optionJsonObj.totalOrder;
    objArray["currentOrder"].innerHTML = "0";
    return;
  }
  
  objArray["totalOrder"].innerHTML = optionJsonObj.totalOrder;
  objArray["currentOrder"].innerHTML = optionJsonObj.currentOrder;
  
  objArray["orderId"].innerHTML = optionJsonObj.orderId;
  objArray["orderStatus"].innerHTML = optionJsonObj.orderStatus;
  objArray["orderProductName"].innerHTML = optionJsonObj.productName;
  objArray["orderProductDetail"].innerHTML = optionJsonObj.productDetail;
  objArray["orderSetUpFee"].innerHTML = optionJsonObj.setUpFee;
  objArray["orderMonthlyFee"].innerHTML = optionJsonObj.monthlyFee;
  objArray["orderServiceTerm"].innerHTML = optionJsonObj.month;
  objArray["orderStore"].innerHTML = optionJsonObj.store;
  objArray["orderAmount"].innerHTML = optionJsonObj.totalAmount;
  objArray["orderAmountTax"].innerHTML = optionJsonObj.amountWithTax;
  objArray["orderPaymentMethod"].innerHTML = optionJsonObj.paymentMethod;
  objArray["orderPaymentInfo"].innerHTML = optionJsonObj.paymentInfo;
  objArray["orderPayment"].innerHTML = optionJsonObj.amountPaid;
  objArray["orderNote"].innerHTML = optionJsonObj.note;

  console.log("Order preloaded!");

}

/** 
 * Name: db1ProviousOrderProcess
 * Description: Dashboard 1 previous order process
 * objArray -- object array
 * 
 * Return None
 */
function db1ProviousOrderProcess(objArray)
{
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send();   //This is necessary even if no data sent to server

  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
        console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      if(respData.status == 0)
      {
        objArray["totalOrder"].innerHTML = respData.totalOrder;
        objArray["currentOrder"].innerHTML = respData.currentOrder;
      
        objArray["orderId"].innerHTML = respData.orderId;
        objArray["orderStatus"].innerHTML = respData.orderStatus;
        objArray["orderProductName"].innerHTML = respData.productName;
        objArray["orderProductDetail"].innerHTML = respData.productDetail;
        objArray["orderSetUpFee"].innerHTML = respData.setUpFee;
        objArray["orderMonthlyFee"].innerHTML = respData.monthlyFee;
        objArray["orderServiceTerm"].innerHTML = respData.month;
        objArray["orderStore"].innerHTML = respData.store;
        objArray["orderAmount"].innerHTML = respData.totalAmount;
        objArray["orderAmountTax"].innerHTML = respData.amountWithTax;
        objArray["orderPaymentMethod"].innerHTML = respData.paymentMethod;
        objArray["orderPaymentInfo"].innerHTML = respData.paymentInfo;
        objArray["orderPayment"].innerHTML = respData.amountPaid;
        objArray["orderNote"].innerHTML = respData.note;
      }
      else if(respData.status == 110)
      {
        return;
      }
      else
      {
        return;
      }
    }
  }
}

/** 
 * Name: db1NextOrderProcess
 * Description: Dashboard 1 next order process
 * objArray -- object array
 * 
 * Return None
 */
function db1NextOrderProcess(objArray)
{
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send();   //This is necessary even if no data sent to server

  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
        console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      if(respData.status == 0)
      {
        objArray["totalOrder"].innerHTML = respData.totalOrder;
        objArray["currentOrder"].innerHTML = respData.currentOrder;
      
        objArray["orderId"].innerHTML = respData.orderId;
        objArray["orderStatus"].innerHTML = respData.orderStatus;
        objArray["orderProductName"].innerHTML = respData.productName;
        objArray["orderProductDetail"].innerHTML = respData.productDetail;
        objArray["orderSetUpFee"].innerHTML = respData.setUpFee;
        objArray["orderMonthlyFee"].innerHTML = respData.monthlyFee;
        objArray["orderServiceTerm"].innerHTML = respData.month;
        objArray["orderStore"].innerHTML = respData.store;
        objArray["orderAmount"].innerHTML = respData.totalAmount;
        objArray["orderAmountTax"].innerHTML = respData.amountWithTax;
        objArray["orderPaymentMethod"].innerHTML = respData.paymentMethod;
        objArray["orderPaymentInfo"].innerHTML = respData.paymentInfo;
        objArray["orderPayment"].innerHTML = respData.amountPaid;
        objArray["orderNote"].innerHTML = respData.note;
      }
      else if(respData.status == 110)
      {
        return;
      }
      else
      {
        return;
      }
    }
  }
}

/** 
 * Name: db1LastOrderProcess
 * Description: Dashboard 1 last order process
 * objArray -- object array
 * 
 * Return None
 */
function db1LastOrderProcess(objArray)
{
  console.log("Load last order");
  
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send();   //This is necessary even if no data sent to server

  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
        console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      if(respData.status == 0)
      {
        objArray["totalOrder"].innerHTML = respData.totalOrder;
        objArray["currentOrder"].innerHTML = respData.currentOrder;
      
        objArray["orderId"].innerHTML = respData.orderId;
        objArray["orderStatus"].innerHTML = respData.orderStatus;
        objArray["orderProductName"].innerHTML = respData.productName;
        objArray["orderProductDetail"].innerHTML = respData.productDetail;
        objArray["orderSetUpFee"].innerHTML = respData.setUpFee;
        objArray["orderMonthlyFee"].innerHTML = respData.monthlyFee;
        objArray["orderServiceTerm"].innerHTML = respData.month;
        objArray["orderStore"].innerHTML = respData.store;
        objArray["orderAmount"].innerHTML = respData.totalAmount;
        objArray["orderAmountTax"].innerHTML = respData.amountWithTax;
        objArray["orderPaymentMethod"].innerHTML = respData.paymentMethod;
        objArray["orderPaymentInfo"].innerHTML = respData.paymentInfo;
        objArray["orderPayment"].innerHTML = respData.amountPaid;
        objArray["orderNote"].innerHTML = respData.note;
      }
    }
  }
}

/** 
 * Name: loadEtPayInfo
 * Description: Dashboard 1 load email transfer payment 
 * objArray -- object array
 * 
 * Return None
 */
function loadEtPayInfo(objArray)
{
  var tempStr;
  
  tempStr = $(objArray["totalAmount"]).val();
  objArray["etPayTotalAmount"] .innerHTML = tempStr;
  
  tempStr = objArray["payEmail"].innerHTML;
  objArray["etPayEmail"] .innerHTML = tempStr;
}

/** 
 * Name: loadCreditCardPayInfo
 * Description: Dashboard 1 load credit card payment 
 * objArray -- object array
 * 
 * Return None
 */
function loadCreditCardPayInfo(objArray)
{
  var tempStr;
  
  tempStr = $(objArray["totalAmount"]).val();
  objArray["paypalTotalAmount"].innerHTML = tempStr;
  
  tempStr = objArray["payEmail"].innerHTML;
  objArray["paypalEmail"].innerHTML = tempStr;

}


/** 
 * Name: db1OrderCommitProcess
 * Description: Dashboard 1 order commit process 
 * objArray -- object array
 * 
 * Return None
 */
function db1OrderCommitProcess(objArray)
{
  var jsonStrInfo = $(objArray["form"]).serializeObject();  
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonStrInfo));

  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      alert(respData.info);
    }
  }

}







