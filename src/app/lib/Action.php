<?php
namespace Ajax;
use Ajax\Formatter;

class Action extends Formatter {

    public function __construct() {
        parent::__construct();
    }

    public function execute($actionType) {
        return $this->$actionType();
    }

    public function change() {
        $path = parent::getCurrentDirName();
        if (!empty($path)) {
            Formatter::prependDS($path);
            parent::setCurrentDirName($path);
        }
        $s3Path = parent::getS3pathName();
        if (is_dir($s3Path)) {
            $response = array();
            $nextItemLists = scandir($s3Path);
            $nextItemLists = array_values($nextItemLists);
            $response = json_encode($nextItemLists);
            echo $response;
        } else {
            $response = '';
            $file = fopen($s3Path, 'r', true);
            foreach (parent::getLines($file) as $line) {
                $response .= $line;
            }
            fclose($file);
            echo htmlspecialchars($response);
        }
    }

    public function remove() {
        $s3 = parent::getS3Object();
        $results = $s3->listObjects([
            'Bucket' => self::_bucketName,
            'Prefix' => parent::getPathName()
        ]);
        foreach ($results['Contents'] as $result) {
            $s3->deleteObject([
                'Bucket' => self::_bucketName,
                'Key' => $result['Key']
            ]);
        }
    }

    public function makedir() {
        $s3 = parent::getS3Object();

        $key = (empty(parent::getCurrentDirName()))? parent::getTargetName():parent::getPathName();
        // 最後に/付けないとファイルになる
        $pathName = parent::appendDS($key);
        // streamWrapperではBucketは作れる(mkdir()で)がDirectoryは作れない
        // mkdir(S3_PROTOCOL.$currentDirName.$newDirName);
        $s3->putObject([
            'Bucket' => self::_bucketName,
            'Key'    => $pathName,
        ]);
    }

    public function upload() {
        $s3 = parent::getS3Object();
        $dirName = parent::appendDS(parent::getCurrentDirName());
        $pathName = $dirName.parent::getFileName();
        try {
            $s3->putObject(array(
                'Bucket' => self::_bucketName,
                'Key'    => $pathName,
                'Body'   => fopen(parent::getTmpFileName(), 'r')
            ));
        } catch (S3Exception $e) {
            echo $e->getMessage();
        }
        echo parent::getFileName();
    }
}