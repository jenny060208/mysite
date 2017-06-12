<?php

namespace Home\Controller;

use Think\Controller;
use Home\Service\BusinessService;
use Home\Service\NeoService;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\NeoDefinition;

class IndexController extends Controller {
	
	/*
	 * Note: this is used old reward website
	 * public function index()
	 * {
	 * session_start();
	 * if(isset($_SESSION['uid']))
	 * {
	 * // header("Location: ".U('Home/User/Index'));
	 * $this->redirect('User/index');
	 * }
	 * else
	 * {
	 * $this->show( );
	 * }
	 * exit();
	 * }
	 */
	public function index() {
		$this->show ();
		exit ();
	}
	
	/**
	 * Name : getMoreServiceInfoProc
	 * Input : N/A
	 * Output: N/A
	 * Description: business get more service infomation process
	 */
	public function getMoreServiceInfoProc() {
		header ( "Content-type: application/json; charset = utf-8" );
		$jsonData = json_decode ( file_get_contents ( 'php://input' ) );
		
		$m_neo = new NeoService ();
		$result = $m_neo->moreServiceInfoProcess ( $jsonData );
		
		$this->ajaxReturn ( $result );
		
		exit ();
	}
	
	/**
	 * Name : getInTouchProc
	 * Input : N/A
	 * Output: N/A
	 * Description: get in touch form process
	 */
	public function getInTouchProc() {
		header ( "Content-type: application/json; charset = utf-8" );
		$jsonData = json_decode ( file_get_contents ( 'php://input' ) );
		
		$m_neo = new NeoService ();
		$result = $m_neo->getInTouchMsgProcess ( $jsonData );
		
		$this->ajaxReturn ( $result );
		
		exit ();
	}
}