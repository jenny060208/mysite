<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// Default Entry point start from here

// Check PHP environment
if (version_compare ( PHP_VERSION, '5.3.0', '<' ))
	die ( 'require PHP > 5.3.0 !' );

// Enable project debug output during development, turn off before release by set to false
define ( 'APP_DEBUG', True );

// Define run time directory
// This is useful for first time to create the entry point,
// commented out due to no use after module created.
// define('RUNTIME_PATH','./Runtime/');

// Define static pages directory
// This is useful for first time to create the entry point,
// commented out due to no use after module created.
// define('HTML_PATH','./Html/');

// Define application directory
// This line is needed
define ( 'APP_PATH', './NeoWeb/' );

// Define default module
// This is useful for first time to create the entry point,
// commented out due to no use after module created.
// define('BIND_MODULE','Home');

// ThinkPHP entry file
require './ThinkPHP/ThinkPHP.php';

// End of file