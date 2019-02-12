<?php

class Constants {

    /**
    * TOKEN String length
    */
    // MIN
    public const TOKEN_MIN_LENGTH = 25;

    // MAX
    public const TOKEN_MAX_LENGTH = 32;

    /**
    * S3\Action/ Change
    */
    public const LIMIT_LINE = 5000;

    /**
    * S3\Action/ Upload
    */
    // Minimum number of size in uploaded file
    public const MIN_FILE_SIZE = 0;

    // Maximum number of characters in uploaded file
    public const MAX_LENGTH = 40;

    // Name of file to be excluded
    public const EXCLUDED_PATTERN = '/^[A-Za-z0-9_\-.()?!&\[\]]*$/';


}
