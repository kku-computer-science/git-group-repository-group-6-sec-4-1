<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Financial\CashFlow;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Constants as FinancialConstants;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\FinancialValidations;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main

class CashFlowValidations extends FinancialValidations
{
    /**
     * @param mixed $rate
     */
    public static function validateRate($rate): float
    {
        $rate = self::validateFloat($rate);

        return $rate;
    }

    /**
     * @param mixed $type
     */
    public static function validatePeriodType($type): int
    {
        $rate = self::validateInt($type);
        if (
            $type !== FinancialConstants::PAYMENT_END_OF_PERIOD &&
            $type !== FinancialConstants::PAYMENT_BEGINNING_OF_PERIOD
        ) {
<<<<<<< HEAD
            throw new Exception(Functions::NAN());
=======
            throw new Exception(ExcelError::NAN());
>>>>>>> main
        }

        return $rate;
    }

    /**
     * @param mixed $presentValue
     */
    public static function validatePresentValue($presentValue): float
    {
        return self::validateFloat($presentValue);
    }

    /**
     * @param mixed $futureValue
     */
    public static function validateFutureValue($futureValue): float
    {
        return self::validateFloat($futureValue);
    }
}
