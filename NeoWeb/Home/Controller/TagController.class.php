<?php
namespace Home\Controller;

use Think\Controller;
use Home\Service\BusinessService;
use Home\Service\NeoService;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\NeoDefinition;

class TagController extends Controller
{

    public function tid($id = 0)
    {
        // echo ("6868 Hello Tag = " . $id);
        $s_neo = new NeoService();
        $result = $s_neo->tagScanProcess($id);

        if ($result->getStatus()) {
            // $webPage = $result->getWebPage();

            session_start();
            $_SESSION["tag_id"] = $result->getTagId();
            $_SESSION["merchant_id"] = $result->getBusinessId();

            $webPage = "Adt/register";

            // log the scan event
            $result = $s_neo->tagScanEventLog($result);

            // re-direct to register page

            $this->redirect($webPage);
        } else {

            echo ("Tag process failed!");

            echo ($result->getInfo());

            // Log the error scan event
            $result = $s_neo->tagScanErrorEventLog($result);

            // $webPage = $result->getWebPage();
            // $this->redirect($webPage);
        }

        exit();
    }
}