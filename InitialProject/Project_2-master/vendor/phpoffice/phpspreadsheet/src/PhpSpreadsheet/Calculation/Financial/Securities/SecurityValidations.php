<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\FinancialValidations;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main

class SecurityValidations extends FinancialValidations
{
    /**
     * @param mixed $issue
     */
    public static function validateIssueDate($issue): float
    {
        return self::validateDate($issue);
    }

    /**
     * @param mixed $settlement
     * @param mixed $maturity
     */
    public static function validateSecurityPeriod($settlement, $maturity): void
    {
        if ($settlement >= $maturity) {
<<<<<<< HEAD
            throw new Exception(Functions::NAN());
=======
            throw new Exception(ExcelError::NAN());
>>>>>>> main
        }
    }

    /**
     * @param mixed $redemption
     */
    public static function validateRedemption($redemption): float
    {
        $redemption = self::validateFloat($redemption);
        if ($redemption <= 0.0) {
<<<<<<< HEAD
            throw new Exception(Functions::NAN());
=======
            throw new Exception(ExcelError::NAN());
>>>>>>> main
        }

        return $redemption;
    }
}
