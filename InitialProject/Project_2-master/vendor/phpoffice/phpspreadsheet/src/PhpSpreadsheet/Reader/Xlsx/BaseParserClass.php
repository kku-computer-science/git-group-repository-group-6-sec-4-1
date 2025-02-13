<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class BaseParserClass
{
<<<<<<< HEAD
    protected static function boolean($value)
    {
        if (is_object($value)) {
            $value = (string) $value;
=======
    /**
     * @param mixed $value
     */
    protected static function boolean($value): bool
    {
        if (is_object($value)) {
            $value = (string) $value; // @phpstan-ignore-line
>>>>>>> main
        }

        if (is_numeric($value)) {
            return (bool) $value;
        }

<<<<<<< HEAD
        return $value === strtolower('true');
=======
        return $value === 'true' || $value === 'TRUE';
>>>>>>> main
    }
}
