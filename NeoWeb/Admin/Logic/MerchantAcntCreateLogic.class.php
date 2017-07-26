<?php

// +----------------------------------------------------------------------
// | Logic for Admin account Create
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Logic;

use Admin\Model\AccountModel;
use Admin\Model\MerchantModel;
use NeoWeb\Admin\Common\AdminDefinition;
use NeoWeb\Admin\Common\AdminUtilities;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\NeoInfoSet;

/**
 * Name : MerchantAcntCreateLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for merchant account create.
 */
class MerchantAcntCreateLogic extends Logic
{

    /**
     * Name : createMerchantAccount
     * Input : create merchant account information
     * Output: array -- create merchant account process result
     *
     * Description: process merchant account creation
     */
    public function createMerchantAccount($recvData)
    {
        $result = array();
        $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
        $result["info"] = "Error! Invalid account information.";

        // Step 1: input field data validation
        // Step 2: check code validation
        // Step 3: check if root account existed already

        // check first name
        $sysUtil = new SysUtility();
        if (! $sysUtil->checkFormField($recvData->n_first_name, CommonDefinition::REG_NAME_ID)) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "Error! 669 Invalid First Name!!!";

            return ($result);
        }

        // check last name
        if (! $sysUtil->checkFormField($recvData->n_last_name, CommonDefinition::REG_NAME_ID)) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "Error! Invalid Last Name!!!";

            return ($result);
        }

        // check merchant name
        if (! $sysUtil->checkFormField($recvData->n_merchant_name, CommonDefinition::REG_NAME_ID)) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "Error! Invalid merchant Name!!!";

            return ($result);
        }

        // Check email field
        if (! $sysUtil->checkFormField($recvData->n_email, CommonDefinition::REG_EMAIL_ID)) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "Error! Invalid Email!!!";

            return ($result);
        }

        // Check phone field
        if (! $sysUtil->checkFormField($recvData->n_phone, CommonDefinition::REG_MOBILE_ID)) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "Error! Invalid Phone Number!!!";

            return ($result);
        }

        // Check mobile field
        if (! $sysUtil->checkFormField($recvData->n_mobile, CommonDefinition::REG_MOBILE_ID)) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "Error! Invalid Mobile Number!!!";

            return ($result);
        }

        // Validate phone area code
        $telAreaCode = $sysUtil->validateTelAreaCode($recvData->n_phone);
        if (is_bool($telAreaCode)) {
            // return due to phone area code is not supported
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "Error! Invalid Phone area code or not supported area!!!";
            return ($result);
        }

        // Create merchant ID,
        // Note: Admin account start with "am"
        // Note: Admin account ID is from AM1001 -- AM 1100 , maximum 100 admin account availaable
        $mModel = new MerchantModel(SysDefinition::USER_DB_CONFIG);

        $db_conn = $mModel->connect();

        if (! $db_conn) {
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result); // Connect to DB failed return without further handling
        }

        $adminUtil = new AdminUtilities();
        $tblName = $adminUtil->getMerchantAccountInfoTblName($telAreaCode);
        $mModel->setTableName($tblName);

        // Check the mobile number and email duplication:
        // Check email duplication
        if ($mModel->checkEmailDuplication($recvData->n_email)) {
            // return due to email duplicated
            $result['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
            $result['info'] = "Error: This email is already in use!!!";

            $mModel->close();
            return ($result);
        }

        // Check phone number duplication
        if ($mModel->checkPhoneDuplication($recvData->n_phone)) {
            // return due to email duplicated
            $result['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
            $result['info'] = "Error: This phone number is already in use!!!";

            $mModel->close();
            return ($result);
        }

        // Check mobile number duplication
        if ($mModel->checkMobileDuplication($recvData->n_mobile)) {
            // return due to email duplicated
            $result['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
            $result['info'] = "Error: This mobile number is already in use!!!";

            $mModel->close();
            return ($result);
        }

        // Get valid merchant ID

        $midFlag = true;

        while ($midFlag) {
            $mid = $adminUtil->getMerchantId($recvData->n_email, $recvData->n_phone, $recvData->n_merchant_name);

            if (! $mModel->checkMidDuplication($mid)) {
                $midFlag = false;
            }
        }

        $tempPw = $adminUtil->generateMerchantAcntPassword($recvData->n_email, $recvData->n_phone, $recvData->n_merchant_name);

        // Get the valid account ID in string
        // $adminId = AdminDefinition::NEO_ADMIN_ACCOUNTID_PREFIX . ((string)$nextAdminId);
        $neoSet = new NeoInfoSet($recvData->n_email);

        $neoSet->setFirstName($recvData->n_first_name);
        $neoSet->setLastName($recvData->n_last_name);
        $neoSet->setBusinessName($recvData->n_merchant_name);
        $neoSet->setPhone($recvData->n_phone);
        $neoSet->setMobile($recvData->n_mobile);
        $neoSet->setUid($mid);
        $neoSet->setPassword($tempPw);

        if (! $mModel->addAcntRegisterInfo($neoSet)) {
            $result['status'] = CommonDefinition::ERROR_CONN;
            $result['info'] = "ERROR: Create merchant account failed!!!";
        } else {
            $result['status'] = CommonDefinition::SUCCESS;
            $result['mid'] = $mid;
            $result['info'] = "Success to create the merchant Account! Your temp password is " . $tempPw;
        }

        $mModel->close();
        return ($result);
    }

    // =================================================================
    // Name : createTagScanEventTbl
    // Input : mid
    // Output: create table result
    //
    // Description: Create the tag scan event table
    // ================================================================
    public function createTagScanEventTbl($mid)
    {
        $result = array();
        $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
        $result["info"] = "Error! Invalid account information.";

        // Create merchant ID,
        // Note: Admin account start with "am"
        // Note: Admin account ID is from AM1001 -- AM 1100 , maximum 100 admin account availaable
        $mModel = new MerchantModel(SysDefinition::USER_DB_CONFIG);

        $db_conn = $mModel->connect();

        if (! $db_conn) {
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result); // Connect to DB failed return without further handling
        }

        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagScanEventTblName($mid);

        if (! $mModel->createMerchantScanEventTable($tblName)) {
            $result['status'] = CommonDefinition::ERROR_CONN;
            $result['info'] = "ERROR: Create merchant account scan event table failed!!!";
        } else {
            $result['status'] = CommonDefinition::SUCCESS;
            $result['info'] = "Success to create the merchant Account scan event table!";
        }

        $mModel->close();
        return ($result);
    }

    // =================================================================
    // Name : createMidUserRegisterTbl
    // Input : mid
    // Output: create table result
    //
    // Description: Create the user register table for this merchant
    // ================================================================
    public function createMidUserRegisterTbl($mid)
    {
        $result = array();
        $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
        $result["info"] = "Error! Invalid account information.";

        // Create merchant ID,
        // Note: Admin account start with "am"
        // Note: Admin account ID is from AM1001 -- AM 1100 , maximum 100 admin account availaable
        $mModel = new MerchantModel(SysDefinition::USER_DB_CONFIG);

        $db_conn = $mModel->connect();

        if (! $db_conn) {
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result); // Connect to DB failed return without further handling
        }

        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagUserRegistTblName($mid);

        if (! $mModel->createMerchantUserRegisterTable($tblName)) {
            $result['status'] = CommonDefinition::ERROR_CONN;
            $result['info'] = "ERROR: Create merchant account scan event table failed!!!";
        } else {
            $result['status'] = CommonDefinition::SUCCESS;
            $result['info'] = "Success to create the merchant Account user register table!";
        }

        $mModel->close();
        return ($result);
    }
}
