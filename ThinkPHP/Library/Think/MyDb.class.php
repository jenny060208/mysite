<?php

// =======================================================
// Name : MyDb
// Date Created: Oct 18, 2016
// Auther : J Wang
// Description : This file is for database middle layer class
// Support single database only
// =======================================================
namespace Think;

use Think\Db\Driver\Mysqli;

/**
 * This is my database middle layer class
 */
class MyDb {
	private static $instance = null; // Database connection instance
	
	/**
	 * Name: getInstance
	 * Description: Get database class instance
	 * 
	 * @access static public
	 * @param mixed $config
	 *        	database connection config
	 * @param
	 *        	N/A
	 * @return Object return database driver class
	 */
	static public function getInstance($config = array()) {
		if (! isset ( self::$instance )) {
			self::$instance = new mysqli ( $config );
		}
		return self::$instance;
	}
	
	/**
	 * Name: __callStatic
	 * Description: Call driver class method
	 * 
	 * @access static public
	 * @param
	 *        	$method
	 * @param
	 *        	$params
	 * @return mixed
	 */
	static public function __callStatic($method, $params) {
		return call_user_func_array ( array (
				self::$instance,
				$method 
		), $params );
	}
}

