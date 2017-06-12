<?php
//=======================================================
// Name        : MyModel
// Date Created: Oct 18, 2016
// Auther      : J Wang
// Description : This file is for MyModel class
//               Support single database only
//=======================================================
namespace Think;
/**
 * ThinkPHP MyModel class
 * This class is created by James
 * 实现了ORM和ActiveRecords模式
 */
class MyModel
{
   protected $db         = null;
   protected $dbTblName  = null;   //table hold all user account information

   // Construct function
   public function __construct( $db_config )
   {
      $this->getDbInst( $db_config );   // Get the database instance
   }
   
   // Desstruct function
   public function __destruct()
   {
      if(!isset($this->db))
      {
         // Close the database
      //   $this->db->close();
      }
      
      unset($this->db);
   } 
   
   //=====================================================
   // Name: checkTblExist
   // Return: true  -- table existed
   //         false -- table does not exist
   // Parameter: table name
   // Description: check if table exist
   //=====================================================
   public function checkTblExist($dbTblName)
   {
      $retVal = false;

      //Check table existence
    //  $strQuery = "SHOW TABLES LIKE '" .$dbTblName."'";

      $strQuery = 'show tables where Tables_in_'.$this->db->getDbName().' =\''.$dbTblName.'\'';
      $result = $this->db->query($strQuery);

      if(!is_bool ($result))
      {
         if($this->db->getRowNumber() >= 1)
         {
            return true;
         }
      }
      return $retVal;
   }

   //=====================================================
   /**
    * Name  : setTableName
    * Access: public
    * Input : $tblName -- table name
    * Output: N/A
    *         
    * Description: set the table name
    *
    */
   //=====================================================
   public function setTableName($tblName)
   {
      $this->dbTblName = $tblName;
      return;
   }

   //=====================================================
   /**
    * Name  : getTableName
    * Access: public
    * Input : N/A
    * Output: N/A
    *         
    * Description: get the table name
    *
    */
   //=====================================================
   public function getTableName( )
   {
      return ($this->dbTblName);
   }
   
   //=====================================================
   /**
    * Name  : getDbInst
    * Input : N/A
    * Output: N/A
    *         
    * Description: Create a db instance
    *              
    */
   //=====================================================
   public function getDbInst( $db_config )
   {
      if(!isset($this->db))
      {
         // Create a new instance
         $this->db = MyDb::getInstance( $db_config );
      }
      return ;
   }
   
  //=====================================================
   /**
    * Name  : Connect
    * Input : N/A
    * Output: True  -- connect to db successfully
    *         false -- connect to db failed
    * Description: connect to db
    *
    */
   //=====================================================
   public function Connect( )
   {      
//      $result = $this->db->connect();
      
//      return($result);
      
      if(null == $this->db->connect())
      {
         return false;
      }
      else
      {
         return true;
      }
   }

   //=====================================================
   // Close Database
   //=====================================================
   public function close( )
   {      
      if(!isset($this->db))
      {
         // Close the database
         $this->db->close();
      }
      return;
   }
   

}

