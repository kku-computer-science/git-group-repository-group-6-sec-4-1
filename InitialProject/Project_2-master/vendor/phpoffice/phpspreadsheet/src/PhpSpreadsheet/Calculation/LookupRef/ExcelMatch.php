<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\LookupRef;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
=======
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main
use PhpOffice\PhpSpreadsheet\Calculation\Internal\WildcardMatch;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class ExcelMatch
{
<<<<<<< HEAD
=======
    use ArrayEnabled;

>>>>>>> main
    public const MATCHTYPE_SMALLEST_VALUE = -1;
    public const MATCHTYPE_FIRST_VALUE = 0;
    public const MATCHTYPE_LARGEST_VALUE = 1;

    /**
     * MATCH.
     *
     * The MATCH function searches for a specified item in a range of cells
     *
     * Excel Function:
     *        =MATCH(lookup_value, lookup_array, [match_type])
     *
     * @param mixed $lookupValue The value that you want to match in lookup_array
     * @param mixed $lookupArray The range of cells being searched
     * @param mixed $matchType The number -1, 0, or 1. -1 means above, 0 means exact match, 1 means below.
     *                         If match_type is 1 or -1, the list has to be ordered.
     *
<<<<<<< HEAD
     * @return int|string The relative position of the found item
     */
    public static function MATCH($lookupValue, $lookupArray, $matchType = self::MATCHTYPE_LARGEST_VALUE)
    {
        $lookupArray = Functions::flattenArray($lookupArray);
        $lookupValue = Functions::flattenSingleValue($lookupValue);
        $matchType = ($matchType === null)
            ? self::MATCHTYPE_LARGEST_VALUE
            : (int) Functions::flattenSingleValue($matchType);
=======
     * @return array|int|string The relative position of the found item
     */
    public static function MATCH($lookupValue, $lookupArray, $matchType = self::MATCHTYPE_LARGEST_VALUE)
    {
        if (is_array($lookupValue)) {
            return self::evaluateArrayArgumentsIgnore([self::class, __FUNCTION__], 1, $lookupValue, $lookupArray, $matchType);
        }

        $lookupArray = Functions::flattenArray($lookupArray);
>>>>>>> main

        try {
            // Input validation
            self::validateLookupValue($lookupValue);
<<<<<<< HEAD
            self::validateMatchType($matchType);
=======
            $matchType = self::validateMatchType($matchType);
>>>>>>> main
            self::validateLookupArray($lookupArray);

            $keySet = array_keys($lookupArray);
            if ($matchType == self::MATCHTYPE_LARGEST_VALUE) {
                // If match_type is 1 the list has to be processed from last to first
                $lookupArray = array_reverse($lookupArray);
                $keySet = array_reverse($keySet);
            }

            $lookupArray = self::prepareLookupArray($lookupArray, $matchType);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        // MATCH() is not case sensitive, so we convert lookup value to be lower cased if it's a string type.
        if (is_string($lookupValue)) {
            $lookupValue = StringHelper::strToLower($lookupValue);
        }

        $valueKey = null;
        switch ($matchType) {
            case self::MATCHTYPE_LARGEST_VALUE:
                $valueKey = self::matchLargestValue($lookupArray, $lookupValue, $keySet);

                break;
            case self::MATCHTYPE_FIRST_VALUE:
                $valueKey = self::matchFirstValue($lookupArray, $lookupValue);

                break;
            case self::MATCHTYPE_SMALLEST_VALUE:
            default:
                $valueKey = self::matchSmallestValue($lookupArray, $lookupValue);
        }

        if ($valueKey !== null) {
            return ++$valueKey;
        }

        // Unsuccessful in finding a match, return #N/A error value
<<<<<<< HEAD
        return Functions::NA();
    }

    private static function matchFirstValue($lookupArray, $lookupValue)
    {
        $wildcardLookup = ((bool) preg_match('/([\?\*])/', $lookupValue));
        $wildcard = WildcardMatch::wildcard($lookupValue);

        foreach ($lookupArray as $i => $lookupArrayValue) {
            $typeMatch = ((gettype($lookupValue) === gettype($lookupArrayValue)) ||
                (is_numeric($lookupValue) && is_numeric($lookupArrayValue)));

            if (
                $typeMatch && is_string($lookupValue) &&
                $wildcardLookup && WildcardMatch::compare($lookupArrayValue, $wildcard)
            ) {
                // wildcard match
                return $i;
            } elseif ($lookupArrayValue === $lookupValue) {
                // exact match
                return $i;
=======
        return ExcelError::NA();
    }

    /**
     * @param mixed $lookupValue
     *
     * @return mixed
     */
    private static function matchFirstValue(array $lookupArray, $lookupValue)
    {
        if (is_string($lookupValue)) {
            $valueIsString = true;
            $wildcard = WildcardMatch::wildcard($lookupValue);
        } else {
            $valueIsString = false;
            $wildcard = '';
        }

        $valueIsNumeric = is_int($lookupValue) || is_float($lookupValue);
        foreach ($lookupArray as $i => $lookupArrayValue) {
            if (
                $valueIsString
                && is_string($lookupArrayValue)
            ) {
                if (WildcardMatch::compare($lookupArrayValue, $wildcard)) {
                    return $i; // wildcard match
                }
            } else {
                if ($lookupArrayValue === $lookupValue) {
                    return $i; // exact match
                }
                if (
                    $valueIsNumeric
                    && (is_float($lookupArrayValue) || is_int($lookupArrayValue))
                    && $lookupArrayValue == $lookupValue
                ) {
                    return $i; // exact match
                }
>>>>>>> main
            }
        }

        return null;
    }

<<<<<<< HEAD
    private static function matchLargestValue($lookupArray, $lookupValue, $keySet)
    {
        foreach ($lookupArray as $i => $lookupArrayValue) {
            $typeMatch = ((gettype($lookupValue) === gettype($lookupArrayValue)) ||
                (is_numeric($lookupValue) && is_numeric($lookupArrayValue)));

=======
    /**
     * @param mixed $lookupValue
     *
     * @return mixed
     */
    private static function matchLargestValue(array $lookupArray, $lookupValue, array $keySet)
    {
        if (is_string($lookupValue)) {
            if (Functions::getCompatibilityMode() === Functions::COMPATIBILITY_OPENOFFICE) {
                $wildcard = WildcardMatch::wildcard($lookupValue);
                foreach (array_reverse($lookupArray) as $i => $lookupArrayValue) {
                    if (is_string($lookupArrayValue) && WildcardMatch::compare($lookupArrayValue, $wildcard)) {
                        return $i;
                    }
                }
            } else {
                foreach ($lookupArray as $i => $lookupArrayValue) {
                    if ($lookupArrayValue === $lookupValue) {
                        return $keySet[$i];
                    }
                }
            }
        }
        $valueIsNumeric = is_int($lookupValue) || is_float($lookupValue);
        foreach ($lookupArray as $i => $lookupArrayValue) {
            if ($valueIsNumeric && (is_int($lookupArrayValue) || is_float($lookupArrayValue))) {
                if ($lookupArrayValue <= $lookupValue) {
                    return array_search($i, $keySet);
                }
            }
            $typeMatch = gettype($lookupValue) === gettype($lookupArrayValue);
>>>>>>> main
            if ($typeMatch && ($lookupArrayValue <= $lookupValue)) {
                return array_search($i, $keySet);
            }
        }

        return null;
    }

<<<<<<< HEAD
    private static function matchSmallestValue($lookupArray, $lookupValue)
    {
        $valueKey = null;

=======
    /**
     * @param mixed $lookupValue
     *
     * @return mixed
     */
    private static function matchSmallestValue(array $lookupArray, $lookupValue)
    {
        $valueKey = null;
        if (is_string($lookupValue)) {
            if (Functions::getCompatibilityMode() === Functions::COMPATIBILITY_OPENOFFICE) {
                $wildcard = WildcardMatch::wildcard($lookupValue);
                foreach ($lookupArray as $i => $lookupArrayValue) {
                    if (is_string($lookupArrayValue) && WildcardMatch::compare($lookupArrayValue, $wildcard)) {
                        return $i;
                    }
                }
            }
        }

        $valueIsNumeric = is_int($lookupValue) || is_float($lookupValue);
>>>>>>> main
        // The basic algorithm is:
        // Iterate and keep the highest match until the next element is smaller than the searched value.
        // Return immediately if perfect match is found
        foreach ($lookupArray as $i => $lookupArrayValue) {
            $typeMatch = gettype($lookupValue) === gettype($lookupArrayValue);
<<<<<<< HEAD
=======
            $bothNumeric = $valueIsNumeric && (is_int($lookupArrayValue) || is_float($lookupArrayValue));
>>>>>>> main

            if ($lookupArrayValue === $lookupValue) {
                // Another "special" case. If a perfect match is found,
                // the algorithm gives up immediately
                return $i;
<<<<<<< HEAD
            } elseif ($typeMatch && $lookupArrayValue >= $lookupValue) {
=======
            }
            if ($bothNumeric && $lookupValue == $lookupArrayValue) {
                return $i; // exact match, as above
            }
            if (($typeMatch || $bothNumeric) && $lookupArrayValue >= $lookupValue) {
>>>>>>> main
                $valueKey = $i;
            } elseif ($typeMatch && $lookupArrayValue < $lookupValue) {
                //Excel algorithm gives up immediately if the first element is smaller than the searched value
                break;
            }
        }

        return $valueKey;
    }

<<<<<<< HEAD
=======
    /**
     * @param mixed $lookupValue
     */
>>>>>>> main
    private static function validateLookupValue($lookupValue): void
    {
        // Lookup_value type has to be number, text, or logical values
        if ((!is_numeric($lookupValue)) && (!is_string($lookupValue)) && (!is_bool($lookupValue))) {
<<<<<<< HEAD
            throw new Exception(Functions::NA());
        }
    }

    private static function validateMatchType($matchType): void
    {
        // Match_type is 0, 1 or -1
        if (
            ($matchType !== self::MATCHTYPE_FIRST_VALUE) &&
            ($matchType !== self::MATCHTYPE_LARGEST_VALUE) && ($matchType !== self::MATCHTYPE_SMALLEST_VALUE)
        ) {
            throw new Exception(Functions::NA());
        }
    }

    private static function validateLookupArray($lookupArray): void
=======
            throw new Exception(ExcelError::NA());
        }
    }

    /**
     * @param mixed $matchType
     */
    private static function validateMatchType($matchType): int
    {
        // Match_type is 0, 1 or -1
        // However Excel accepts other numeric values,
        //  including numeric strings and floats.
        //  It seems to just be interested in the sign.
        if (!is_numeric($matchType)) {
            throw new Exception(ExcelError::Value());
        }
        if ($matchType > 0) {
            return self::MATCHTYPE_LARGEST_VALUE;
        }
        if ($matchType < 0) {
            return self::MATCHTYPE_SMALLEST_VALUE;
        }

        return self::MATCHTYPE_FIRST_VALUE;
    }

    private static function validateLookupArray(array $lookupArray): void
>>>>>>> main
    {
        // Lookup_array should not be empty
        $lookupArraySize = count($lookupArray);
        if ($lookupArraySize <= 0) {
<<<<<<< HEAD
            throw new Exception(Functions::NA());
        }
    }

    private static function prepareLookupArray($lookupArray, $matchType)
=======
            throw new Exception(ExcelError::NA());
        }
    }

    /**
     * @param mixed $matchType
     */
    private static function prepareLookupArray(array $lookupArray, $matchType): array
>>>>>>> main
    {
        // Lookup_array should contain only number, text, or logical values, or empty (null) cells
        foreach ($lookupArray as $i => $value) {
            //    check the type of the value
            if ((!is_numeric($value)) && (!is_string($value)) && (!is_bool($value)) && ($value !== null)) {
<<<<<<< HEAD
                throw new Exception(Functions::NA());
=======
                throw new Exception(ExcelError::NA());
>>>>>>> main
            }
            // Convert strings to lowercase for case-insensitive testing
            if (is_string($value)) {
                $lookupArray[$i] = StringHelper::strToLower($value);
            }
            if (
                ($value === null) &&
                (($matchType == self::MATCHTYPE_LARGEST_VALUE) || ($matchType == self::MATCHTYPE_SMALLEST_VALUE))
            ) {
                unset($lookupArray[$i]);
            }
        }

        return $lookupArray;
    }
}
