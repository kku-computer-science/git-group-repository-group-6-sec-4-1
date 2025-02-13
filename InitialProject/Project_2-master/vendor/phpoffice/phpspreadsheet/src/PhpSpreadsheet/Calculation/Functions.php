<?php

namespace PhpOffice\PhpSpreadsheet\Calculation;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Shared\Date;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
=======
>>>>>>> main

class Functions
{
    const PRECISION = 8.88E-016;

    /**
     * 2 / PI.
     */
    const M_2DIVPI = 0.63661977236758134307553505349006;

    const COMPATIBILITY_EXCEL = 'Excel';
    const COMPATIBILITY_GNUMERIC = 'Gnumeric';
    const COMPATIBILITY_OPENOFFICE = 'OpenOfficeCalc';

    /** Use of RETURNDATE_PHP_NUMERIC is discouraged - not 32-bit Y2038-safe, no timezone. */
    const RETURNDATE_PHP_NUMERIC = 'P';
    /** Use of RETURNDATE_UNIX_TIMESTAMP is discouraged - not 32-bit Y2038-safe, no timezone. */
    const RETURNDATE_UNIX_TIMESTAMP = 'P';
    const RETURNDATE_PHP_OBJECT = 'O';
    const RETURNDATE_PHP_DATETIME_OBJECT = 'O';
    const RETURNDATE_EXCEL = 'E';

    /**
     * Compatibility mode to use for error checking and responses.
     *
     * @var string
     */
    protected static $compatibilityMode = self::COMPATIBILITY_EXCEL;

    /**
     * Data Type to use when returning date values.
     *
     * @var string
     */
    protected static $returnDateType = self::RETURNDATE_EXCEL;

    /**
<<<<<<< HEAD
     * List of error codes.
     *
     * @var array
     */
    protected static $errorCodes = [
        'null' => '#NULL!',
        'divisionbyzero' => '#DIV/0!',
        'value' => '#VALUE!',
        'reference' => '#REF!',
        'name' => '#NAME?',
        'num' => '#NUM!',
        'na' => '#N/A',
        'gettingdata' => '#GETTING_DATA',
    ];

    /**
     * Set the Compatibility Mode.
     *
     * @param string $compatibilityMode Compatibility Mode
     *                                                Permitted values are:
     *                                                    Functions::COMPATIBILITY_EXCEL            'Excel'
     *                                                    Functions::COMPATIBILITY_GNUMERIC        'Gnumeric'
     *                                                    Functions::COMPATIBILITY_OPENOFFICE    'OpenOfficeCalc'
=======
     * Set the Compatibility Mode.
     *
     * @param string $compatibilityMode Compatibility Mode
     *                                  Permitted values are:
     *                                      Functions::COMPATIBILITY_EXCEL        'Excel'
     *                                      Functions::COMPATIBILITY_GNUMERIC     'Gnumeric'
     *                                      Functions::COMPATIBILITY_OPENOFFICE   'OpenOfficeCalc'
>>>>>>> main
     *
     * @return bool (Success or Failure)
     */
    public static function setCompatibilityMode($compatibilityMode)
    {
        if (
            ($compatibilityMode == self::COMPATIBILITY_EXCEL) ||
            ($compatibilityMode == self::COMPATIBILITY_GNUMERIC) ||
            ($compatibilityMode == self::COMPATIBILITY_OPENOFFICE)
        ) {
            self::$compatibilityMode = $compatibilityMode;

            return true;
        }

        return false;
    }

    /**
     * Return the current Compatibility Mode.
     *
     * @return string Compatibility Mode
<<<<<<< HEAD
     *                            Possible Return values are:
     *                                Functions::COMPATIBILITY_EXCEL            'Excel'
     *                                Functions::COMPATIBILITY_GNUMERIC        'Gnumeric'
     *                                Functions::COMPATIBILITY_OPENOFFICE    'OpenOfficeCalc'
=======
     *                Possible Return values are:
     *                    Functions::COMPATIBILITY_EXCEL        'Excel'
     *                    Functions::COMPATIBILITY_GNUMERIC     'Gnumeric'
     *                    Functions::COMPATIBILITY_OPENOFFICE   'OpenOfficeCalc'
>>>>>>> main
     */
    public static function getCompatibilityMode()
    {
        return self::$compatibilityMode;
    }

    /**
<<<<<<< HEAD
     * Set the Return Date Format used by functions that return a date/time (Excel, PHP Serialized Numeric or PHP Object).
     *
     * @param string $returnDateType Return Date Format
     *                                                Permitted values are:
     *                                                    Functions::RETURNDATE_UNIX_TIMESTAMP        'P'
     *                                                    Functions::RETURNDATE_PHP_DATETIME_OBJECT        'O'
     *                                                    Functions::RETURNDATE_EXCEL            'E'
=======
     * Set the Return Date Format used by functions that return a date/time (Excel, PHP Serialized Numeric or PHP DateTime Object).
     *
     * @param string $returnDateType Return Date Format
     *                               Permitted values are:
     *                                   Functions::RETURNDATE_UNIX_TIMESTAMP       'P'
     *                                   Functions::RETURNDATE_PHP_DATETIME_OBJECT  'O'
     *                                   Functions::RETURNDATE_EXCEL                'E'
>>>>>>> main
     *
     * @return bool Success or failure
     */
    public static function setReturnDateType($returnDateType)
    {
        if (
            ($returnDateType == self::RETURNDATE_UNIX_TIMESTAMP) ||
            ($returnDateType == self::RETURNDATE_PHP_DATETIME_OBJECT) ||
            ($returnDateType == self::RETURNDATE_EXCEL)
        ) {
            self::$returnDateType = $returnDateType;

            return true;
        }

        return false;
    }

    /**
     * Return the current Return Date Format for functions that return a date/time (Excel, PHP Serialized Numeric or PHP Object).
     *
     * @return string Return Date Format
<<<<<<< HEAD
     *                            Possible Return values are:
     *                                Functions::RETURNDATE_UNIX_TIMESTAMP        'P'
     *                                Functions::RETURNDATE_PHP_DATETIME_OBJECT        'O'
     *                                Functions::RETURNDATE_EXCEL            'E'
=======
     *                Possible Return values are:
     *                    Functions::RETURNDATE_UNIX_TIMESTAMP         'P'
     *                    Functions::RETURNDATE_PHP_DATETIME_OBJECT    'O'
     *                    Functions::RETURNDATE_EXCEL            '     'E'
>>>>>>> main
     */
    public static function getReturnDateType()
    {
        return self::$returnDateType;
    }

    /**
     * DUMMY.
     *
     * @return string #Not Yet Implemented
     */
    public static function DUMMY()
    {
        return '#Not Yet Implemented';
    }

<<<<<<< HEAD
    /**
     * DIV0.
     *
     * @return string #Not Yet Implemented
     */
    public static function DIV0()
    {
        return self::$errorCodes['divisionbyzero'];
    }

    /**
     * NA.
     *
     * Excel Function:
     *        =NA()
     *
     * Returns the error value #N/A
     *        #N/A is the error value that means "no value is available."
     *
     * @return string #N/A!
     */
    public static function NA()
    {
        return self::$errorCodes['na'];
    }

    /**
     * NaN.
     *
     * Returns the error value #NUM!
     *
     * @return string #NUM!
     */
    public static function NAN()
    {
        return self::$errorCodes['num'];
    }

    /**
     * NAME.
     *
     * Returns the error value #NAME?
     *
     * @return string #NAME?
     */
    public static function NAME()
    {
        return self::$errorCodes['name'];
    }

    /**
     * REF.
     *
     * Returns the error value #REF!
     *
     * @return string #REF!
     */
    public static function REF()
    {
        return self::$errorCodes['reference'];
    }

    /**
     * NULL.
     *
     * Returns the error value #NULL!
     *
     * @return string #NULL!
     */
    public static function null()
    {
        return self::$errorCodes['null'];
    }

    /**
     * VALUE.
     *
     * Returns the error value #VALUE!
     *
     * @return string #VALUE!
     */
    public static function VALUE()
    {
        return self::$errorCodes['value'];
    }

    public static function isMatrixValue($idx)
=======
    /** @param mixed $idx */
    public static function isMatrixValue($idx): bool
>>>>>>> main
    {
        return (substr_count($idx, '.') <= 1) || (preg_match('/\.[A-Z]/', $idx) > 0);
    }

<<<<<<< HEAD
    public static function isValue($idx)
    {
        return substr_count($idx, '.') == 0;
    }

    public static function isCellValue($idx)
=======
    /** @param mixed $idx */
    public static function isValue($idx): bool
    {
        return substr_count($idx, '.') === 0;
    }

    /** @param mixed $idx */
    public static function isCellValue($idx): bool
>>>>>>> main
    {
        return substr_count($idx, '.') > 1;
    }

<<<<<<< HEAD
    public static function ifCondition($condition)
=======
    /** @param mixed $condition */
    public static function ifCondition($condition): string
>>>>>>> main
    {
        $condition = self::flattenSingleValue($condition);

        if ($condition === '') {
            return '=""';
        }
<<<<<<< HEAD
        if (!is_string($condition) || !in_array($condition[0], ['>', '<', '='])) {
=======
        if (!is_string($condition) || !in_array($condition[0], ['>', '<', '='], true)) {
>>>>>>> main
            $condition = self::operandSpecialHandling($condition);
            if (is_bool($condition)) {
                return '=' . ($condition ? 'TRUE' : 'FALSE');
            } elseif (!is_numeric($condition)) {
<<<<<<< HEAD
=======
                if ($condition !== '""') { // Not an empty string
                    // Escape any quotes in the string value
                    $condition = (string) preg_replace('/"/ui', '""', $condition);
                }
>>>>>>> main
                $condition = Calculation::wrapResult(strtoupper($condition));
            }

            return str_replace('""""', '""', '=' . $condition);
        }
        preg_match('/(=|<[>=]?|>=?)(.*)/', $condition, $matches);
        [, $operator, $operand] = $matches;

        $operand = self::operandSpecialHandling($operand);
        if (is_numeric(trim($operand, '"'))) {
            $operand = trim($operand, '"');
        } elseif (!is_numeric($operand) && $operand !== 'FALSE' && $operand !== 'TRUE') {
            $operand = str_replace('"', '""', $operand);
            $operand = Calculation::wrapResult(strtoupper($operand));
        }

        return str_replace('""""', '""', $operator . $operand);
    }

<<<<<<< HEAD
=======
    /**
     * @param mixed $operand
     *
     * @return mixed
     */
>>>>>>> main
    private static function operandSpecialHandling($operand)
    {
        if (is_numeric($operand) || is_bool($operand)) {
            return $operand;
        } elseif (strtoupper($operand) === Calculation::getTRUE() || strtoupper($operand) === Calculation::getFALSE()) {
            return strtoupper($operand);
        }

        // Check for percentage
        if (preg_match('/^\-?\d*\.?\d*\s?\%$/', $operand)) {
            return ((float) rtrim($operand, '%')) / 100;
        }

        // Check for dates
        if (($dateValueOperand = Date::stringToExcel($operand)) !== false) {
            return $dateValueOperand;
        }

        return $operand;
    }

    /**
<<<<<<< HEAD
=======
     * NULL.
     *
     * Returns the error value #NULL!
     *
     * @deprecated 1.23.0 Use the null() method in the Information\ExcelError class instead
     * @see Information\ExcelError::null()
     *
     * @return string #NULL!
     */
    public static function null()
    {
        return Information\ExcelError::null();
    }

    /**
     * NaN.
     *
     * Returns the error value #NUM!
     *
     * @deprecated 1.23.0 Use the NAN() method in the Information\Error class instead
     * @see Information\ExcelError::NAN()
     *
     * @return string #NUM!
     */
    public static function NAN()
    {
        return Information\ExcelError::NAN();
    }

    /**
     * REF.
     *
     * Returns the error value #REF!
     *
     * @deprecated 1.23.0 Use the REF() method in the Information\ExcelError class instead
     * @see Information\ExcelError::REF()
     *
     * @return string #REF!
     */
    public static function REF()
    {
        return Information\ExcelError::REF();
    }

    /**
     * NA.
     *
     * Excel Function:
     *        =NA()
     *
     * Returns the error value #N/A
     *        #N/A is the error value that means "no value is available."
     *
     * @deprecated 1.23.0 Use the NA() method in the Information\ExcelError class instead
     * @see Information\ExcelError::NA()
     *
     * @return string #N/A!
     */
    public static function NA()
    {
        return Information\ExcelError::NA();
    }

    /**
     * VALUE.
     *
     * Returns the error value #VALUE!
     *
     * @deprecated 1.23.0 Use the VALUE() method in the Information\ExcelError class instead
     * @see Information\ExcelError::VALUE()
     *
     * @return string #VALUE!
     */
    public static function VALUE()
    {
        return Information\ExcelError::VALUE();
    }

    /**
     * NAME.
     *
     * Returns the error value #NAME?
     *
     * @deprecated 1.23.0 Use the NAME() method in the Information\ExcelError class instead
     * @see Information\ExcelError::NAME()
     *
     * @return string #NAME?
     */
    public static function NAME()
    {
        return Information\ExcelError::NAME();
    }

    /**
     * DIV0.
     *
     * @deprecated 1.23.0 Use the DIV0() method in the Information\ExcelError class instead
     * @see Information\ExcelError::DIV0()
     *
     * @return string #Not Yet Implemented
     */
    public static function DIV0()
    {
        return Information\ExcelError::DIV0();
    }

    /**
>>>>>>> main
     * ERROR_TYPE.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return int|string
     */
    public static function errorType($value = '')
    {
        $value = self::flattenSingleValue($value);

        $i = 1;
        foreach (self::$errorCodes as $errorCode) {
            if ($value === $errorCode) {
                return $i;
            }
            ++$i;
        }

        return self::NA();
=======
     * @deprecated 1.23.0 Use the type() method in the Information\ExcelError class instead
     * @see Information\ExcelError::type()
     *
     * @return array|int|string
     */
    public static function errorType($value = '')
    {
        return Information\ExcelError::type($value);
>>>>>>> main
    }

    /**
     * IS_BLANK.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool
     */
    public static function isBlank($value = null)
    {
        if ($value !== null) {
            $value = self::flattenSingleValue($value);
        }

        return $value === null;
=======
     * @deprecated 1.23.0 Use the isBlank() method in the Information\Value class instead
     * @see Information\Value::isBlank()
     *
     * @return array|bool
     */
    public static function isBlank($value = null)
    {
        return Information\Value::isBlank($value);
>>>>>>> main
    }

    /**
     * IS_ERR.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool
     */
    public static function isErr($value = '')
    {
        $value = self::flattenSingleValue($value);

        return self::isError($value) && (!self::isNa(($value)));
=======
     * @deprecated 1.23.0 Use the isErr() method in the Information\ErrorValue class instead
     * @see Information\ErrorValue::isErr()
     *
     * @return array|bool
     */
    public static function isErr($value = '')
    {
        return Information\ErrorValue::isErr($value);
>>>>>>> main
    }

    /**
     * IS_ERROR.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool
     */
    public static function isError($value = '')
    {
        $value = self::flattenSingleValue($value);

        if (!is_string($value)) {
            return false;
        }

        return in_array($value, self::$errorCodes);
=======
     * @deprecated 1.23.0 Use the isError() method in the Information\ErrorValue class instead
     * @see Information\ErrorValue::isError()
     *
     * @return array|bool
     */
    public static function isError($value = '')
    {
        return Information\ErrorValue::isError($value);
>>>>>>> main
    }

    /**
     * IS_NA.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool
     */
    public static function isNa($value = '')
    {
        $value = self::flattenSingleValue($value);

        return $value === self::NA();
=======
     * @deprecated 1.23.0 Use the isNa() method in the Information\ErrorValue class instead
     * @see Information\ErrorValue::isNa()
     *
     * @return array|bool
     */
    public static function isNa($value = '')
    {
        return Information\ErrorValue::isNa($value);
>>>>>>> main
    }

    /**
     * IS_EVEN.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool|string
     */
    public static function isEven($value = null)
    {
        $value = self::flattenSingleValue($value);

        if ($value === null) {
            return self::NAME();
        } elseif ((is_bool($value)) || ((is_string($value)) && (!is_numeric($value)))) {
            return self::VALUE();
        }

        return $value % 2 == 0;
=======
     * @deprecated 1.23.0 Use the isEven() method in the Information\Value class instead
     * @see Information\Value::isEven()
     *
     * @return array|bool|string
     */
    public static function isEven($value = null)
    {
        return Information\Value::isEven($value);
>>>>>>> main
    }

    /**
     * IS_ODD.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool|string
     */
    public static function isOdd($value = null)
    {
        $value = self::flattenSingleValue($value);

        if ($value === null) {
            return self::NAME();
        } elseif ((is_bool($value)) || ((is_string($value)) && (!is_numeric($value)))) {
            return self::VALUE();
        }

        return abs($value) % 2 == 1;
=======
     * @deprecated 1.23.0 Use the isOdd() method in the Information\Value class instead
     * @see Information\Value::isOdd()
     *
     * @return array|bool|string
     */
    public static function isOdd($value = null)
    {
        return Information\Value::isOdd($value);
>>>>>>> main
    }

    /**
     * IS_NUMBER.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool
     */
    public static function isNumber($value = null)
    {
        $value = self::flattenSingleValue($value);

        if (is_string($value)) {
            return false;
        }

        return is_numeric($value);
=======
     * @deprecated 1.23.0 Use the isNumber() method in the Information\Value class instead
     * @see Information\Value::isNumber()
     *
     * @return array|bool
     */
    public static function isNumber($value = null)
    {
        return Information\Value::isNumber($value);
>>>>>>> main
    }

    /**
     * IS_LOGICAL.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool
     */
    public static function isLogical($value = null)
    {
        $value = self::flattenSingleValue($value);

        return is_bool($value);
=======
     * @deprecated 1.23.0 Use the isLogical() method in the Information\Value class instead
     * @see Information\Value::isLogical()
     *
     * @return array|bool
     */
    public static function isLogical($value = null)
    {
        return Information\Value::isLogical($value);
>>>>>>> main
    }

    /**
     * IS_TEXT.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool
     */
    public static function isText($value = null)
    {
        $value = self::flattenSingleValue($value);

        return is_string($value) && !self::isError($value);
=======
     * @deprecated 1.23.0 Use the isText() method in the Information\Value class instead
     * @see Information\Value::isText()
     *
     * @return array|bool
     */
    public static function isText($value = null)
    {
        return Information\Value::isText($value);
>>>>>>> main
    }

    /**
     * IS_NONTEXT.
     *
     * @param mixed $value Value to check
     *
<<<<<<< HEAD
     * @return bool
     */
    public static function isNonText($value = null)
    {
        return !self::isText($value);
=======
     * @deprecated 1.23.0 Use the isNonText() method in the Information\Value class instead
     * @see Information\Value::isNonText()
     *
     * @return array|bool
     */
    public static function isNonText($value = null)
    {
        return Information\Value::isNonText($value);
>>>>>>> main
    }

    /**
     * N.
     *
     * Returns a value converted to a number
     *
<<<<<<< HEAD
     * @param null|mixed $value The value you want converted
     *
     * @return number N converts values listed in the following table
=======
     * @deprecated 1.23.0 Use the asNumber() method in the Information\Value class instead
     * @see Information\Value::asNumber()
     *
     * @param null|mixed $value The value you want converted
     *
     * @return number|string N converts values listed in the following table
>>>>>>> main
     *        If value is or refers to N returns
     *        A number            That number
     *        A date                The serial number of that date
     *        TRUE                1
     *        FALSE                0
     *        An error value        The error value
     *        Anything else        0
     */
    public static function n($value = null)
    {
<<<<<<< HEAD
        while (is_array($value)) {
            $value = array_shift($value);
        }

        switch (gettype($value)) {
            case 'double':
            case 'float':
            case 'integer':
                return $value;
            case 'boolean':
                return (int) $value;
            case 'string':
                //    Errors
                if ((strlen($value) > 0) && ($value[0] == '#')) {
                    return $value;
                }

                break;
        }

        return 0;
=======
        return Information\Value::asNumber($value);
>>>>>>> main
    }

    /**
     * TYPE.
     *
     * Returns a number that identifies the type of a value
     *
<<<<<<< HEAD
=======
     * @deprecated 1.23.0 Use the type() method in the Information\Value class instead
     * @see Information\Value::type()
     *
>>>>>>> main
     * @param null|mixed $value The value you want tested
     *
     * @return number N converts values listed in the following table
     *        If value is or refers to N returns
     *        A number            1
     *        Text                2
     *        Logical Value        4
     *        An error value        16
     *        Array or Matrix        64
     */
    public static function TYPE($value = null)
    {
<<<<<<< HEAD
        $value = self::flattenArrayIndexed($value);
        if (is_array($value) && (count($value) > 1)) {
            end($value);
            $a = key($value);
            //    Range of cells is an error
            if (self::isCellValue($a)) {
                return 16;
            //    Test for Matrix
            } elseif (self::isMatrixValue($a)) {
                return 64;
            }
        } elseif (empty($value)) {
            //    Empty Cell
            return 1;
        }
        $value = self::flattenSingleValue($value);

        if (($value === null) || (is_float($value)) || (is_int($value))) {
            return 1;
        } elseif (is_bool($value)) {
            return 4;
        } elseif (is_array($value)) {
            return 64;
        } elseif (is_string($value)) {
            //    Errors
            if ((strlen($value) > 0) && ($value[0] == '#')) {
                return 16;
            }

            return 2;
        }

        return 0;
=======
        return Information\Value::type($value);
>>>>>>> main
    }

    /**
     * Convert a multi-dimensional array to a simple 1-dimensional array.
     *
     * @param array|mixed $array Array to be flattened
     *
     * @return array Flattened array
     */
    public static function flattenArray($array)
    {
        if (!is_array($array)) {
            return (array) $array;
        }

<<<<<<< HEAD
        $arrayValues = [];
        foreach ($array as $value) {
            if (is_array($value)) {
                foreach ($value as $val) {
                    if (is_array($val)) {
                        foreach ($val as $v) {
                            $arrayValues[] = $v;
                        }
                    } else {
                        $arrayValues[] = $val;
                    }
                }
            } else {
                $arrayValues[] = $value;
            }
        }

        return $arrayValues;
=======
        $flattened = [];
        $stack = array_values($array);

        while (!empty($stack)) {
            $value = array_shift($stack);

            if (is_array($value)) {
                array_unshift($stack, ...array_values($value));
            } else {
                $flattened[] = $value;
            }
        }

        return $flattened;
>>>>>>> main
    }

    /**
     * @param mixed $value
     *
     * @return null|mixed
     */
    public static function scalar($value)
    {
        if (!is_array($value)) {
            return $value;
        }

        do {
            $value = array_pop($value);
        } while (is_array($value));

        return $value;
    }

    /**
     * Convert a multi-dimensional array to a simple 1-dimensional array, but retain an element of indexing.
     *
     * @param array|mixed $array Array to be flattened
     *
     * @return array Flattened array
     */
    public static function flattenArrayIndexed($array)
    {
        if (!is_array($array)) {
            return (array) $array;
        }

        $arrayValues = [];
        foreach ($array as $k1 => $value) {
            if (is_array($value)) {
                foreach ($value as $k2 => $val) {
                    if (is_array($val)) {
                        foreach ($val as $k3 => $v) {
                            $arrayValues[$k1 . '.' . $k2 . '.' . $k3] = $v;
                        }
                    } else {
                        $arrayValues[$k1 . '.' . $k2] = $val;
                    }
                }
            } else {
                $arrayValues[$k1] = $value;
            }
        }

        return $arrayValues;
    }

    /**
     * Convert an array to a single scalar value by extracting the first element.
     *
     * @param mixed $value Array or scalar value
     *
     * @return mixed
     */
    public static function flattenSingleValue($value = '')
    {
        while (is_array($value)) {
            $value = array_shift($value);
        }

        return $value;
    }

    /**
     * ISFORMULA.
     *
<<<<<<< HEAD
     * @param mixed $cellReference The cell to check
     * @param ?Cell $cell The current cell (containing this formula)
     *
     * @return bool|string
     */
    public static function isFormula($cellReference = '', ?Cell $cell = null)
    {
        if ($cell === null) {
            return self::REF();
        }
        $cellReference = self::expandDefinedName((string) $cellReference, $cell);
        $cellReference = self::trimTrailingRange($cellReference);

        preg_match('/^' . Calculation::CALCULATION_REGEXP_CELLREF . '$/i', $cellReference, $matches);

        $cellReference = $matches[6] . $matches[7];
        $worksheetName = str_replace("''", "'", trim($matches[2], "'"));

        $worksheet = (!empty($worksheetName))
            ? $cell->getWorksheet()->getParent()->getSheetByName($worksheetName)
            : $cell->getWorksheet();

        return $worksheet->getCell($cellReference)->isFormula();
=======
     * @deprecated 1.23.0 Use the isFormula() method in the Information\Value class instead
     * @see Information\Value::isFormula()
     *
     * @param mixed $cellReference The cell to check
     * @param ?Cell $cell The current cell (containing this formula)
     *
     * @return array|bool|string
     */
    public static function isFormula($cellReference = '', ?Cell $cell = null)
    {
        return Information\Value::isFormula($cellReference, $cell);
>>>>>>> main
    }

    public static function expandDefinedName(string $coordinate, Cell $cell): string
    {
        $worksheet = $cell->getWorksheet();
<<<<<<< HEAD
        $spreadsheet = $worksheet->getParent();
        // Uppercase coordinate
        $pCoordinatex = strtoupper($coordinate);
        // Eliminate leading equal sign
        $pCoordinatex = Worksheet::pregReplace('/^=/', '', $pCoordinatex);
=======
        $spreadsheet = $worksheet->getParentOrThrow();
        // Uppercase coordinate
        $pCoordinatex = strtoupper($coordinate);
        // Eliminate leading equal sign
        $pCoordinatex = (string) preg_replace('/^=/', '', $pCoordinatex);
>>>>>>> main
        $defined = $spreadsheet->getDefinedName($pCoordinatex, $worksheet);
        if ($defined !== null) {
            $worksheet2 = $defined->getWorkSheet();
            if (!$defined->isFormula() && $worksheet2 !== null) {
<<<<<<< HEAD
                $coordinate = "'" . $worksheet2->getTitle() . "'!" . Worksheet::pregReplace('/^=/', '', $defined->getValue());
=======
                $coordinate = "'" . $worksheet2->getTitle() . "'!" .
                    (string) preg_replace('/^=/', '', str_replace('$', '', $defined->getValue()));
>>>>>>> main
            }
        }

        return $coordinate;
    }

    public static function trimTrailingRange(string $coordinate): string
    {
<<<<<<< HEAD
        return Worksheet::pregReplace('/:[\\w\$]+$/', '', $coordinate);
=======
        return (string) preg_replace('/:[\\w\$]+$/', '', $coordinate);
    }

    public static function trimSheetFromCellReference(string $coordinate): string
    {
        if (strpos($coordinate, '!') !== false) {
            $coordinate = substr($coordinate, strrpos($coordinate, '!') + 1);
        }

        return $coordinate;
>>>>>>> main
    }
}
