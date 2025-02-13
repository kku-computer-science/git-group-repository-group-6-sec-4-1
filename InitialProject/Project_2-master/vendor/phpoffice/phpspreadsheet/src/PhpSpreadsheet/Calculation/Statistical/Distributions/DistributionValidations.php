<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

use PhpOffice\PhpSpreadsheet\Calculation\Exception;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\StatisticalValidations;

class DistributionValidations extends StatisticalValidations
{
    /**
     * @param mixed $probability
     */
    public static function validateProbability($probability): float
    {
        $probability = self::validateFloat($probability);

        if ($probability < 0.0 || $probability > 1.0) {
<<<<<<< HEAD
            throw new Exception(Functions::NAN());
=======
            throw new Exception(ExcelError::NAN());
>>>>>>> main
        }

        return $probability;
    }
}
