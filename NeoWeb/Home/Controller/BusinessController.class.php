<?php

namespace Home\Controller;

use Think\Controller;
use Home\Service\BusinessService;
use Home\Service\NeoService;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\NeoDefinition;

class BusinessController extends Controller {
	public function business_main() {
		$this->show ();
	}
	public function business_register() {
		$this->show ();
	}
	public function business_sign_in() {
		$this->show ();
	}
	public function business_pw_recover() {
		$this->show ();
	}
	public function registerProc() {
		header ( "Content-type: application/json; charset = utf-8" );
		$reg_data = json_decode ( file_get_contents ( 'php://input' ) );
		$m_bn = new BusinessService ();
		$data = $m_bn->businessTempAcntRegist ( $reg_data );
		
		$this->ajaxReturn ( $data );
	}
	public function signInProc() {
		header ( "Content-type: application/json; charset = utf-8" );
		$sign_data = json_decode ( file_get_contents ( 'php://input' ) );
		
		$m_bn = new BusinessService ();
		$data = $m_bn->businessSignIn ( $sign_data );
		
		$this->ajaxReturn ( $data );
	}
	public function pwRecoverProcess() {
		header ( "Content-type: application/json; charset = utf-8" );
		$pw_recv_data = json_decode ( file_get_contents ( 'php://input' ) );
		
		$m_bn = new BusinessService ();
		$data = $m_bn->pwRecover ( $pw_recv_data );
		
		$this->ajaxReturn ( $data );
	}
	
	/**
	 * Name : signOutProc
	 * Input : N/A
	 * Output: N/A
	 * Description: user sign out process page
	 */
	public function signOutProc() {
		session_start ();
		session_unset ();
		session_destroy ();
		$this->redirect ( "Business/business_main" );
	}
	
	/**
	 * Name : bn_dashboard
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard main page, only jump to here if sign in successfully
	 * jump to sign in page if no session found
	 */
	public function bn_dashboard() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			
			$m_bn = new BusinessService ();
			$bn_dashboard_detail = $m_bn->getBnDashBoardDetail ( $bn_id );
			
			if (1 == $bn_dashboard_detail) {
				$this->redirect ( "Business/business_db1" );
			} else if (2 == $bn_dashboard_detail) {
				$this->redirect ( "Business/business_db2" );
			} else {
				// Exit session due to not found
				session_start ();
				session_unset ();
				session_destroy ();
				$this->redirect ( "Business/signIn" );
			}
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : business_db1
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard main page for temp account preocess.
	 */
	public function business_db1() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_name = $_SESSION ["bn_name"];
			$bn_id = $_SESSION ["bid"];
			
			$bnInfo = array ();
			$bnInfo ["bid"] = $bn_id;
			$bnInfo ["bName"] = $bn_name;
			
			$m_bn = new BusinessService ();
			$bn_db_info = $m_bn->getBnDb1GeneralInfo ( $bn_id );
			
			if (! is_bool ( $userDbTblName )) {
				// DashBoard information found
				$this->assign ( "bnInfo", $bnInfo );
				$this->assign ( "profile", $bn_db_info );
				$this->show ();
			} else {
				$this->redirect ( "Business/signIn" );
			}
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : business_db1_profile
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard merchant profile for temp account.
	 */
	public function business_db1_profile() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_name = $_SESSION ["bn_name"];
			$bn_id = $_SESSION ["bid"];
			
			$bnInfo = array ();
			$bnInfo ["bid"] = $bn_id;
			$bnInfo ["bName"] = $bn_name;
			
			$this->assign ( "bnInfo", $bnInfo );
			$this->show ();
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : loadDashBoard1BnProfile
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard 1 merchant profile preload process.
	 */
	public function loadDashBoard1BnProfile() {
		header ( "Content-type: application/json; charset = utf-8" );
		$profile_data = json_decode ( file_get_contents ( 'php://input' ) );
		
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			
			$m_bn = new BusinessService ();
			$result = $m_bn->preloadDb1BnProfile ( $bn_id );
			
			$this->ajaxReturn ( $result );
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : updateDashBoard1BnProfile
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard 1 merchant profile upload process.
	 */
	public function updateDashBoard1BnProfile() {
		header ( "Content-type: application/json; charset = utf-8" );
		$profile_data = json_decode ( file_get_contents ( 'php://input' ) );
		
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			
			$m_bn = new BusinessService ();
			$result = $m_bn->updateDb1BnProfile ( $profile_data, $bn_id );
			
			$this->ajaxReturn ( $result );
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : db1_password_update
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard 1 merchant account password update.
	 */
	public function db1_password_update() {
		header ( "Content-type: application/json; charset = utf-8" );
		$pw_update_data = json_decode ( file_get_contents ( 'php://input' ) );
		
		if (isset ( $_SESSION ['bid'] )) {
			$bn_id = $_SESSION ['bid'];
			$m_bn = new BusinessService ();
			$result = $m_bn->updateDb1Password ( $pw_update_data, $bn_id );
			
			$this->ajaxReturn ( $result );
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : business_db1_status
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard merchant status for temp account.
	 */
	public function business_db1_status() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_name = $_SESSION ["bn_name"];
			$bn_id = $_SESSION ["bid"];
			$bnInfo = array ();
			$bnInfo ["bid"] = $bn_id;
			$bnInfo ["bName"] = $bn_name;
			
			// foreach ( $bnInfo as $key => $value )
			// {
			// echo $key . " has the value" . $value;
			// }
			
			$m_bn = new BusinessService ();
			$statusInfo = $m_bn->getBnDb1StatusInfo ( $bn_id );
			
			// foreach ( $statusInfo as $key => $value )
			// {
			// echo $key . " has the value" . $value;
			// }
			
			if (! is_bool ( $statusInfo )) {
				// DashBoard information found
				$this->assign ( "bnInfo", $bnInfo );
				$this->assign ( "statusInfo", $statusInfo );
				$this->show ();
			} else {
				$this->redirect ( "Business/signIn" );
			}
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : business_db1_Product page
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard merchant payment process for temp account.
	 */
	public function business_db1_product() {
		if (isset ( $_SESSION ["bid"] )) {
			$bnInfo = array ();
			$bnInfo ["bid"] = $_SESSION ["bid"];
			$bnInfo ["bName"] = $_SESSION ["bn_name"];
			
			$m_neo = new NeoService ();
			$productInfo = $m_neo->getBnDb1ProductInfo ( $bn_id );
			
			if (! is_bool ( $productInfo )) {
				$productInfoJson = json_encode ( $productInfo, JSON_FORCE_OBJECT );
				$this->assign ( "productInfoJson", $productInfoJson );
			}
			
			// load the Order info
			$m_neo = new NeoService ();
			$orderInfo = $m_neo->getDb1OrderById ( $bnInfo ["bid"], CommonDefinition::FIRST_ORDER );
			
			if (! is_bool ( $orderInfo )) {
				$orderInfoJson = json_encode ( $orderInfo, JSON_FORCE_OBJECT );
				session_start ();
				if ($orderInfo ["totalOrder"] == CommonDefinition::NO_RESULT) {
					$_SESSION ["current_order"] = CommonDefinition::NO_RESULT;
				} else {
					$_SESSION ["current_order"] = CommonDefinition::ONE_RESULT;
				}
				
				$_SESSION ["total_order"] = $orderInfo ["totalOrder"];
				// Preload the order info
				$this->assign ( "orderInfoJson", $orderInfoJson );
			}
			
			// Payment Method info
			$paymentMethodInfo ["ETransfer"] = NeoDefinition::ET_EMAIL_INFO . NeoDefinition::EMAIL_INTERAC_LINK;
			$paymentMethodInfo ["paypal"] = NeoDefinition::PAYPAL_EMAIL_INFO . NeoDefinition::PAYPAL_LINK;
			$paymentMethodInfo ["note"] = NeoDefinition::PAYMENT_METHOD_INDICATION;
			
			$this->assign ( "bnInfo", $bnInfo );
			
			// Preload the payment methods info
			$this->assign ( "paymentMethodInfo", $paymentMethodInfo );
			
			$this->show ();
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : business_db1_general
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard merchant general info process for temp account.
	 */
	public function business_db1_general() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_name = $_SESSION ["bn_name"];
			$bn_id = $_SESSION ["bid"];
			
			$bnInfo = array ();
			$bnInfo ["bid"] = $bn_id;
			$bnInfo ["bName"] = $bn_name;
			
			$m_bn = new BusinessService ();
			$bn_db_info = $m_bn->getBnDb1GeneralInfo ( $bn_id );
			
			if (! is_bool ( $bn_db_info )) {
				// DashBoard information found
				$this->assign ( "bnInfo", $bnInfo );
				$this->assign ( "profile", $bn_db_info );
				
				// Payment Method info
				$paymentMethodInfo ["ETransfer"] = NeoDefinition::ET_EMAIL_INFO . NeoDefinition::EMAIL_INTERAC_LINK;
				$paymentMethodInfo ["paypal"] = NeoDefinition::PAYPAL_EMAIL_INFO . NeoDefinition::PAYPAL_LINK;
				$paymentMethodInfo ["note"] = NeoDefinition::PAYMENT_METHOD_INDICATION;
				
				// Preload the payment methods info
				$this->assign ( "paymentMethodInfo", $paymentMethodInfo );
				
				$this->show ();
			} else {
				$this->redirect ( "Business/signIn" );
			}
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : db1PreviousOrderProcess
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard 1 previous order process.
	 */
	public function db1PreviousOrderProcess() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			
			$m_neo = new NeoService ();
			$result = $m_neo->getDb1PreviousOrderById ( $bn_id );
			
			$this->ajaxReturn ( $result );
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : db1NextOrderProcess
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard 1 next order process.
	 */
	public function db1NextOrderProcess() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			
			$m_neo = new NeoService ();
			$result = $m_neo->getDb1NextOrderById ( $bn_id );
			
			$this->ajaxReturn ( $result );
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : db1LastOrderProcess
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard 1 next order process.
	 */
	public function db1LastOrderProcess() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			
			$m_neo = new NeoService ();
			$result = $m_neo->getDb1LastOrderById ( $bn_id );
			
			$this->ajaxReturn ( $result );
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : db1_order_commit_et
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard 1 order commit paid by email transfer.
	 */
	public function db1_order_commit_et() {
		header ( "Content-type: application/json; charset = utf-8" );
		$order_data = json_decode ( file_get_contents ( 'php://input' ) );
		
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			$m_neo = new NeoService ();
			$result = $m_neo->db1OrderCommitEtProcess ( $order_data, $bn_id );
			
			$this->ajaxReturn ( $result );
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : db1_order_commit_cc
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard 1 order commit paid by credit card / paypal.
	 */
	public function db1_order_commit_cc() {
		header ( "Content-type: application/json; charset = utf-8" );
		$order_data = json_decode ( file_get_contents ( 'php://input' ) );
		
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			$m_neo = new NeoService ();
			$result = $m_neo->db1OrderCommitCcProcess ( $order_data, $bn_id );
			
			$this->ajaxReturn ( $result );
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
	
	/**
	 * Name : business_db1_msg_form
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard message form process.
	 */
	public function business_db1_msg_form() {
		header ( "Content-type: application/json; charset = utf-8" );
		$msg_data = json_decode ( file_get_contents ( 'php://input' ) );
		
		if (isset ( $_SESSION ["bid"] )) {
			$bn_id = $_SESSION ["bid"];
			
			$inMsg = array ();
			$inMsg ["subject"] = $msg_data->fm_subject;
			$inMsg ["message"] = $msg_data->fm_message;
			
			$m_bn = new BusinessService ();
			$result = $m_bn->addDb1BnContactMsg ( $bn_id, $inMsg );
		} else {
			$result ["status"] = - 1;
			$result ["info"] = "Warning, " . "Your message is not received!";
		}
		$this->ajaxReturn ( $result );
	}
	/**
	 * Name : business_db2
	 * Input : N/A
	 * Output: N/A
	 * Description: Business dashboard main page for temp account.
	 */
	public function business_db2() {
		if (isset ( $_SESSION ["bid"] )) {
			$bn_name = $_SESSION ["bn_name"];
			$bn_id = $_SESSION ["bid"];
			
			$bnInfo = array ();
			$bnInfo ["bid"] = $bn_id;
			$bnInfo ["bName"] = $bn_name;
			
			$this->assign ( "bnInfo", $bnInfo );
			$this->show ();
		} else {
			$this->redirect ( "Business/signIn" );
		}
	}
}