<?php

// +----------------------------------------------------------------------
// | Service for Business account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Home\Logic;

use Home\Model\NeoModel;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;
use NeoWeb\Common\Common\NeoDefinition;
use NeoWeb\Common\Common\Order1InfoSet;

/**
 * Name : NeoDashBoard1Logic
 * Input : N/A
 * Output: N/A
 * Description: Logic for all Neo company related dashboard 1 (Potential merchant) management:
 * Product type, order, status information.
 */
class NeoDashBoard1Logic extends Logic {
	/**
	 * Name : dashBoard1ProductInfo
	 * Input : None
	 * Output: array -- dashboard 1 product info
	 *
	 * Description: get dashboard 1 product info
	 */
	public function neoProductInfo() {
		$result = array ();
		
		$sysUtil = new SysUtility ();
		$productInfoTblName = $sysUtil->getNeoProductInfoTblName ();
		
		$neoModel = new NeoModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_neo_conn = $neoModel->connect ();
		
		if (! $db_neo_conn) {
			return (false); // Connect to DB failed return without further handling
		}
		
		// set the db table name
		$neoModel->setTableName ( $productInfoTblName );
		$queryResult = $neoModel->getNeoAllProductInfo ();
		
		if (! is_bool ( $queryResult )) {
			$result = $queryResult;
			// Preset the default value
			$result ["service_term"] = 6;
			$result ["store_quantity"] = 1;
			
			$neoModel->close ();
			return ($result);
		} else {
			$neoModel->close ();
			return (false);
		}
		
		return ($result);
	}
	
	/**
	 * Name : getDashBoard1OrderById
	 * Input : business ID
	 * Output: array -- Neo dashboard 1 order info
	 *
	 * Description: get dashboard 1 order info
	 */
	public function getDashBoard1OrderById($bid, $index) {
		$result = array ();
		
		$neoUtil = new SysUtility ();
		$tblName = $neoUtil->getNeoDb1OrderTblName ();
		
		$neoModel = new NeoModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_neo_conn = $neoModel->connect ();
		
		if (! $db_neo_conn) {
			return (false); // Connect to DB failed return without further handling
		}
		
		// set the db table name
		$neoModel->setTableName ( $tblName );
		$queryResult = $neoModel->getDashboard1OrderById ( $bid, $index );
		
		if (! is_bool ( $queryResult )) {
			$result ["totalOrder"] = $queryResult->getOrderNumber ();
			$result ["currentOrder"] = $index;
			$result ["orderId"] = $queryResult->getOrderId ();
			$result ["productName"] = $queryResult->getProductName ();
			$result ["month"] = $queryResult->getMonthTerm ();
			$result ["store"] = $queryResult->getStoreQuantity ();
			$result ["totalAmount"] = $queryResult->getTotalAmount ();
			$result ["amountWithTax"] = round ( $result ["totalAmount"], 2 ) * round ( $queryResult->getTaxRate (), 2 );
			$result ["amountPaid"] = $queryResult->getAmountPaid ();
			$result ["paymentMethod"] = $neoUtil->getPaymentMethodByIndex ( $queryResult->getPaymentMethod () );
			$result ["paymentInfo"] = $queryResult->getPaymentInfo ();
			$result ["orderStatus"] = $queryResult->getOrderStatus ();
			$result ["note"] = $queryResult->getOrderNote ();
			
			// Get product detail info according to product name
			$tblName = $neoUtil->getNeoProductInfoTblName ();
			
			$neoModel->setTableName ( $tblName );
			$queryResult = $neoModel->getNeoProductInfoByName ( $result ["productName"] );
			$result ["productDetail"] = $queryResult ["productDetail"];
			$result ["setUpFee"] = $queryResult ["setUpFee"];
			$result ["monthlyFee"] = $queryResult ["monthlyFee"];
			
			$neoModel->close ();
			return ($result);
		} else {
			$neoModel->close ();
			return (false);
		}
	}
	
	/**
	 * Name : getDashBoard1PreviousOrderById
	 * Input : business ID
	 * Output: array -- Neo dashboard 1 previous order info
	 *
	 * Description: get dashboard 1 previous order info
	 */
	public function getDashBoard1PreviousOrderById($bid) {
		$currentOrder = ( int ) $_SESSION ["current_order"];
		$totalOrder = ( int ) $_SESSION ["total_order"];
		
		if ($totalOrder == CommonDefinition::NO_RESULT) {
			// No order existed, return with no change
			$result ["status"] = CommonDefinition::SUCCESS_NO_RESULT;
			return $result;
		}
		
		if ($currentOrder == CommonDefinition::ONE_RESULT) {
			// Reach the first one already, return with no change
			$result ["status"] = CommonDefinition::SUCCESS_NO_RESULT;
			return $result;
		}
		// Get the previous order
		$currentOrder = $currentOrder - 1;
		
		$result = $this->getDashBoard1OrderById ( $bid, $currentOrder );
		
		if (is_bool ( $result )) {
			$result ["status"] = CommonDefinition::SUCCESS_NO_RESULT;
			return $result;
		} else {
			$result ["status"] = CommonDefinition::SUCCESS;
			
			// Save the current order index to session
			session_start ();
			$_SESSION ["current_order"] = $currentOrder;
			$_SESSION ["total_order"] = $result ["totalOrder"];
			
			return $result;
		}
	}
	
	/**
	 * Name : getDashBoard1NextOrderById
	 * Input : business ID
	 * Output: array -- Neo dashboard 1 next order info
	 *
	 * Description: get dashboard 1 next order info
	 */
	public function getDashBoard1NextOrderById($bid) {
		$currentOrder = ( int ) $_SESSION ["current_order"];
		$totalOrder = ( int ) $_SESSION ["total_order"];
		
		if ($totalOrder == CommonDefinition::NO_RESULT) {
			// No order existed, return with no change
			$result ["status"] = CommonDefinition::SUCCESS_NO_RESULT;
			return $result;
		}
		
		if ($currentOrder >= $totalOrder) {
			// Reach the first one already, return with no change
			$result ["status"] = CommonDefinition::SUCCESS_NO_RESULT;
			return $result;
		}
		// Get the previous order
		$currentOrder = $currentOrder + 1;
		
		$result = $this->getDashBoard1OrderById ( $bid, $currentOrder );
		
		if (is_bool ( $result )) {
			$result ["status"] = CommonDefinition::SUCCESS_NO_RESULT;
			return $result;
		} else {
			$result ["status"] = CommonDefinition::SUCCESS;
			// Save the current order index to session
			session_start ();
			$_SESSION ["current_order"] = $currentOrder;
			$_SESSION ["total_order"] = $result ["totalOrder"];
			return $result;
		}
	}
	
	/**
	 * Name : getDashBoard1LastOrderById
	 * Input : business ID
	 * Output: array -- Neo dashboard 1 last order info
	 *
	 * Description: get dashboard 1 last order info
	 */
	public function getDashBoard1LastOrderById($bid) {
		$currentOrder = 0;
		$totalOrder = ( int ) $_SESSION ["total_order"];
		
		if ($totalOrder == CommonDefinition::NO_RESULT) {
			// No order existed, return with no change
			$result ["status"] = CommonDefinition::SUCCESS_NO_RESULT;
			return $result;
		}
		
		// Get the previous order
		$currentOrder = $totalOrder;
		
		// echo ("Current Order = " . $currentOrder);
		// echo ("Total Order = " . $totalOrder);
		
		$result = $this->getDashBoard1OrderById ( $bid, $currentOrder );
		
		if (is_bool ( $result )) {
			$result ["status"] = CommonDefinition::SUCCESS_NO_RESULT;
			return $result;
		} else {
			$result ["status"] = CommonDefinition::SUCCESS;
			// Save the current order index to session
			session_start ();
			$_SESSION ["current_order"] = $currentOrder;
			
			return $result;
		}
	}
	
	/**
	 * Name : orderCommitEtProcess
	 * Input : $bid -- business ID
	 * $order_data -- order info
	 * Output: array -- Neo dashboard 1 order commit process
	 *
	 * Description: dashboard 1 commit process for email transfer
	 */
	public function orderCommitEtProcess($order_data, $bid) {
		$sysUtil = new SysUtility ();
		$orderSet = new Order1InfoSet ( $bid );
		$result = array ();
		
		$orderSet->setBusinessId ( $bid );
		$orderSet->setProductName ( $order_data->product_name_id );
		$orderSet->setMonthTerm ( $order_data->service_term_id );
		$orderSet->setStoreQuantity ( $order_data->store_quantity_id );
		$orderSet->setTotalAmount ( $order_data->amount_id );
		$orderSet->setTaxRate ( CommonDefinition::TAX_RATE_CANADA );
		$orderSet->setAmountPaid ( CommonDefinition::ZERO_NUM ); // Assume no payment received yet
		$orderSet->setPaymentMethod ( CommonDefinition::PAY_METHOD_EMAIL ); // paid by email
		                                                                 // transfer
		$orderSet->setOrderStatus ( NeoDefinition::ORDER_STATUS_EMAIL_COMMIT ); // set order status
		
		$temp = $sysUtil->generateDb1OrderId ( $bid );
		
		// Set the order ID
		$orderSet->setOrderId ( $temp );
		$orderSet->setOrderNote ( NeoDefinition::ET_ORDER_NOTE_1 );
		$orderSet->setPaymentInfo ( NeoDefinition::ET_ORDER_PAYMENT_INFO_1 );
		
		$tblName = $sysUtil->getNeoDb1OrderTblName ();
		
		$neoModel = new NeoModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_neo_conn = $neoModel->connect ();
		
		if (! $db_neo_conn) {
			return (false); // Connect to DB failed return without further handling
		}
		
		// set the db table name
		$neoModel->setTableName ( $tblName );
		$queryResult = $neoModel->addDashboard1OrderById ( $orderSet );
		
		if ($queryResult) {
			$result ["status"] = CommonDefinition::SUCCESS;
			$result ["info"] = NeoDefinition::ET_ORDER_ADD_SUCCESS . NeoDefinition::EMAIL_INTERAC_LINK;
			
			// get the total order number after this submit if add order success
			
			$queryResult = $neoModel->getDashboard1OrderNumberByBid ( $bid );
			if (! is_bool ( $queryResult )) {
				session_start ();
				$_SESSION ["total_order"] = $queryResult;
			}
		} else {
			$result ["status"] = CommonDefinition::ERROR;
			$result ["info"] = NeoDefinition::ET_ORDER_ADD_FAIL;
		}
		
		$neoModel->close ();
		return ($result);
	}
	
	/**
	 * Name : orderCommitCcProcess
	 * Input : $bid -- business ID
	 * $order_data -- order info
	 * Output: array -- Neo dashboard 1 order commit process
	 *
	 * Description: dashboard 1 order process for credit card /paypal
	 */
	public function orderCommitCcProcess($order_data, $bid) {
		$sysUtil = new SysUtility ();
		$orderSet = new Order1InfoSet ( $bid );
		$result = array ();
		
		$orderSet->setBusinessId ( $bid );
		$orderSet->setProductName ( $order_data->product_name_id );
		$orderSet->setMonthTerm ( $order_data->service_term_id );
		$orderSet->setStoreQuantity ( $order_data->store_quantity_id );
		$orderSet->setTotalAmount ( $order_data->amount_id );
		$orderSet->setTaxRate ( CommonDefinition::TAX_RATE_CANADA );
		$orderSet->setAmountPaid ( CommonDefinition::ZERO_NUM ); // Assume no payment received yet
		$orderSet->setPaymentMethod ( CommonDefinition::PAY_METHOD_CREDIT_CARD ); // paid by
		                                                                       // credit
		                                                                       // card
		$orderSet->setOrderStatus ( NeoDefinition::ORDER_STATUS_CREDIT_CARD_COMMIT ); // set order status
		
		$temp = $sysUtil->generateDb1OrderId ( $bid );
		
		// Set the order ID
		$orderSet->setOrderId ( $temp );
		$orderSet->setOrderNote ( NeoDefinition::ET_ORDER_NOTE_1 );
		$orderSet->setPaymentInfo ( NeoDefinition::ET_ORDER_PAYMENT_INFO_1 );
		
		$tblName = $sysUtil->getNeoDb1OrderTblName ();
		
		$neoModel = new NeoModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_neo_conn = $neoModel->connect ();
		
		if (! $db_neo_conn) {
			return (false); // Connect to DB failed return without further handling
		}
		
		// set the db table name
		$neoModel->setTableName ( $tblName );
		$queryResult = $neoModel->addDashboard1OrderById ( $orderSet );
		
		if ($queryResult) {
			$result ["status"] = CommonDefinition::SUCCESS;
			$result ["info"] = NeoDefinition::CC_ORDER_ADD_SUCCESS;
			
			// get the total order number after this submit if add order success
			$queryResult = $neoModel->getDashboard1OrderNumberByBid ( $bid );
			if (! is_bool ( $queryResult )) {
				session_start ();
				$_SESSION ["total_order"] = $queryResult;
			}
		} else {
			$result ["status"] = CommonDefinition::ERROR;
			$result ["info"] = NeoDefinition::CC_ORDER_ADD_FAIL;
		}
		
		$neoModel->close ();
		return ($result);
	}
}
