<?php
use Common\Stream;

trait TokenChecker
{
    /**
    * lookup TokenList and check if there is a token in it
    * @param  string  $contents
    * @param  string  $token
    * @return boolean
    */
    protected function lookupToken($contents, $token)
    {
        if (strpos($contents, $token) === false) {
            return false;
        }
        return true;
    }

    protected function getTokenList($tokenfpath)
    {
        $stream = new Stream($tokenfpath);
        $contents = $stream->fread($stream->getSize());
        return $contents;
    }
}