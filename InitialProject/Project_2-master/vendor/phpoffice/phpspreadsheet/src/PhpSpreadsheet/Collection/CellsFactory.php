<?php

namespace PhpOffice\PhpSpreadsheet\Collection;

use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class CellsFactory
{
    /**
     * Initialise the cache storage.
     *
     * @param Worksheet $worksheet Enable cell caching for this worksheet
     *
<<<<<<< HEAD
     * @return Cells
     * */
    public static function getInstance(Worksheet $worksheet)
=======
     * */
    public static function getInstance(Worksheet $worksheet): Cells
>>>>>>> main
    {
        return new Cells($worksheet, Settings::getCache());
    }
}
