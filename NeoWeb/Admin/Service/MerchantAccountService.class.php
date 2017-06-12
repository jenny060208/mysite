<?php

// +----------------------------------------------------------------------
// | Service for Admin Business account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Service;

use Admin\Logic\MerchantAcntCreateLogic;
use NeoWeb\Common\Common\CommonDefinition;

/**
 * Name : MerchantAccountService
 * Input : N/A
 * Output: N/A
 * Description: Service for all Merchant account management:
 */
class MerchantAccountService extends Service {
	/**
	 * Name : createMerchantAccount
	 * Access: public
	 * Input : Array to host email register information
	 * Output: array -- merchant account create process result
	 *
	 * Description: merchant account create process in detail
	 */
	public function createMerchantAccount($reg_data) {
		$mLogic = new MerchantAcntCreateLogic ();
		$result = $mLogic->createMerchantAccount ( $reg_data );
		
		if ($result ['status'] != CommonDefinition::SUCCESS) {
			// return due to create merchant account failed
			return ($result);
		}
		
		$midTemp = $result ["mid"];
		
		// For the mid,
		// Create the tag scan event table
		// and user register table
		// Create the scan event table for this mid
		$result = $mLogic->createTagScanEventTbl ( $midTemp );
		
		if ($result ['status'] != CommonDefinition::SUCCESS) {
			// return due to create scan event table failed
			return ($result);
		}
		
		// Create the user register table for this mid
		$result = $mLogic->createMidUserRegisterTbl ( $midTemp );
		if ($result ['status'] != CommonDefinition::SUCCESS) {
			// return due to create user register table failed
			return ($result);
		}
		
		return ($result);
	}
}

