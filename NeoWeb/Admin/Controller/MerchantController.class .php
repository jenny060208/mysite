<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Service\MerchantAccountService;

class MerchantController extends Controller
{

    // ==========================================================
    // Name : merchant_account_create
    // Input : N/A
    // Output: N/A
    // Description: create merchant account
    // ==========================================================
    public function merchant_account_create()
    {
        header("Content-type: application/json; charset = utf-8");
        $jsonMsg = json_decode(file_get_contents('php://input'));

        echo ("debug 223");

        // $mService = new MerchantAccountService();
        // $result = $mService->createMerchantAccount($jsonMsg);

        // $this->ajaxReturn($result);
        exit();
    }
}