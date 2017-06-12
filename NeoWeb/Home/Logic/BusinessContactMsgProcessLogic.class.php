<?php

// +----------------------------------------------------------------------
// | Service for Business account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Home\Logic;

use Home\Model\BusinessModel;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;

/**
 * Name : BusinessContactMsgProcessLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for business account contact message process:
 */
class BusinessContactMsgProcessLogic extends Logic {
	/**
	 * Name : addBnContactMsg
	 * Input : bid -- business ID
	 * $inMsg -- business account contact message received
	 * Output: Contact message process result
	 *
	 * Description: business account contact message process
	 */
	public function addDb1BnContactMsg($bid, $inMsg) {
		$result = array ();
		
		$bnUtil = new SysUtility ();
		
		if (! $bnUtil->checkStringlength ( $inMsg ["subject"], CommonDefinition::MAX_CONTACT_MSG_SUBJECT_LENGTH )) {
			$result ["status"] = CommonDefinition::ERROR;
			$result ["info"] = "Error: Subject characters are more than 100!";
			return ($result); // Connect to DB failed return without further handling
		} else if (! $bnUtil->checkStringlength ( $inMsg ["message"], CommonDefinition::MAX_CONTACT_MSG_LENGTH )) {
			$result ["status"] = CommonDefinition::ERROR;
			$result ["info"] = "Error: Message characters are more than 300!";
			return ($result); // Connect to DB failed return without further handling
		}
		
		$bnInfoTblName = $bnUtil->getDb1ContactMsgTblName ();
		
		$bnModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_bn_conn = $bnModel->connect ();
		
		if (! $db_bn_conn) {
			$result ["status"] = CommonDefinition::ERROR;
			$result ["info"] = "Error1025: Fail to connect to DataBase!";
			return ($result); // Connect to DB failed return without further handling
		}
		// Check table and create if does not exist
		
		$bnModel->setTableName ( $bnInfoTblName );
		
		// Convert received message and related information from Array to json string.
		$jsonMsg = json_encode ( $inMsg );
		// No previous message existed, add a new one
		$bnSet = new BusinessInfoSet ( null, null, null, null );
		$bnSet->setBusinessId ( $bid );
		$bnSet->setMsg ( $inMsg ["message"] );
		$bnSet->setMsgSubject ( $inMsg ["subject"] );
		$bnSet->setMsgFlag ( CommonDefinition::MSG_FLAG_NEW );
		
		if ($bnModel->addDashBoard1BnContactMsg ( $bnSet )) {
			$result ["status"] = CommonDefinition::SUCCESS;
			$result ["info"] = "Thanks, your message is received! We will conact you soon. ";
		} else {
			$result ["status"] = CommonDefinition::ERROR;
			$result ["info"] = "ERROR! your message cannot be processed.";
		}
		
		$bnModel->close ();
		return ($result);
	}
}
