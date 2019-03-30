<?php
namespace S3;

class Formatter extends Init
{
    protected $request;
    public const _S3Protcol = S3_PROTOCOL;

    public function __construct($request)
    {
        $this->request = $request;
    }

    protected function getPathName()
    {
        $pathName = $this->request->getDirname().'/'.$this->request->getName();
        return $pathName;
    }

    protected function getS3PathName()
    {
        $pathName = $this->getPathName();
        return self::_S3Protcol.self::$bucketname.$pathName;
    }

    protected function prependDS($str)
    {
        $str = substr_replace($str, '/', 0, 0);
        return $str;
    }

    protected function appendDS($str)
    {
        $len = strlen($str);
        $str = substr_replace($str, '/', $len, 0);
        return $str;
    }

    protected function isRootDir()
    {
        if (empty($this->request->getDirname())) {
            return true;
        }
    }

    protected function getOpenFileOnlyRead($path)
    {
        if (file_exists($path)) {
            $file = fopen($path, 'r', true);
            return $file;
        } else {
            parent::getDisOpenFileException();
        }
    }

    private function _getLines($fName)
    {
        while (($line = fgets($fName)) !== false) {
            yield $line;
        }
    }

    protected function getLines($fName)
    {
        $response = '';
        $lineCnt = 0;
        try {
            foreach ($this->_getLines($fName) as $line) {
                if (parent::isTolerableLineCount($lineCnt)) {
                    $response .= $line;
                    $lineCnt++;
                }
            }
            return htmlspecialchars($response);
        } finally {
            fclose($fName);
        }
    }

    public static function getFiles($fileName)
    {
        $file = $_FILES[$fileName];
        if (parent::isValidFile($file)) {
            return $file;
        }
    }
}
