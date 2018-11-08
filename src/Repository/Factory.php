<?php
/**
 * Created by PhpStorm.
 * User: otorain
 * Date: 18-10-31
 * Time: 上午10:40
 */

namespace Aliyun\Oss\Repository;

use Aliyun\Oss\OssClient;

class Factory
{
    /**
     * 获取 OSS 客户端实例
     */
    public static function getOssClient()
    {
        $appId          = Config::APP_ID;
        $appKey         = Config::APP_KEY;
        $endpoint       = Config::ENDPOINT;

        return new OssClient( $appId, $appKey, $endpoint, false );
    }
}