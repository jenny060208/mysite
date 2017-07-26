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
   var pattern = /^([a-zA-Z0-9 ])/;  

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
 * Check enquiry form detail msg
 * Return true if message length is valid (maximum 300 characters)
 *        false if message length is not valid
 */  
function enquiryFormMsgCheck(message)
{  
   if ((message.length <4) || (message.length > 300))
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
  //Verify the input form item first
  // 1 -- verify full name
  // 2 -- verify email
  // 3 -- verify phone
  // 4 -- verify Company name
 
  var elementVerify = true;
  var name_value    = $(objArray["name"]).val();
  var email_value   = $(objArray["email"]).val();
  var phone_value   = $(objArray["phone"]).val();
  var bn_name_value = $(objArray["companyName"]).val();

  console.log(name_value);
  console.log(email_value);
  console.log(phone_value);
  console.log(bn_name_value);
  
  // Name check
  if(!usernameCheck(name_value))
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
  
  // email check
  if(!emailCheck(email_value))
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
  
  // Phone check
  if(!mobileNumberCheck(phone_value))
  {
    // change the error cell background color to red
    changeBgColor(objArray["phone"], false);
    objArray["phone"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["phone"], true);
  }
  
  //Company name check
  if(!usernameCheck(bn_name_value))
  {
    // change the error cell background color to red
    changeBgColor(objArray["companyName"], false);
    objArray["companyName"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["companyName"], true);
  }
  
  if(!elementVerify)
  {
    //Return due to field check error
    return;
  }
  
  var formInfo = $(objArray["form"]).serializeObject();
  var jsonStr = JSON.stringify(formInfo);
  
  console.log(jsonStr);
         
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(jsonStr);
  
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

  // Empty selected box before add
  selectId.options.length = 0;
  
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
 * Name: addSelectOptions3
 * Description: Add option items not include value in select
 * selectId -- Select ID
 * optionJsonObj -- Option items in Json object format
 * index -- selected index
 * Return None
 */
function addSelectOptions3(selectId, optionJsonObj, index)
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

  // Empty selected box before add
  selectId.options.length = 0;

  for(var count = 0; count < arrayOptions.length; count++)
  {
    optionName = arrayOptions[count];
    optionValue = arrayOptions[count];
    optionItem = new Option(optionName, optionValue);
    selectId.options.add(optionItem);
  }
  //Set selected item 
  selectId.selectedIndex = Number(index) -1;

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

/** 
 * Name: createRootAccount
 * Description: Create admin root account
 * objArray -- object array
 * 
 * Return None
 */
function createRootAccount(objArray)
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

/** 
 * Name: adminPasswordRecover
 * Description: Admin account password recover
 * objArray -- object array
 * 
 * Return None
 */
function adminPasswordRecover(objArray)
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

/** 
 * Name: adminAccountSignIn
 * Description: Admin account sign in process
 * objArray -- object array
 * 
 * Return None
 */
function adminAccountSignIn(objArray)
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
      
      if(respData.status == 0)
      {
        // Response success
        alert(respData.info);
        //jump to new dashboard page
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
 * Name: generalEnquiryFormProcess
 * Description: general enquiry form process
 * objArray -- object array
 * 
 * Return None
 */
function generalEnquiryFormProcess(objArray)
{
  var  elementVerify = true;
  var nameValue = $(objArray["name"]).val();
  var emailValue = $(objArray["email"]).val();
  var msgValue = $(objArray["msg"]).val();
  
  //Verify the input form item first
  // Verify email
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

  // Verify name
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
  
  // Verify message
  if(!enquiryFormMsgCheck(msgValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["msg"], false);
    objArray["name"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["msg"], true);
  }

  if(!elementVerify)
  {
    return;
  }

//process to submit message to server
  var jsonStrInfo = $(objArray["form"]).serializeObject();
  console.log(JSON.stringify(jsonStrInfo));

  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonStrInfo));

  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      alert(respData.info);
    }
  }
}


/** 
 * Name: getMoreInfoFormProcess
 * Description: Get more information form process
 * objArray -- object array
 * 
 * Return None
 */
function getMoreInfoFormProcess(objArray)
{
  var  elementVerify = true;
  var nameValue = $(objArray["name"]).val();
  var emailValue = $(objArray["email"]).val();
  var phoneValue = $(objArray["phone"]).val();
  var companyNameValue = $(objArray["company_name"]).val();

  //Verify the input form item first
  //Verify name
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
  
  // Verify email
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

  // Verify phone number
  if(!mobileNumberCheck(phoneValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["phone"], false);
    objArray["phone"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["phone"], true);
  }
  
  // Verify company name
  if(!businessNameCheck(companyNameValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["company_name"], false);
    objArray["company_name"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["company_name"], true);
  }

  if(!elementVerify)
  {
    return;
  }

//process to submit message to server
  var objTemp = new Object();
  
  objTemp.name = nameValue;
  objTemp.email = emailValue;
  objTemp.phone = phoneValue;
  objTemp.companyName = companyNameValue;
    
  var jsonString = JSON.stringify(objTemp);//Serialization
 // alert("JsonString  = " + JsonString );
  console.log(jsonString);
  
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", objArray["action"], true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonString));

  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      alert(respData.info);
    }
  }
}

/** 
 * Name: linkActionProcess1
 * Description: link action process style 1 (action only)
 * objArray -- object array
 * 
 * Return None
 */
function linkActionProcess1(objArray)
{
  var actionStr = objArray["action"];

  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send( );

  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
      //get the json data
      var respData = $.parseJSON(data);
      alert(respData.info);
    }
  }
}

//=========================================================
// Admin process 
//=========================================================
function adminAccountCreateProcess(objArray)
{
  
  //Verify the input form item first
  // 1 -- verify first name
  // 2 -- verify last name
  // 3 -- verify email
  // 4 -- verify phone number
  // 5 -- verify mobile number
  
  var elementVerify = true;
  var fNameValue   = $(objArray["first_name"]).val();
  var lNameValue   = $(objArray["last_name"]).val();
  var emailValue  = $(objArray["email"]).val();
  var phoneValue = $(objArray["phone"]).val();
  var mobileValue = $(objArray["mobile"]).val();
  
  // Verify first name
  if(!usernameCheck(fNameValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["first_name"], false);
    objArray["first_name"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["first_name"], true);
  }
         
  // Verify last name
  if(!usernameCheck(lNameValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["last_name"], false);
    objArray["last_name"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["last_name"], true);
  }
  
  // Verify email
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
    
  //Verify the phone
  if(!mobileNumberCheck(phoneValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["phone"], false);
    objArray["phone"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["phone"], true);
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
  
  //
  if(!elementVerify)
  {
    return;
  }
    
  var actionStr = objArray["action"];

  var jsonInfo = $(objArray["form"]).serializeObject();
  console.log(JSON.stringify(jsonInfo));
       
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonInfo));
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      alert(respData.info);
    }
  }
}

function merchantAccountCreatePresetProcess(objArray)
{
  $(objArray["first_name"]).val(null);
  $(objArray["last_name"]).val(null);
  $(objArray["merchant_name"]).val(null);
  $(objArray["email"]).val(null);
  $(objArray["phone"]).val(null);
  $(objArray["mobile"]).val(null);
  return;
}


function merchantAccountCreateProcess(objArray)
{
  
  //Verify the input form item first
  // 1 -- verify first name
  // 2 -- verify last name
  // 3 -- verify merchant name
  // 4 -- verify email
  // 5 -- verify phone number
  // 6 -- verify mobile number
  
  var elementVerify = true;
  var fNameValue   = $(objArray["first_name"]).val();
  var lNameValue   = $(objArray["last_name"]).val();
  var mNameValue   = $(objArray["merchant_name"]).val();
  var emailValue  = $(objArray["email"]).val();
  var phoneValue = $(objArray["phone"]).val();
  var mobileValue = $(objArray["mobile"]).val();
  
  // Verify first name
  if(!usernameCheck(fNameValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["first_name"], false);
    objArray["first_name"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["first_name"], true);
  }
         
  // Verify last name
  if(!usernameCheck(lNameValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["last_name"], false);
    objArray["last_name"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["last_name"], true);
  }
  
  // Verify merchant name
  if(!businessNameCheck(mNameValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["merchant_name"], false);
    objArray["last_name"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["merchant_name"], true);
  }
  
  // Verify email
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
    
  //Verify the phone
  if(!mobileNumberCheck(phoneValue))
  {
    // change the error cell background color to red
    changeBgColor(objArray["phone"], false);
    objArray["phone"].focus();
    elementVerify = false;
  }
  else
  {
    changeBgColor(objArray["phone"], true);
  }
  
  // Verify the mobile
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
  
  //
  if(!elementVerify)
  {
    return;
  }
    
  var actionStr = objArray["action"];

  var jsonInfo = $(objArray["form"]).serializeObject();
  console.log(JSON.stringify(jsonInfo));
       
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonInfo));
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      alert(respData.info);
    }
  }
}

// Create Tag process
function tagCreateProcess(objArray)
{
  var actionStr = objArray["action"];

  var jsonInfo = $(objArray["form"]).serializeObject();
  console.log(JSON.stringify(jsonInfo));
       
  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(JSON.stringify(jsonInfo));
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      alert(respData.info);
    }
  }
}

/** 
 * Name: tagInfoPreload
 * Description: preload tag info
 * objArray -- object array
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function tagInfoPreload(objArray, optionJsonObj)
{
  var totalTag;
  var tagInfoObj = new Object();
  tagInfoObj.current_tag =  objArray["currentTag"].innerHTML;

  var tagInfoJson =  JSON.stringify(tagInfoObj);
  console.log(tagInfoJson);
  
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(tagInfoJson);
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      
      if((respData.status == 0) && (respData.info.total_tag != 0))
      {
        $(objArray["tagId"]).val(respData.info.tag_id);
        $(objArray["tagIndex"]).val(respData.info.tag_index);
        $(objArray["tagNumber"]).val(respData.info.tag_number);
        $(objArray["tagBid"]).val(respData.info.bid);
        $(objArray["tagLabel"]).val(respData.info.tag_label);
        $(objArray["tagWebPage"]).val(respData.info.tag_webpage);
        
        objArray["totalTag"].innerHTML = respData.info.total_tag;
        objArray["currentTag"].innerHTML = respData.info.current_tag;
        
     // Load tag status options
        addSelectOptions3(objArray["tagStatus"], respData.info.tag_status_def, respData.info.tag_status);
        
        // Load tag type options
        addSelectOptions3(objArray["tagType"], respData.info.tag_type_def, respData.info.tag_type);
        
      }
      else
      {
        objArray["totalTag"].innerHTML = "0";
        objArray["currentTag"].innerHTML =  "0";
        
        $(objArray["tagId"]).val(null);
        $(objArray["tagIndex"]).val(null);
        $(objArray["tagNumber"]).val(null);
        $(objArray["tagBid"]).val(null);
        $(objArray["tagLabel"]).val(null);
        $(objArray["tagWebPage"]).val(null);
        
        addSelectOptions3(objArray["tagStatus"], 0, 0);
        
        // Load tag type options
        addSelectOptions3(objArray["tagType"], 0, 0);
      }
    }
  }  
  
}

/** 
 * Name: tagLoadPreviousProcess
 * Description: preload tag info
 * objArray -- object array
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function tagLoadPreviousProcess(objArray)
{
  var totalTag;
  var tagInfoObj = new Object();
  tagInfoObj.current_tag =  objArray["currentTag"].innerHTML;

  var tagInfoJson =  JSON.stringify(tagInfoObj);
  console.log(tagInfoJson);
  
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(tagInfoJson);
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      
      if((respData.status == 0) && (respData.info.total_tag != 0))
      {
        $(objArray["tagId"]).val(respData.info.tag_id);
        $(objArray["tagIndex"]).val(respData.info.tag_index);
        $(objArray["tagNumber"]).val(respData.info.tag_number);
        $(objArray["tagBid"]).val(respData.info.bid);
        $(objArray["tagLabel"]).val(respData.info.tag_label);
        $(objArray["tagWebPage"]).val(respData.info.tag_webpage);
        
        objArray["totalTag"].innerHTML = respData.info.total_tag;
        objArray["currentTag"].innerHTML = respData.info.current_tag;
        
     // Load tag status options
        addSelectOptions3(objArray["tagStatus"], respData.info.tag_status_def, respData.info.tag_status);
        
        // Load tag type options
        addSelectOptions3(objArray["tagType"], respData.info.tag_type_def, respData.info.tag_type);
        
      }
      else
      {
        objArray["totalTag"].innerHTML = "0";
        objArray["currentTag"].innerHTML =  "0";
        
        $(objArray["tagId"]).val(null);
        $(objArray["tagIndex"]).val(null);
        $(objArray["tagNumber"]).val(null);
        $(objArray["tagBid"]).val(null);
        $(objArray["tagLabel"]).val(null);
        $(objArray["tagWebPage"]).val(null);
        
        addSelectOptions3(objArray["tagStatus"], 0, 0);
        
        // Load tag type options
        addSelectOptions3(objArray["tagType"], 0, 0);
      }
    }
  }  
}

/** 
 * Name: tagLoadNextProcess
 * Description: preload tag info
 * objArray -- object array
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function tagLoadNextProcess(objArray)
{
  var totalTag;
  var tagInfoObj = new Object();
  tagInfoObj.current_tag =  objArray["currentTag"].innerHTML;

  var tagInfoJson =  JSON.stringify(tagInfoObj);
  console.log(tagInfoJson);
  
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(tagInfoJson);
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      
      if((respData.status == 0) && (respData.info.total_tag != 0))
      {
        $(objArray["tagId"]).val(respData.info.tag_id);
        $(objArray["tagIndex"]).val(respData.info.tag_index);
        $(objArray["tagNumber"]).val(respData.info.tag_number);
        $(objArray["tagBid"]).val(respData.info.bid);
        $(objArray["tagLabel"]).val(respData.info.tag_label);
        $(objArray["tagWebPage"]).val(respData.info.tag_webpage);
        
        objArray["totalTag"].innerHTML = respData.info.total_tag;
        objArray["currentTag"].innerHTML = respData.info.current_tag;
        
     // Load tag status options
        addSelectOptions3(objArray["tagStatus"], respData.info.tag_status_def, respData.info.tag_status);
        
        // Load tag type options
        addSelectOptions3(objArray["tagType"], respData.info.tag_type_def, respData.info.tag_type);
        
      }
      else
      {
        objArray["totalTag"].innerHTML = "0";
        objArray["currentTag"].innerHTML =  "0";
        
        $(objArray["tagId"]).val(null);
        $(objArray["tagIndex"]).val(null);
        $(objArray["tagNumber"]).val(null);
        $(objArray["tagBid"]).val(null);
        $(objArray["tagLabel"]).val(null);
        $(objArray["tagWebPage"]).val(null);
        
        addSelectOptions3(objArray["tagStatus"], 0, 0);
        
        // Load tag type options
        addSelectOptions3(objArray["tagType"], 0, 0);
      }
    }
  }
  
}

/** 
 * Name: tagDeleteProcess
 * Description: preload tag info
 * objArray -- object array
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function tagDeleteProcess(objArray)
{
  // Check the total tags first, if zero then return directly
  var totalTag = Number(objArray["totalTag"].innerHTML);

  if(totalTag == 0)
  {
    return;
  }

  var tagInfoObj = new Object();
  tagInfoObj.current_tag =  objArray["currentTag"].innerHTML;
  tagInfoObj.tag_id =  $(objArray["tagId"]).val();
  
  var tagInfoJson =  JSON.stringify(tagInfoObj);
  console.log(tagInfoJson);
  
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(tagInfoJson);
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      
      if((respData.status == 0) && (respData.info.total_tag != 0))
      {
        $(objArray["tagId"]).val(respData.info.tag_id);
        $(objArray["tagIndex"]).val(respData.info.tag_index);
        $(objArray["tagNumber"]).val(respData.info.tag_number);
        $(objArray["tagBid"]).val(respData.info.bid);
        $(objArray["tagLabel"]).val(respData.info.tag_label);
        $(objArray["tagWebPage"]).val(respData.info.tag_webpage);
        
        objArray["totalTag"].innerHTML = respData.info.total_tag;
        objArray["currentTag"].innerHTML = respData.info.current_tag;
        
     // Load tag status options
        addSelectOptions3(objArray["tagStatus"], respData.info.tag_status_def, respData.info.tag_status);
        
        // Load tag type options
        addSelectOptions3(objArray["tagType"], respData.info.tag_type_def, respData.info.tag_type);
        
      }
      else
      {
        objArray["totalTag"].innerHTML = "0";
        objArray["currentTag"].innerHTML =  "0";
        
        $(objArray["tagId"]).val(null);
        $(objArray["tagIndex"]).val(null);
        $(objArray["tagNumber"]).val(null);
        $(objArray["tagBid"]).val(null);
        $(objArray["tagLabel"]).val(null);
        $(objArray["tagWebPage"]).val(null);
        
        addSelectOptions3(objArray["tagStatus"], 0, 0);
        
        // Load tag type options
        addSelectOptions3(objArray["tagType"], 0, 0);
      }
    }
  }
  
}

/** 
 * Name: tagUpdateProcess
 * Description: preload tag info
 * objArray -- object array
 * optionJsonObj -- Option items in Json object format
 * Return None
 */
function tagUpdateProcess(objArray)
{
  // Check the total tags first, if zero then return directly
  var totalTag = Number(objArray["totalTag"].innerHTML);

  if(totalTag == 0)
  {
    return;
  }

  var tagInfoObj = new Object();
  tagInfoObj.current_tag =  objArray["currentTag"].innerHTML;
  tagInfoObj.total_tag =  objArray["totalTag"].innerHTML;
  tagInfoObj.tag_id =  $(objArray["tagId"]).val();
  tagInfoObj.tag_index =  $(objArray["tagIndex"]).val();
  tagInfoObj.tag_number =  $(objArray["tagNumber"]).val();
  tagInfoObj.tag_status = $(objArray["tagStatus"]).val();
  tagInfoObj.tag_type = $(objArray["tagType"]).val();
  tagInfoObj.tag_bid = $(objArray["tagBid"]).val();
  tagInfoObj.tag_label = $(objArray["tagLabel"]).val();
  tagInfoObj.tag_web_page = $(objArray["tagWebPage"]).val();

  var tagInfoJson =  JSON.stringify(tagInfoObj);
  console.log(tagInfoJson);

  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(tagInfoJson);
    
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
      }
     
    }
  }
  
}

/** 
 * Name: tagReportRefreshProcess
 * Description: tag report refresh
 * objArray -- object array
 * 
 * Return None
 */
function tagReportRefreshProcess(objArray)
{
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send();
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      
      objArray["tagTotal"].innerHTML = respData.tag_report_total
      objArray["tagInitial"].innerHTML = respData.tag_report_initial
      objArray["tagEnable"].innerHTML = respData.tag_report_enable
      objArray["tagDisable"].innerHTML = respData.tag_report_disable
    }
  }
  
}

/** 
 * Name: adtUserRegisterProcess
 * Description: tag user register form process
 * objArray -- object array
 * 
 * Return None
 */
function adtUserRegisterProcess(objArray)
{
  //Verify the input form item first
  // 1 -- verify first name
  // 2 -- verify last name
  // 3 -- verify email
  // 4 -- verify mobile name
  // 5 -- verify check box
  
  var elementVerify = true;
  var fNameValue   = $(objArray["firstName"]).val();
  var lNameValue   = $(objArray["lastName"]).val();
  var emailValue  = $(objArray["email"]).val();
  var mobileValue = $(objArray["mobile"]).val();
  var chkBoxValue = $(objArray["chkBox"]).is(':checked');

  var fNameError = objArray["firstNameError"];
  var lNameError = objArray["lastNameError"] ;
  var emailError = objArray["emailError"];
  var mobileError = objArray["mobileError"];
  var chkError = objArray["chkBoxError"];
  
  // clear the error indication first
  fNameError.style.display = "none";
  lNameError.style.display = "none";
  emailError.style.display = "none";
  mobileError.style.display = "none";
  chkError.style.display = "none";
  
  
  // Verify first name
  if(!usernameCheck(fNameValue))
  {
    // change the error cell background color to red
  //  changeBgColor(objArray["firstName"], false);
    objArray["firstName"].focus();
    fNameError.style.display = "block";
    fNameError.innerHTML = "Invalid First Name";
    elementVerify = false;
  }
  
         
  // Verify last name
  if(!usernameCheck(lNameValue))
  {
    // change the error cell background color to red
  //  changeBgColor(objArray["lastName"], false);
    objArray["lastName"].focus();
    lNameError.style.display = "block";
    lNameError.innerHTML = "Invalid Last Name";
    elementVerify = false;
  }

  // Verify email
  if(!emailCheck(emailValue))
  {
    // change the error cell background color to red
  //  changeBgColor(objArray["email"], false);
    objArray["email"].focus();
    emailError.style.display = "block";
    emailError.innerHTML = "Invalid email";
    elementVerify = false;
  }

  // Verify the mobile
  if(!mobileNumberCheck(mobileValue))
  {
    // change the error cell background color to red
  //  changeBgColor(objArray["mobile"], false);
    objArray["mobile"].focus();
    mobileError.style.display = "block";
    mobileError.innerHTML = "Invalid Mobile phone number";
    elementVerify = false;
  }

  //
  if(!elementVerify)
  {
    return;
  }

  // Verify the check box
  if(false == chkBoxValue)
  {
    //  alert("Please check the consent box!");
    chkError.style.display = "block";
    chkError.innerHTML = "Please check the consent box!";
    return;
  }

  var userRegisterObj = new Object();
  userRegisterObj.first_name =  fNameValue;
  userRegisterObj.last_name =  lNameValue;
  userRegisterObj.email =  emailValue;
  userRegisterObj.mobile = mobileValue;
  
  var userRegisterInfoJson =  JSON.stringify(userRegisterObj);
  console.log(userRegisterInfoJson);

  var actionStr = objArray["action"];

  // send form data in Json string to server 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(userRegisterInfoJson);
    
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
        // Response success
        fNameError.style.display = "none";
        lNameError.style.display = "none";
        emailError.style.display = "none";
        mobileError.style.display = "none";
        chkError.style.display = "none";
        //jump to new dashboard page
        location.href = respData.url;
      }
      else if (respData.status == 500)
      {
        // check field error 
      //  alert(respData.info);
        if(respData.info.indexOf("email") >= 0)
        {
          emailError.style.display = "block";
          emailError.innerHTML = respData.info;
        }
        
        if(respData.info.indexOf("mobile") >= 0)
        {
          mobileError.style.display = "block";
          mobileError.innerHTML = respData.info;
        }
      }
      else
      {
        alert(respData.info);
      }
    }
  }

}

/** 
 * Name: merchantAccountInfoLoadInAdmin
 * Description: preload merchant account info
 * objArray -- object array
 * currentMerchant -- current merchant
 * 
 * Return None
 */
function merchantAccountInfoLoadInAdmin(objArray, currentMerchant)
{
  var totalMerchant;
  var merchantInfoObj = new Object();
  merchantInfoObj.current_merchant =  currentMerchant;

  var merchantInfoJson =  JSON.stringify(merchantInfoObj);
  console.log(merchantInfoJson);
  
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(merchantInfoJson);
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      
      if((respData.status == 0) && (respData.info.total_merchant != 0))
      {
        $(objArray["mid"]).val(respData.info.merchant_id);
        $(objArray["first_name"]).val(respData.info.first_name);
        $(objArray["last_name"]).val(respData.info.last_name);
        $(objArray["merchant_name"]).val(respData.info.merchant_name);
        $(objArray["web_page"]).val(respData.info.web_page);
        $(objArray["email"]).val(respData.info.email);
        $(objArray["phone"]).val(respData.info.phone);
        $(objArray["mobile"]).val(respData.info.mobile);
        
        
        $(objArray["address"]).val(respData.info.address);
        $(objArray["city"]).val(respData.info.city);
        $(objArray["postal_code"]).val(respData.info.postal_code);
        
        $(objArray["fb_id"]).val(respData.info.fb_id);
        $(objArray["twitter_id"]).val(respData.info.twitter_id);
        $(objArray["reward_msg"]).val(respData.info.reward_msg);
        $(objArray["success_msg"]).val(respData.info.success_msg);
        $(objArray["note"]).val(respData.info.note);
        
        objArray["currentMerchant"].innerHTML = respData.info.current_merchant;
        objArray["totalMerchant"].innerHTML = respData.info.total_merchant;

        // Load merchant status options
        addSelectOptions3(objArray["merchant_status"], respData.info.merchant_status_def, respData.info.merchant_status);
        // Load province/state
        addSelectOptions3(objArray["province"], respData.info.province_def, respData.info.province);
        //Load country
        addSelectOptions3(objArray["country"], respData.info.country_def, respData.info.country);

      }
      else
      {
        $(objArray["first_name"]).val(null);
        $(objArray["last_name"]).val(null);
        $(objArray["merchant_name"]).val(null);
        $(objArray["web_page"]).val(null);
        $(objArray["email"]).val(null);
        $(objArray["phone"]).val(null);
         
        $(objArray["mobile"]).val(null);
        $(objArray["address"]).val(null);
        $(objArray["city"]).val(null);
        $(objArray["postal_code"]).val(null);

        $(objArray["fb_id"]).val(null);
        $(objArray["twitter_id"]).val(null);
        $(objArray["reward_msg"]).val(null);
        $(objArray["success_msg"]).val(null);
        $(objArray["note"]).val(null);
    
        objArray["currentMerchant"].innerHTML = 0;
        objArray["totalMerchant"].innerHTML = 0;

        // Load merchant status options
        addSelectOptions3(objArray["merchant_status"], 0, 0);
        addSelectOptions3(objArray["province"], 0, 0);
        addSelectOptions3(objArray["country"], 0, 0);
        
        
      }
    }
  }  
  
}

/** 
 * Name: merchantAccountInfoPreviousLoadInAdmin
 * Description: load previous merchant account info
 * objArray -- object array
 * 
 * 
 * Return None
 */
function merchantAccountInfoPreviousLoadInAdmin(objArray)
{
  var currentMerchant;

  currentMerchant =  Number(objArray["currentMerchant"].innerHTML);

  if(currentMerchant > 1)
  {
    currentMerchant = currentMerchant -1;
  }

  merchantAccountInfoLoadInAdmin(objArray, currentMerchant);
}


/** 
 * Name: merchantAccountInfoNextLoadInAdmin
 * Description: load next merchant account info
 * objArray -- object array
 * 
 * 
 * Return None
 */
function merchantAccountInfoNextLoadInAdmin(objArray)
{
  var currentMerchant;

  currentMerchant =  Number(objArray["currentMerchant"].innerHTML);

  currentMerchant = currentMerchant + 1;

  merchantAccountInfoLoadInAdmin(objArray, currentMerchant);
}

/** 
 * Name: merchantAcntDeleteProcessInAdmin
 * Description: delete the merchant account
 * objArray -- object array
 * 
 * 
 * Return None
 */
function merchantAcntDeleteProcessInAdmin(objArray)
{
  // Check the total account first, if zero then return directly
  var totalAcnt = Number(objArray["totalMerchant"].innerHTML);
  if(totalAcnt == 0)
  {
    return;
  }

  var merchantInfoObj = new Object();
  merchantInfoObj.current_merchant =  objArray["currentMerchant"].innerHTML;
  merchantInfoObj.merchant_id = $(objArray["mid"]).val();
  
  var merchantInfoJson =  JSON.stringify(merchantInfoObj);
  console.log(merchantInfoJson);
  
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(merchantInfoJson);
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      
      if((respData.status == 0) && (respData.info.total_merchant != 0))
      {
        $(objArray["mid"]).val(respData.info.merchant_id);
        $(objArray["first_name"]).val(respData.info.first_name);
        $(objArray["last_name"]).val(respData.info.last_name);
        $(objArray["merchant_name"]).val(respData.info.merchant_name);
        $(objArray["web_page"]).val(respData.info.web_page);
        $(objArray["email"]).val(respData.info.email);
        $(objArray["phone"]).val(respData.info.phone);
        $(objArray["mobile"]).val(respData.info.mobile);
        $(objArray["address"]).val(respData.info.address);
        $(objArray["city"]).val(respData.info.city);
        $(objArray["postal_code"]).val(respData.info.postal_code);
        $(objArray["fb_id"]).val(respData.info.fb_id);
        $(objArray["twitter_id"]).val(respData.info.twitter_id);
        $(objArray["reward_msg"]).val(respData.info.reward_msg);
        $(objArray["success_msg"]).val(respData.info.success_msg);
        $(objArray["note"]).val(respData.info.note);
    
        objArray["currentMerchant"].innerHTML = respData.info.current_merchant;
        objArray["totalMerchant"].innerHTML = respData.info.total_merchant;

        // Load merchant status options
        addSelectOptions3(objArray["merchant_status"], respData.info.merchant_status_def, respData.info.merchant_status);
        // Load province/state
        addSelectOptions3(objArray["province"], respData.info.province_def, respData.info.province);
        //Load country
        addSelectOptions3(objArray["country"], respData.info.country_def, respData.info.country);

      }
      else
      {
        $(objArray["mid"]).val(null);
        $(objArray["first_name"]).val(null);
        $(objArray["last_name"]).val(null);
        $(objArray["merchant_name"]).val(null);
        $(objArray["web_page"]).val(null);
        $(objArray["email"]).val(null);
        $(objArray["phone"]).val(null);
       
        $(objArray["mobile"]).val(null);
        $(objArray["address"]).val(null);
        $(objArray["city"]).val(null);
        $(objArray["postal_code"]).val(null);

        $(objArray["fb_id"]).val(null);
        $(objArray["twitter_id"]).val(null);
        $(objArray["reward_msg"]).val(null);
        $(objArray["success_msg"]).val(null);
        $(objArray["note"]).val(null);
      
        objArray["currentMerchant"].innerHTML = 0;
        objArray["totalMerchant"].innerHTML = 0;

        // Load merchant status options
        addSelectOptions3(objArray["merchant_status"], 0, 0);
        addSelectOptions3(objArray["province"], 0, 0);
        addSelectOptions3(objArray["country"], 0, 0);
      }
    }
  }
}


/** 
 * Name: merchantAcntUpdateProcessInAdmin
 * Description: update the merchant account
 * objArray -- object array
 * 
 * 
 * Return None
 */
function merchantAcntUpdateProcessInAdmin(objArray)
{
  // Check the total account first, if zero then return directly
  var totalAcnt = Number(objArray["totalMerchant"].innerHTML);
  if(totalAcnt == 0)
  {
    return;
  }
  // Validate the input field
  var merchantInfoObj = new Object();
  merchantInfoObj.current_merchant =  objArray["currentMerchant"].innerHTML;
  merchantInfoObj.total_merchant = objArray["totalMerchant"].innerHTML;
  
  merchantInfoObj.merchant_id =  $(objArray["mid"]).val();
  merchantInfoObj.first_name =  $(objArray["first_name"]).val();
  merchantInfoObj.last_name =$(objArray["last_name"]).val();
  merchantInfoObj.merchant_name =  $(objArray["merchant_name"]).val();
  merchantInfoObj.merchant_status =  $(objArray["merchant_status"]).val();
  merchantInfoObj.web_page =  $(objArray["web_page"]).val();
  
  merchantInfoObj.email =$(objArray["email"]).val();
  merchantInfoObj.phone =  $(objArray["phone"]).val();
  merchantInfoObj.mobile =  $(objArray["mobile"]).val();
  
  merchantInfoObj.address =$(objArray["address"]).val();
  merchantInfoObj.city =  $(objArray["city"]).val();
  merchantInfoObj.province =  $(objArray["province"]).val();
  merchantInfoObj.country =  $(objArray["country"]).val();
  merchantInfoObj.postal_code =  $(objArray["postal_code"]).val();
  merchantInfoObj.fb_id =$(objArray["fb_id"]).val();
  merchantInfoObj.twitter_id =$(objArray["twitter_id"]).val();
 
  merchantInfoObj.reward_msg =$(objArray["reward_msg"]).val();
  merchantInfoObj.success_msg =$(objArray["success_msg"]).val();
  merchantInfoObj.note =$(objArray["note"]).val();
 
  var merchantInfoJson =  JSON.stringify(merchantInfoObj);
  console.log(merchantInfoJson);
  
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send(merchantInfoJson);
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
     
      alert(respData.info);
     
    }
  }
}

/** 
 * Name: merchantAcntReportRefreshProcessInAdmin
 * Description: merchant account report refresh
 * objArray -- object array
 * 
 * Return None
 */
function merchantAcntReportRefreshProcessInAdmin(objArray)
{
  var actionStr = objArray["action"];
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("post", actionStr, true);
  xmlhttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
  xmlhttp.send();
    
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var data = xmlhttp.responseText;
      console.log(data);
             
      //get the json data
      var respData = $.parseJSON(data);
      
      objArray["mAcntTotal"].innerHTML = respData.acnt_report_total
      objArray["mAcntInitial"].innerHTML = respData.acnt_report_initial
      objArray["mAcntEnable"].innerHTML = respData.acnt_report_enable
      objArray["mAcntDisable"].innerHTML = respData.acnt_report_disable
    }
  }

}




