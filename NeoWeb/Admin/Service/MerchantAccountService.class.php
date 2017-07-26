<?php

// +----------------------------------------------------------------------
// | Service for Admin Business account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Service;

use Admin\Logic\MerchantAcntCreateLogic;
use Admin\Logic\MerchantAcntUpdateLogic;
use NeoWeb\Common\Common\CommonDefinition;

/**
 * Name : MerchantAccountService
 * Input : N/A
 * Output: N/A
 * Description: Service for all Merchant account management:
 */
class MerchantAccountService extends Service
{

    /**
     * Name : createMerchantAccount
     * Access: public
     * Input : Array to host email register information
     * Output: array -- merchant account create process result
     *
     * Description: merchant account create process in detail
     */
    public function createMerchantAccount($reg_data)
    {
        $mLogic = new MerchantAcntCreateLogic();
        $result = $mLogic->createMerchantAccount($reg_data);

        if ($result['status'] != CommonDefinition::SUCCESS) {
            // return due to create merchant account failed
            return ($result);
        }

        $midTemp = $result["mid"];

        // For the mid,
        // Create the tag scan event table
        // and user register table
        // Create the scan event table for this mid
        $result = $mLogic->createTagScanEventTbl($midTemp);

        if ($result['status'] != CommonDefinition::SUCCESS) {
            // return due to create scan event table failed
            return ($result);
        }

        // Create the user register table for this mid
        $result = $mLogic->createMidUserRegisterTbl($midTemp);
        if ($result['status'] != CommonDefinition::SUCCESS) {
            // return due to create user register table failed
            return ($result);
        }

        return ($result);
    }

    /**
     * Name : deleteMerchantAccount
     * Access: public
     * Input : data about the merchant ID
     * Output: array -- merchant account delete process result
     *
     * Description: merchant account delete process in detail
     */
    public function deleteMerchantAccount($recv_data)
    {
        $mLogic = new MerchantAcntUpdateLogic();
        $result = $mLogic->merchantAcntDelete($recv_data);

        return ($result);
    }

    // ==========================================================
    // Name : loadMerchantAccount
    // Access: public
    // Input : index of merchant account
    // Output: merchant account info
    // Description: load specific merchant account info
    // ==========================================================
    public function loadMerchantAccount($recv_data)
    {
        $mLogic = new MerchantAcntUpdateLogic();
        $result = $mLogic->loadMerchantAccountInfo($recv_data);

        return ($result);
    }

    // ==========================================================
    // Name : updateMerchantAccount
    // Access: public
    // Input : merchant account info
    // Output: update result
    // Description: update specific merchant account info
    // ==========================================================
    public function updateMerchantAccount($recv_data)
    {
        $mLogic = new MerchantAcntUpdateLogic();
        $result = $mLogic->merchantAccountInfoUpdate($recv_data);

        return ($result);
    }

    // ==========================================================
    // Name : preLoadMerchantAcntReport
    // Access: public
    // Input : None
    // Output: load merchant account report
    // Description: load merchant account report
    // ==========================================================
    public function preLoadMerchantAcntReport()
    {
        $mLogic = new MerchantAcntUpdateLogic();
        $result = $mLogic->getMerchantAcntReport();

        return ($result);
    }
}

