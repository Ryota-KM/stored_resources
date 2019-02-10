<?php
namespace Account;
use \Exception;

class Filter {

    var $SESSION_KEY = '';
    var $USER_DATA_FILE_PATH = '';
    var $TOKEN_LIST_FILE_PASS = '';

    public function __construct($credentialOptions) {
        if ($this->isActivateOptions($credentialOptions, $this)) {
            foreach ($credentialOptions as $propaty => $param) {
                $this->$propaty = $param;
            }
        }
    }

    private function isActivateOptions($credentialOptions, $class) {
        $isActivate = true;
        $classOptions = array_keys(get_class_vars(get_class($class)));
        foreach ($classOptions as $classOption) {
            if (!array_key_exists($classOption, $credentialOptions)) $isActivate = false;
        }
        if (!$isActivate) throw new Exception("system error occurred \none of the credentialoptions is not set");
        else return true;
    }

    protected function isWriteAndReadable(...$files) {
        $isFail = false;
        foreach ($files as $file) {
            if (!is_readable($file)) {
                throw new Exception("system error occurred \npassword file is unreadable");
                $isFail = true;
            }
            if (!is_writable($file)) {
                throw new Exception("system error occurred \npassword file is write disabled");
                $isFail = true;
            }
        }
        if (!$isFail) return true;
    }

    /* Fetch TokenList and check if there is a token in it  */
    public static function isResisted($list, $str, $isPath = true) {
        if ($isPath) {
            if (!is_readable($list)) throw new Exception("system error occurred \nfile is unreadable");
            $list = file_get_contents($list);
        }
        if (strpos($list, $str) === false) return false;
        else return true;
    }

    /* Validate login permission */
    public static function isAllowAutoLogin($tokenListPath, $SESToken) {
        if (empty($SESToken)) return false;
        if (self::isResisted($tokenListPath, $SESToken)) return true;
        else return false;
    }

}