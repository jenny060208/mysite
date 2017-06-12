<?php

// +----------------------------------------------------------------------
// | Service for Admin account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Service;

use NeoWeb\Common\Common\CommonDefinition;
use Admin\Logic\AdminAcntCreateLogic;
use Admin\Logic\AdminAcntSignInLogic;

/**
 * Name : AdminAccountService
 * Input : N/A
 * Output: N/A
 * Description: Service for all Admin account management:
 */
class AdminAccountService extends Service {
	/**
	 * Name : createRootAccount
	 * Access: public
	 * Input : Array to host account create information from web page
	 * Output: array -- root account create process result
	 *
	 * Description: business register process in detail
	 */
	public function createRootAccount($recvData) {
		$mLogic = new AdminAcntCreateLogic ();
		$result = $mLogic->createRootAccount ( $recvData );
		
		return ($result);
	}
	
	/**
	 * Name : createAdminAccount
	 * Access: public
	 * Input : json data to host admin account create information from web page
	 * Output: array -- admin account create process result
	 *
	 * Description: business register process in detail
	 */
	public function createAdminAccount($recvData) {
		$mLogic = new AdminAcntCreateLogic ();
		$result = $mLogic->createAdminAccount ( $recvData );
		
		return ($result);
	}
	
	/**
	 * Name : adminAcntSignIn
	 * Access: public
	 * Input : admin account sign in
	 * Output: sign in process result
	 *
	 * Description: admin account sing in processs in detail
	 */
	public function adminAcntSignIn($recvData) {
		$mLogic = new AdminAcntSignInLogic ();
		$result = $mLogic->signInProcess ( $recvData );
		
		return ($result);
	}
}

