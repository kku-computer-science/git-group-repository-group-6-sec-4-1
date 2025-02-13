<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\LookupRef;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ErrorValue;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main

class LookupRefValidations
{
    /**
     * @param mixed $value
     */
    public static function validateInt($value): int
    {
        if (!is_numeric($value)) {
<<<<<<< HEAD
            if (Functions::isError($value)) {
                throw new Exception($value);
            }

            throw new Exception(Functions::VALUE());
=======
            if (ErrorValue::isError($value)) {
                throw new Exception($value);
            }

            throw new Exception(ExcelError::VALUE());
>>>>>>> main
        }

        return (int) floor((float) $value);
    }

    /**
     * @param mixed $value
     */
    public static function validatePositiveInt($value, bool $allowZero = true): int
    {
        $value = self::validateInt($value);

        if (($allowZero === false && $value <= 0) || $value < 0) {
<<<<<<< HEAD
            throw new Exception(Functions::VALUE());
=======
            throw new Exception(ExcelError::VALUE());
>>>>>>> main
        }

        return $value;
    }
}
