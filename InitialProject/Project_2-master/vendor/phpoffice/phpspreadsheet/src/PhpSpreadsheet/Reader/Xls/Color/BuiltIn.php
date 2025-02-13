<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls\Color;

class BuiltIn
{
<<<<<<< HEAD
    protected static $map = [
=======
    private const BUILTIN_COLOR_MAP = [
>>>>>>> main
        0x00 => '000000',
        0x01 => 'FFFFFF',
        0x02 => 'FF0000',
        0x03 => '00FF00',
        0x04 => '0000FF',
        0x05 => 'FFFF00',
        0x06 => 'FF00FF',
        0x07 => '00FFFF',
        0x40 => '000000', // system window text color
        0x41 => 'FFFFFF', // system window background color
    ];

    /**
     * Map built-in color to RGB value.
     *
     * @param int $color Indexed color
     *
     * @return array
     */
    public static function lookup($color)
    {
<<<<<<< HEAD
        if (isset(self::$map[$color])) {
            return ['rgb' => self::$map[$color]];
        }

        return ['rgb' => '000000'];
=======
        return ['rgb' => self::BUILTIN_COLOR_MAP[$color] ?? '000000'];
>>>>>>> main
    }
}
