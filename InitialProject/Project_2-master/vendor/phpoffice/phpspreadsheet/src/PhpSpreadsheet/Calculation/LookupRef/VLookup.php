<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\LookupRef;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
=======
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class VLookup extends LookupBase
{
<<<<<<< HEAD
=======
    use ArrayEnabled;

>>>>>>> main
    /**
     * VLOOKUP
     * The VLOOKUP function searches for value in the left-most column of lookup_array and returns the value
     *     in the same row based on the index_number.
     *
     * @param mixed $lookupValue The value that you want to match in lookup_array
     * @param mixed $lookupArray The range of cells being searched
     * @param mixed $indexNumber The column number in table_array from which the matching value must be returned.
     *                                The first column is 1.
     * @param mixed $notExactMatch determines if you are looking for an exact match based on lookup_value
     *
     * @return mixed The value of the found cell
     */
    public static function lookup($lookupValue, $lookupArray, $indexNumber, $notExactMatch = true)
    {
<<<<<<< HEAD
        $lookupValue = Functions::flattenSingleValue($lookupValue);
        $indexNumber = Functions::flattenSingleValue($indexNumber);
        $notExactMatch = ($notExactMatch === null) ? true : Functions::flattenSingleValue($notExactMatch);

        try {
=======
        if (is_array($lookupValue) || is_array($indexNumber)) {
            return self::evaluateArrayArgumentsIgnore([self::class, __FUNCTION__], 1, $lookupValue, $lookupArray, $indexNumber, $notExactMatch);
        }

        $notExactMatch = (bool) ($notExactMatch ?? true);

        try {
            self::validateLookupArray($lookupArray);
>>>>>>> main
            $indexNumber = self::validateIndexLookup($lookupArray, $indexNumber);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $f = array_keys($lookupArray);
        $firstRow = array_pop($f);
        if ((!is_array($lookupArray[$firstRow])) || ($indexNumber > count($lookupArray[$firstRow]))) {
<<<<<<< HEAD
            return Functions::REF();
        }
        $columnKeys = array_keys($lookupArray[$firstRow]);
        $returnColumn = $columnKeys[--$indexNumber];
        $firstColumn = array_shift($columnKeys);

        if (!$notExactMatch) {
            uasort($lookupArray, ['self', 'vlookupSort']);
=======
            return ExcelError::REF();
        }
        $columnKeys = array_keys($lookupArray[$firstRow]);
        $returnColumn = $columnKeys[--$indexNumber];
        $firstColumn = array_shift($columnKeys) ?? 1;

        if (!$notExactMatch) {
            /** @var callable */
            $callable = [self::class, 'vlookupSort'];
            uasort($lookupArray, $callable);
>>>>>>> main
        }

        $rowNumber = self::vLookupSearch($lookupValue, $lookupArray, $firstColumn, $notExactMatch);

        if ($rowNumber !== null) {
            // return the appropriate value
            return $lookupArray[$rowNumber][$returnColumn];
        }

<<<<<<< HEAD
        return Functions::NA();
    }

    private static function vlookupSort($a, $b)
    {
        reset($a);
        $firstColumn = key($a);
        $aLower = StringHelper::strToLower($a[$firstColumn]);
        $bLower = StringHelper::strToLower($b[$firstColumn]);
=======
        return ExcelError::NA();
    }

    private static function vlookupSort(array $a, array $b): int
    {
        reset($a);
        $firstColumn = key($a);
        $aLower = StringHelper::strToLower((string) $a[$firstColumn]);
        $bLower = StringHelper::strToLower((string) $b[$firstColumn]);
>>>>>>> main

        if ($aLower == $bLower) {
            return 0;
        }

        return ($aLower < $bLower) ? -1 : 1;
    }

<<<<<<< HEAD
    private static function vLookupSearch($lookupValue, $lookupArray, $column, $notExactMatch)
    {
        $lookupLower = StringHelper::strToLower($lookupValue);
=======
    /**
     * @param mixed $lookupValue The value that you want to match in lookup_array
     * @param  int|string $column
     */
    private static function vLookupSearch($lookupValue, array $lookupArray, $column, bool $notExactMatch): ?int
    {
        $lookupLower = StringHelper::strToLower((string) $lookupValue);
>>>>>>> main

        $rowNumber = null;
        foreach ($lookupArray as $rowKey => $rowData) {
            $bothNumeric = is_numeric($lookupValue) && is_numeric($rowData[$column]);
            $bothNotNumeric = !is_numeric($lookupValue) && !is_numeric($rowData[$column]);
<<<<<<< HEAD
            $cellDataLower = StringHelper::strToLower($rowData[$column]);
=======
            $cellDataLower = StringHelper::strToLower((string) $rowData[$column]);
>>>>>>> main

            // break if we have passed possible keys
            if (
                $notExactMatch &&
                (($bothNumeric && ($rowData[$column] > $lookupValue)) ||
                ($bothNotNumeric && ($cellDataLower > $lookupLower)))
            ) {
                break;
            }

            $rowNumber = self::checkMatch(
                $bothNumeric,
                $bothNotNumeric,
                $notExactMatch,
                $rowKey,
                $cellDataLower,
                $lookupLower,
                $rowNumber
            );
        }

        return $rowNumber;
    }
}
