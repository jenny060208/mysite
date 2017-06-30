<?php

// +----------------------------------------------------------------------
// | Service for Tag management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Service;

use Admin\Logic\TagCreateLogic;
use Admin\Logic\TagUpdateLogic;
use Admin\Logic\TagLoadLogic;
use NeoWeb\Common\Common\CommonDefinition;

/**
 * Name : MerchantAccountService
 * Input : N/A
 * Output: N/A
 * Description: Service for all Merchant account management:
 */
class TagInfoService extends Service
{

    /**
     * Name : createTag
     * Access: public
     * Input : Array to host tag create information
     * Output: array -- tag create process result
     *
     * Description:tag create process in detail
     */
    public function createTag($recv_data)
    {
        $mLogic = new TagCreateLogic();
        $result = $mLogic->tagCreate($recv_data);

        return ($result);
    }

    /**
     * Name : updateTag
     * Access: public
     * Input :json message to host tag info
     * Output: array -- tag info process process result
     *
     * Description: tag update process in detail
     */
    public function updateTag($recv_data)
    {
        $mLogic = new TagUpdateLogic();
        $result = $mLogic->tagUpdate($recv_data);

        return ($result);
    }

    /**
     * Name : deleteTag
     * Access: public
     * Input :json message to host tag info
     * Output: array -- tag info process process result
     *
     * Description: tag delete process in detail
     */
    public function deleteTag($recv_data)
    {
        $mLogic = new TagUpdateLogic();
        $result = $mLogic->tagDelete($recv_data);

        return ($result);
    }

    /**
     * Name : loadFirstTagInfo
     * Access: public
     * Input :None
     * Output: array -- get first tag info
     *
     * Description: get the first tag info
     */
    public function loadFirstTagInfo()
    {
        $mLogic = new TagLoadLogic();
        // get the first tag info
        $result = $mLogic->getTagInfo(1);

        return ($result);
    }

    /**
     * Name : loadPreviousTagInfo
     * Access: public
     * Input :$recv_data -- data from request
     * Output: array -- get the previous specific tag info
     *
     * Description: get the previous specific tag info
     */
    public function loadPreviousTagInfo($recv_data)
    {
        $mLogic = new TagLoadLogic();
        // get the previous specific tag info
        $result = $mLogic->getPreviousTagInfo($recv_data);

        return ($result);
    }

    /**
     * Name : loadNextTagInfo
     * Access: public
     * Input :$recv_data -- data from request
     * Output: array -- get the next specific tag info
     *
     * Description: get the next specific tag info
     */
    public function loadNextTagInfo($recv_data)
    {
        $mLogic = new TagLoadLogic();
        // get the next specific tag info
        $result = $mLogic->getNextTagInfo($recv_data);

        return ($result);
    }

    /**
     * Name : preLoadTagReport
     * Access: public
     * Input :None
     * Output: preload tag report
     *
     * Description: load tag report info
     */
    public function preLoadTagReport()
    {
        $mLogic = new TagLoadLogic();
        // get the next specific tag info
        $result = $mLogic->getTagReport();

        return ($result);
    }
}

