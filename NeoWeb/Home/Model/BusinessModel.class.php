<?php

// +----------------------------------------------------------------------
// | Model for user account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Home\Model;

use Think\MyModel;
// use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;
use NeoWeb\Common\Common\AllTableInfoDefinition;

/**
 * Name : BusinessModel
 * Input : N/A
 * Output: N/A
 * Description: model for all business account management:
 * Register/Login/Logout/Password recover, etc
 */
class BusinessModel extends MyModel
{

    // =====================================================
    // Name: getBnAccountTblNameByEmail
    // Return: mixed
    // table name -- if the email is found in one table
    // false -- email is not found in table
    // Parameter: business email
    // Description: get the table name including the email
    // =====================================================
    public function getBnAccountTblNameByEmail($strEmail)
    {
        if (! $this->checkBnEmailByAllTables($strEmail)) {
            return (false); // table not found
        } else {
            return ($this->getTableName());
        }
    }

    // =====================================================
    // Name: checkBnEmailByAllTables
    // Return: TRUE -- business email exists in Database already
    // FALSE -- business email does not exist in Database
    // Parameter: business email
    // Description: check if business email existed in database, itorate all user account tables
    // =====================================================
    public function checkBnEmailByAllTables($strEmail)
    {
        $retVal = false;

        // Check the temp account table first
        $bnUtil = new SysUtility();
        $tblName = $bnUtil->genDashboard1AcntTblName();
        $this->setTableName($tblName);

        if ($this->checkBusinessEmail($strEmail)) {
            return true; // return due to email found in the database
        }

        // First step: list all business account tables in the database,
        // return false if no table existed
        // Second Step: if table existed, check the email in each table,
        // return true if email is found,
        // false if not found after all tables iterated.
        $strQuery = 'SHOW TABLES LIKE \'' . '%' . AllTableInfoDefinition::BN_TABLE_NAME_PREFIX . '%' . '\'';

        $result = $this->db->query($strQuery);
        $rowCount = $this->db->getRowNumber();

        if (! is_bool($result)) {
            if ($rowCount >= 1) {
                for ($count = 0; $count < $rowCount; $count ++) {
                    $row = $result[$count]; // get row information in array format
                                             // Get the column of table name in array
                    $tblName = $row['tables_in_neoreward (%bn_ac_tbl_%)'];
                    $this->setTableName($tblName);
                    if ($this->checkBusinessEmail($strEmail)) {
                        return true; // return due to email found in the database
                    }
                }
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkBusinessEmail
    // Return: true -- Business email exists in Database already
    // false -- Business email does not exist in Database
    // Parameter: email
    // Description: check if business email existed in specific business account table database
    // =====================================================
    public function checkBusinessEmail($email)
    {
        $retVal = false;

        // Query the email column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_email=\''.$email.'\'';
        // Query the email column with better performance
        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_ID . " FROM " . $this->dbTblName . ' WHERE bn_email=\'' . $email . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkEmailDuplicationByAllTables
    // Return: TRUE -- email duplicated in Database already
    // FALSE -- email does not duplicate in Database
    // Parameter: email, bid
    // Description: check if email duplicated in database, itorate all user account tables
    // =====================================================
    public function checkEmailDuplicationByAllTables($email, $bid)
    {
        $retVal = false;

        // Check the temp account table first
        $bnUtil = new SysUtility();
        $tblName = $bnUtil->genDashboard1AcntTblName();
        $this->setTableName($tblName);

        if ($this->checkEmailDuplication($email, $bid)) {
            return true; // return due to email found in the database
        }

        // First step: list all business account tables in the database,
        // return false if no table existed
        // Second Step: if table existed, check the email in each table,
        // return true if email duplication is found,
        // false if not found after all tables iterated.
        $strQuery = 'SHOW TABLES LIKE \'' . '%' . AllTableInfoDefinition::BN_TABLE_NAME_PREFIX . '%' . '\'';

        $result = $this->db->query($strQuery);
        $rowCount = $this->db->getRowNumber();

        if (! is_bool($result)) {
            if ($rowCount >= 1) {
                for ($count = 0; $count < $rowCount; $count ++) {
                    $row = $result[$count]; // get row information in array format
                                             // Get the column of table name in array
                    $tblName = $row['tables_in_neoreward (%bn_ac_tbl_%)'];
                    $this->setTableName($tblName);
                    if ($this->checkEmailDuplication($email, $bid)) {
                        return true; // return due to email found in the database
                    }
                }
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkEmailDuplication
    // Return: true -- Email duplicates in Database
    // false -- Email does not duplicate in Database
    // Parameter: email, bid
    // Description: check if business email duplication in specific business account table database
    // =====================================================
    public function checkEmailDuplication($email, $bid)
    {
        $retVal = false;

        // Query the email column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_email=\''.$email.'\'';
        // Query the email column with better performance
        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_ID . " FROM " . $this->dbTblName . ' WHERE bn_email=\'' . $email . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 1) {
                // More than one email found, means duplication found
                $retVal = true;
            } else if ($this->db->getRowNumber() == 1) {
                // Found the same email, if bid is differnet, it means email duplicated
                // if bid is the same, it means it's self
                $row = $result[0]; // get row information in array format
                if ($bid != $row[AllTableInfoDefinition::BN_DB_FIELD_ID]) {
                    $retVal = true;
                }
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkMobileDuplicationByAllTables
    // Return: TRUE -- mobile duplicated in Database already
    // FALSE -- mobile does not duplicate in Database
    // Parameter: mobile, bid
    // Description: check if mobile duplicated in database, itorate all business account tables
    // =====================================================
    public function checkMobileDuplicationByAllTables($mobile, $bid)
    {
        $retVal = false;

        // Check the temp account table first
        $bnUtil = new SysUtility();
        $tblName = $bnUtil->genDashboard1AcntTblName();
        $this->setTableName($tblName);

        if ($this->checkMobileDuplication($mobile, $bid)) {
            return true; // return due to email found in the database
        }

        // First step: list all business account tables in the database,
        // return false if no table existed
        // Second Step: if table existed, check the email in each table,
        // return true if email duplication is found,
        // false if not found after all tables iterated.
        $strQuery = 'SHOW TABLES LIKE \'' . '%' . AllTableInfoDefinition::BN_TABLE_NAME_PREFIX . '%' . '\'';

        $result = $this->db->query($strQuery);
        $rowCount = $this->db->getRowNumber();

        if (! is_bool($result)) {
            if ($rowCount >= 1) {
                for ($count = 0; $count < $rowCount; $count ++) {
                    $row = $result[$count]; // get row information in array format
                                             // Get the column of table name in array
                    $tblName = $row['tables_in_neoreward (%bn_ac_tbl_%)'];
                    $this->setTableName($tblName);
                    if ($this->checkMobileDuplication($mobile, $bid)) {
                        return true; // return due to mobile duplication in the database
                    }
                }
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkMobileDuplication
    // Return: true -- Mobile duplicates in Database
    // false -- Mobile does not duplicate in Database
    // Parameter: Mobile, bid
    // Description: check if Mobile duplication in specific business account table database
    // =====================================================
    public function checkMobileDuplication($mobile, $bid)
    {
        $retVal = false;

        // Query the mobile column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_email=\''.$email.'\'';
        // Query the mobile column with better performance
        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_ID . " FROM " . $this->dbTblName . ' WHERE bn_mobile=\'' . $mobile . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 1) {
                // More than one mobile found, means duplication found
                $retVal = true;
            } else if ($this->db->getRowNumber() == 1) {
                // Found the same mobile, if bid is differnet, it means mobile duplicated
                // if bid is the same, it means it's self
                $row = $result[0]; // get row information in array format
                if ($bid != $row[AllTableInfoDefinition::BN_DB_FIELD_ID]) {
                    $retVal = true;
                }
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: createDashboard1AccountTbl
    // Return: true -- potential business account table created
    // false -- potential business table failed to create
    // Parameter: business potential account table name
    // Description: create the potential business account table
    // =====================================================
    public function createDashboard1AccountTbl($tableName)
    {
        $retVal = false;
        // Step 1: check if table existed in DB
        if ($this->checkTblExist($tableName)) {
            $retVal = true; // return due to table found in the DB
        } else {
            // Step 2: create the table if not existed in DB
            $strQuery = "CREATE TABLE " . $tableName;
            $strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . " VARCHAR(100) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_BN_NAME . " VARCHAR(100) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . " VARCHAR(100) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PHONE . " VARCHAR(15) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL_ALT . " VARCHAR(100),";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MOBILE . " VARCHAR(15),";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_TYPE . " TINYINT DEFAULT 0,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ADDRESS . " VARCHAR(100),";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_CITY . " VARCHAR(50),";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PROVINCE . " TINYINT,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_COUNTRY . " TINYINT,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_POSTAL_CODE . " VARCHAR(20),";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . " VARCHAR(30) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PW . " VARCHAR(36),";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_REG_DATE . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS . " TINYINT DEFAULT 1";
            $strQuery .= ")";

            $result = $this->db->execute($strQuery);

            if (! is_bool($result)) {
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkBusinessId
    // Return: true -- business id exists in Database already
    // false -- business id does not exist in Database
    // Parameter: business id
    // Description: check if business id existed in specific business account table database
    // =====================================================
    public function checkBusinessId($businessId)
    {
        $retVal = false;
        // Query the tag id column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_id=\''.$businessId.'\'';
        // Query the tag id column with better performance
        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_EMAIL . " FROM " . $this->dbTblName . ' WHERE bn_id=\'' . $businessId . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkBusinessPhone
    // Return: true -- business phone exists in Database table already
    // false -- business phone does not exist in Database table
    // Parameter: business phone
    // Description: check if business phone existed in specific business account table database
    // =====================================================
    public function checkBusinessPhone($phone)
    {
        $retVal = false;
        // Query the tag id column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_phone=\''.$phone.'\'';

        // Query the business column with better performance
        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_ID . " FROM " . $this->dbTblName . ' WHERE bn_phone=\'' . $phone . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: addDashboard1AcntRegisterInfo
    // Return: true -- Add business register information succesfully
    // false -- Add business register information failed
    // Parameter: Business register information
    // Description: Add business register information to database
    // =====================================================
    public function addDashboard1AcntRegisterInfo($bnInfo)
    {
        $retVal = false;

        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PHONE . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_BN_NAME . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PW . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . ") VALUES ( ";
        $strQuery .= '\'' . $bnInfo->getFullName() . '\', '; // Add full name value
        $strQuery .= '\'' . $bnInfo->getEmail() . '\', '; // Add email value
        $strQuery .= '\'' . $bnInfo->getPhone() . '\', '; // Add phone value
        $strQuery .= '\'' . $bnInfo->getBusinessName() . '\', '; // Add business name value
        $strQuery .= '\'' . $bnInfo->getPassword() . '\', '; // Add password value
        $strQuery .= '\'' . $bnInfo->getBusinessId() . '\')'; // Add business ID value

        // $sql = "INSERT INTO mytable (username, password, email, regdate)VALUES('??', '$password',
                                                               // '12345@163.com', $regdate)";
        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: getBnAcntInfoByEmail
    // Return: BusinessInfoSet -- Business info
    // false -- query to DB failed
    // Parameter: business email
    // Description: Get business account info by index of email
    // =====================================================
    public function getBnAcntInfoByEmail($strEmail)
    {
        $retVal = false;

        $strTemp = CommonDefinition::STR_NULL_DATA;
        $out = new BusinessInfoSet(null, null, null, null);

        // Compose the query string
        // Query the email column
        $strQuery = "SELECT * FROM " . $this->dbTblName . ' WHERE bn_email=\'' . $strEmail . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 0) {
                $row = $result[0]; // get row information in array format

                $out->setFullName($row[AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME]);
                $out->setEmail($row[AllTableInfoDefinition::BN_DB_FIELD_EMAIL]);
                $out->setPhone($row[AllTableInfoDefinition::BN_DB_FIELD_PHONE]);
                $out->setBusinessName($row[AllTableInfoDefinition::BN_DB_FIELD_BN_NAME]);
                $out->setPassword($row[AllTableInfoDefinition::BN_DB_FIELD_PW]);
                $out->setBusinessId($row[AllTableInfoDefinition::BN_DB_FIELD_ID]);
                $out->setRegDate($row[AllTableInfoDefinition::BN_DB_FIELD_REG_DATE]);
                $out->setStatus($row[AllTableInfoDefinition::BN_DB_FIELD_STATUS]);

                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getBnAcntPasswordByEmail
    // Return: BusinessInfoSet -- Business info
    // false -- query to DB failed
    // Parameter: business email
    // Description: Get business account password by index of email
    // =====================================================
    public function getBnAcntPasswordByEmail($strEmail)
    {
        $retVal = false;
        $out = new BusinessInfoSet(null, null, null, null);

        // Compose the query string
        // Query the email column to get password
        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_PW . " FROM " . $this->dbTblName . ' WHERE bn_email=\'' . $strEmail . '\'';
        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 0) {
                $row = $result[0]; // get row information in array format
                $out->setPassword($row[AllTableInfoDefinition::BN_DB_FIELD_PW]);
                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getAcntPasswordById
    // Return: BusinessInfoSet -- Business info
    // false -- query to DB failed
    // Parameter: business ID
    // Description: Get business account password by index of id
    // =====================================================
    public function getAcntPasswordById($bid)
    {
        $retVal = false;
        $out = new BusinessInfoSet(null, null, null, null);

        // Compose the query string
        // Query the bid column to get password
        // $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_PW . " FROM " . $this->dbTblName . ' WHERE
        // bn_email=\'' .
        // $strEmail . '\'';

        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_PW . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::BN_DB_FIELD_ID . "=" . '\'' . $bid . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 0) {
                $row = $result[0]; // get row information in array format
                $out->setPassword($row[AllTableInfoDefinition::BN_DB_FIELD_PW]);
                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getAcntStatusById
    // Return: BusinessInfoSet -- Business info
    // false -- query to DB failed
    // Parameter: business ID
    // Description: Get business account status by index of id
    // =====================================================
    public function getAcntStatusById($bid)
    {
        $retVal = false;
        $out = new BusinessInfoSet(null, null, null, null);

        // Compose the query string
        // Query the bid column to get status
        // $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_PW . " FROM " . $this->dbTblName . ' WHERE
        // bn_email=\'' .
        // $strEmail . '\'';

        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_STATUS . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::BN_DB_FIELD_ID . "=" . '\'' . $bid . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 0) {
                $row = $result[0]; // get row information in array format
                $out->setStatus($row[AllTableInfoDefinition::BN_DB_FIELD_STATUS]);
                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: updateAccountPasswordById
    // Return: true -- update success
    // false -- query to DB failed
    // Parameter: business ID
    // $pwSet -- password in business info set
    // Description: Update business account password by index of id
    // =====================================================
    public function updateAccountPasswordById($pwSet, $bid)
    {
        $retVal = false;

        $strQuery = "UPDATE " . $this->dbTblName . " SET ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PW . "=" . '\'' . $pwSet->getPassword() . '\'';
        $strQuery .= " WHERE ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . "=" . '\'' . $bid . '\'';

        // 'UPDATE runoob_tbl SET runoob_title="Learning JAVA" WHERE runoob_id=3';

        // For debug purpose
        // echo ($strQuery);

        $result = $this->db->execute($strQuery);

        if ($result == false) {
            return ($retVal);
        } else {
            $retVal = true;
            return $retVal;
        }
    }

    // =====================================================
    // Name: getDashboard1AcntInfoById
    // Return: BusinessInfoSet -- Business info except note
    // false -- query to DB failed
    // Parameter: business ID
    // Description: Get business account info by index of id
    // =====================================================
    public function getDashboard1AcntInfoById($strBid)
    {
        $retVal = false;

        $out = new BusinessInfoSet(null, null, null, null);

        // Compose the query string
        // Query the email column
        $strQuery = "SELECT * FROM " . $this->dbTblName . ' WHERE bn_id=\'' . $strBid . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 0) {
                $row = $result[0]; // get row information in array format

                $out->setFullName($row[AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME]);
                $out->setEmail($row[AllTableInfoDefinition::BN_DB_FIELD_EMAIL]);
                $out->setPhone($row[AllTableInfoDefinition::BN_DB_FIELD_PHONE]);
                $out->setBusinessName($row[AllTableInfoDefinition::BN_DB_FIELD_BN_NAME]);
                $out->setPassword($row[AllTableInfoDefinition::BN_DB_FIELD_PW]);
                $out->setBusinessId($row[AllTableInfoDefinition::BN_DB_FIELD_ID]);
                $out->setRegDate($row[AllTableInfoDefinition::BN_DB_FIELD_REG_DATE]);
                $out->setStatus($row[AllTableInfoDefinition::BN_DB_FIELD_STATUS]);
                $out->setEmailAlt($row[AllTableInfoDefinition::BN_DB_FIELD_EMAIL_ALT]);
                $out->setMobile($row[AllTableInfoDefinition::BN_DB_FIELD_MOBILE]);
                $out->setBnType($row[AllTableInfoDefinition::BN_DB_FIELD_TYPE]);
                $out->setAddress($row[AllTableInfoDefinition::BN_DB_FIELD_ADDRESS]);
                $out->setCity($row[AllTableInfoDefinition::BN_DB_FIELD_CITY]);
                $out->setProvince($row[AllTableInfoDefinition::BN_DB_FIELD_PROVINCE]);
                $out->setCountry($row[AllTableInfoDefinition::BN_DB_FIELD_COUNTRY]);
                $out->setPostalCode($row[AllTableInfoDefinition::BN_DB_FIELD_POSTAL_CODE]);

                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: updateDashBoard1ProfileInfoById
    // Parameter: $profileSet -- update profile info set
    // $bid -- business ID
    // Return: true -- Update success
    // false -- Update fail
    //
    // Description: Update dashboard 1 profile info
    // =====================================================
    public function updateDashBoard1ProfileInfoById($profileSet, $bid)
    {
        $retVal = false;

        $strQuery = "UPDATE " . $this->dbTblName . " SET ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . "=" . '\'' . $profileSet->getFullName() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . "=" . '\'' . $profileSet->getEmail() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PHONE . "=" . '\'' . $profileSet->getPhone() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_BN_NAME . "=" . '\'' . $profileSet->getBusinessName() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MOBILE . "=" . '\'' . $profileSet->getMobile() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_TYPE . "=" . '\'' . $profileSet->getBnType() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ADDRESS . "=" . '\'' . $profileSet->getAddress() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_CITY . "=" . '\'' . $profileSet->getCity() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PROVINCE . "=" . '\'' . $profileSet->getProvince() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_COUNTRY . "=" . '\'' . $profileSet->getCountry() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS . "=" . '\'' . $profileSet->getStatus() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_POSTAL_CODE . "=" . '\'' . $profileSet->getPostalCode() . '\'';
        $strQuery .= " WHERE ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . "=" . '\'' . $bid . '\'';

        // 'UPDATE runoob_tbl SET runoob_title="Learning JAVA" WHERE runoob_id=3';

        // For debug purpose
        // echo ($strQuery);

        $result = $this->db->execute($strQuery);

        if ($result == false) {
            return ($retVal);
        } else {
            $retVal = true;
            return $retVal;
        }
    }

    // =====================================================
    // Name: createDashboard1AccountMsgTbl
    // Return: true -- potential business account msg table created
    // false -- potential business account msg table created failed
    // Parameter: business potential account message table name
    // Description: create the potential business account message table
    // =====================================================
    public function createDashboard1AccountMsgTbl($tableName)
    {
        $retVal = false;
        // Step 1: check if table existed in DB
        if ($this->checkTblExist($tableName)) {
            $retVal = true; // return due to table found in the DB
        } else {
            // Step 2: create the table if not existed in DB
            $strQuery = "CREATE TABLE " . $tableName;
            $strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . " VARCHAR(30) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG_SUBJECT . " VARCHAR(100) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG . " VARCHAR(300) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_REG_DATE . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
            $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG_FLAG . " TINYINT DEFAULT 1";
            $strQuery .= ")";

            $result = $this->db->execute($strQuery);

            if (! is_bool($result)) {
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkDashboard1ContactMsgById
    // Return: true -- contact message exists in Database table already
    // false -- business phone does not exist in Database table
    // Parameter: business ID
    // Description: check if Dashboard 1 business contact message existed in specific business account table database
    // =====================================================
    public function checkDashboard1ContactMsgById($bid)
    {
        $retVal = false;

        // Query the tag id column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_phone=\''.$phone.'\'';

        // Query the business column with better performance
        $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_MSG_FLAG . " FROM " . $this->dbTblName . ' WHERE bn_id=\'' . $bid . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getDashBoard1ContactMsgById
    // Return: business account contact message
    // false -- message does not exist in Database table
    // Parameter: business ID
    // Description: get business contact message existed in specific business account table database
    // =====================================================
    public function getDashBoard1ContactMsgById($bid)
    {
        $retVal = false;
        $out = new BusinessInfoSet(null, null, null, null);

        // Query the tag id column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_phone=\''.$phone.'\'';

        // Query the business column with better performance
        $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName . ' WHERE bn_id=\'' . $bid . '\'';
        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $row = $result[0]; // get row information in array format

                $out->setMsg($row[AllTableInfoDefinition::BN_DB_FIELD_MSG]);
                $out->setMsgSubject($row[AllTableInfoDefinition::BN_DB_FIELD_MSG_SUBJECT]);
                $out->setMsgFlag($row[AllTableInfoDefinition::BN_DB_FIELD_MSG_FLAG]);
                $out->setRegDate($row[AllTableInfoDefinition::BN_DB_FIELD_REG_DATE]);
                $out->setUid($row[AllTableInfoDefinition::BN_DB_FIELD_UID]);
                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: addDashBoard1BnContactMsg
    // Return: true -- Temp business contact message added success
    // false -- Temp business contact message added fail
    // Parameter: Temp business account contact message
    // Description: add Temp business account contact message
    // =====================================================
    public function addDashBoard1BnContactMsg($bnSet)
    {
        $retVal = false;

        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG_SUBJECT . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . ") VALUES ( ";
        $strQuery .= '\'' . $bnSet->getMsg() . '\', '; // Add message
        $strQuery .= '\'' . $bnSet->getMsgSubject() . '\', '; // Add message subject
        $strQuery .= '\'' . $bnSet->getBusinessId() . '\')'; // Add business ID value

        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: updateDashBoard1BnContactMsg
    // Return: true -- business contact message update success
    // false -- business contact message update fail
    // Parameter: business account contact message
    // Description: update business account contact message
    // =====================================================
    public function updateDashBoard1BnContactMsg($bnMsg)
    {
        $strQuery = "UPDATE " . $this->dbTblName . " SET ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG . "=" . '\'' . $bnMsg->getMsg() . '\', ';
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG_FLAG . "=" . '\'' . $bnMsg->getMsgFlag() . '\'';
        $strQuery .= " WHERE ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . "=" . '\'' . $bnMsg->getBusinessId() . '\'';

        $retVal = $this->db->execute($strQuery);
        return $retVal;
    }

    // =====================================================
    // Name: getDb1StatusMsg
    // Return: business account dash board 1 status message
    // false -- message does not exist in Database table
    // Parameter: None
    // Description:business account dash board 1 status message existed
    // =====================================================
    public function getDb1StatusMsg()
    {
        $retVal = false;
        $msgArray = array();

        // Query the tag id column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_phone=\''.$phone.'\'';

        // Query the business column with better performance
        $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName;
        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $row = $result[0]; // get row information in array format

                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_1_YES] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_1_YES];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_1_NO] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_1_NO];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_2_YES] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_2_YES];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_2_NO] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_2_NO];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_3_YES] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_3_YES];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_3_NO] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_3_NO];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_4_YES] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_4_YES];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_4_NO] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_4_NO];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_5_YES] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_5_YES];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_5_NO] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_5_NO];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_6_YES] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_6_YES];
                $msgArray[AllTableInfoDefinition::BN_DB_FIELD_STEP_6_NO] = $row[AllTableInfoDefinition::BN_DB_FIELD_STEP_6_NO];

                return $msgArray;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: createPotentialBnAccountMsgTbl
    // Return: true -- potential business account message table created
    // false -- potential business account message table failed to create
    // Parameter: business potential account message table name
    // Description: create the potential business account message table
    // =====================================================
    // public function createPotentialBnAccountMsgTbl($tableName)
    // {
    // $retVal = false;
    // // Step 1: check if table existed in DB
    // if($this->checkTblExist($tableName))
    // {
    // $retVal = true; //return due to table found in the DB
    // }
    // else
    // {
    // Step 2: create the table if not existed in DB
    // $strQuery = "CREATE TABLE ".$tableName;
    // $strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    // $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID." VARCHAR(30) NOT NULL,";
    // $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_NOTE." VARCHAR(2048) NOT NULL,";
    // $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS." TINYINT DEFAULT 1" ;
    // $strQuery .= ")";

    // $result = $this->db->execute($strQuery);
    //
    // if(!is_bool ($result))
    // {
    // $retVal = true;
    // }
    // }
    // return $retVal;
    // }
}

