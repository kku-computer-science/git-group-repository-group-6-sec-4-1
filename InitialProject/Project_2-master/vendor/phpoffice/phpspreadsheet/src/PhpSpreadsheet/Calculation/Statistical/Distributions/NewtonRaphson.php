<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions;

use PhpOffice\PhpSpreadsheet\Calculation\Functions;
<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main

class NewtonRaphson
{
    private const MAX_ITERATIONS = 256;

<<<<<<< HEAD
=======
    /** @var callable */
>>>>>>> main
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

<<<<<<< HEAD
=======
    /** @return float|string */
>>>>>>> main
    public function execute(float $probability)
    {
        $xLo = 100;
        $xHi = 0;

        $dx = 1;
        $x = $xNew = 1;
        $i = 0;

        while ((abs($dx) > Functions::PRECISION) && ($i++ < self::MAX_ITERATIONS)) {
            // Apply Newton-Raphson step
            $result = call_user_func($this->callback, $x);
            $error = $result - $probability;

            if ($error == 0.0) {
                $dx = 0;
            } elseif ($error < 0.0) {
                $xLo = $x;
            } else {
                $xHi = $x;
            }

            // Avoid division by zero
            if ($result != 0.0) {
                $dx = $error / $result;
                $xNew = $x - $dx;
            }

            // If the NR fails to converge (which for example may be the
            // case if the initial guess is too rough) we apply a bisection
            // step to determine a more narrow interval around the root.
            if (($xNew < $xLo) || ($xNew > $xHi) || ($result == 0.0)) {
                $xNew = ($xLo + $xHi) / 2;
                $dx = $xNew - $x;
            }
            $x = $xNew;
        }

        if ($i == self::MAX_ITERATIONS) {
<<<<<<< HEAD
            return Functions::NA();
=======
            return ExcelError::NA();
>>>>>>> main
        }

        return $x;
    }
}
