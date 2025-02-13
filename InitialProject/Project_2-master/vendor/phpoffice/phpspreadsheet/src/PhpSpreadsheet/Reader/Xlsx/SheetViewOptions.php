<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;

class SheetViewOptions extends BaseParserClass
{
<<<<<<< HEAD
    private $worksheet;

=======
    /** @var Worksheet */
    private $worksheet;

    /** @var ?SimpleXMLElement */
>>>>>>> main
    private $worksheetXml;

    public function __construct(Worksheet $workSheet, ?SimpleXMLElement $worksheetXml = null)
    {
        $this->worksheet = $workSheet;
        $this->worksheetXml = $worksheetXml;
    }

    public function load(bool $readDataOnly, Styles $styleReader): void
    {
        if ($this->worksheetXml === null) {
            return;
        }

        if (isset($this->worksheetXml->sheetPr)) {
<<<<<<< HEAD
            $this->tabColor($this->worksheetXml->sheetPr, $styleReader);
            $this->codeName($this->worksheetXml->sheetPr);
            $this->outlines($this->worksheetXml->sheetPr);
            $this->pageSetup($this->worksheetXml->sheetPr);
=======
            $sheetPr = $this->worksheetXml->sheetPr;
            $this->tabColor($sheetPr, $styleReader);
            $this->codeName($sheetPr);
            $this->outlines($sheetPr);
            $this->pageSetup($sheetPr);
>>>>>>> main
        }

        if (isset($this->worksheetXml->sheetFormatPr)) {
            $this->sheetFormat($this->worksheetXml->sheetFormatPr);
        }

        if (!$readDataOnly && isset($this->worksheetXml->printOptions)) {
            $this->printOptions($this->worksheetXml->printOptions);
        }
    }

    private function tabColor(SimpleXMLElement $sheetPr, Styles $styleReader): void
    {
        if (isset($sheetPr->tabColor)) {
            $this->worksheet->getTabColor()->setARGB($styleReader->readColor($sheetPr->tabColor));
        }
    }

<<<<<<< HEAD
    private function codeName(SimpleXMLElement $sheetPr): void
    {
=======
    private function codeName(SimpleXMLElement $sheetPrx): void
    {
        $sheetPr = $sheetPrx->attributes() ?? [];
>>>>>>> main
        if (isset($sheetPr['codeName'])) {
            $this->worksheet->setCodeName((string) $sheetPr['codeName'], false);
        }
    }

    private function outlines(SimpleXMLElement $sheetPr): void
    {
        if (isset($sheetPr->outlinePr)) {
<<<<<<< HEAD
            if (
                isset($sheetPr->outlinePr['summaryRight']) &&
                !self::boolean((string) $sheetPr->outlinePr['summaryRight'])
=======
            $attr = $sheetPr->outlinePr->attributes() ?? [];
            if (
                isset($attr['summaryRight']) &&
                !self::boolean((string) $attr['summaryRight'])
>>>>>>> main
            ) {
                $this->worksheet->setShowSummaryRight(false);
            } else {
                $this->worksheet->setShowSummaryRight(true);
            }

            if (
<<<<<<< HEAD
                isset($sheetPr->outlinePr['summaryBelow']) &&
                !self::boolean((string) $sheetPr->outlinePr['summaryBelow'])
=======
                isset($attr['summaryBelow']) &&
                !self::boolean((string) $attr['summaryBelow'])
>>>>>>> main
            ) {
                $this->worksheet->setShowSummaryBelow(false);
            } else {
                $this->worksheet->setShowSummaryBelow(true);
            }
        }
    }

    private function pageSetup(SimpleXMLElement $sheetPr): void
    {
        if (isset($sheetPr->pageSetUpPr)) {
<<<<<<< HEAD
            if (
                isset($sheetPr->pageSetUpPr['fitToPage']) &&
                !self::boolean((string) $sheetPr->pageSetUpPr['fitToPage'])
=======
            $attr = $sheetPr->pageSetUpPr->attributes() ?? [];
            if (
                isset($attr['fitToPage']) &&
                !self::boolean((string) $attr['fitToPage'])
>>>>>>> main
            ) {
                $this->worksheet->getPageSetup()->setFitToPage(false);
            } else {
                $this->worksheet->getPageSetup()->setFitToPage(true);
            }
        }
    }

<<<<<<< HEAD
    private function sheetFormat(SimpleXMLElement $sheetFormatPr): void
    {
=======
    private function sheetFormat(SimpleXMLElement $sheetFormatPrx): void
    {
        $sheetFormatPr = $sheetFormatPrx->attributes() ?? [];
>>>>>>> main
        if (
            isset($sheetFormatPr['customHeight']) &&
            self::boolean((string) $sheetFormatPr['customHeight']) &&
            isset($sheetFormatPr['defaultRowHeight'])
        ) {
            $this->worksheet->getDefaultRowDimension()
                ->setRowHeight((float) $sheetFormatPr['defaultRowHeight']);
        }

        if (isset($sheetFormatPr['defaultColWidth'])) {
            $this->worksheet->getDefaultColumnDimension()
                ->setWidth((float) $sheetFormatPr['defaultColWidth']);
        }

        if (
            isset($sheetFormatPr['zeroHeight']) &&
            ((string) $sheetFormatPr['zeroHeight'] === '1')
        ) {
            $this->worksheet->getDefaultRowDimension()->setZeroHeight(true);
        }
    }

<<<<<<< HEAD
    private function printOptions(SimpleXMLElement $printOptions): void
    {
        if (self::boolean((string) $printOptions['gridLinesSet'])) {
            $this->worksheet->setShowGridlines(true);
        }
        if (self::boolean((string) $printOptions['gridLines'])) {
            $this->worksheet->setPrintGridlines(true);
        }
        if (self::boolean((string) $printOptions['horizontalCentered'])) {
            $this->worksheet->getPageSetup()->setHorizontalCentered(true);
        }
        if (self::boolean((string) $printOptions['verticalCentered'])) {
=======
    private function printOptions(SimpleXMLElement $printOptionsx): void
    {
        $printOptions = $printOptionsx->attributes() ?? [];
        if (isset($printOptions['gridLinesSet']) && self::boolean((string) $printOptions['gridLinesSet'])) {
            $this->worksheet->setShowGridlines(true);
        }
        if (isset($printOptions['gridLines']) && self::boolean((string) $printOptions['gridLines'])) {
            $this->worksheet->setPrintGridlines(true);
        }
        if (isset($printOptions['horizontalCentered']) && self::boolean((string) $printOptions['horizontalCentered'])) {
            $this->worksheet->getPageSetup()->setHorizontalCentered(true);
        }
        if (isset($printOptions['verticalCentered']) && self::boolean((string) $printOptions['verticalCentered'])) {
>>>>>>> main
            $this->worksheet->getPageSetup()->setVerticalCentered(true);
        }
    }
}
