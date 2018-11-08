<?php

/**
 * Oss 文件操作类
 */

namespace Aliyun\Oss\Repository;

use Aliyun\Oss\Core\OssException;
use Aliyun\Oss\OssClient;

class File
{

    /**
     * 上传文件
     * @param string $source_filename  上传的源文件名称( fullpath )
     * @param string $target_filename  上传文件的保存名称 ( fullpath )
     * @param string $bucket           保存的 oss bucket 名称
     * @return null
     */
    public static function upload( string $source_filename, string $target_filename, string $bucket = Config::BUCKET )
    {
        $ossClient      = Factory::getOssClient();
        try{
            $result         = $ossClient -> uploadFile( $bucket, 'dir/' . $target_filename, $source_filename );
        }
        catch ( OssException $e ) {
            return [ 'err_msg' => $e -> getMessage() ];
        }
        return $result;
    }

    /**
     * 下载文件
     * @param string $source_filename 下载的源文件地址( fullpath )
     * @param string $target_filename 保存的文件名( fullpath )
     * @param string $bucket 下载文件位于的 oss bucket 名称
     * @return string | array
     */
    public static function download( string $source_filename, string $target_filename, string $bucket = Config::BUCKET )
    {
        $option     = [
            OssClient::OSS_FILE_DOWNLOAD => $target_filename
        ];

        $ossClient  = Factory::getOssClient();

        try{
            $result     = $ossClient -> getObject( $bucket, $source_filename, $option );
        }
        catch ( OssException $e ) {
            return [ 'err_msg' => $e -> getMessage() ];
        }

        return $result;
    }

    /**
     * 删除文件
     * @param string $filename  要删除的目标文件名( fullpath )
     * @param string $bucket    要删除的目标文件所在文件夹
     * @return null
     */
    public static function remove( string $filename, string $bucket = Config::BUCKET )
    {
        $ossClient = Factory::getOssClient();

        try {
            $result    = $ossClient -> deleteObject( $bucket, $filename );
        }
        catch ( OssException $e ) {
            return [ 'err_msg' => $e -> getMessage() ];
        }

        return $result;
    }

    /**
     * 判断文件是否存在
     * @param string $filename 要判断的文件名( fullpath )
     * @param string $bucket   判断的文件所在的 bucket 名称
     * @return bool | array
     */
    public static function exists( string $filename, string $bucket = Config::BUCKET )
    {
        $ossClient = Factory::getOssClient();

        try {
            $result    = $ossClient -> doesObjectExist( $bucket, $filename );
        }
        catch ( OssException $e ) {
            return [ 'err_msg' => $e -> getMessage() ];
        }

        return $result;
    }

}