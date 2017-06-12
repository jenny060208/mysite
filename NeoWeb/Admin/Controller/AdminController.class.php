<?php

namespace Admin\Controller;

use Think\Controller;
use Admin\Service\AdminAccountService;
use Admin\Service\InstallationService;
use Admin\Service\MerchantAccountService;
use Admin\Service\TagInfoService;

class AdminController extends Controller {
	
	/**
	 * Name : create_root_account
	 * Input : N/A
	 * Output: N/A
	 * Description: create root account process
	 */
	public function create_root_account() {
		header ( "Content-type: application/json; charset = utf-8" );
		$jsonMsg = json_decode ( file_get_contents ( 'php://input' ) );
		
		$mService = new AdminAccountService ();
		$result = $mService->createRootAccount ( $jsonMsg );
		
		$this->show ();
		exit ();
	}
	
	/**
	 * Name : admin_account_create
	 * Input : N/A
	 * Output: N/A
	 * Description: create admin account process
	 */
	public function admin_account_create() {
		header ( "Content-type: application/json; charset = utf-8" );
		$jsonMsg = json_decode ( file_get_contents ( 'php://input' ) );
		
		$mService = new AdminAccountService ();
		$result = $mService->createAdminAccount ( $jsonMsg );
		
		$this->ajaxReturn ( $result );
		exit ();
	}
	
	/**
	 * Name : signIn
	 * Input : N/A
	 * Output: N/A
	 * Description: admin account sign in process
	 */
	public function admin_account_signin() {
		header ( "Content-type: application/json; charset = utf-8" );
		$jsonMsg = json_decode ( file_get_contents ( 'php://input' ) );
		
		$mService = new AdminAccountService ();
		$result = $mService->adminAcntSignIn ( $jsonMsg );
		
		$this->ajaxReturn ( $result );
		exit ();
	}
	
	/**
	 * Name : password_recover
	 * Input : N/A
	 * Output: N/A
	 * Description: admin account password recover
	 */
	public function password_recover() {
		// echo 'Hello World from Admin!';
		$this->show ();
		exit ();
	}
	
	/**
	 * Name : create_all_tables
	 * Input : N/A
	 * Output: N/A
	 * Description: Create all tables needed, kinds of script used to create all tables
	 */
	public function create_all_tables() {
		$mService = new InstallationService ();
		$result = $mService->createAllTables ();
		
		$this->ajaxReturn ( $result );
		exit ();
	}
	
	// ==========================================================
	// Name : signOutProc
	// Input : N/A
	// Output: N/A
	// Description: Admin Account sign out process
	// ==========================================================
	public function signOutProc() {
		session_start ();
		session_unset ();
		session_destroy ();
		$this->redirect ( "Index/index" );
	}
	
	// ==========================================================
	// Name : admin_dash_board
	// Input : N/A
	// Output: N/A
	// Description: Enter into admin dash board
	// ==========================================================
	public function admin_dash_board() {
		if (isset ( $_SESSION ["admin_id"] )) {
			$adminName = $_SESSION ["admin_name"];
			
			$this->assign ( "ProfileName", $adminName );
			
			$this->show ();
		} else {
			$this->redirect ( "Index/index" );
		}
	}
	
	// ==========================================================
	// Name : admin_board_merchant
	// Input : N/A
	// Output: N/A
	// Description: Enter into admin dash board merchant
	// ==========================================================
	public function admin_board_merchant() {
		if (isset ( $_SESSION ["admin_id"] )) {
			$adminName = $_SESSION ["admin_name"];
			
			$this->assign ( "ProfileName", $adminName );
			
			$this->show ();
		} else {
			$this->redirect ( "Index/index" );
		}
	}
	
	// ==========================================================
	// Name : admin_board_product
	// Input : N/A
	// Output: N/A
	// Description: Enter into admin dash board product
	// ==========================================================
	public function admin_board_product() {
		if (isset ( $_SESSION ["admin_id"] )) {
			$adminName = $_SESSION ["admin_name"];
			
			$this->assign ( "ProfileName", $adminName );
			
			$this->show ();
		} else {
			$this->redirect ( "Index/index" );
		}
	}
	
	// ==========================================================
	// Name : admin_board_user
	// Input : N/A
	// Output: N/A
	// Description: Enter into admin dash board user
	// ==========================================================
	public function admin_board_user() {
		if (isset ( $_SESSION ["admin_id"] )) {
			$adminName = $_SESSION ["admin_name"];
			
			$this->assign ( "ProfileName", $adminName );
			
			$this->show ();
		} else {
			$this->redirect ( "Index/index" );
		}
	}
	
	// ==========================================================
	// Name : admin_board_tag
	// Input : N/A
	// Output: N/A
	// Description: Enter into admin dash board tag
	// ==========================================================
	public function admin_board_tag() {
		if (isset ( $_SESSION ["admin_id"] )) {
			$adminName = $_SESSION ["admin_name"];
			
			$this->assign ( "ProfileName", $adminName );
			
			$this->show ();
		} else {
			$this->redirect ( "Index/index" );
		}
	}
	
	// ==========================================================
	// Name : merchant_account_create
	// Input : N/A
	// Output: N/A
	// Description: create merchant account
	// ==========================================================
	public function merchant_account_create() {
		header ( "Content-type: application/json; charset = utf-8" );
		$jsonMsg = json_decode ( file_get_contents ( 'php://input' ) );
		
		$mService = new MerchantAccountService ();
		$result = $mService->createMerchantAccount ( $jsonMsg );
		
		$this->ajaxReturn ( $result );
		exit ();
	}
	
	// ==========================================================
	// Name : tag_create_process
	// Input : N/A
	// Output: N/A
	// Description: create a tag process
	// ==========================================================
	public function tag_create_process() {
		header ( "Content-type: application/json; charset = utf-8" );
		$jsonMsg = json_decode ( file_get_contents ( 'php://input' ) );
		
		$mService = new TagInfoService ();
		$result = $mService->createTag ( $jsonMsg );
		
		$this->ajaxReturn ( $result );
		exit ();
	}
	
	// ==========================================================
	// Name : tag_update_process
	// Input : N/A
	// Output: N/A
	// Description: update a tag process
	// ==========================================================
	public function tag_update_process() {
		header ( "Content-type: application/json; charset = utf-8" );
		$jsonMsg = json_decode ( file_get_contents ( 'php://input' ) );
		
		$mService = new TagInfoService ();
		$result = $mService->updateTag ( $jsonMsg );
		
		$this->ajaxReturn ( $result );
		exit ();
	}
}