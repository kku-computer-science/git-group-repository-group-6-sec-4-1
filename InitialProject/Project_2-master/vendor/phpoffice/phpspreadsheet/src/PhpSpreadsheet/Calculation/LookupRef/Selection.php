<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\LookupRef;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Functions;

class Selection
{
=======
use PhpOffice\PhpSpreadsheet\Calculation\ArrayEnabled;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;

class Selection
{
    use ArrayEnabled;

>>>>>>> main
    /**
     * CHOOSE.
     *
     * Uses lookup_value to return a value from the list of value arguments.
     * Use CHOOSE to select one of up to 254 values based on the lookup_value.
     *
     * Excel Function:
     *        =CHOOSE(index_num, value1, [value2], ...)
     *
<<<<<<< HEAD
=======
     * @param mixed $chosenEntry The entry to select from the list (indexed from 1)
>>>>>>> main
     * @param mixed ...$chooseArgs Data values
     *
     * @return mixed The selected value
     */
<<<<<<< HEAD
    public static function choose(...$chooseArgs)
    {
        $chosenEntry = Functions::flattenArray(array_shift($chooseArgs));
        $entryCount = count($chooseArgs) - 1;

        if (is_array($chosenEntry)) {
            $chosenEntry = array_shift($chosenEntry);
        }
        if (is_numeric($chosenEntry)) {
            --$chosenEntry;
        } else {
            return Functions::VALUE();
        }
        $chosenEntry = floor($chosenEntry);
        if (($chosenEntry < 0) || ($chosenEntry > $entryCount)) {
            return Functions::VALUE();
=======
    public static function choose($chosenEntry, ...$chooseArgs)
    {
        if (is_array($chosenEntry)) {
            return self::evaluateArrayArgumentsSubset([self::class, __FUNCTION__], 1, $chosenEntry, ...$chooseArgs);
        }

        $entryCount = count($chooseArgs) - 1;

        if (is_numeric($chosenEntry)) {
            --$chosenEntry;
        } else {
            return ExcelError::VALUE();
        }
        $chosenEntry = floor($chosenEntry);
        if (($chosenEntry < 0) || ($chosenEntry > $entryCount)) {
            return ExcelError::VALUE();
>>>>>>> main
        }

        if (is_array($chooseArgs[$chosenEntry])) {
            return Functions::flattenArray($chooseArgs[$chosenEntry]);
        }

        return $chooseArgs[$chosenEntry];
    }
}
