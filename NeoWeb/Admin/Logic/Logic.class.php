<?php

// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Logic;

use Think\MyModel;
define('ADMIN_LOGIC_PATH', dirname(dirname(__FILE__)));
define('NEO_WEB_ADMIN_LOGIC_PATH', dirname(dirname(dirname(__FILE__))));

// Load config file
require_once (ADMIN_LOGIC_PATH . '/Conf/config.php');

// Load library file
require_once (ADMIN_LOGIC_PATH . '/Common/admin_definition.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/system_definition.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/sys_utility.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/email_utility.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/common_definition.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/business_info_set.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/business_definition.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/user_info_set.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/user_definition.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/neo_product_definition.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/product_info_set.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/order_1_info_set.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/all_table_info_definition.php');

require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/neo_info_set.php');

require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Common/Common/tag_info_set.php');

require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Admin/Common/admin_definition.php');
require_once (NEO_WEB_ADMIN_LOGIC_PATH . '/Admin/Common/admin_utilities.php');

abstract class Logic
{

    /**
     * Constructures
     */
    public function __construct()
    {}
}
