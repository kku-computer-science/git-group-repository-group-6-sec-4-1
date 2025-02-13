<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\MathTrig;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main

class Helpers
{
    /**
     * Many functions accept null/false/true argument treated as 0/0/1.
     *
     * @return float|string quotient or DIV0 if denominator is too small
     */
    public static function verySmallDenominator(float $numerator, float $denominator)
    {
<<<<<<< HEAD
        return (abs($denominator) < 1.0E-12) ? Functions::DIV0() : ($numerator / $denominator);
=======
        return (abs($denominator) < 1.0E-12) ? ExcelError::DIV0() : ($numerator / $denominator);
>>>>>>> main
    }

    /**
     * Many functions accept null/false/true argument treated as 0/0/1.
     *
     * @param mixed $number
     *
     * @return float|int
     */
    public static function validateNumericNullBool($number)
    {
        $number = Functions::flattenSingleValue($number);
        if ($number === null) {
            return 0;
        }
        if (is_bool($number)) {
            return (int) $number;
        }
        if (is_numeric($number)) {
            return 0 + $number;
        }

<<<<<<< HEAD
        throw new Exception(Functions::VALUE());
=======
        throw new Exception(ExcelError::throwError($number));
>>>>>>> main
    }

    /**
     * Validate numeric, but allow substitute for null.
     *
     * @param mixed $number
     * @param null|float|int $substitute
     *
     * @return float|int
     */
    public static function validateNumericNullSubstitution($number, $substitute)
    {
        $number = Functions::flattenSingleValue($number);
        if ($number === null && $substitute !== null) {
            return $substitute;
        }
        if (is_numeric($number)) {
            return 0 + $number;
        }

<<<<<<< HEAD
        throw new Exception(Functions::VALUE());
=======
        throw new Exception(ExcelError::throwError($number));
>>>>>>> main
    }

    /**
     * Confirm number >= 0.
     *
     * @param float|int $number
     */
    public static function validateNotNegative($number, ?string $except = null): void
    {
        if ($number >= 0) {
            return;
        }

<<<<<<< HEAD
        throw new Exception($except ?? Functions::NAN());
=======
        throw new Exception($except ?? ExcelError::NAN());
>>>>>>> main
    }

    /**
     * Confirm number > 0.
     *
     * @param float|int $number
     */
    public static function validatePositive($number, ?string $except = null): void
    {
        if ($number > 0) {
            return;
        }

<<<<<<< HEAD
        throw new Exception($except ?? Functions::NAN());
=======
        throw new Exception($except ?? ExcelError::NAN());
>>>>>>> main
    }

    /**
     * Confirm number != 0.
     *
     * @param float|int $number
     */
    public static function validateNotZero($number): void
    {
        if ($number) {
            return;
        }

<<<<<<< HEAD
        throw new Exception(Functions::DIV0());
=======
        throw new Exception(ExcelError::DIV0());
>>>>>>> main
    }

    public static function returnSign(float $number): int
    {
        return $number ? (($number > 0) ? 1 : -1) : 0;
    }

    public static function getEven(float $number): float
    {
        $significance = 2 * self::returnSign($number);

        return $significance ? (ceil($number / $significance) * $significance) : 0;
    }

    /**
     * Return NAN or value depending on argument.
     *
     * @param float $result Number
     *
     * @return float|string
     */
    public static function numberOrNan($result)
    {
<<<<<<< HEAD
        return is_nan($result) ? Functions::NAN() : $result;
=======
        return is_nan($result) ? ExcelError::NAN() : $result;
>>>>>>> main
    }
}
