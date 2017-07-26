<?php

// +----------------------------------------------------------------------
// | Model for Neo product and payment management
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
use NeoWeb\Common\Common\AllTableInfoDefinition;
use NeoWeb\Common\Common\Order1InfoSet;
use NeoWeb\Common\Common\TagInfoSet;
use NeoWeb\Common\Common\BusinessInfoSet;

/**
 * Name : NeoModel
 * Input : N/A
 * Output: N/A
 * Description: model for all NEO group account management:
 * Register/Login/Logout/Password recover, etc
 */
class NeoModel extends MyModel
{

    // =====================================================
    // Name: checkEmailDuplication
    // Return: true -- Email duplicates in Database
    // false -- Email does not duplicate in Database
    // Parameter: email
    // Description: check if email duplication in merchant account tag user register table database
    // =====================================================
    public function checkEmailDuplication($email)
    {
        $retVal = false;

        // Query the email column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_email=\''.$email.'\'';
        // Query the email column with better performance
        $strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_TAG_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_EMAIL . "=" . '\'' . $email . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                // More than one email found, means duplication found
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkMobileDuplication
    // Return: true -- Mobile duplicates in Database
    // false -- Mobile does not duplicate in Database
    // Parameter: Mobile
    // Description: check if Mobile duplication in merchant account tag user register table database
    // =====================================================
    public function checkMobileDuplication($mobile)
    {
        $retVal = false;

        // Query the mobile column
        // $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_email=\''.$email.'\'';
        // Query the mobile column with better performance
        $strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_TAG_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_MOBILE . "=" . '\'' . $mobile . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                // More than one mobile found, means duplication found
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getNeoAllProductInfo
    // Return: mixed
    // product info -- if the product info is found in table
    // false -- no product found or table doesn't exist
    // Parameter: None
    // Description: get the NEO all product info
    // =====================================================
    public function getNeoAllProductInfo()
    {
        $retVal = false;
        $productArray = array();

        // Query product info with better performance
        $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName;
        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                for ($count = 0; $count < $this->db->getRowNumber(); $count ++) {
                    $row = $result[$count]; // get row information in array format

                    $productArray["productName"][$count] = $row[AllTableInfoDefinition::DB_FIELD_PRODUCT_NAME];
                    $productArray["setUpFee"][$count] = $row[AllTableInfoDefinition::DB_FIELD_SET_UP_FEE];
                    $productArray["monthlyFee"][$count] = $row[AllTableInfoDefinition::DB_FIELD_MONTHLY_FEE];
                    $productArray["productDetail"][$count] = $row[AllTableInfoDefinition::DB_FIELD_PRODUCT_DETAIL];
                }
                return $productArray;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getNeoProductInfoByName
    // Return: mixed
    // product info -- if the product info is found in table
    // false -- no product found or table doesn't exist
    // Parameter: $productName
    // Description: get the NEO specific product info
    // =====================================================
    public function getNeoProductInfoByName($productName)
    {
        $retVal = false;
        $productArray = array();

        // Query product info with better performance
        $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_PRODUCT_NAME . '=\'' . $productName . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $row = $result[0]; // get row information in array format

                $productArray["productName"] = $row[AllTableInfoDefinition::DB_FIELD_PRODUCT_NAME];
                $productArray["setUpFee"] = $row[AllTableInfoDefinition::DB_FIELD_SET_UP_FEE];
                $productArray["monthlyFee"] = $row[AllTableInfoDefinition::DB_FIELD_MONTHLY_FEE];
                $productArray["productDetail"] = $row[AllTableInfoDefinition::DB_FIELD_PRODUCT_DETAIL];

                return $productArray;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: getDashboard1OrderById
    // Return: mixed
    // product info -- if the product info is found in table
    // false -- no product found or table doesn't exist
    // Parameter: $bid -- merchant ID
    // $index -- the specific order, start from 1
    // Description: get the NEO product info
    // =====================================================
    public function getDashboard1OrderById($bid, $index)
    {
        $orderSet = new Order1InfoSet($bid);

        // Query product info with better performance
        // $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName;

        $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::BN_DB_FIELD_ID . '=\'' . $bid . '\'';

        // echo ($strQuery);

        $result = $this->db->query($strQuery);

        // echo ("Get order number = " . $this->db->getRowNumber());

        if (! is_bool($result)) {
            $orderSet->setOrderNumber($this->db->getRowNumber());

            if ($orderSet->getOrderNumber() == CommonDefinition::NO_RESULT) {
                // Return due to no order found
                return ($orderSet);
            } else if ($index > $orderSet->getOrderNumber()) {
                $orderSet->setOrderNumber(CommonDefinition::NO_RESULT);
                // Return due to no order found
                return ($orderSet);
            } else {
                $row = $result[$index - 1]; // get row information in array format
                $orderSet->setOrderId($row[AllTableInfoDefinition::NEO_DB_FIELD_ORDER_ID]);
                $orderSet->setProductName($row[AllTableInfoDefinition::DB_FIELD_PRODUCT_NAME]);
                $orderSet->setMonthTerm($row[AllTableInfoDefinition::NEO_DB_FIELD_MONTH_TERM]);
                $orderSet->setStoreQuantity($row[AllTableInfoDefinition::NEO_DB_FIELD_STORE_QTY]);
                $orderSet->setTotalAmount($row[AllTableInfoDefinition::NEO_DB_FIELD_TOTAL_AMOUNT]);
                $orderSet->setTaxRate($row[AllTableInfoDefinition::NEO_DB_FIELD_TAX_RATE]);
                $orderSet->setAmountPaid($row[AllTableInfoDefinition::NEO_DB_FIELD_AMOUNT_PAID]);
                $orderSet->setOrderStatus($row[AllTableInfoDefinition::NEO_DB_FIELD_ORDER_STATUS]);
                $orderSet->setPaymentMethod($row[AllTableInfoDefinition::NEO_DB_FIELD_PAYMENT_METHOD]);
                $orderSet->setPaymentInfo($row[AllTableInfoDefinition::NEO_DB_FIELD_PAYMENT_INFO]);
                $orderSet->setOrderNote($row[AllTableInfoDefinition::NEO_DB_FIELD_ORDER_NOTE]);

                return ($orderSet);
            }
        } else {
            $orderSet->setOrderNumber(CommonDefinition::NO_RESULT);
            return ($orderSet);
        }
    }

    // =====================================================
    // Name: addDashboard1OrderById
    // Return: true -- add order to table success
    // false -- add order to table failed
    //
    // Parameter: $orderSet -- order detail information
    //
    // Description: Add the order record to table
    // =====================================================
    public function addDashboard1OrderById($orderSet)
    {
        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_ORDER_ID . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . ", ";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_PRODUCT_NAME . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_MONTH_TERM . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_STORE_QTY . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_TOTAL_AMOUNT . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_TAX_RATE . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_AMOUNT_PAID . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_PAYMENT_METHOD . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_PAYMENT_INFO . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_ORDER_STATUS . ", ";
        $strQuery .= AllTableInfoDefinition::NEO_DB_FIELD_ORDER_NOTE . ") VALUES ( ";
        $strQuery .= '\'' . $orderSet->getOrderId() . '\', '; // Add order ID
        $strQuery .= '\'' . $orderSet->getBusinessId() . '\', '; // Add business ID
        $strQuery .= '\'' . $orderSet->getProductName() . '\', '; // Add product name
        $strQuery .= '\'' . $orderSet->getMonthTerm() . '\', '; // Add month term
        $strQuery .= '\'' . $orderSet->getStoreQuantity() . '\', '; // Add store quantity
        $strQuery .= '\'' . $orderSet->getTotalAmount() . '\', '; // Add total amount
        $strQuery .= '\'' . $orderSet->getTaxRate() . '\', '; // Add tax rate
        $strQuery .= '\'' . $orderSet->getAmountPaid() . '\', '; // Add amount paid
        $strQuery .= '\'' . $orderSet->getPaymentMethod() . '\', '; // Add payment method
        $strQuery .= '\'' . $orderSet->getPaymentInfo() . '\', '; // Add payment info
        $strQuery .= '\'' . $orderSet->getOrderStatus() . '\', '; // Add payment method
        $strQuery .= '\'' . $orderSet->getOrderNote() . '\')'; // Add business ID value

        $result = $this->db->execute($strQuery);

        return ($result);
    }

    // =====================================================
    // Name: getDashboard1OrderNumberByBid
    // Return: mixed
    // number of orders available for the specific business id
    // false -- order query failed
    // Parameter: $bid -- merchant ID
    //
    // Description: get the DB1 order number info by business ID
    // =====================================================
    public function getDashboard1OrderNumberByBid($bid)
    {
        // Query Dash board 1 info with better performance
        // $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName;
        $strQuery = "SELECT " . AllTableInfoDefinition::NEO_DB_FIELD_ORDER_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::BN_DB_FIELD_ID . '=\'' . $bid . '\'';

        $result = $this->db->query($strQuery);

        // echo ("Get order number = " . $this->db->getRowNumber());

        if (! is_bool($result)) {
            return ($this->db->getRowNumber());
        } else {
            return (false);
        }
    }

    // =====================================================
    // Name: addMoreServiceEnquiry($bnSet)
    // Return: true -- add message success
    // false -- add message failed
    // Parameter: message needs to be added
    // Description: add business enquiry message
    // =====================================================
    public function addMoreServiceEnquiry($bnSet)
    {
        $retVal = false;

        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PHONE . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_BN_NAME . ") VALUES ( ";
        $strQuery .= '\'' . $bnSet->getFullName() . '\', '; // Add full name
        $strQuery .= '\'' . $bnSet->getEmail() . '\', '; // Addemail
        $strQuery .= '\'' . $bnSet->getPhone() . '\', '; // Add phone
        $strQuery .= '\'' . $bnSet->getBusinessName() . '\')'; // Add business name

        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: addInTouchMsg
    // Return: true -- add message success
    // false -- add message failed
    // Parameter: message needs to be added
    // Description: add in touch message message
    // =====================================================
    public function addInTouchMsg($bnSet)
    {
        $retVal = false;

        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . ", ";
        $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG . ") VALUES ( ";
        $strQuery .= '\'' . $bnSet->getFullName() . '\', '; // Add full name
        $strQuery .= '\'' . $bnSet->getEmail() . '\', '; // Add email
        $strQuery .= '\'' . $bnSet->getMsg() . '\')'; // Add business message

        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: getTagInfoById
    // Return: Info by Tag ID
    // false -- Tag related info not found
    // Parameter: tag ID
    // Description: get tag related info by Tag ID
    // =====================================================
    public function getTagInfoById($id)
    {
        $tagSet = new TagInfoSet($id);
        $tagSet->setStatus(false);

        // Compose the query string
        // Query the email column to get password
        $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_TAG_ID . "=" . '\'' . $id . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $row = $result[0]; // get row information in array format

                $tagSet->setBusinessId($row[AllTableInfoDefinition::BN_DB_FIELD_ID]);
                $tagSet->setTagLabel($row[AllTableInfoDefinition::DB_FIELD_TAG_LABEL]);
                $tagSet->setTagNumber($row[AllTableInfoDefinition::DB_FIELD_TAG_NUMBER]);
                $tagSet->setWebPage($row[AllTableInfoDefinition::DB_FIELD_TAG_WEB_PAGE]);

                $tagSet->setStatus(true);
            }
        }
        return ($tagSet);
    }

    // =====================================================
    // Name: addTagScanEvent
    // Return: true --> add event success
    // false -- add event failed
    // Parameter: log set data
    // Description: add log event
    // =====================================================
    public function addTagScanEvent($setData)
    {
        $retVal = false;

        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . ") VALUES ( ";
        $strQuery .= '\'' . $setData->getTagId() . '\')'; // Add tag id

        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: addTagScanErrorEvent
    // Return: true --> add event success
    // false -- add event failed
    // Parameter: log set data
    // Description: add scan error log event
    // =====================================================
    public function addTagScanErrorEvent($setData)
    {
        $retVal = false;

        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . ") VALUES ( ";
        $strQuery .= '\'' . $setData->getTagId() . '\')'; // Add tag id

        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: addUserTagRegisterInfo
    // Return: true --> add user register through tag success
    // false -- operation failed
    // Parameter: user set data
    // Description: add user tag register account info
    // =====================================================
    public function addUserTagRegisterInfo($userSet)
    {
        $retVal = false;
        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_FIRST_NAME . ", ";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_LAST_NAME . ", ";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_EMAIL . ", ";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_MOBILE . ", ";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . ") VALUES ( ";
        $strQuery .= '\'' . $userSet->getFirstName() . '\', '; // Add First Name
        $strQuery .= '\'' . $userSet->getLastName() . '\', '; // Add Last name
        $strQuery .= '\'' . $userSet->getEmail() . '\', '; // Add Email
        $strQuery .= '\'' . $userSet->getMobile() . '\', '; // Add Mobile number
        $strQuery .= '\'' . $userSet->getTagId() . '\')'; // Add Tag ID

        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: getMerchantAccountTableNameById
    // Return: table name with merchant account
    // null -- the merchant account is not found
    // Parameter: mid
    // Description: get business account table name for the merchant ID
    // =====================================================
    public function getMerchantAccountTableNameById($mid)
    {
        $result = null;
        $sysUtil = new SysUtility();

        for ($count = 0; $count < count(CommonDefinition::PROVINCE_INDEX_AREA_CODE); $count ++) {
            $areaCode = CommonDefinition::PROVINCE_INDEX_AREA_CODE[$count];
            $tblName = $sysUtil->getMerchantAccountInfoTblName($areaCode);

            $this->setTableName($tblName);

            $strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_BUSINESS_NAME . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . "=" . '\'' . $mid . '\'';

            $result = $this->db->query($strQuery);

            if (! is_bool($result)) {
                if ($this->db->getRowNumber() >= 1) {
                    // More than one email found, means duplication found
                    return ($tblName);
                }
            }
        }

        return ($result);
    }

    // =====================================================
    // Name: getRegistSuccessMsg
    // Return: regist success message for user regist through tag
    //
    // Parameter: mid
    // Description: get regist success message for user regist through tag
    // =====================================================
    public function getRegistSuccessMsg($mid)
    {
        $bnSet = new BusinessInfoSet(null, null, null, null);

        $strQuery = "SELECT " . "*" . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . '=\'' . $mid . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                $row = $result[0]; // get row information in array format
                $bnSet->setBusinessName($row[AllTableInfoDefinition::DB_FIELD_BUSINESS_NAME]);
                $bnSet->setWebPage($row[AllTableInfoDefinition::DB_FIELD_WEB_PAGE]);
                $bnSet->setFaceBookId($row[AllTableInfoDefinition::DB_FIELD_FACE_BOOK_ID]);
                $bnSet->setTwitterId($row[AllTableInfoDefinition::DB_FIELD_TWITTER_ID]);
                $bnSet->setEmail($row[AllTableInfoDefinition::DB_FIELD_EMAIL]);
                $bnSet->setRewardMsg($row[AllTableInfoDefinition::DB_FIELD_TAG_REWARD_MSG]);
                $bnSet->setSuccessMsg($row[AllTableInfoDefinition::DB_FIELD_TAG_REGIST_SUCCESS_MSG]);

                $bnSet->setStatus(true);
            }
        }
        return ($bnSet);
    }
}

