<?php
namespace Home\Controller;

use Think\Controller;
use Home\Service\UserService;


class UserController extends Controller
{
  public $user_id = 0;
  public $user = array();
   
  public function _initialize()
  {
    session_start();
   /*   
      if(isset($_SESSION['user'])) 
      {
         $user = session('user');
      }
    */
    /*  
      if(session('?user'))
      {
         $user = session('user');
         $user = M('users')->where("user_id = {$user['user_id']}")->find();
         session('user',$user);  //覆盖session 中的 user               
         $this->user = $user;
         $this->user_id = $user['user_id'];
         $this->assign('user',$user); //存储用户信息
         $this->assign('user_id',$this->user_id);
      }
   */
   
  }
   
  /**
   * Name  : index
   * Input : N/A
   * Output: N/A
   * Description: user profile main page, only jump to here if sign in successfully 
   *              jump to sign in page if no session found
   */
  public function index()
  {
    if(isset($_SESSION['uid']))
    {
      $user_name = $_SESSION['user_name'];

      $storeInfo = array();
      $storeInfo['user_name'] = $user_name;
      $storeInfo['storeCount'] = 5;
      $storeInfo['points'] = "5";

      $this->assign('storeInfo',$storeInfo);
      $this->show( );
    } 
    else
    {
      $this->redirect('User/signIn');
    }  
  //     $this->show( );
  }
 
  /**
   * Name  : register
   * Input : N/A
   * Output: N/A
   * Description: user register page
   * 
   */
  public function register()
  {
    //  echo 'User Register!';
    $this->show( );
  }

  /**
   * Name  : registerProc
   * Input : N/A
   * Output: N/A
   * Description: user register process page
   * 
   */
  public function registerProc()
  {
    header("Content-type: application/json; charset = utf-8");
    $reg_data = json_decode(file_get_contents('php://input'));
    $m_user = new UserService();
    $result = $m_user->registUserByEmail($reg_data);

    $this->ajaxReturn($result);
  }
  
  /**
   * Name  : signIn
   * Input : N/A
   * Output: N/A
   * Description: user sign in page
   * 
   */
  public function signIn()
  {
    // echo 'User Sign In!';
    $this->show( );
  }

  /**
   * Name  : signInProc
   * Input : N/A
   * Output: N/A
   * Description: user sign in process page
   * 
   */
  public function signInProc()
  {
    header("Content-type: application/json; charset = utf-8");
    $sign_data = json_decode(file_get_contents('php://input'));

    $m_user = new UserService();
    $result = $m_user->signInUserByEmail($sign_data);

    $this->ajaxReturn($result);
  }
  
  /**
   * Name  : passwd_recover
   * Input : N/A
   * Output: N/A
   * Description: user password recover page
   * 
   */
  public function passwd_recover()
  {
    //   echo 'User password recover';
    $this->show( );
  }
   
  /**
   * Name  : pwRecoverProcess
   * Input : N/A
   * Output: N/A
   * Description: user password recover process page
   * 
   */
  public function pwRecoverProcess()
  {
    header("Content-type: application/json; charset = utf-8");
    $pw_recv_data = json_decode(file_get_contents('php://input'));

    $m_user = new UserService();
    $result = $m_user->pwRecoverByEmail($pw_recv_data);

    $this->ajaxReturn($result);
  }
   
  /**
   * Name  : userProfile
   * Input : N/A
   * Output: N/A
   * Description: user sign out process page
   * 
   */
  public function user_profile( )
  {
    if(isset($_SESSION['uid']))
    {
      $user_id = $_SESSION['uid'];
      $user_name = $_SESSION['user_name'];

      $userInfo = array();
      $userInfo['user_id']   = $user_id;
      $userInfo['user_name'] = $user_name;

      $this->assign('userInfo',$userInfo);
      $this->show( );
    } 
    else
    {
      $this->redirect('User/signIn');
    }      
  }
  
 /**
   * Name  : basic_info
   * Input : N/A
   * Output: N/A
   * Description: user basic info
   * 
   */
  public function basic_info( )
  {
    header("Content-type: application/json; charset = utf-8");
    $basic_data = json_decode(file_get_contents('php://input'));

    if(isset($_SESSION['uid']))
    {
      $user_id = $_SESSION['uid'];

      $m_user = new UserService();
      $result = $m_user->userBasicInfo($user_id);
 //     $result = array();
 //     $result["status"] = 0;
 //     $result["info"]   = "Failed to connect to Server!";

      $this->ajaxReturn($result);
    }
    else
    {
      $this->redirect('User/signIn');
    }      
  }

  /**
   * Name  : basic_info_update
   * Input : N/A
   * Output: N/A
   * Description: user basic info update process
   * 
   */
  public function basic_info_update( )
  {
    header("Content-type: application/json; charset = utf-8");
    $basic_info_data = json_decode(file_get_contents('php://input'));
     
    if(isset($_SESSION['uid']))
    {
      $user_id   = $_SESSION['uid'];
      $m_user = new UserService();
      
      $result = $m_user->userBasicInfoUpdate($basic_info_data, $user_id);
      $this->ajaxReturn($result);
    } 
    else
    {
      $this->redirect('User/signIn');
    }
  }

 /**
   * Name  : password_update
   * Input : N/A
   * Output: N/A
   * Description: user password update process
   * 
   */
  public function password_update( )
  {
    header("Content-type: application/json; charset = utf-8");
    $pw_update_data = json_decode(file_get_contents('php://input'));
     
    if(isset($_SESSION['uid']))
    {
      $user_id   = $_SESSION['uid'];
      $m_user = new UserService();
      
      $result = $m_user->userPasswordUpdate($pw_update_data, $user_id);
      $this->ajaxReturn($result);
    } 
    else
    {
      $this->redirect('User/signIn');
    }      
  }
  
  /**
   * Name  : get_notice_pref_info
   * Input : N/A
   * Output: N/A
   * Description: get user notification preference info
   * 
   */
  public function get_notice_pref_info( )
  {
    header("Content-type: application/json; charset = utf-8");
    $pref_update_data = json_decode(file_get_contents('php://input'));
    
    if(isset($_SESSION['uid']))
    {
      $user_id   = $_SESSION['uid'];
      $m_user = new UserService();
      
      $result = $m_user->getUserNotificationInfo($user_id);
      $this->ajaxReturn($result);
    } 
    else
    {
      $this->redirect('User/signIn');
    }      
  }
  
  
  
  
  
  
 /**
   * Name  : notification_pref_update
   * Input : N/A
   * Output: N/A
   * Description: user notification preference update process
   * 
   */
  public function notification_pref_update( )
  {
    header("Content-type: application/json; charset = utf-8");
    $pref_update_data = json_decode(file_get_contents('php://input'));
     
    if(isset($_SESSION['uid']))
    {
      $user_id   = $_SESSION['uid'];
      $m_user = new UserService();
      
      $result = $m_user->userNotificationPrefUpdate($pref_update_data, $user_id);
      $this->ajaxReturn($result);
    } 
    else
    {
      $this->redirect('User/signIn');
    }      
  }
  
  
  
  
  /**
   * Name  : signOutProc
   * Input : N/A
   * Output: N/A
   * Description: user sign out process page
   * 
   */
  public function signOutProc( )
  {
    session_start(); 
    session_unset(); 
    session_destroy(); 
    $this->redirect('Index/index');
  }

  /**
   * Name  : insert
   * Input : N/A
   * Output: N/A
   * Description: user insert page, 
   * Note: mainly for testing purpose now
   * 
   */
  public function insert()
  {
    $this->show( );
  }
   
   
}