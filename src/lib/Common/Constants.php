<?php

namespace App\Common;

class Constants
{
    /* AccountData FilePath
    ------------------------------------------*/
    // Resisted Accountlist
    public const UD_FILE = UD_FILE;

    // Resisted Tokenlist
    public const TL_FILE = TL_FILE;

    /* Meta
    ------------------------------------------*/
    public const HTML_EXTENSION = ".html";

    /* TOKEN String length
    ------------------------------------------*/
    // MIN
    public const TOKEN_MIN_LENGTH = 25;

    // MAX
    public const TOKEN_MAX_LENGTH = 32;

    /* Application Status Check
    ------------------------------------------*/
    // SESSION key for status
    public const STATUS = STATUS;

    // Application available
    public const OK = 1;

    // Application not available
    public const NG = 0;

    /* S3 Transfer Acceleration Switch
    ------------------------------------------*/
    // ON or OFF
    public const ACLR_SETTING = ACLR_SETTING;

    /* Operation
    ------------------------------------------*/
    // read line limit
    public const MAX_READ_LINE = MAX_READ_LINE;

    // "s3://"
    public const S3_PROTOCOL = S3_PROTOCOL;

    /* File Upload
    ------------------------------------------*/
    // Minimum number of size in uploaded file
    public const MIN_FILE_SIZE = 0;

    // Maximum number of characters in uploaded file
    public const MAX_FNAME_LENGTH = MAX_FNAME_LENGTH;

    // Name of file to be excluded
    public const EXCLUDED_PATTERN = '/^[A-Za-z0-9_\-.()?!&\[\]]*$/';

    // Exact match pattern of username
    public const PATTERN_OF_USERNAME = '/^[a-zA-Z0-9_\-.]{3,15}$/';

    // Exact match pattern of password
    public const PATTERN_OF_PASSWORD = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,32}$/';
}
