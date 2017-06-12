<?php

// +----------------------------------------------------------------------
// | Service for Admin management installation related
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Service;

use NeoWeb\Common\Common\CommonDefinition;
use Admin\Logic\AdminAcntCreateLogic;
use Admin\Logic\AdminAcntSignInLogic;
use Admin\Logic\createAllTablesLogic;

/**
 * Name : AdminAccountService
 * Input : N/A
 * Output: N/A
 * Description: Service for all Admin account management:
 */
class InstallationService extends Service {
	/**
	 * Name : createAllTables
	 * Access: public
	 * Input : none
	 * Output:create tables result
	 *
	 * Description:crearte all tables needed
	 */
	public function createAllTables() {
		$mLogic = new createAllTablesLogic ();
		$result = $mLogic->createAllTables ();
		
		return ($result);
	}
}

