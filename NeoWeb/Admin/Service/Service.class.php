<?php

// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Service;

define ( 'ADMIN_SERVICE_PATH', dirname ( dirname ( __FILE__ ) ) );
define ( 'NEO_WEB_ADMIN_SERVICE_PATH', dirname ( dirname ( dirname ( __FILE__ ) ) ) );

// Load common files
require_once (NEO_WEB_ADMIN_SERVICE_PATH . '/Common/Common/common_definition.php');

// Load library file
abstract class Service {
	
	/**
	 * Constructure
	 */
	public function __construct() {
	}
}
