<?php

// +----------------------------------------------------------------------
// | Service for Admin Business account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Service;

use NeoWeb\Common\Common\CommonDefinition;
use Home\Logic\BusinessRegistLogic;
use Home\Logic\BusinessSignInLogic;
use Home\Logic\BusinessPwRecoverLogic;
use Home\Logic\BusinessDashBoard1Logic;
use Home\Logic\BusinessContactMsgProcessLogic;

/**
 * Name : BusinessAccountService
 * Input : N/A
 * Output: N/A
 * Description: Service for all Admin Business account management:
 */
class BusinessAccountService extends Service {
	/**
	 * Name : businessTempAcntRegist
	 * Access: public
	 * Input : Array to host email register information
	 * Output: array -- register process result
	 *
	 * Description: business register process in detail
	 */
	public function businessTempAcntRegist($reg_data) {
		$bnRegTool = new BusinessRegistLogic ();
		$result = $bnRegTool->registBnTempAccount ( $reg_data );
		
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
	 * Name : businessSignIn
	 * Access: public
	 * Input : business email, password
	 * Output: array -- Sign in process result
	 *
	 * Description: business sign in verification
	 */
	public function businessSignIn($sign_data) {
		$bnSignTool = new BusinessSignInLogic ();
		$result = $bnSignTool->signInBusiness ( $sign_data );
		
		return ($result);
	}
	
	/**
	 * Name : pwRecover
	 * Access: public
	 * Input : User email
	 * Output: array -- password recover process result
	 *
	 * Description: password recover by email process
	 */
	public function pwRecover($pw_recv_data) {
		$bnPwRecoverTool = new BusinessPwRecoverLogic ();
		$result = $bnPwRecoverTool->pwRecoverByEmail ( $pw_recv_data );
		
		return ($result);
	}
	
	/**
	 * Name : getBnDashBoardDetail
	 * Access: public
	 * Input : Business ID
	 * Output: dashboard ID in detail
	 *
	 * Description: Get the business dashboard in detail.
	 */
	public function getBnDashBoardDetail($bn_id) {
		$strTemp = substr ( $bn_id, 0, 2 );
		
		if (CommonDefinition::SUCCESS == strcmp ( $strTemp, "BT" )) {
			// Temp merchant account
			return (1);
		} else if (CommonDefinition::SUCCESS == strcmp ( $strTemp, "MD" )) {
			// Confirmed merchant account
			return (2);
		} else {
			return (- 1);
		}
	}
	
	/**
	 * Name : getBnDb1GeneralInfo
	 * Access: public
	 * Input : Business ID
	 * Output: dashboard 1 (Potential merchant account) generaL infomrationID in detail
	 *
	 * Description: Get the business dashboard 1 general info
	 */
	public function getBnDb1GeneralInfo($bn_id) {
		$bnDbTool = new BusinessDashBoard1Logic ();
		$result = $bnDbTool->dashBoard1GeneralInfo ( $bn_id );
		
		return ($result);
	}
	
	/**
	 * Name : getBnDb1StatusInfo
	 * Access: public
	 * Input : Business ID
	 * Output: dashboard 1 (Potential merchant account) status infomrationID in detail
	 *
	 * Description: Get the business dashboard 1 general info
	 */
	public function getBnDb1StatusInfo($bn_id) {
		$bnDbTool = new BusinessDashBoard1Logic ();
		$result = $bnDbTool->dashBoard1StatusInfo ( $bn_id );
		
		return ($result);
	}
	
	/**
	 * Name : addDb1BnContactMsg
	 * Access: public
	 * Input : Business ID
	 * Output: dashboard 1 (Potential merchant account) generaL infomrationID in detail
	 *
	 * Description: Get the business dashboard 1 general info
	 */
	public function addDb1BnContactMsg($bn_id, $inMsg) {
		$bnDbTool = new BusinessContactMsgProcessLogic ();
		$result = $bnDbTool->addDb1BnContactMsg ( $bn_id, $inMsg );
		
		return ($result);
	}
	
	/**
	 * Name : preloadDb1BnProfile
	 * Access: public
	 * Input : Business ID
	 * Output: dashboard 1 (Potential merchant account) profile infomration in detail
	 *
	 * Description: Get the business dashboard 1 profile info
	 */
	public function preloadDb1BnProfile($bn_id) {
		$bnDbTool = new BusinessDashBoard1Logic ();
		$result = $bnDbTool->dashBoard1ProfileInfoPreload ( $bn_id );
		
		return ($result);
	}
	
	/**
	 * Name : updateDb1BnProfile
	 * Access: public
	 * Input : Business ID, profile data
	 * Output: dashboard 1 (Potential merchant account) profile update result
	 *
	 * Description: Get the business dashboard 1 profile info update result
	 */
	public function updateDb1BnProfile($profile_data, $bn_id) {
		$bnDbTool = new BusinessDashBoard1Logic ();
		$result = $bnDbTool->dashBoard1ProfileInfoUpdate ( $profile_data, $bn_id );
		
		return ($result);
	}
	
	/**
	 * Name : updateDb1Password
	 * Access: public
	 * Input : Business ID, password update data
	 * Output: dashboard 1 (Potential merchant account) password update result
	 *
	 * Description: Get the business dashboard 1 password update result
	 */
	public function updateDb1Password($pw_update_data, $bn_id) {
		$bnDbTool = new BusinessDashBoard1Logic ();
		$result = $bnDbTool->dashBoard1PasswordUpdate ( $pw_update_data, $bn_id );
		
		return ($result);
	}

/**
 * Name : signOut
 * Input : N/A
 * Output: N/A
 *
 * Description: user sign out
 */
	// public function signOut()
	// {
	// session("user_auth", null);
	// unset($_SESSION['cart']);
	// session("user_auth_sign", null);
	// }

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

