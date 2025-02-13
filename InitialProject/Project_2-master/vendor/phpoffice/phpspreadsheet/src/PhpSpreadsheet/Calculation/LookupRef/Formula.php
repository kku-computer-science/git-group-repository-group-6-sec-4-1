<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\LookupRef;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
=======
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
>>>>>>> main
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class Formula
{
    /**
     * FORMULATEXT.
     *
     * @param mixed $cellReference The cell to check
     * @param Cell $cell The current cell (containing this formula)
     *
     * @return string
     */
    public static function text($cellReference = '', ?Cell $cell = null)
    {
        if ($cell === null) {
<<<<<<< HEAD
            return Functions::REF();
=======
            return ExcelError::REF();
>>>>>>> main
        }

        preg_match('/^' . Calculation::CALCULATION_REGEXP_CELLREF . '$/i', $cellReference, $matches);

        $cellReference = $matches[6] . $matches[7];
        $worksheetName = trim($matches[3], "'");
        $worksheet = (!empty($worksheetName))
<<<<<<< HEAD
            ? $cell->getWorksheet()->getParent()->getSheetByName($worksheetName)
=======
            ? $cell->getWorksheet()->getParentOrThrow()->getSheetByName($worksheetName)
>>>>>>> main
            : $cell->getWorksheet();

        if (
            $worksheet === null ||
            !$worksheet->cellExists($cellReference) ||
            !$worksheet->getCell($cellReference)->isFormula()
        ) {
<<<<<<< HEAD
            return Functions::NA();
=======
            return ExcelError::NA();
>>>>>>> main
        }

        return $worksheet->getCell($cellReference)->getValue();
    }
}
