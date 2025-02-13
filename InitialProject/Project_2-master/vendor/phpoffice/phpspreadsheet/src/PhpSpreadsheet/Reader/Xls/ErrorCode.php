<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls;

class ErrorCode
{
<<<<<<< HEAD
    protected static $map = [
=======
    private const ERROR_CODE_MAP = [
>>>>>>> main
        0x00 => '#NULL!',
        0x07 => '#DIV/0!',
        0x0F => '#VALUE!',
        0x17 => '#REF!',
        0x1D => '#NAME?',
        0x24 => '#NUM!',
        0x2A => '#N/A',
    ];

    /**
     * Map error code, e.g. '#N/A'.
     *
     * @param int $code
     *
     * @return bool|string
     */
    public static function lookup($code)
    {
<<<<<<< HEAD
        if (isset(self::$map[$code])) {
            return self::$map[$code];
        }

        return false;
=======
        return self::ERROR_CODE_MAP[$code] ?? false;
>>>>>>> main
    }
}
