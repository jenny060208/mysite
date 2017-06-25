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
use Admin\Model\InstallationModel;
use NeoWeb\Admin\Common\AdminDefinition;
use NeoWeb\Admin\Common\AdminUtilities;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;
use NeoWeb\Common\Common\AllTableInfoDefinition;

/**
 * Name : createAllTablesLogic
 * Input : N/A
 * Output: N/A
 * Description: model for all business account management:
 * Register/Login/Logout/Password recover, etc
 */
class createAllTablesLogic extends Logic
{

    /**
     * Name : createAllTables
     * Input : create All tables needed
     * Output: Success -- create all tables successfully
     * ERROR -- Create tables failed
     * Description: Process all table creation related logic
     */
    public function createAllTables()
    {
        // Create All admin related tables
        $result = $this->createAdminTables();

        if ($result["status"] != CommonDefinition::SUCCESS) {
            return ($result); // return due to create table failed
        }

        // Create Neo related tables
        $result = $this->createNeoTables();
        if ($result["status"] != CommonDefinition::SUCCESS) {
            return ($result); // return due to create table failed
        }

        // Create All merchant related tables
        $result = $this->createMerchantTables();

        if ($result["status"] != CommonDefinition::SUCCESS) {
            return ($result); // return due to create table failed
        }

        // Create All user related tables
        $result = $this->createUserTables();
        if ($result["status"] != CommonDefinition::SUCCESS) {
            return ($result); // return due to create table failed
        }

        $result["info"] = "SUCCESS! All tables are created!";

        return ($result);
    }

    /**
     * Name : createAdminTables
     * Input : create All Admin related tables needed
     * Output: Success -- create all tables successfully
     * ERROR -- Create tables failed
     * Description: Process all Admin table creation related logic
     */
    private function createAdminTables()
    {
        $result = array();
        $result["status"] = CommonDefinition::ERROR;
        $mModel = new InstallationModel(SysDefinition::USER_DB_CONFIG);

        $db_conn = $mModel->connect();

        if (! $db_conn) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Connect to DB failed";
            return ($result);
        }

        $sysUtil = new SysUtility();
        $adminUtil = new AdminUtilities();

        // create the merchant get more info talbe
        $tblName = $sysUtil->getNeoBusinessEnquiryTblName();

        if (! $mModel->createMerchantMoreInfoTbl($tblName)) {
            $result["info"] = "ERROR!!! Failed to create table: " . $tblName . "!";
            $mModel->close();
            return ($result);
        }

        // create the general in touch talbe
        $tblName = $sysUtil->getNeoInTouchTblName();

        if (! $mModel->createGeneralInTouchTbl($tblName)) {
            $result["info"] = "ERROR!!! Failed to create table: " . $tblName . "!";
            $mModel->close();
            return ($result);
        }

        // Create the merchant account dashboard 1 contact message table (dash board 1 -- temp account)
        $tblName = $sysUtil->getDb1ContactMsgTblName();

        if (! $mModel->createDashboard1AccountMsgTbl($tblName)) {
            // return due to create table fail
            $result["info"] = "ERROR!!! Failed to create table: " . $tblName . "!";
            $mModel->close();
            return ($result);
        }

        // Create the Administratore account table
        $tblName = $adminUtil->getAdminAccountInfoTblName();

        if (! $mModel->createAdminAccountTbl($tblName)) {
            // return due to create table fail
            $result["info"] = "ERROR!!! Failed to create table: " . $tblName . "!";
            $mModel->close();
            return ($result);
        }

        $mModel->close();

        $result["status"] = CommonDefinition::SUCCESS;
        $result["info"] = "SUCCESS!!! Create Admin table!";

        return ($result);
    }

    /**
     * Name : createNeoTables
     * Input : create All Neo company related tables needed
     * Output: Success -- create all tables successfully
     * ERROR -- Create tables failed
     * Description: Process all Merchants table creation related logic
     */
    private function createNeoTables()
    {
        $result = array();
        $result["status"] = CommonDefinition::ERROR;
        $mModel = new InstallationModel(SysDefinition::USER_DB_CONFIG);

        $db_conn = $mModel->connect();

        if (! $db_conn) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Connect to DB failed";
            return ($result);
        }

        $sysUtil = new SysUtility();

        // Create the merchant account dashboard 1 contact message table (dash board 1 -- temp account)
        $tblName = $sysUtil->getNeoProductInfoTblName();

        if (! $mModel->createNeoProductInfoTbl($tblName)) {
            // return due to create table fail
            $result["info"] = "ERROR!!! Failed to create table: " . $tblName . "!";
            $mModel->close();
            return ($result);
        }

        // Create the Tag info table
        $tblName = $sysUtil->getTagInfoTblName();
        if (! $mModel->createNeoTagInfoTbl($tblName)) {
            // return due to create table fail
            $result["info"] = "ERROR!!! Failed to create table: " . $tblName . "!";
            $mModel->close();
            return ($result);
        }

        // Create the Tag scan error event log table
        $tblName = $sysUtil->getTagScanErrorEventTblName();
        if (! $mModel->createTagScanErrorEventLogTbl($tblName)) {
            // return due to create table fail
            $result["info"] = "ERROR!!! Failed to create table: " . $tblName . "!";
            $mModel->close();
            return ($result);
        }

        $mModel->close();

        $result["status"] = CommonDefinition::SUCCESS;
        $result["info"] = "SUCCESS!!! Create All NEO tables!";

        return ($result);
    }

    /**
     * Name : createMerchantTables
     * Input : create All Merchants relarted tables needed
     * Output: Success -- create all tables successfully
     * ERROR -- Create tables failed
     * Description: Process all Merchants table creation related logic
     */
    private function createMerchantTables()
    {
        $result = array();
        $result["status"] = CommonDefinition::ERROR;
        $mModel = new InstallationModel(SysDefinition::USER_DB_CONFIG);

        $db_conn = $mModel->connect();

        if (! $db_conn) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Connect to DB failed";
            return ($result);
        }

        $sysUtil = new SysUtility();
        // Create the merchant account registration table (dash board 1 -- temp account)
        $tblName = $sysUtil->genDashboard1AcntTblName();

        if (! $mModel->createTempMerchantAccountTbl($tblName)) {
            // return due to create table fail
            $result["info"] = "ERROR!!! Failed to create table: " . $tblName . "!";
            $mModel->close();
            return ($result);
        }

        // Create all Merchant DB2 account table name
        // Note: account name starts with 3 characters area code
        $namePostFix = AllTableInfoDefinition::BN_TABLE_NAME_DASHBOARD_2_POSTFIX;
        // Create the merchant account dashboard 2 contact message table (dash board 2)
        for ($counter = 0; $counter < count(CommonDefinition::PROVINCE_INDEX_AREA_CODE); $counter ++) {
            $tempStr = CommonDefinition::PROVINCE_INDEX_AREA_CODE[$counter];

            // get the Business account DB2 table name
            $tempTblName = $tempStr . $namePostFix;

            if (! $mModel->createMerchantAccountTbl($tempTblName)) {
                // return due to create table fail
                $result["info"] = "ERROR!!! Failed to create table: " . $tempTblName . "!";
                $mModel->close();
                return ($result);
            }
        }

        // Create all Merchant DB2 account table name
        // Note: account name starts with 3 characters area code

        $mModel->close();

        $result["status"] = CommonDefinition::SUCCESS;
        $result["info"] = "SUCCESS!!! Create All NEO tables!";

        return ($result);
    }

    /**
     * Name : createUserTables
     * Input : create All user relarted tables needed
     * Output: Success -- create all tables successfully
     * ERROR -- Create tables failed
     * Description: Process all users table creation related logic
     */
    private function createUserTables()
    {
        $result = array();
        $result["status"] = CommonDefinition::SUCCESS;
        $result["info"] = "Scuues to create tables";

        return ($result);
    }
}
