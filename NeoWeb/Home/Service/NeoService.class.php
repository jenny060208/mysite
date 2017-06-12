<?php

// +----------------------------------------------------------------------
// | Service for business account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Home\Service;

use NeoWeb\Common\Common\CommonDefinition;
use Home\Logic\BusinessRegistLogic;
use Home\Logic\BusinessSignInLogic;
use Home\Logic\BusinessPwRecoverLogic;
use Home\Logic\BusinessDashBoard1Logic;
use Home\Logic\BusinessContactMsgProcessLogic;
use Home\Logic\NeoDashBoard1Logic;
use Home\Logic\NeoGeneralProcessLogic;
use Home\Logic\ScanTagProcessLogic;

/**
 * Name : NeoService
 * Input : N/A
 * Output: N/A
 * Description: Manage the NEO product, order, payment and various client report service
 */
class NeoService extends Service {
	
	/**
	 * Name : getBnDb1ProductInfo
	 * Access: public
	 * Input : None
	 * Output: dashboard 1 (Potential merchant account) product infomrationID in detail
	 *
	 * Description: Get the business dashboard 1 product info
	 */
	public function getBnDb1ProductInfo() {
		$neoDb1Logic = new NeoDashBoard1Logic ();
		$result = $neoDb1Logic->neoProductInfo ();
		
		return ($result);
	}
	
	/**
	 * Name : getDb1FirstOrderById
	 * Access: public
	 * Input : $bid -- business id
	 * Output: array -- business Dashboard 1 order info
	 *
	 * Description: Get business Dash board 1 order information
	 */
	public function getDb1OrderById($bid, $index) {
		$neoDb1Logic = new NeoDashBoard1Logic ();
		$result = $neoDb1Logic->getDashBoard1OrderById ( $bid, $index );
		
		return ($result);
	}
	
	/**
	 * Name : getDb1PreviousOrderById
	 * Access: public
	 * Input : $bid -- business id
	 *
	 * Output: array -- business Dashboard 1 previous order info
	 *
	 * Description: Get business Dash board 1 previous order information
	 */
	public function getDb1PreviousOrderById($bid) {
		$neoDb1Logic = new NeoDashBoard1Logic ();
		$result = $neoDb1Logic->getDashBoard1PreviousOrderById ( $bid );
		
		return ($result);
	}
	
	/**
	 * Name : getDb1NextOrderById
	 * Access: public
	 * Input : $bid -- business id
	 *
	 * Output: array -- business Dashboard 1 next order info
	 *
	 * Description: Get business Dash board 1 next order information
	 */
	public function getDb1NextOrderById($bid) {
		$neoDb1Logic = new NeoDashBoard1Logic ();
		$result = $neoDb1Logic->getDashBoard1NextOrderById ( $bid );
		
		return ($result);
	}
	
	/**
	 * Name : getDb1LastOrderById
	 * Access: public
	 * Input : $bid -- business id
	 *
	 * Output: array -- business Dashboard 1 last order info
	 *
	 * Description: Get business Dash board 1 last order information
	 */
	public function getDb1LastOrderById($bn_id) {
		$neoDb1Logic = new NeoDashBoard1Logic ();
		$result = $neoDb1Logic->getDashBoard1LastOrderById ( $bn_id );
		
		return ($result);
	}
	
	/**
	 * Name : db1OrderCommitEtProcess
	 * Access: public
	 * Input : $bid -- business id
	 * $order_data -- order data
	 * Output: array -- business Dashboard 1 order commit process result
	 *
	 * Description: business Dash board 1 order commit Email transfer process
	 */
	public function db1OrderCommitEtProcess($order_data, $bid) {
		$neoDb1Logic = new NeoDashBoard1Logic ();
		$result = $neoDb1Logic->orderCommitEtProcess ( $order_data, $bid );
		
		return ($result);
	}
	
	/**
	 * Name : db1OrderCommitCcProcess
	 * Access: public
	 * Input : $bid -- business id
	 * $order_data -- order data
	 * Output: array -- business Dashboard 1 order commit process result
	 *
	 * Description: business Dash board 1 order commit credit card / paypal process
	 */
	public function db1OrderCommitCcProcess($order_data, $bid) {
		$neoDb1Logic = new NeoDashBoard1Logic ();
		$result = $neoDb1Logic->orderCommitCcProcess ( $order_data, $bid );
		
		return ($result);
	}
	
	/**
	 * Name : moreServiceInfoProcess
	 * Access: public
	 * Input :None
	 * $jsonData -- input data from front
	 * Output: array -- enquiry form process
	 *
	 * Description: merchant get more info process
	 */
	public function moreServiceInfoProcess($jsonStr) {
		$neoLogic = new NeoGeneralProcessLogic ();
		$result = $neoLogic->getMoreServiceInfoProcess ( $jsonStr );
		
		return ($result);
	}
	
	/**
	 * Name : generalEnquiryMsgProcess
	 * Access: public
	 * Input :None
	 * $jsonData -- input data from front
	 * Output: array -- enquiry form process
	 *
	 * Description: merchant get more info process
	 */
	public function getInTouchMsgProcess($jsonStr) {
		$neoLogic = new NeoGeneralProcessLogic ();
		$result = $neoLogic->getInTouchMsgProcess ( $jsonStr );
		
		return ($result);
	}
	
	/**
	 * Name : tagScanProcess
	 * Access: public
	 * Input :$id -- scan tag id input
	 *
	 * Output: scan tag process result
	 *
	 * Description: scan tag process result
	 */
	public function tagScanProcess($id) {
		$neoLogic = new ScanTagProcessLogic ();
		$result = $neoLogic->tagProcess ( $id );
		
		return ($result);
	}
	
	/**
	 * Name : tagScanEventLog
	 * Access: public
	 * Input :$eventData -- scan event data
	 *
	 * Output: event log result
	 *
	 * Description: scan tag process result
	 */
	public function tagScanEventLog($eventData) {
		$neoLogic = new ScanTagProcessLogic ();
		$result = $neoLogic->scanEventLog ( $eventData );
		
		return ($result);
	}
	
	/**
	 * Name : tagScanErrorEventLog
	 * Access: public
	 * Input :$eventData -- scan event data
	 *
	 * Output: event log result
	 *
	 * Description: scan tag process result
	 */
	public function tagScanErrorEventLog($eventData) {
		$neoLogic = new ScanTagProcessLogic ();
		$result = $neoLogic->errorEventLog ( $eventData );
		
		return ($result);
	}
}






