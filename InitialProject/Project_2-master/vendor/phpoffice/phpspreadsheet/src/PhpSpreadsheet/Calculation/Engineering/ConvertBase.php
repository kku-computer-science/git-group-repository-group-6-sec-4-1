<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Engineering;

use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main

abstract class ConvertBase
{
    use ArrayEnabled;

<<<<<<< HEAD
=======
    /** @param mixed $value */
>>>>>>> main
    protected static function validateValue($value): string
    {
        if (is_bool($value)) {
            if (Functions::getCompatibilityMode() !== Functions::COMPATIBILITY_OPENOFFICE) {
<<<<<<< HEAD
                throw new Exception(Functions::VALUE());
=======
                throw new Exception(ExcelError::VALUE());
>>>>>>> main
            }
            $value = (int) $value;
        }

        if (is_numeric($value)) {
            if (Functions::getCompatibilityMode() == Functions::COMPATIBILITY_GNUMERIC) {
                $value = floor((float) $value);
            }
        }

        return strtoupper((string) $value);
    }

<<<<<<< HEAD
=======
    /** @param mixed $places */
>>>>>>> main
    protected static function validatePlaces($places = null): ?int
    {
        if ($places === null) {
            return $places;
        }

        if (is_numeric($places)) {
            if ($places < 0 || $places > 10) {
<<<<<<< HEAD
                throw new Exception(Functions::NAN());
=======
                throw new Exception(ExcelError::NAN());
>>>>>>> main
            }

            return (int) $places;
        }

<<<<<<< HEAD
        throw new Exception(Functions::VALUE());
=======
        throw new Exception(ExcelError::VALUE());
>>>>>>> main
    }

    /**
     * Formats a number base string value with leading zeroes.
     *
     * @param string $value The "number" to pad
     * @param ?int $places The length that we want to pad this value
     *
     * @return string The padded "number"
     */
    protected static function nbrConversionFormat(string $value, ?int $places): string
    {
        if ($places !== null) {
            if (strlen($value) <= $places) {
                return substr(str_pad($value, $places, '0', STR_PAD_LEFT), -10);
            }

<<<<<<< HEAD
            return Functions::NAN();
=======
            return ExcelError::NAN();
>>>>>>> main
        }

        return substr($value, -10);
    }
}
