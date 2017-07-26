<?php
namespace Home\Controller;

use Think\Controller;
use Home\Service\BusinessService;
use Home\Service\NeoService;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\NeoDefinition;

class AdtController extends Controller
{

    /**
     * Name : register
     * Input : $tid -- tag id
     * Output: N/A
     * Description: Load the information according to this tag id and show on
     */
    public function register()
    {
        if (isset($_SESSION["tag_id"])) {
            $tagId = $_SESSION["tag_id"];
            $merchantId = $_SESSION["merchant_id"];

            $service = new NeoService();
            $result = $service->loadUserRegisterInfo($tagId);

            if (false == $result->getStatus()) {
                echo ($result->getInfo());
            } else {
                // Load the business name and reward message

                $this->assign("merchant_name", $result->getWebPage());

                $this->assign("merchant_id", $result->getBusinessId());
                $this->assign("tag_id", $result->getTagId());
                $this->show();
            }
        }
    }

    /**
     * Name : register
     * Input : $tid -- tag id
     * Output: N/A
     * Description: Load the information according to this tag id and show on
     */
    public function register_process()
    {
        header("Content-type: application/json; charset = utf-8");
        $json_data = json_decode(file_get_contents('php://input'));

        $service = new NeoService();
        $result = $service->addTagUserRegisterInfo($json_data);

        $this->ajaxReturn($result);
    }

    /**
     * Name : register
     * Input : $tid -- tag id
     * Output: N/A
     * Description: Load the information according to this tag id and show on
     */
    public function register_success()
    {
        header("Content-type: application/json; charset = utf-8");
        $json_data = json_decode(file_get_contents('php://input'));

        $service = new NeoService();
        $result = $service->loadUserRegistSuccessInfo();

        // // if ($result["status"]) {
        // $this->assign("merchant_name", $result["merchant_name"]);
        $this->assign("merchant_name", $result["merchant_name"]);
        $this->assign("website", $result["website"]);

        $linkTemp = "http://" . $result["website"];
        $this->assign("website_link", $linkTemp);

        $this->assign("success_message", $result["success_message"]);

        // $this->assign("website", $result["website"]);
        // $this->assign("success_message", $result["success_message"]);
        // // } else {}

        $this->show();
    }
}