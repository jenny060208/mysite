<?php
//=======================================================
// Name        : Mysqli driver
// Date Created: Oct 18, 2016
// Auther      : J Wang
// Description : This file is for Mysqli database driver class
//               Support single database only
//=======================================================
namespace Think\Db\Driver;
use Think\Db\MyDriver;

/**
 * mysql Database driver 
 */
class Mysqli extends MyDriver
{
   
   /**
     * 解析pdo连接的dsn信息
     * @access public
     * @param array $config 连接信息
     * @return string
     */
   protected function parseDsn($config)
   {
      $dsn = 'mysql:dbname='.$config['database'].';host='.$config['hostname'];
      $dsn  .= ';port='.$config['hostport'];
    //  $dsn  .= ';charset='.$config['charset'];
      return $dsn;
   }
   

   /**
    * Name:   getFields
    * Description: get database table field information
    * @access public
    * @param  $tableName -- database table name
    * @param  N/A
    * @return array with field name
    */
   public function getFields($tableName) 
   {
      /*
      $this->initConnect(true);
      list($tableName) = explode(' ', $tableName);
      if(strpos($tableName,'.'))
      {
         list($dbName,$tableName) = explode('.',$tableName);
         $sql = 'SHOW COLUMNS FROM `'.$dbName.'`.`'.$tableName.'`';
      }
      else
      {
         $sql = 'SHOW COLUMNS FROM `'.$tableName.'`';
      }
        
      $result = $this->query($sql);
      $info   = array();
      if($result) 
      {
         foreach ($result as $key => $val) 
         {
            if(\PDO::CASE_LOWER != $this->_linkID->getAttribute(\PDO::ATTR_CASE))
            {
               $val = array_change_key_case ( $val ,  CASE_LOWER );
            }
            $info[$val['field']] = array(
                    'name'    => $val['field'],
                    'type'    => $val['type'],
                    'notnull' => (bool) ($val['null'] === ''), // not null is empty, null is yes
                    'default' => $val['default'],
                    'primary' => (strtolower($val['key']) == 'pri'),
                    'autoinc' => (strtolower($val['extra']) == 'auto_increment'),
                );
         }
      }
      return $info;
      */
   }

   /**
    * Name:   getTables
    * Description: get tables information in database
    * @access public
    * @param  $dbName -- database name
    * @param  N/A
    * @return array with table name
    */
   public function getTables($dbName='') 
   {
      /*
      $sql    = !empty($dbName)?'SHOW TABLES FROM '.$dbName:'SHOW TABLES ';
      $result = $this->query($sql);
      $info   =   array();
      foreach ($result as $key => $val) 
      {
         $info[$key] = current($val);
      }
      return $info;
      */
   }

   /**
    * Name:   parseKey
    * Description: field and table name process
    * @access protected
    * @param  string $key
    * @param  N/A
    * @return string
    */
   protected function parseKey(&$key) 
   {
      /*
      $key   =  trim($key);
      if(!is_numeric($key) && !preg_match('/[,\'\"\*\(\)`.\s]/',$key)) 
      {
         $key = '`'.$key.'`';
      }
      return $key;
      */
   }

   /**
    * Name:   parseDuplicate
    * Description: ON DUPLICATE KEY UPDATE analysis
    * @access protected
    * @param  mixed $duplicate
    * @param  N/A
    * @return string
    */
   protected function parseDuplicate($duplicate)
   {
      /*
      // return null if boolean value or empty
      if(is_bool($duplicate) || empty($duplicate)) 
      {
         return '';
      }
        
      if(is_string($duplicate))
      {
        	// field1,field2  turn to array
        	$duplicate = explode(',', $duplicate);
      }
      elseif(is_object($duplicate))
      {
         // object to array
         $duplicate = get_class_vars($duplicate);
      }

      $updates                    = array();
      foreach((array) $duplicate as $key=>$val)
      {
         if(is_numeric($key))
         {  // array('field1', 'field2', 'field3') deploy to 
            // ON DUPLICATE KEY UPDATE field1=VALUES(field1), field2=VALUES(field2), 
            // field3=VALUES(field3)
            $updates[] = $this->parseKey($val)."=VALUES(".$this->parseKey($val).")";
         }
         else
         {
            if(is_scalar($val)) // compatible to vector pass value method
            {
               $val = array('value', $val);
            }
            
            if(!isset($val[1])) 
            {
               continue;
            }

            switch($val[0])
            {
               case 'exp': // expression
               {
                  $updates[]  = $this->parseKey($key)."=($val[1])";
                  break;
               }
               case 'value': // Value
               default:
               {
                  $name      = count($this->bind);
                  $updates[] = $this->parseKey($key)."=:".$name;
                  $this->bindParam($name, $val[1]);
                  break;
               }
            }
         }
      }
      if(empty($updates)) 
      {
         return '';
      }
      return " ON DUPLICATE KEY UPDATE ".join(', ', $updates);
      */
   }

   /**
    * Name:   procedure
    * Description: Execute memory procedure query, return multi data set
    * @access public
    * @param  string $str  sql instruction
    * @param  N/A
    * @return mixed
    */
   public function procedure($str) 
   {
      /*
      $this->initConnect(false);
      $this->linkID->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
      if ( !$this->linkID ) 
      {
         return false;
      }
        
      $this->queryStr = $str;
      if($fetchSql)
      {
         return $this->queryStr;
      }
        
      // Free previous query result
      if ( !empty($this->PDOStatement) ) 
      {
         $this->free();
      }

      $this->PDOStatement = $this->linkID->prepare($str);
      if(false === $this->PDOStatement)
      {
         $this->error();
         return false;
      }

      try
      {
         $result = $this->PDOStatement->execute();
         do
         {
            $result = $this->PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
            if ($result)
            {
               $resultArr[] = $result;
            }
         }
         while ($this->PDOStatement->nextRowset());
         $this->_linkID->setAttribute(\PDO::ATTR_ERRMODE, $this->options[\PDO::ATTR_ERRMODE]);
         return $resultArr;
      }
      catch (\PDOException $e)
      {
         $this->error();
         $this->_linkID->setAttribute(\PDO::ATTR_ERRMODE, $this->options[\PDO::ATTR_ERRMODE]);
         return false;
      }
      
      */
   }
}

