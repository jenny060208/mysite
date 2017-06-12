<?php

// =======================================================
// Name : MyDriver
// Date Created: Oct 18, 2016
// Auther : J Wang
// Description : This file is for Mysql database driver class
// Support single database only
// =======================================================
namespace Think\Db;

use Think\Config;
use Think\Debug;
use Think\Log;
use PDO;

abstract class MyDriver {
	// PDO Operation instance
	protected $PDOStatement = null;
	// Current SQL instruction
	protected $queryStr = '';
	// Query result
	protected $queryResult = null;
	// return record number of rows
	protected $numOfRows = 0;
	// connection ID
	protected $conn = null;
	
	// PDO connection parameters
	protected $options = array (
			PDO::ATTR_CASE => PDO::CASE_LOWER,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
			PDO::ATTR_STRINGIFY_FETCHES => false 
	);
	protected $configDsn = null;
	// Database connection parameters
	protected $dbConfig = array (
			'hostname' => '127.0.0.1', // Server IP address
			'database' => '', // Database name
			'username' => '', // User name
			'password' => '', // password
			'hostport' => '', // host port
			'charset' => 'utf8'  // Database default char set: utf8
	);
	
	/**
	 * Description: construction function with parameters
	 * 
	 * @access public
	 * @param array $config
	 *        	Database config array
	 */
	public function __construct($config = '') {
		$this->dbConfig ['hostname'] = $config ['db_host'];
		$this->dbConfig ['database'] = $config ['db_name'];
		$this->dbConfig ['hostport'] = $config ['db_port'];
		$this->dbConfig ['username'] = $config ['db_user'];
		$this->dbConfig ['password'] = $config ['db_pwd'];
		// $this->$dbConfig['password'] = 'wzm12345';
		
		unset ( $this->conn );
	}
	
	/**
	 * Name: __destruct
	 * Description:destruct function
	 * 
	 * @access public
	 * @param
	 *        	N/A
	 * @param
	 *        	N/A
	 * @return void
	 */
	public function __destruct() {
		// free query
		$this->free ();
		// Close the connection
		$this->close ();
	}
	
	/**
	 * Name: connect
	 * Description: Database connection
	 * 
	 * @access public
	 * @param
	 *        	N/A
	 * @return connection result
	 */
	public function connect() {
		if (! isset ( $this->conn )) {
			$configDsn = $this->parseDsn ( $this->dbConfig );
			
			try {
				/*
				 * echo 'DSN String: '.$configDsn."\r\n";
				 * echo $this->dbConfig['username']."\r\n";
				 * echo $this->dbConfig['password']."\r\n";
				 */
				$this->conn = new PDO ( $configDsn, $this->dbConfig ['username'], $this->dbConfig ['password'], $this->options );
				// echo "DB connection Success";
			} catch ( \PDOException $e ) {
				echo 'Connection failed: ' . $e->getMessage ();
				unset ( $this->conn );
			}
		}
		return ($this->conn);
	}
	
	/**
	 * Deploy PDO dsn connection message
	 * 
	 * @access protected
	 * @param array $config
	 *        	connection message
	 * @return string
	 */
	protected function parseDsn($config) {
	}
	
	/**
	 * Name: query
	 * Description: run query operation, used for select operation
	 * 
	 * @access public
	 * @param string $str
	 *        	sql statement
	 * @param
	 *        	N/A
	 * @return mixed
	 */
	public function query($str) {
		// $this->initConnect( );
		if (! isset ( $this->conn )) {
			return false; // return false if no database connection
		}
		
		$this->queryStr = $str;
		
		// Free the previous query result
		if (! empty ( $this->PDOStatement )) {
			$this->free ();
		}
		
		$this->PDOStatement = $this->conn->prepare ( $str );
		if (false === $this->PDOStatement) {
			return false;
		}
		
		try {
			$result = $this->PDOStatement->execute ();
			if (false === $result) {
				return false;
			} else {
				return $this->getResult ();
			}
		} catch ( \PDOException $e ) {
			return false;
		}
	}
	
	/**
	 * Name: execute
	 * Description: run execute operation, used for delete, insert, updata operation
	 * 
	 * @access public
	 * @param string $str
	 *        	sql statement
	 * @param
	 *        	N/A
	 * @return mixed
	 */
	public function execute($str) {
		// $this->initConnect( );
		if (! isset ( $this->conn )) {
			return false; // return false if no database connection
		}
		
		$this->queryStr = $str;
		
		// Release the previous query result
		$this->free ();
		
		$this->PDOStatement = $this->conn->prepare ( $this->queryStr );
		if (false === $this->PDOStatement) {
			return false;
		}
		
		try {
			$result = $this->PDOStatement->execute ();
			if (false === $result) {
				return false;
			} else {
				$this->numRows = $this->PDOStatement->rowCount ();
				return $this->numRows;
			}
		} catch ( \PDOException $e ) {
			return false;
		}
	}
	
	/**
	 * Name: getResult
	 * Description: Get all query result
	 * 
	 * @access private
	 * @param
	 *        	N/A
	 * @param
	 *        	N/A
	 * @return array
	 */
	private function getResult() {
		// Return the data set
		$result = $this->PDOStatement->fetchAll ( PDO::FETCH_ASSOC );
		$this->numRows = count ( $result );
		return $result;
	}
	
	/**
	 * Name: public
	 * Description: get the query result row number
	 * 
	 * @access private
	 * @param
	 *        	N/A
	 * @param
	 *        	N/A
	 * @return integer row number
	 */
	public function getRowNumber() {
		return ($this->numRows);
	}
	
	/**
	 * Name: public
	 * Description: get the query result row number
	 * 
	 * @access private
	 * @param
	 *        	N/A
	 * @param
	 *        	N/A
	 * @return integer row number
	 */
	public function getDbName() {
		return ($this->dbConfig ['database']);
	}
	
	/**
	 * Name: free
	 * Description: free the query result
	 * 
	 * @access public
	 * @param
	 *        	N/A
	 * @return N/A
	 */
	public function free() {
		if (isset ( $this->PDOStatement )) {
			$this->PDOStatement = null;
		}
	}
	
	/**
	 * Name: close
	 * Description: Close Database
	 * 
	 * @access public
	 * @param
	 *        	N/A
	 * @param
	 *        	N/A
	 * @return N/A
	 */
	public function close() {
		if (isset ( $this->conn )) {
			$this->conn = null;
		}
	}
	
	/**
	 * Name: initConnect
	 * Description: initial database connection
	 * 
	 * @access protected
	 * @param
	 *        	N/A
	 * @param
	 *        	N/A
	 * @return void
	 */
	protected function initConnect() {
		// connect signle database
		if (! isset ( $this->$conn )) {
			$this->$conn = $this->connect ();
		}
	}
}
