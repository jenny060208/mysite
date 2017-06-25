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
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\UserDefinition;
use NeoWeb\Common\Common\AllTableInfoDefinition;
use NeoWeb\Common\Common\UserInfoSet;

/**
 * Name : UserModel
 * Input : N/A
 * Output: N/A
 * Description: model for all user account management:
 * Register/Login/Logout/Password recover, etc
 */
class UserModel extends MyModel
{

    // =====================================================
    // Name: getUserAccountTblNameByEmail
    // Return: mixed
    // table name -- if the email is found in one table
    // false -- email is not found in table
    // Parameter: user email
    // Description: get the table name including the email
    // =====================================================
    public function getUserAccountTblNameByEmail($strEmail)
    {
        if (! $this->checkUserEmailByAllTables($strEmail)) {
            return (false); // table not found
        } else {
            return ($this->getTableName());
        }
    }

    // =====================================================
    // Name: checkUserEmailByAllTables
    // Return: TRUE -- user email exists in Database already
    // FALSE -- user email does not exist in Database
    // Parameter: user email
    // Description: check if user email existed in database, itorate all user account tables
    // =====================================================
    public function checkUserEmailByAllTables($strEmail)
    {
        $retVal = false;

        // First step: list all user account tables in the database,
        // return false if no table existed
        // Second Step: if table existed, check the email in each table,
        // return true if email is found,
        // false if not found after all tables iterated.
        $strQuery = 'SHOW TABLES LIKE \'' . '%' . AllTableInfoDefinition::USER_TABLE_NAME_PREFIX . '%' . '\'';

        $result = $this->db->query($strQuery);
        $rowCount = $this->db->getRowNumber();

        if (! is_bool($result)) {
            if ($rowCount >= 1) {
                for ($count = 0; $count < $rowCount; $count ++) {
                    $row = $result[$count]; // get row information in array format
                                             // Get the column of table name in array
                                             // $tblName = $row['tables_in_neoreward (%user_info_tbl_%)'];

                    $tblName = $row['tables_in_neo_loyalty (%user_info_tbl_%)']; // Note: this one must be modified with the read
                                                                                  // database name

                    $this->setTableName($tblName);
                    if ($this->checkUserEmail($strEmail)) {
                        return true; // return due to email found in the database
                    }
                }
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkUserEmail
    // Return: true -- user email exists in Database already
    // false -- user email does not exist in Database
    // Parameter: user email
    // Description: check if user email existed in specific user account table database
    // =====================================================
    public function checkUserEmail($email)
    {
        $retVal = false;

        // Query the email column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE user_email=\''.$email.'\'';

        // Query the email column
        $strQuery = "SELECT " . AllTableInfoDefinition::USER_DB_FIELD_EMAIL . " FROM " . $this->dbTblName . ' WHERE user_email=\'' . $email . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $retVal = true;
            }
        }

        return $retVal;
    }

    // =====================================================
    // Name: creatUserAccountTbl
    // Return: true -- user account table created
    // false -- user account table failed to create
    // Parameter: user account table name
    // Description: create the user account table
    // =====================================================
    public function creatUserAccountTbl($tableName)
    {
        $retVal = false;
        // Step 1: check if table existed in DB
        if ($this->checkTblExist($tableName)) {
            $retVal = true; // return due to table found in the DB
        } else {
            // Step 2: create the table if not existed in DB
            $strQuery = "CREATE TABLE " . $tableName;
            $strQuery .= " (id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_NAME . " VARCHAR(30) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_MOBILE . " VARCHAR(15) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_EMAIL . " VARCHAR(30) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_PASSWORD . " VARCHAR(36) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_POSTAL_CODE . " VARCHAR(12),";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_TAG . " VARCHAR(30) NOT NULL,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_ADDRESS_1 . " VARCHAR(100),";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_ADDRESS_2 . " VARCHAR(100),";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_CITY . " VARCHAR(50),";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_PROVINCE . " TINYINT,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_COUNTRY . " TINYINT,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_BIRTHDAY . " TINYINT,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_BIRTH_MONTH . " TINYINT,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_STORE_NOTICE . " TINYINT DEFAULT 4,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_NEO_NOTICE . " TINYINT DEFAULT 4,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_REG_DATE . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
            $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_STATUS . " TINYINT DEFAULT 1";
            $strQuery .= ")";

            $result = $this->db->execute($strQuery);

            if (! is_bool($result)) {
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkUserMobile
    // Return: true -- user mobile exists in Database already
    // false -- user mobile does not exist in Database
    // Parameter: user mobile
    // Description: check if user mobile existed in specific user account table database
    // =====================================================
    /*
     * public function checkUserMobile($user_mobile)
     * {
     * //Query the email column
     * $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE user_mobile=\''.$user_mobile.'\'';
     * $result = $this->db->query($strQuery);
     * if(is_bool ($result))
     * {
     * //only false should be if check failed
     * if($result === false)
     * {
     * return false;
     * }
     * }
     * if($this->db->getRowNumber() >= 1)
     * {
     * return true;
     * }
     * else
     * {
     * return false;
     * }
     * }
     */

    // =====================================================
    // Name: getUserAccountTblNameByUserId
    // Return: mixed
    // table name -- if the email is found in one table
    // false -- email is not found in table
    // Parameter: user email
    // Description: get the table name including the email
    // =====================================================
    public function getUserAccountTblNameByUserId($strUserId)
    {
        if (! $this->checkUserIdByAllTables($strUserId)) {
            return (false); // table not found
        } else {
            return ($this->getTableName());
        }
    }

    // =====================================================
    // Name: checkUserIdByAllTables
    // Return: TRUE -- user ID exists in Database already
    // FALSE -- user email does not exist in Database
    // Parameter: user email
    // Description: check if user email existed in database, itorate all user account tables
    // =====================================================
    public function checkUserIdByAllTables($strUserId)
    {
        $retVal = false;

        // First step: list all user account tables in the database,
        // return false if no table existed
        // Second Step: if table existed, check the email in each table,
        // return true if email is found,
        // false if not found after all tables iterated.
        $strQuery = 'SHOW TABLES LIKE \'' . '%' . AllTableInfoDefinition::USER_TABLE_NAME_PREFIX . '%' . '\'';

        $result = $this->db->query($strQuery);
        $rowCount = $this->db->getRowNumber();

        if (! is_bool($result)) {
            if ($rowCount >= 1) {
                for ($count = 0; $count < $rowCount; $count ++) {
                    $row = $result[$count]; // get row information in array format
                                             // Get the column of table name in array
                    $tblName = $row['tables_in_neoreward (%user_info_tbl_%)'];
                    $this->setTableName($tblName);
                    if ($this->checkUserTagId($strUserId)) {
                        return true; // return due to email found in the database
                    }
                }
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkUserTagId
    // Return: true -- user tag id exists in Database already
    // false -- user tag id does not exist in Database
    // Parameter: user tag id
    // Description: check if user tag id existed in specific user account table database
    // =====================================================
    public function checkUserTagId($userTagId)
    {
        $retVal = false;
        // Query the tag id column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE user_tag_id=\''.$userTagId.'\'';

        // Query the tag id column
        $strQuery = "SELECT " . AllTableInfoDefinition::USER_DB_FIELD_EMAIL . " FROM " . $this->dbTblName . ' WHERE user_tag_id=\'' . $userTagId . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: addUserRegisterInfo
    // Return: true -- Add user register information succesfully
    // false -- Add user register information failed
    // Parameter: $userSet
    // Description: Add user register information to database
    // =====================================================
    public function addUserRegisterInfo($userSet)
    {
        $retVal = false;

        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_NAME . ", ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_MOBILE . ", ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_EMAIL . ", ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_PASSWORD . ", ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_TAG . ") VALUES ( ";
        $strQuery .= '\'' . $userSet->getUserName() . '\', '; // Add the user name value
        $strQuery .= '\'' . $userSet->getMobile() . '\', '; // Add the user mobile value
        $strQuery .= '\'' . $userSet->getEmail() . '\', '; // Add the user email value
        $strQuery .= '\'' . $userSet->getPassword() . '\', '; // Add the user password value
        $strQuery .= '\'' . $userSet->getTagId() . '\')'; // Add the user postal code value

        // $sql = "INSERT INTO mytable (username, password, email, regdate)VALUES('??', '$password',
                                                           // '12345@163.com', $regdate)";

        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: getUserAccountByEmail
    // Return: UserInfoSet -- User info
    // false -- query to DB failed
    // Parameter: user email
    // Description: Get user info by index of email
    // =====================================================
    public function getUserAccountByEmail($email)
    {
        $retVal = false;

        $out = new UserInfoSet(null, null, null, null);

        // Compose the query string
        // Query the email column
        $strQuery = "SELECT * FROM " . $this->dbTblName . ' WHERE user_email=\'' . $email . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 0) {
                $row = $result[0]; // get row information in array format

                $out->setUserName($row[AllTableInfoDefinition::USER_DB_FIELD_NAME]);
                $out->setMobile($row[AllTableInfoDefinition::USER_DB_FIELD_MOBILE]);
                $out->setEmail($row[AllTableInfoDefinition::USER_DB_FIELD_EMAIL]);
                $out->setPassword($row[AllTableInfoDefinition::USER_DB_FIELD_PASSWORD]);
                $out->setPostalCode($row[AllTableInfoDefinition::USER_DB_FIELD_POSTAL_CODE]);
                $out->setTagId($row[AllTableInfoDefinition::USER_DB_FIELD_TAG]);
                $out->setRegDate($row[AllTableInfoDefinition::USER_DB_FIELD_REG_DATE]);
                $out->setUserStatus($row[AllTableInfoDefinition::USER_DB_FIELD_STATUS]);
                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getUserAccountPasswordByEmail
    // Return: UserInfoSet -- User info
    // false -- query to DB failed
    // Parameter: user email
    // Description: Get user info by index of email
    // =====================================================
    public function getUserAccountPasswordByEmail($email)
    {
        $retVal = false;

        $out = new UserInfoSet($strTemp, $strTemp, $strTemp, $strTemp, $strTemp);

        // Compose the query string
        // Query the email column
        $strQuery = "SELECT " . AllTableInfoDefinition::USER_DB_FIELD_PASSWORD . " FROM " . $this->dbTblName . ' WHERE user_email=\'' . $email . '\'';
        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 0) {
                $row = $result[0]; // get row information in array format
                $out->setPassword($row[AllTableInfoDefinition::USER_DB_FIELD_PASSWORD]);
                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getUserAccountInfoByUserId
    // Return: UserInfoSet -- User info
    // false -- query to DB failed
    // Parameter: user email
    // Description: Get user info by index of userId
    // =====================================================
    public function getUserAccountInfoByUserId($userId)
    {
        $retVal = false;

        $out = new UserInfoSet(null, null, null, null);

        // Compose the query string
        // Query the user tagID column
        $strQuery = "SELECT * FROM " . $this->dbTblName . ' WHERE user_tag_id=\'' . $userId . '\'';
        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() > 0) {
                $row = $result[0]; // get row information in array format

                $out->setUserName($row[AllTableInfoDefinition::USER_DB_FIELD_NAME]);
                $out->setMobile($row[AllTableInfoDefinition::USER_DB_FIELD_MOBILE]);
                $out->setEmail($row[AllTableInfoDefinition::USER_DB_FIELD_EMAIL]);
                $out->setPassword($row[AllTableInfoDefinition::USER_DB_FIELD_PASSWORD]);
                $out->setPostalCode($row[AllTableInfoDefinition::USER_DB_FIELD_POSTAL_CODE]);
                $out->setTagId($row[AllTableInfoDefinition::USER_DB_FIELD_TAG]);
                $out->setRegDate($row[AllTableInfoDefinition::USER_DB_FIELD_REG_DATE]);
                $out->setUserStatus($row[AllTableInfoDefinition::USER_DB_FIELD_STATUS]);
                $out->setAddress1($row[AllTableInfoDefinition::USER_DB_FIELD_ADDRESS_1]);
                $out->setAddress2($row[AllTableInfoDefinition::USER_DB_FIELD_ADDRESS_2]);
                $out->setCity($row[AllTableInfoDefinition::USER_DB_FIELD_CITY]);
                $out->setProvince($row[AllTableInfoDefinition::USER_DB_FIELD_PROVINCE]);
                $out->setCountry($row[AllTableInfoDefinition::USER_DB_FIELD_COUNTRY]);
                $out->setBirthday($row[AllTableInfoDefinition::USER_DB_FIELD_BIRTHDAY]);
                $out->setBirthMonth($row[AllTableInfoDefinition::USER_DB_FIELD_BIRTH_MONTH]);
                $out->setStoreNotice($row[AllTableInfoDefinition::USER_DB_FIELD_STORE_NOTICE]);
                $out->setNeoNotice($row[AllTableInfoDefinition::USER_DB_FIELD_NEO_NOTICE]);

                return $out;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: updateUserBasicInfoByUserId
    // Return: TRUE -- User info update success
    // false -- User info update fail
    // Parameter: $userInfo -- user account info needs to be updated
    // $user_id -- user ID
    // Description: Update user info by index of userId
    // =====================================================
    public function updateUserBasicInfoByUserId($userInfo, $user_id)
    {
        $retVal = false;

        $strQuery = "UPDATE " . $this->dbTblName . " SET ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_NAME . "=" . '\'' . $userInfo->getUserName() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_MOBILE . "=" . '\'' . $userInfo->getMobile() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_EMAIL . "=" . '\'' . $userInfo->getEmail() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_POSTAL_CODE . "=" . '\'' . $userInfo->getPostalCode() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_ADDRESS_1 . "=" . '\'' . $userInfo->getAddress1() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_ADDRESS_2 . "=" . '\'' . $userInfo->getAddress2() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_CITY . "=" . '\'' . $userInfo->getCity() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_PROVINCE . "=" . '\'' . $userInfo->getProvince() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_COUNTRY . "=" . '\'' . $userInfo->getCountry() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_BIRTH_MONTH . "=" . '\'' . $userInfo->getBirthMonth() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_BIRTHDAY . "=" . '\'' . $userInfo->getBirthday() . '\'';
        $strQuery .= " WHERE ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_TAG . "=" . '\'' . $user_id . '\'';

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
    // Name: updateUserPasswordByUserId
    // Return: TRUE -- User password update success
    // false -- User password update fail
    // Parameter: $userInfo -- user account info needs to be updated
    // $user_id -- user ID
    // Description: Update user password by index of userId
    // =====================================================
    public function updateUserPasswordByUserId($userInfo, $user_id)
    {
        $retVal = false;

        $strQuery = "UPDATE " . $this->dbTblName . " SET ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_PASSWORD . "=" . '\'' . $userInfo->getPassword() . '\'';
        $strQuery .= " WHERE ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_TAG . "=" . '\'' . $user_id . '\'';

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
    // Name: updateUserNoticeMethodByUserId
    // Return: TRUE -- User notice preference update success
    // false -- User notice preference update fail
    // Parameter: $userInfo -- user account info needs to be updated
    // $user_id -- user ID
    // Description: Update user notice preference by index of userId
    // =====================================================
    public function updateUserNoticeMethodByUserId($userInfo, $user_id)
    {
        $retVal = false;

        $strQuery = "UPDATE " . $this->dbTblName . " SET ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_STORE_NOTICE . "=" . '\'' . $userInfo->getStoreNotice() . '\', ';
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_NEO_NOTICE . "=" . '\'' . $userInfo->getNeoNotice() . '\'';
        $strQuery .= " WHERE ";
        $strQuery .= AllTableInfoDefinition::USER_DB_FIELD_TAG . "=" . '\'' . $user_id . '\'';

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
    // Name: getUserInfoByMobile
    // Return: UserInfoSet -- User info
    // NULL -- quey to DB failed
    // Parameter: user mobile
    // Description: Get user info by index of email
    // =====================================================
    /*
     * public function getUserInfoByMobile($userMobile)
     * {
     * $strTemp = AllTableInfoDefinition::STR_NULL_DATA;
     * $out = new UserInfoSet($strTemp, $strTemp, $strTemp, $strTemp,$strTemp);
     * //Compose the query string
     * //Query the email column
     * $strQuery = "SELECT * FROM ".$this->dbTblName.' WHERE user_mobile=\''.$userMobile.'\'';
     * $result = $this->mysqli->query($strQuery);
     * if ($result->num_rows > 0)
     * {
     * $row = $result->fetch_assoc();
     * $out->setUserName($row[AllTableInfoDefinition::USER_DB_FIELD_NAME]);
     * $out->setMobile($row[AllTableInfoDefinition::USER_DB_FIELD_MOBILE]);
     * $out->setEmail($row[AllTableInfoDefinition::USER_DB_FIELD_EMAIL]);
     * $out->setPassword($row[AllTableInfoDefinition::USER_DB_FIELD_PASSWORD]);
     * $out->setPostalCode($row[AllTableInfoDefinition::USER_DB_FIELD_POSTAL_CODE]);
     * $out->setTagId($row[AllTableInfoDefinition::USER_DB_FIELD_TAG]);
     * $out->setRegDate($row[AllTableInfoDefinition::USER_DB_FIELD_REG_DATE]);
     * $out->setUserStatus($row[AllTableInfoDefinition::USER_DB_FIELD_STATUS]);
     * $result->close();
     * return $out;
     * }
     * else
     * {
     * $result->close();
     * return null;
     * }
     * }
     */
    // =====================================================
    // Name: deleteUserInfoByEmail
    // Return: SUCCESS -- delete record from table successfully
    // ERROR -- Failed to delete record
    // Parameter: user mobile
    // Description: Delete record according to user email
    // =====================================================
    /*
     * public function deleteUserInfoByEmail($userEmail)
     * {
     * //Compose the query string
     * //Query the email column
     * $strQuery = "DELETE FROM ".$this->dbTblName." WHERE user_email=\'".$userEmail."\'";
     * $result = $this->db->execute($strQuery);
     * if(is_bool ($result))
     * {
     * //only false should be if check failed
     * if($result === false)
     * {
     * return false;
     * }
     * }
     * return true;
     * }
     */
    // =====================================================
    // Name: deleteUserInfoByMobile
    // Return: SUCCESS -- delete record from table successfully
    // ERROR -- Failed to delete record
    // Parameter: user mobile
    // Description: Delete record according to user mobile
    // =====================================================
    /*
     * public function deleteUserInfoByMobile($userMobile)
     * {
     * //Compose the query string
     * //Query the email column
     * $strQuery = "DELETE FROM ".$this->dbTblName." WHERE user_mobile=\'".$userMobile."\'";
     * $result = $this->db->execute($strQuery);
     * if(is_bool ($result))
     * {
     * //only false should be if check failed
     * if($result === false)
     * {
     * return false;
     * }
     * }
     * return true;
     * }
     */
}
