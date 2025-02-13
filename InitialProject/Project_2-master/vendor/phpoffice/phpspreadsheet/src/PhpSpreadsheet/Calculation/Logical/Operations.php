<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Logical;

use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main

class Operations
{
    use ArrayEnabled;

    /**
     * LOGICAL_AND.
     *
     * Returns boolean TRUE if all its arguments are TRUE; returns FALSE if one or more argument is FALSE.
     *
     * Excel Function:
     *        =AND(logical1[,logical2[, ...]])
     *
     *        The arguments must evaluate to logical values such as TRUE or FALSE, or the arguments must be arrays
     *            or references that contain logical values.
     *
     *        Boolean arguments are treated as True or False as appropriate
     *        Integer or floating point arguments are treated as True, except for 0 or 0.0 which are False
     *        If any argument value is a string, or a Null, the function returns a #VALUE! error, unless the string
     *            holds the value TRUE or FALSE, in which case it is evaluated as the corresponding boolean value
     *
     * @param mixed ...$args Data values
     *
     * @return bool|string the logical AND of the arguments
     */
    public static function logicalAnd(...$args)
    {
<<<<<<< HEAD
        $args = Functions::flattenArray($args);

        if (count($args) == 0) {
            return Functions::VALUE();
        }

        $args = array_filter($args, function ($value) {
            return $value !== null || (is_string($value) && trim($value) == '');
        });

        $returnValue = self::countTrueValues($args);
        if (is_string($returnValue)) {
            return $returnValue;
        }
        $argCount = count($args);

        return ($returnValue > 0) && ($returnValue == $argCount);
=======
        return self::countTrueValues($args, function (int $trueValueCount, int $count): bool {
            return $trueValueCount === $count;
        });
>>>>>>> main
    }

    /**
     * LOGICAL_OR.
     *
     * Returns boolean TRUE if any argument is TRUE; returns FALSE if all arguments are FALSE.
     *
     * Excel Function:
     *        =OR(logical1[,logical2[, ...]])
     *
     *        The arguments must evaluate to logical values such as TRUE or FALSE, or the arguments must be arrays
     *            or references that contain logical values.
     *
     *        Boolean arguments are treated as True or False as appropriate
     *        Integer or floating point arguments are treated as True, except for 0 or 0.0 which are False
     *        If any argument value is a string, or a Null, the function returns a #VALUE! error, unless the string
     *            holds the value TRUE or FALSE, in which case it is evaluated as the corresponding boolean value
     *
     * @param mixed $args Data values
     *
     * @return bool|string the logical OR of the arguments
     */
    public static function logicalOr(...$args)
    {
<<<<<<< HEAD
        $args = Functions::flattenArray($args);

        if (count($args) == 0) {
            return Functions::VALUE();
        }

        $args = array_filter($args, function ($value) {
            return $value !== null || (is_string($value) && trim($value) == '');
        });

        $returnValue = self::countTrueValues($args);
        if (is_string($returnValue)) {
            return $returnValue;
        }

        return $returnValue > 0;
=======
        return self::countTrueValues($args, function (int $trueValueCount): bool {
            return $trueValueCount > 0;
        });
>>>>>>> main
    }

    /**
     * LOGICAL_XOR.
     *
     * Returns the Exclusive Or logical operation for one or more supplied conditions.
     * i.e. the Xor function returns TRUE if an odd number of the supplied conditions evaluate to TRUE,
     *      and FALSE otherwise.
     *
     * Excel Function:
     *        =XOR(logical1[,logical2[, ...]])
     *
     *        The arguments must evaluate to logical values such as TRUE or FALSE, or the arguments must be arrays
     *            or references that contain logical values.
     *
     *        Boolean arguments are treated as True or False as appropriate
     *        Integer or floating point arguments are treated as True, except for 0 or 0.0 which are False
     *        If any argument value is a string, or a Null, the function returns a #VALUE! error, unless the string
     *            holds the value TRUE or FALSE, in which case it is evaluated as the corresponding boolean value
     *
     * @param mixed $args Data values
     *
     * @return bool|string the logical XOR of the arguments
     */
    public static function logicalXor(...$args)
    {
<<<<<<< HEAD
        $args = Functions::flattenArray($args);

        if (count($args) == 0) {
            return Functions::VALUE();
        }

        $args = array_filter($args, function ($value) {
            return $value !== null || (is_string($value) && trim($value) == '');
        });

        $returnValue = self::countTrueValues($args);
        if (is_string($returnValue)) {
            return $returnValue;
        }

        return $returnValue % 2 == 1;
=======
        return self::countTrueValues($args, function (int $trueValueCount): bool {
            return $trueValueCount % 2 === 1;
        });
>>>>>>> main
    }

    /**
     * NOT.
     *
     * Returns the boolean inverse of the argument.
     *
     * Excel Function:
     *        =NOT(logical)
     *
     *        The argument must evaluate to a logical value such as TRUE or FALSE
     *
     *        Boolean arguments are treated as True or False as appropriate
     *        Integer or floating point arguments are treated as True, except for 0 or 0.0 which are False
     *        If any argument value is a string, or a Null, the function returns a #VALUE! error, unless the string
     *            holds the value TRUE or FALSE, in which case it is evaluated as the corresponding boolean value
     *
     * @param mixed $logical A value or expression that can be evaluated to TRUE or FALSE
     *                      Or can be an array of values
     *
     * @return array|bool|string the boolean inverse of the argument
     *         If an array of values is passed as an argument, then the returned result will also be an array
     *            with the same dimensions
     */
    public static function NOT($logical = false)
    {
        if (is_array($logical)) {
            return self::evaluateSingleArgumentArray([self::class, __FUNCTION__], $logical);
        }

        if (is_string($logical)) {
            $logical = mb_strtoupper($logical, 'UTF-8');
            if (($logical == 'TRUE') || ($logical == Calculation::getTRUE())) {
                return false;
            } elseif (($logical == 'FALSE') || ($logical == Calculation::getFALSE())) {
                return true;
            }

<<<<<<< HEAD
            return Functions::VALUE();
=======
            return ExcelError::VALUE();
>>>>>>> main
        }

        return !$logical;
    }

    /**
<<<<<<< HEAD
     * @return int|string
     */
    private static function countTrueValues(array $args)
    {
        $trueValueCount = 0;

        foreach ($args as $arg) {
            // Is it a boolean value?
            if (is_bool($arg)) {
                $trueValueCount += $arg;
            } elseif ((is_numeric($arg)) && (!is_string($arg))) {
                $trueValueCount += ((int) $arg != 0);
            } elseif (is_string($arg)) {
                $arg = mb_strtoupper($arg, 'UTF-8');
                if (($arg == 'TRUE') || ($arg == Calculation::getTRUE())) {
                    $arg = true;
                } elseif (($arg == 'FALSE') || ($arg == Calculation::getFALSE())) {
                    $arg = false;
                } else {
                    return Functions::VALUE();
                }
                $trueValueCount += ($arg != 0);
            }
        }

        return $trueValueCount;
=======
     * @return bool|string
     */
    private static function countTrueValues(array $args, callable $func)
    {
        $trueValueCount = 0;
        $count = 0;

        $aArgs = Functions::flattenArrayIndexed($args);
        foreach ($aArgs as $k => $arg) {
            ++$count;
            // Is it a boolean value?
            if (is_bool($arg)) {
                $trueValueCount += $arg;
            } elseif (is_string($arg)) {
                $isLiteral = !Functions::isCellValue($k);
                $arg = mb_strtoupper($arg, 'UTF-8');
                if ($isLiteral && ($arg == 'TRUE' || $arg == Calculation::getTRUE())) {
                    ++$trueValueCount;
                } elseif ($isLiteral && ($arg == 'FALSE' || $arg == Calculation::getFALSE())) {
                    //$trueValueCount += 0;
                } else {
                    --$count;
                }
            } elseif (is_int($arg) || is_float($arg)) {
                $trueValueCount += (int) ($arg != 0);
            } else {
                --$count;
            }
        }

        return ($count === 0) ? ExcelError::VALUE() : $func($trueValueCount, $count);
>>>>>>> main
    }
}
