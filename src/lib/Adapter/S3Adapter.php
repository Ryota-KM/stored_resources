<?php
namespace App\Adapter;

use \InvalidArgumentException;
use Aws\Exception\UnresolvedApiException;
use Aws\S3\S3ClientInterface;
use Aws\S3\S3Client;

class S3Adapter extends S3Client implements S3ClientInterface
{
    private static $S3Client;

    public static function getS3Client(array $s3Options)
    {
        if (!isset(self::$S3Client)) {
            try {
                $instance =  new parent($s3Options);
            } catch (InvalidArgumentException $e) {
            } catch (UnresolvedApiException $e) {
            } finally {
                if (isset($e)) {
                    die('system error occurred.<br/>'.$e->getMessage().'<br/>please confirm "S3ClientSetting"');
                }
            }
            self::$S3Client = $instance;
        }

        return self::$S3Client;
    }
}
