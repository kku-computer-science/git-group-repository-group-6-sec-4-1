<?php

namespace Maatwebsite\Excel\Factories;

use Maatwebsite\Excel\Concerns\MapsCsvSettings;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithReadFilter;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Files\TemporaryFile;
use Maatwebsite\Excel\Filters\LimitFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

class ReaderFactory
{
    use MapsCsvSettings;

    /**
     * @param  object  $import
     * @param  TemporaryFile  $file
     * @param  string  $readerType
     * @return IReader
     *
     * @throws Exception
     */
<<<<<<< HEAD
    public static function make($import, TemporaryFile $file, string $readerType = null): IReader
=======
    public static function make($import, TemporaryFile $file, ?string $readerType = null): IReader
>>>>>>> main
    {
        $reader = IOFactory::createReader(
            $readerType ?: static::identify($file)
        );

        if (method_exists($reader, 'setReadDataOnly')) {
            $reader->setReadDataOnly(config('excel.imports.read_only', true));
        }

        if (method_exists($reader, 'setReadEmptyCells')) {
            $reader->setReadEmptyCells(!config('excel.imports.ignore_empty', false));
        }

        if ($reader instanceof Csv) {
            static::applyCsvSettings(config('excel.imports.csv', []));

            if ($import instanceof WithCustomCsvSettings) {
                static::applyCsvSettings($import->getCsvSettings());
            }

            $reader->setDelimiter(static::$delimiter);
            $reader->setEnclosure(static::$enclosure);
            $reader->setEscapeCharacter(static::$escapeCharacter);
            $reader->setContiguous(static::$contiguous);
            $reader->setInputEncoding(static::$inputEncoding);
<<<<<<< HEAD
=======
            if (method_exists($reader, 'setTestAutoDetect')) {
                $reader->setTestAutoDetect(static::$testAutoDetect);
            }
>>>>>>> main
        }

        if ($import instanceof WithReadFilter) {
            $reader->setReadFilter($import->readFilter());
        } elseif ($import instanceof WithLimit) {
            $reader->setReadFilter(new LimitFilter(
                $import instanceof WithStartRow ? $import->startRow() : 1,
                $import->limit()
            ));
        }

        return $reader;
    }

    /**
     * @param  TemporaryFile  $temporaryFile
     * @return string
     *
     * @throws NoTypeDetectedException
     */
    private static function identify(TemporaryFile $temporaryFile): string
    {
        try {
            return IOFactory::identify($temporaryFile->getLocalPath());
        } catch (Exception $e) {
<<<<<<< HEAD
            throw new NoTypeDetectedException(null, null, $e);
=======
            throw new NoTypeDetectedException('', 0, $e);
>>>>>>> main
        }
    }
}
