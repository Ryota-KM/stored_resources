<?php
namespace S3;
use S3\RequestDTO;


class Formatter extends \Validator {

    protected $RequestDTO;
    protected $s3Object;
    protected $bucketName;

    const _S3Protcol = S3_PROTOCOL;

    public function __construct($myBucketName, $s3Object, $RequestDTO) {
        $this->bucketName = $myBucketName;
        $this->s3Object = $s3Object;
        $this->RequestDTO = $RequestDTO;
    }

    protected function formattedPathName() {
        $pathName = $this->RequestDTO->getCurrentDirName().'/'.$this->RequestDTO->getTargetName();
        return $pathName;
    }

    protected function formattedS3pathName() {
        $pathName = $this->formattedPathName();
        return self::_S3Protcol.$this->bucketName.$pathName;
    }

    protected function prependDS($str) {
        $str = substr_replace($str, '/', 0, 0);
        return $str;
    }

    protected function appendDS($str) {
        $len = strlen($str);
        $str = substr_replace($str, '/', $len, 0);
        return $str;
    }

    protected function isRootDirectory() {
        if (empty($this->RequestDTO->getCurrentDirName())){
            return true;
        }
    }

    public static function getFiles($fileName) {
        $file = $_FILES[$fileName];
        if (\Validator::isValidFile($file)) return $file;
        else throw new \Exception('ERROR. uploaded files can not be accepted');
    }

}