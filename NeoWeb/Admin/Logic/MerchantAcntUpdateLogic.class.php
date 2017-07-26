<?php

// +----------------------------------------------------------------------
// | Logic for Admin account Create
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Logic;

use Admin\Model\MerchantModel;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\BusinessInfoSet;

/**
 * Name : MerchantAcntUpdateLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for merchant account update.
 */
class MerchantAcntUpdateLogic extends Logic
{

    /**
     * Name : createMerchantAccount
     * Input : create merchant account information
     * Output: array -- create merchant account process result
     *
     * Description: process merchant account creation
     */

    // =================================================================
    // Name : loadMerchantAccountInfo
    // Input : $recvData -- received data from json
    // Output: merchant account info for the specific one
    //
    // Description: get the specific merchanrt account info
    // ================================================================
    public function loadMerchantAccountInfo($recvData)
    {
        $result = array();
        $result["status"] = CommonDefinition::ERROR;

        $mSet = new BusinessInfoSet(null, null, null, null);

        $mSet->setCurrentAcnt($recvData->current_merchant);

        // check first name
        $sysUtil = new SysUtility();

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

        $acntQuantity = $mModel->getMerchantAcntQuantity();

        // echo ("Total merchant = " . $acntQuantity["total"]);

        // for ($count = 0; $count < count($acntQuantity["info"]); $count ++) {
        // echo ("Merchant Quantity = " . $acntQuantity["info"][$count]);
        // }

        if ($acntQuantity["total"] == 0) {
            $result["status"] = CommonDefinition::SUCCESS;
            $result["info"]["total_merchant"] = 0;
        } else {
            $index = 0;
            $currentTemp = $mSet->getCurrentAcnt();

            // make sure the current should not be larger than the maximum
            if ($currentTemp > $acntQuantity["total"]) {
                $currentTemp = $acntQuantity["total"];
                $mSet->setCurrentAcnt($currentTemp);

                // echo ("Current merchant = " . $currentTemp);
            }

            for ($count = 0; $count < count($acntQuantity["info"]); $count ++) {
                $index += $acntQuantity["info"][$count];

                if ($mSet->getCurrentAcnt() > $index) {
                    $currentTemp = $currentTemp - $acntQuantity["info"][$count];
                } else {
                    $tblName = $sysUtil->getMerchantAccountInfoTblName(CommonDefinition::PROVINCE_INDEX_AREA_CODE[$count]);

                    // echo ("Table Name = " . $tblName);

                    // echo ("Current index = " . $currentTemp);

                    $mModel->setTableName($tblName);
                    $queryResult = $mModel->getCurrentMerchantAcntInfo($currentTemp);

                    if ($queryResult->getStatus()) {

                        $result["status"] = CommonDefinition::SUCCESS;

                        $result["info"]["total_merchant"] = $acntQuantity["total"];
                        $result["info"]["current_merchant"] = $mSet->getCurrentAcnt();

                        $result["info"]["first_name"] = $queryResult->getFirstName();
                        $result["info"]["last_name"] = $queryResult->getLastName();
                        $result["info"]["merchant_name"] = $queryResult->getBusinessName();
                        $result["info"]["merchant_id"] = $queryResult->getBusinessId();
                        $result["info"]["merchant_status"] = $queryResult->getBusinessStatus();
                        $result["info"]["web_page"] = $queryResult->getWebPage();

                        $result["info"]["email"] = $queryResult->getEmail();
                        $result["info"]["phone"] = $queryResult->getPhone();
                        $result["info"]["mobile"] = $queryResult->getMobile();

                        $result["info"]["address"] = $queryResult->getAddress();
                        $result["info"]["city"] = $queryResult->getCity();
                        $result["info"]["province"] = $queryResult->getProvince();
                        $result["info"]["country"] = $queryResult->getCountry();
                        $result["info"]["postal_code"] = $queryResult->getPostalCode();

                        $result["info"]["fb_id"] = $queryResult->getFaceBookId();
                        $result["info"]["twitter_id"] = $queryResult->getTwitterId();

                        $result["info"]["reward_msg"] = $queryResult->getRewardMsg();
                        $result["info"]["success_msg"] = $queryResult->getSuccessMsg();
                        $result["info"]["note"] = $queryResult->getNote();

                        // Load the merchant status type definition
                        for ($count = 0; $count < count(CommonDefinition::BUSINESS_STATUS_DEF); $count ++) {
                            $result["info"]["merchant_status_def"][$count] = CommonDefinition::BUSINESS_STATUS_DEF[$count];
                        }

                        // Load the province defition
                        for ($count = 0; $count < count(CommonDefinition::PROVINCE_NAME); $count ++) {
                            $result["info"]["province_def"][$count] = CommonDefinition::PROVINCE_NAME[$count];
                        }

                        // Load the Country defition
                        for ($count = 0; $count < count(CommonDefinition::COUNTRY_NAME); $count ++) {
                            $result["info"]["country_def"][$count] = CommonDefinition::COUNTRY_NAME[$count];
                        }

                        $mModel->close();
                        return ($result);
                    } else {
                        $result["status"] = CommonDefinition::ERROR;
                        $result["info"] = "No more record";
                    }
                }
            }
        }

        $mModel->close();
        return ($result);
    }

    // =================================================================
    // Name : merchantAcntDelete
    // Input : $recvData -- received data from json
    // Output: merchant account delete info for the specific one
    //
    // Description: delete the specific merchanrt account info
    // ================================================================
    public function merchantAcntDelete($recv_data)
    {
        $currentMerchant = (int) ($recv_data->current_merchant);
        $merchantId = $recv_data->merchant_id;

        $result = array();
        $sysUtil = new SysUtility();

        $mModel = new MerchantModel(SysDefinition::USER_DB_CONFIG);
        $db_conn = $mModel->connect();

        if (! $db_conn) {
            // Connect to DB failed return without further handling
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result);
        }

        // Get the total quantity
        $acntQuantity = $mModel->getMerchantAcntQuantity();
        if ($acntQuantity["total"] == CommonDefinition::ZERO_NUM) {
            // no record is found
            $result["status"] = CommonDefinition::ERROR_NO_RECORD;
            $result["info"] = "No more record";

            $mModel->close();
            return ($result);
        }

        // get the merchant account table name
        $tblName = $mModel->getMerchantAccountTableNameById($merchantId);
        $mModel->setTableName($tblName);

        // Delete the merchant account by merchant id
        $queryResult = $mModel->deleteMerchantAccountById($merchantId);

        if ($queryResult == false) {
            $result["status"] = CommonDefinition::ERROR_NO_RECORD;
            $result["info"] = "No more record, Delete merchant id operation failed";
            $mModel->close();
            return ($result);
        } else {
            // Get the total quantity
            $acntQuantity = $mModel->getMerchantAcntQuantity();
            if ($acntQuantity["total"] == CommonDefinition::ZERO_NUM) {
                // no more record is found
                $result["status"] = CommonDefinition::SUCCESS;
                $result["info"]["total_merchant"] = CommonDefinition::ZERO_NUM;

                // Delete the bounded table about scan event and user register
                $tblName = $sysUtil->getTagScanEventTblName($merchantId);
                $mModel->deleteTable($tblName);

                $tblName = $sysUtil->getTagUserRegistTblName($merchantId);
                $mModel->deleteTable($tblName);

                $mModel->close();
                return ($result);
            }

            if ($currentMerchant > $acntQuantity["total"]) {
                $currentMerchant = $acntQuantity["total"];
            }

            $index = 0;
            $currentTemp = $currentMerchant;

            for ($count = 0; $count < count($acntQuantity["info"]); $count ++) {
                $index += $acntQuantity["info"][$count];

                if ($currentMerchant > $index) {
                    $currentTemp = $currentTemp - $acntQuantity["info"][$count];
                } else {
                    $tblName = $sysUtil->getMerchantAccountInfoTblName(CommonDefinition::PROVINCE_INDEX_AREA_CODE[$count]);

                    // echo ("Table Name = " . $tblName);

                    // echo ("Current index = " . $currentTemp);

                    $mModel->setTableName($tblName);
                    $queryResult = $mModel->getCurrentMerchantAcntInfo($currentTemp);

                    if ($queryResult->getStatus()) {

                        $result["status"] = CommonDefinition::SUCCESS;

                        $result["info"]["total_merchant"] = $acntQuantity["total"];
                        $result["info"]["current_merchant"] = $currentMerchant;

                        $result["info"]["first_name"] = $queryResult->getFirstName();
                        $result["info"]["last_name"] = $queryResult->getLastName();
                        $result["info"]["merchant_name"] = $queryResult->getBusinessName();
                        $result["info"]["merchant_id"] = $queryResult->getBusinessId();
                        $result["info"]["merchant_status"] = $queryResult->getBusinessStatus();
                        $result["info"]["web_page"] = $queryResult->getWebPage();

                        $result["info"]["email"] = $queryResult->getEmail();
                        $result["info"]["phone"] = $queryResult->getPhone();
                        $result["info"]["mobile"] = $queryResult->getMobile();

                        $result["info"]["address"] = $queryResult->getAddress();
                        $result["info"]["city"] = $queryResult->getCity();
                        $result["info"]["province"] = $queryResult->getProvince();
                        $result["info"]["country"] = $queryResult->getCountry();
                        $result["info"]["postal_code"] = $queryResult->getPostalCode();

                        $result["info"]["fb_id"] = $queryResult->getFaceBookId();
                        $result["info"]["twitter_id"] = $queryResult->getTwitterId();

                        $result["info"]["reward_msg"] = $queryResult->getRewardMsg();
                        $result["info"]["success_msg"] = $queryResult->getSuccessMsg();
                        $result["info"]["note"] = $queryResult->getNote();

                        // Load the merchant status type definition
                        for ($count = 0; $count < count(CommonDefinition::BUSINESS_STATUS_DEF); $count ++) {
                            $result["info"]["merchant_status_def"][$count] = CommonDefinition::BUSINESS_STATUS_DEF[$count];
                        }

                        // Load the province defition
                        for ($count = 0; $count < count(CommonDefinition::PROVINCE_NAME); $count ++) {
                            $result["info"]["province_def"][$count] = CommonDefinition::PROVINCE_NAME[$count];
                        }

                        // Load the Country defition
                        for ($count = 0; $count < count(CommonDefinition::COUNTRY_NAME); $count ++) {
                            $result["info"]["country_def"][$count] = CommonDefinition::COUNTRY_NAME[$count];
                        }

                        // Delete the bounded table about scan event and user register
                        $tblName = $sysUtil->getTagScanEventTblName($merchantId);
                        $mModel->deleteTable($tblName);

                        $tblName = $sysUtil->getTagUserRegistTblName($merchantId);
                        $mModel->deleteTable($tblName);

                        $mModel->close();
                        return ($result);
                    } else {
                        $result["status"] = CommonDefinition::ERROR;
                        $result["info"] = "No more record";
                    }
                }
            }
        }

        $mModel->close();
        return ($result);
    }

    // =================================================================
    // Name : merchantAccountInfoUpdate
    // Input : $recvData -- received data from json
    // Output: merchant account update info for the specific one
    //
    // Description: update the specific merchanrt account info
    // ================================================================
    public function merchantAccountInfoUpdate($recv_data)
    {
        $result = array();
        $result["status"] = CommonDefinition::ERROR;

        $sysUtil = new SysUtility();

        $mSet = new BusinessInfoSet(null, $recv_data->email, $recv_data->phone, $recv_data->merchant_name);

        // Convert the options name to index

        $mSet->setCurrentAcnt($recv_data->current_merchant);
        $mSet->setTotalAcnt($recv_data->total_merchant);
        $mSet->setBusinessId($recv_data->merchant_id);
        $mSet->setFirstName($recv_data->first_name);
        $mSet->setLastName($recv_data->last_name);
        $mSet->setBusinessStatus($sysUtil->getBusinessStatusIndex($recv_data->merchant_status) + 1);
        $mSet->setWebPage($recv_data->web_page);
        $mSet->setMobile($recv_data->mobile);
        $mSet->setWebPage($recv_data->web_page);

        $mSet->setAddress($recv_data->address);
        $mSet->setCity($recv_data->city);

        $mSet->setProvince($sysUtil->getProvinceIndex($recv_data->province) + 1);
        $mSet->setCountry($sysUtil->getCountryIndex($recv_data->country) + 1);

        $mSet->setPostalCode($recv_data->postal_code);
        $mSet->setFaceBookId($recv_data->fb_id);

        $mSet->setTwitterId($recv_data->twitter_id);
        $mSet->setRewardMsg($recv_data->reward_msg);

        $mSet->setSuccessMsg($recv_data->success_msg);
        $mSet->setNote($recv_data->note);

        $result = $sysUtil->validateBusinessInfoSet($mSet);
        if ($result["status"] != CommonDefinition::SUCCESS) {
            return ($result);
        }

        $mModel = new MerchantModel(SysDefinition::USER_DB_CONFIG);

        $db_conn = $mModel->connect();
        if (! $db_conn) {
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result); // Connect to DB failed return without further handling
        }

        $tblName = $mModel->getMerchantAccountTableNameById($mSet->getBusinessId());
        if (null == $tblName) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Not a valid merchant ID to update!";
            $mModel->close();
            return ($result);
        }

        $mModel->setTableName($tblName);

        $bnCurrent = $mModel->getMerchantAcntInfoById($mSet->getBusinessId());

        if (! $bnCurrent->getStatus()) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Not a valid merchant ID to update!";
            $mModel->close();
            return ($result);
        }

        // Compare the element, only move on to process update if any element is changed
        if (CommonDefinition::SAME_RESULT == $sysUtil->compareBusinessInfoSet($mSet, $bnCurrent)) {
            $result["status"] = CommonDefinition::SUCCESS;
            $result["info"] = "Success to update this account!";
            $mModel->close();
            return ($result);
        }

        // check email duplication
        if (CommonDefinition::SAME_RESULT != strcmp($mSet->getEmail(), $bnCurrent->getEmail())) {
            // check duplication due to email is changed
            if ($mModel->checkEmailDuplicationInAllTables($mSet->getEmail())) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, This email is already in use!";

                $mModel->close();
                return ($result);
            }
        }

        // check phone duplication
        if (CommonDefinition::SAME_RESULT != strcmp($mSet->getPhone(), $bnCurrent->getPhone())) {
            if ($mModel->checkPhoneDuplicationInAllTables($mSet->getPhone())) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, This phone number is already in use!";
                $mModel->close();
                return ($result);
            }
        }

        if (CommonDefinition::SAME_RESULT != strcmp($mSet->getMobile(), $bnCurrent->getMobile())) {
            // check mobile duplication
            if ($mModel->checkPhoneDuplicationInAllTables($mSet->getMobile())) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, This phone number is already in use!";
                $mModel->close();
                return ($result);
            }
        }

        if ($mModel->updateMerchantAccount($mSet)) {
            $result["status"] = CommonDefinition::SUCCESS;
            $result["info"] = "Success to update this account!";
        } else {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error! Failed to update this account";
        }

        $mModel->close();
        return ($result);
    }

    // =================================================================
    // Name : getMerchantAcntReport
    // Input : None
    // Output: merchant account report
    //
    // Description: get merchant account report
    // ================================================================
    public function getMerchantAcntReport()
    {
        $result = array();
        $sysUtil = new SysUtility();

        $mModel = new MerchantModel(SysDefinition::USER_DB_CONFIG);
        $db_conn = $mModel->connect();

        if (! $db_conn) {
            // Connect to DB failed return without further handling
            $result["acnt_report_total"] = CommonDefinition::ZERO_NUM;
            $result["acnt_report_initial"] = CommonDefinition::ZERO_NUM;
            $result["acnt_report_enable"] = CommonDefinition::ZERO_NUM;
            $result["acnt_report_disable"] = CommonDefinition::ZERO_NUM;

            return ($result);
        }

        $acntResult = $mModel->getMerchantAcntReport();

        $result["acnt_report_total"] = $acntResult["total"];
        $result["acnt_report_initial"] = $acntResult["initial"];
        $result["acnt_report_enable"] = $acntResult["enable"];
        $result["acnt_report_disable"] = $acntResult["disable"];

        $mModel->close();
        return ($result);
    }
}
