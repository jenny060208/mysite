<?php

// +----------------------------------------------------------------------
// | Service for user account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Home\Service;

use Home\Logic\UserRegistLogic;
use Home\Logic\UserSignInLogic;
use Home\Logic\UserPwRecoverLogic;
use Home\Logic\UserProfileLogic;

/**
 * Name : UserService
 * Input : N/A
 * Output: N/A
 * Description: model for all user account management:
 * Register/Login/Logout/Password recover, etc
 */
class UserService extends Service {
	/**
	 * Name : registUserByEmail
	 * Access: public
	 * Input : Array to host email register information
	 * Output: array -- register process result
	 *
	 * Description: user register process in detail
	 */
	public function registUserByEmail($reg_data) {
		$userRegTool = new UserRegistLogic ();
		$result = $userRegTool->registUserByEmail ( $reg_data );
		
		return ($result);
	}
	
	/**
	 * Name : registUserByFacebook
	 * Input : Array to host Facebook register information
	 * Output: True -- User register successfully
	 * False -- User register failed
	 * Description: user register operation
	 */
	// public function registUserByFacebook($user)
	// {
	
	// }
	
	/**
	 * Name : signInUserByEmail
	 * Access: public
	 * Input : User email, password
	 * Output: array -- Sign in process result
	 *
	 * Description: user sign in verification
	 */
	public function signInUserByEmail($sign_data) {
		$userSignTool = new UserSignInLogic ();
		$result = $userSignTool->signInUserByEmail ( $sign_data );
		
		return ($result);
	}
	
	/**
	 * Name : pwRecoverByEmail
	 * Access: public
	 * Input : User email
	 * Output: array -- password recover process result
	 *
	 * Description: password recover by email process
	 */
	public function pwRecoverByEmail($pw_recv_data) {
		$userPwRecoverTool = new UserPwRecoverLogic ();
		$result = $userPwRecoverTool->pwRecoverByEmail ( $pw_recv_data );
		
		return ($result);
	}
	
	/**
	 * Name : userBasicInfo
	 * Access: public
	 * Input : get user profile basic info data
	 * Output: array -- user profile basic info process result
	 *
	 * Description: get user profile basic info
	 */
	public function userBasicInfo($user_id) {
		$basicInfoTool = new UserProfileLogic ();
		$result = $basicInfoTool->getBasicInfo ( $user_id );
		
		return ($result);
	}
	
	/**
	 * Name : userBasicInfoUpdate
	 * Access: public
	 * Input : user profile basic info data
	 * Output: array -- user profile basic info process result
	 *
	 * Description: user profile basic info update
	 */
	public function userBasicInfoUpdate($basic_info_data, $user_id) {
		$basicInfoUpdateTool = new UserProfileLogic ();
		$result = $basicInfoUpdateTool->updateBasicInfo ( $basic_info_data, $user_id );
		
		return ($result);
	}
	
	/**
	 * Name : userPasswordUpdate
	 * Access: public
	 * Input : user profile password update process
	 * Output: array -- user profile password update process result
	 *
	 * Description: user profile basic info update
	 */
	public function userPasswordUpdate($pw_update_data, $user_id) {
		$pwUpdateTool = new UserProfileLogic ();
		$result = $pwUpdateTool->updateUserPassword ( $pw_update_data, $user_id );
		
		return ($result);
	}
	
	/**
	 * Name : getUserNotificationInfo
	 * Access: public
	 * Input : userId -- userID
	 * Output: array -- user profile notice method result
	 *
	 * Description: get user profile notification preference method
	 */
	public function getUserNotificationInfo($user_id) {
		$prefUpdateTool = new UserProfileLogic ();
		$result = $prefUpdateTool->get_notice_pref_info ( $user_id );
		
		return ($result);
	}
	
	/**
	 * Name : userNotificationPrefUpdate
	 * Access: public
	 * Input : user profile notification preference update process
	 * Output: array -- user profile password update process result
	 *
	 * Description: user profile notification preference update
	 */
	public function userNotificationPrefUpdate($pref_update_data, $user_id) {
		$prefUpdateTool = new UserProfileLogic ();
		$result = $prefUpdateTool->updateUserPref ( $pref_update_data, $user_id );
		
		return ($result);
	}

/**
 * Name : autoLogin
 * Input : $user -- user sign in information
 * Output: True -- sign in successfully
 * False -- sign in failed
 * Description: user automatic sign in
 */
	// private function autoSignin($user)
	// {
	// Refresh Sign in information
	/*
	 * $data = array(
	 * "uid" => $user["uid"],
	 * "login" => array("exp", "`login`+1"),
	 * "last_login_time" => NOW_TIME,
	 * "last_login_ip" => get_client_ip(1),
	 * );
	 * $this->save($data);
	 *
	 * // record sign in session and cookies
	 * $auth = array(
	 * "uid" => $user["uid"],
	 * "username" => get_username($user["uid"]),
	 * "last_login_time" => $user["last_login_time"],
	 * );
	 * session("user_auth", $auth);
	 * session("uid", $auth["uid"]);
	 * session("user_auth_sign", data_auth_sign($auth));
	 */
	// }
}
