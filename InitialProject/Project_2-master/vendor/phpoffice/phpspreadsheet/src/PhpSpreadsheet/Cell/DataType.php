<?php

namespace PhpOffice\PhpSpreadsheet\Cell;

use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class DataType
{
    // Data types
    const TYPE_STRING2 = 'str';
    const TYPE_STRING = 's';
    const TYPE_FORMULA = 'f';
    const TYPE_NUMERIC = 'n';
    const TYPE_BOOL = 'b';
    const TYPE_NULL = 'null';
    const TYPE_INLINE = 'inlineStr';
    const TYPE_ERROR = 'e';
    const TYPE_ISO_DATE = 'd';

    /**
     * List of error codes.
     *
<<<<<<< HEAD
     * @var array
=======
     * @var array<string, int>
>>>>>>> main
     */
    private static $errorCodes = [
        '#NULL!' => 0,
        '#DIV/0!' => 1,
        '#VALUE!' => 2,
        '#REF!' => 3,
        '#NAME?' => 4,
        '#NUM!' => 5,
        '#N/A' => 6,
<<<<<<< HEAD
    ];

    /**
     * Get list of error codes.
     *
     * @return array
=======
        '#CALC!' => 7,
    ];

    public const MAX_STRING_LENGTH = 32767;

    /**
     * Get list of error codes.
     *
     * @return array<string, int>
>>>>>>> main
     */
    public static function getErrorCodes()
    {
        return self::$errorCodes;
    }

    /**
     * Check a string that it satisfies Excel requirements.
     *
     * @param null|RichText|string $textValue Value to sanitize to an Excel string
     *
<<<<<<< HEAD
     * @return null|RichText|string Sanitized value
=======
     * @return RichText|string Sanitized value
>>>>>>> main
     */
    public static function checkString($textValue)
    {
        if ($textValue instanceof RichText) {
            // TODO: Sanitize Rich-Text string (max. character count is 32,767)
            return $textValue;
        }

        // string must never be longer than 32,767 characters, truncate if necessary
<<<<<<< HEAD
        $textValue = StringHelper::substring($textValue, 0, 32767);
=======
        $textValue = StringHelper::substring((string) $textValue, 0, self::MAX_STRING_LENGTH);
>>>>>>> main

        // we require that newline is represented as "\n" in core, not as "\r\n" or "\r"
        $textValue = str_replace(["\r\n", "\r"], "\n", $textValue);

        return $textValue;
    }

    /**
     * Check a value that it is a valid error code.
     *
     * @param mixed $value Value to sanitize to an Excel error code
     *
     * @return string Sanitized value
     */
    public static function checkErrorCode($value)
    {
        $value = (string) $value;

        if (!isset(self::$errorCodes[$value])) {
            $value = '#NULL!';
        }

        return $value;
    }
}
