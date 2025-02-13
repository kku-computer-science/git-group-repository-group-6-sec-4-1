<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Reader\Security\XmlScanner;
use PhpOffice\PhpSpreadsheet\Shared\File;
=======
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Reader\Security\XmlScanner;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
>>>>>>> main

abstract class BaseReader implements IReader
{
    /**
     * Read data only?
     * Identifies whether the Reader should only read data values for cells, and ignore any formatting information;
     *        or whether it should read both data and formatting.
     *
     * @var bool
     */
    protected $readDataOnly = false;

    /**
     * Read empty cells?
     * Identifies whether the Reader should read data values for cells all cells, or should ignore cells containing
     *         null value or empty string.
     *
     * @var bool
     */
    protected $readEmptyCells = true;

    /**
     * Read charts that are defined in the workbook?
     * Identifies whether the Reader should read the definitions for any charts that exist in the workbook;.
     *
     * @var bool
     */
    protected $includeCharts = false;

    /**
     * Restrict which sheets should be loaded?
     * This property holds an array of worksheet names to be loaded. If null, then all worksheets will be loaded.
     *
     * @var null|string[]
     */
    protected $loadSheetsOnly;

    /**
     * IReadFilter instance.
     *
     * @var IReadFilter
     */
    protected $readFilter;

<<<<<<< HEAD
    protected $fileHandle;

    /**
     * @var XmlScanner
=======
    /** @var resource */
    protected $fileHandle;

    /**
     * @var ?XmlScanner
>>>>>>> main
     */
    protected $securityScanner;

    public function __construct()
    {
        $this->readFilter = new DefaultReadFilter();
    }

    public function getReadDataOnly()
    {
        return $this->readDataOnly;
    }

    public function setReadDataOnly($readCellValuesOnly)
    {
        $this->readDataOnly = (bool) $readCellValuesOnly;

        return $this;
    }

    public function getReadEmptyCells()
    {
        return $this->readEmptyCells;
    }

    public function setReadEmptyCells($readEmptyCells)
    {
        $this->readEmptyCells = (bool) $readEmptyCells;

        return $this;
    }

    public function getIncludeCharts()
    {
        return $this->includeCharts;
    }

    public function setIncludeCharts($includeCharts)
    {
        $this->includeCharts = (bool) $includeCharts;

        return $this;
    }

    public function getLoadSheetsOnly()
    {
        return $this->loadSheetsOnly;
    }

    public function setLoadSheetsOnly($sheetList)
    {
        if ($sheetList === null) {
            return $this->setLoadAllSheets();
        }

        $this->loadSheetsOnly = is_array($sheetList) ? $sheetList : [$sheetList];

        return $this;
    }

    public function setLoadAllSheets()
    {
        $this->loadSheetsOnly = null;

        return $this;
    }

    public function getReadFilter()
    {
        return $this->readFilter;
    }

    public function setReadFilter(IReadFilter $readFilter)
    {
        $this->readFilter = $readFilter;

        return $this;
    }

<<<<<<< HEAD
    public function getSecurityScanner()
=======
    public function getSecurityScanner(): ?XmlScanner
>>>>>>> main
    {
        return $this->securityScanner;
    }

<<<<<<< HEAD
=======
    public function getSecurityScannerOrThrow(): XmlScanner
    {
        if ($this->securityScanner === null) {
            throw new ReaderException('Security scanner is unexpectedly null');
        }

        return $this->securityScanner;
    }

>>>>>>> main
    protected function processFlags(int $flags): void
    {
        if (((bool) ($flags & self::LOAD_WITH_CHARTS)) === true) {
            $this->setIncludeCharts(true);
        }
<<<<<<< HEAD
=======
        if (((bool) ($flags & self::READ_DATA_ONLY)) === true) {
            $this->setReadDataOnly(true);
        }
        if (((bool) ($flags & self::SKIP_EMPTY_CELLS) || (bool) ($flags & self::IGNORE_EMPTY_CELLS)) === true) {
            $this->setReadEmptyCells(false);
        }
    }

    protected function loadSpreadsheetFromFile(string $filename): Spreadsheet
    {
        throw new PhpSpreadsheetException('Reader classes must implement their own loadSpreadsheetFromFile() method');
    }

    /**
     * Loads Spreadsheet from file.
     *
     * @param int $flags the optional second parameter flags may be used to identify specific elements
     *                       that should be loaded, but which won't be loaded by default, using these values:
     *                            IReader::LOAD_WITH_CHARTS - Include any charts that are defined in the loaded file
     */
    public function load(string $filename, int $flags = 0): Spreadsheet
    {
        $this->processFlags($flags);

        try {
            return $this->loadSpreadsheetFromFile($filename);
        } catch (ReaderException $e) {
            throw $e;
        }
>>>>>>> main
    }

    /**
     * Open file for reading.
<<<<<<< HEAD
     *
     * @param string $filename
     */
    protected function openFile($filename): void
    {
=======
     */
    protected function openFile(string $filename): void
    {
        $fileHandle = false;
>>>>>>> main
        if ($filename) {
            File::assertFile($filename);

            // Open file
            $fileHandle = fopen($filename, 'rb');
<<<<<<< HEAD
        } else {
            $fileHandle = false;
        }
        if ($fileHandle !== false) {
            $this->fileHandle = $fileHandle;
        } else {
            throw new ReaderException('Could not open file ' . $filename . ' for reading.');
        }
=======
        }
        if ($fileHandle === false) {
            throw new ReaderException('Could not open file ' . $filename . ' for reading.');
        }

        $this->fileHandle = $fileHandle;
>>>>>>> main
    }
}
