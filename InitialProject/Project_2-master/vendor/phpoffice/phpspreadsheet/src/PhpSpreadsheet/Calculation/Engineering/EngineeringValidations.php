<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Engineering;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main

class EngineeringValidations
{
    /**
     * @param mixed $value
     */
    public static function validateFloat($value): float
    {
        if (!is_numeric($value)) {
<<<<<<< HEAD
            throw new Exception(Functions::VALUE());
=======
            throw new Exception(ExcelError::VALUE());
>>>>>>> main
        }

        return (float) $value;
    }

    /**
     * @param mixed $value
     */
    public static function validateInt($value): int
    {
        if (!is_numeric($value)) {
<<<<<<< HEAD
            throw new Exception(Functions::VALUE());
=======
            throw new Exception(ExcelError::VALUE());
>>>>>>> main
        }

        return (int) floor((float) $value);
    }
}
