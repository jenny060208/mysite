<?php

namespace Home\Controller;

use Think\Controller;
use Home\Service\BusinessService;
use Home\Service\NeoService;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\NeoDefinition;

class TagController extends Controller {
	public function tid($id = 0) {
		// echo ("Hello Tag = " . $id);
		$s_neo = new NeoService ();
		$result = $s_neo->tagScanProcess ( $id );
		
		if (CommonDefinition::SUCCESS == $result->getStatus ()) {
			$webPage = $result->getWebPage ();
			
			// Direct to the user scan event
			$this->assign ( "tagInfo", $result->getTagId () );
			$this->assign ( "bid", $result->getBusinessId () );
			$this->redirect ( $webPage );
			// log the scan event
			
			$result = $s_neo->tagScanEventLog ( $result );
		} else {
			$webPage = $result->getWebPage ();
			$this->redirect ( $webPage );
			$result = $s_neo->tagScanErrorEventLog ( $result );
		}
		
		exit ();
	}
}