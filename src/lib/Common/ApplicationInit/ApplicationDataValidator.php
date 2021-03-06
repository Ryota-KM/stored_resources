<?php
namespace App\Common\ApplicationInit;

use App\Common\Common;

class ApplicationDataValidator extends ApplicationDataException
{
    use BucketCheckerTrait;
    use TokenCheckerTrait;

    private static $udfile = Common::UD_FILE;
    private static $tlfile = Common::TL_FILE;

    /**
    * Assign parameter to SESSION[$key] when processing ends normally
    * Catch an Exception at the caller of this function
    * @param string $key $_SESSION['key']
    * @param boolean $sesInit Whether to initialize SESSION[$key]
    * @return void
    */
    public static function checkApplicationStatus($key, $sesInit = false)
    {
        if ($sesInit) {
            Common::initSession($key);
            $status = Common::NG;
        } else {
            $status = self::fetchApplicationStatus($key);
        }

        if ($status !== Common::OK) {
            $files = [self::$udfile, self::$tlfile];
            foreach ($files as $file) {
                self::validateFileLocation($file);
                self::validateFileReadable($file);
                self::validateFileWritable($file);
            }
            Common::setSession($key, Common::OK);
        }
    }

    private static function fetchApplicationStatus($key)
    {
        $status = Common::getSession($key);
        return $status;
    }

    private static function validateFileLocation($file)
    {
        if (!file_exists($file)) {
            parent::fileLocationException();
        }
    }

    private static function validateFileReadable($file)
    {
        if (!is_readable($file)) {
            parent::unreadableFileException();
        }
    }

    private static function validateFileWritable($file)
    {
        if (!is_writable($file)) {
            parent::unwritableFileException();
        }
    }
}
