<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xlsx;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
=======
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
>>>>>>> main
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class Style extends WriterPart
{
    /**
     * Write styles to XML format.
     *
     * @return string XML Output
     */
    public function writeStyles(Spreadsheet $spreadsheet)
    {
        // Create XML writer
        $objWriter = null;
        if ($this->getParentWriter()->getUseDiskCaching()) {
            $objWriter = new XMLWriter(XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());
        } else {
            $objWriter = new XMLWriter(XMLWriter::STORAGE_MEMORY);
        }

        // XML header
        $objWriter->startDocument('1.0', 'UTF-8', 'yes');

        // styleSheet
        $objWriter->startElement('styleSheet');
        $objWriter->writeAttribute('xml:space', 'preserve');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');

        // numFmts
        $objWriter->startElement('numFmts');
        $objWriter->writeAttribute('count', $this->getParentWriter()->getNumFmtHashTable()->count());
=======
        $objWriter->writeAttribute('xmlns', Namespaces::MAIN);

        // numFmts
        $objWriter->startElement('numFmts');
        $objWriter->writeAttribute('count', (string) $this->getParentWriter()->getNumFmtHashTable()->count());
>>>>>>> main

        // numFmt
        for ($i = 0; $i < $this->getParentWriter()->getNumFmtHashTable()->count(); ++$i) {
            $this->writeNumFmt($objWriter, $this->getParentWriter()->getNumFmtHashTable()->getByIndex($i), $i);
        }

        $objWriter->endElement();

        // fonts
        $objWriter->startElement('fonts');
<<<<<<< HEAD
        $objWriter->writeAttribute('count', $this->getParentWriter()->getFontHashTable()->count());

        // font
        for ($i = 0; $i < $this->getParentWriter()->getFontHashTable()->count(); ++$i) {
            $this->writeFont($objWriter, $this->getParentWriter()->getFontHashTable()->getByIndex($i));
=======
        $objWriter->writeAttribute('count', (string) $this->getParentWriter()->getFontHashTable()->count());

        // font
        for ($i = 0; $i < $this->getParentWriter()->getFontHashTable()->count(); ++$i) {
            $thisfont = $this->getParentWriter()->getFontHashTable()->getByIndex($i);
            if ($thisfont !== null) {
                $this->writeFont($objWriter, $thisfont);
            }
>>>>>>> main
        }

        $objWriter->endElement();

        // fills
        $objWriter->startElement('fills');
<<<<<<< HEAD
        $objWriter->writeAttribute('count', $this->getParentWriter()->getFillHashTable()->count());

        // fill
        for ($i = 0; $i < $this->getParentWriter()->getFillHashTable()->count(); ++$i) {
            $this->writeFill($objWriter, $this->getParentWriter()->getFillHashTable()->getByIndex($i));
=======
        $objWriter->writeAttribute('count', (string) $this->getParentWriter()->getFillHashTable()->count());

        // fill
        for ($i = 0; $i < $this->getParentWriter()->getFillHashTable()->count(); ++$i) {
            $thisfill = $this->getParentWriter()->getFillHashTable()->getByIndex($i);
            if ($thisfill !== null) {
                $this->writeFill($objWriter, $thisfill);
            }
>>>>>>> main
        }

        $objWriter->endElement();

        // borders
        $objWriter->startElement('borders');
<<<<<<< HEAD
        $objWriter->writeAttribute('count', $this->getParentWriter()->getBordersHashTable()->count());

        // border
        for ($i = 0; $i < $this->getParentWriter()->getBordersHashTable()->count(); ++$i) {
            $this->writeBorder($objWriter, $this->getParentWriter()->getBordersHashTable()->getByIndex($i));
=======
        $objWriter->writeAttribute('count', (string) $this->getParentWriter()->getBordersHashTable()->count());

        // border
        for ($i = 0; $i < $this->getParentWriter()->getBordersHashTable()->count(); ++$i) {
            $thisborder = $this->getParentWriter()->getBordersHashTable()->getByIndex($i);
            if ($thisborder !== null) {
                $this->writeBorder($objWriter, $thisborder);
            }
>>>>>>> main
        }

        $objWriter->endElement();

        // cellStyleXfs
        $objWriter->startElement('cellStyleXfs');
<<<<<<< HEAD
        $objWriter->writeAttribute('count', 1);

        // xf
        $objWriter->startElement('xf');
        $objWriter->writeAttribute('numFmtId', 0);
        $objWriter->writeAttribute('fontId', 0);
        $objWriter->writeAttribute('fillId', 0);
        $objWriter->writeAttribute('borderId', 0);
=======
        $objWriter->writeAttribute('count', '1');

        // xf
        $objWriter->startElement('xf');
        $objWriter->writeAttribute('numFmtId', '0');
        $objWriter->writeAttribute('fontId', '0');
        $objWriter->writeAttribute('fillId', '0');
        $objWriter->writeAttribute('borderId', '0');
>>>>>>> main
        $objWriter->endElement();

        $objWriter->endElement();

        // cellXfs
        $objWriter->startElement('cellXfs');
<<<<<<< HEAD
        $objWriter->writeAttribute('count', count($spreadsheet->getCellXfCollection()));

        // xf
        foreach ($spreadsheet->getCellXfCollection() as $cellXf) {
            $this->writeCellStyleXf($objWriter, $cellXf, $spreadsheet);
=======
        $objWriter->writeAttribute('count', (string) count($spreadsheet->getCellXfCollection()));

        // xf
        $alignment = new Alignment();
        $defaultAlignHash = $alignment->getHashCode();
        if ($defaultAlignHash !== $spreadsheet->getDefaultStyle()->getAlignment()->getHashCode()) {
            $defaultAlignHash = '';
        }
        foreach ($spreadsheet->getCellXfCollection() as $cellXf) {
            $this->writeCellStyleXf($objWriter, $cellXf, $spreadsheet, $defaultAlignHash);
>>>>>>> main
        }

        $objWriter->endElement();

        // cellStyles
        $objWriter->startElement('cellStyles');
<<<<<<< HEAD
        $objWriter->writeAttribute('count', 1);
=======
        $objWriter->writeAttribute('count', '1');
>>>>>>> main

        // cellStyle
        $objWriter->startElement('cellStyle');
        $objWriter->writeAttribute('name', 'Normal');
<<<<<<< HEAD
        $objWriter->writeAttribute('xfId', 0);
        $objWriter->writeAttribute('builtinId', 0);
=======
        $objWriter->writeAttribute('xfId', '0');
        $objWriter->writeAttribute('builtinId', '0');
>>>>>>> main
        $objWriter->endElement();

        $objWriter->endElement();

        // dxfs
        $objWriter->startElement('dxfs');
<<<<<<< HEAD
        $objWriter->writeAttribute('count', $this->getParentWriter()->getStylesConditionalHashTable()->count());

        // dxf
        for ($i = 0; $i < $this->getParentWriter()->getStylesConditionalHashTable()->count(); ++$i) {
            $this->writeCellStyleDxf($objWriter, $this->getParentWriter()->getStylesConditionalHashTable()->getByIndex($i)->getStyle());
=======
        $objWriter->writeAttribute('count', (string) $this->getParentWriter()->getStylesConditionalHashTable()->count());

        // dxf
        for ($i = 0; $i < $this->getParentWriter()->getStylesConditionalHashTable()->count(); ++$i) {
            /** @var ?Conditional */
            $thisstyle = $this->getParentWriter()->getStylesConditionalHashTable()->getByIndex($i);
            if ($thisstyle !== null) {
                $this->writeCellStyleDxf($objWriter, $thisstyle->getStyle());
            }
>>>>>>> main
        }

        $objWriter->endElement();

        // tableStyles
        $objWriter->startElement('tableStyles');
        $objWriter->writeAttribute('defaultTableStyle', 'TableStyleMedium9');
        $objWriter->writeAttribute('defaultPivotStyle', 'PivotTableStyle1');
        $objWriter->endElement();

        $objWriter->endElement();

        // Return
        return $objWriter->getData();
    }

    /**
     * Write Fill.
     */
    private function writeFill(XMLWriter $objWriter, Fill $fill): void
    {
        // Check if this is a pattern type or gradient type
        if (
            $fill->getFillType() === Fill::FILL_GRADIENT_LINEAR ||
            $fill->getFillType() === Fill::FILL_GRADIENT_PATH
        ) {
            // Gradient fill
            $this->writeGradientFill($objWriter, $fill);
        } elseif ($fill->getFillType() !== null) {
            // Pattern fill
            $this->writePatternFill($objWriter, $fill);
        }
    }

    /**
     * Write Gradient Fill.
     */
    private function writeGradientFill(XMLWriter $objWriter, Fill $fill): void
    {
        // fill
        $objWriter->startElement('fill');

        // gradientFill
        $objWriter->startElement('gradientFill');
<<<<<<< HEAD
        $objWriter->writeAttribute('type', $fill->getFillType());
        $objWriter->writeAttribute('degree', $fill->getRotation());
=======
        $objWriter->writeAttribute('type', (string) $fill->getFillType());
        $objWriter->writeAttribute('degree', (string) $fill->getRotation());
>>>>>>> main

        // stop
        $objWriter->startElement('stop');
        $objWriter->writeAttribute('position', '0');

        // color
<<<<<<< HEAD
        $objWriter->startElement('color');
        $objWriter->writeAttribute('rgb', $fill->getStartColor()->getARGB());
        $objWriter->endElement();
=======
        if ($fill->getStartColor()->getARGB() !== null) {
            $objWriter->startElement('color');
            $objWriter->writeAttribute('rgb', $fill->getStartColor()->getARGB());
            $objWriter->endElement();
        }
>>>>>>> main

        $objWriter->endElement();

        // stop
        $objWriter->startElement('stop');
        $objWriter->writeAttribute('position', '1');

        // color
<<<<<<< HEAD
        $objWriter->startElement('color');
        $objWriter->writeAttribute('rgb', $fill->getEndColor()->getARGB());
        $objWriter->endElement();
=======
        if ($fill->getEndColor()->getARGB() !== null) {
            $objWriter->startElement('color');
            $objWriter->writeAttribute('rgb', $fill->getEndColor()->getARGB());
            $objWriter->endElement();
        }
>>>>>>> main

        $objWriter->endElement();

        $objWriter->endElement();

        $objWriter->endElement();
    }

    private static function writePatternColors(Fill $fill): bool
    {
        if ($fill->getFillType() === Fill::FILL_NONE) {
            return false;
        }

        return $fill->getFillType() === Fill::FILL_SOLID || $fill->getColorsChanged();
    }

    /**
     * Write Pattern Fill.
     */
    private function writePatternFill(XMLWriter $objWriter, Fill $fill): void
    {
        // fill
        $objWriter->startElement('fill');

        // patternFill
        $objWriter->startElement('patternFill');
<<<<<<< HEAD
        $objWriter->writeAttribute('patternType', $fill->getFillType());
=======
        $objWriter->writeAttribute('patternType', (string) $fill->getFillType());
>>>>>>> main

        if (self::writePatternColors($fill)) {
            // fgColor
            if ($fill->getStartColor()->getARGB()) {
<<<<<<< HEAD
                $objWriter->startElement('fgColor');
                $objWriter->writeAttribute('rgb', $fill->getStartColor()->getARGB());
=======
                if (!$fill->getEndColor()->getARGB() && $fill->getFillType() === Fill::FILL_SOLID) {
                    $objWriter->startElement('bgColor');
                    $objWriter->writeAttribute('rgb', $fill->getStartColor()->getARGB());
                } else {
                    $objWriter->startElement('fgColor');
                    $objWriter->writeAttribute('rgb', $fill->getStartColor()->getARGB());
                }
>>>>>>> main
                $objWriter->endElement();
            }
            // bgColor
            if ($fill->getEndColor()->getARGB()) {
                $objWriter->startElement('bgColor');
                $objWriter->writeAttribute('rgb', $fill->getEndColor()->getARGB());
                $objWriter->endElement();
            }
        }

        $objWriter->endElement();

        $objWriter->endElement();
    }

<<<<<<< HEAD
=======
    private function startFont(XMLWriter $objWriter, bool &$fontStarted): void
    {
        if (!$fontStarted) {
            $fontStarted = true;
            $objWriter->startElement('font');
        }
    }

>>>>>>> main
    /**
     * Write Font.
     */
    private function writeFont(XMLWriter $objWriter, Font $font): void
    {
<<<<<<< HEAD
        // font
        $objWriter->startElement('font');
=======
        $fontStarted = false;
        // font
>>>>>>> main
        //    Weird! The order of these elements actually makes a difference when opening Xlsx
        //        files in Excel2003 with the compatibility pack. It's not documented behaviour,
        //        and makes for a real WTF!

        // Bold. We explicitly write this element also when false (like MS Office Excel 2007 does
        // for conditional formatting). Otherwise it will apparently not be picked up in conditional
        // formatting style dialog
        if ($font->getBold() !== null) {
<<<<<<< HEAD
=======
            $this->startFont($objWriter, $fontStarted);
>>>>>>> main
            $objWriter->startElement('b');
            $objWriter->writeAttribute('val', $font->getBold() ? '1' : '0');
            $objWriter->endElement();
        }

        // Italic
        if ($font->getItalic() !== null) {
<<<<<<< HEAD
=======
            $this->startFont($objWriter, $fontStarted);
>>>>>>> main
            $objWriter->startElement('i');
            $objWriter->writeAttribute('val', $font->getItalic() ? '1' : '0');
            $objWriter->endElement();
        }

        // Strikethrough
        if ($font->getStrikethrough() !== null) {
<<<<<<< HEAD
=======
            $this->startFont($objWriter, $fontStarted);
>>>>>>> main
            $objWriter->startElement('strike');
            $objWriter->writeAttribute('val', $font->getStrikethrough() ? '1' : '0');
            $objWriter->endElement();
        }

        // Underline
        if ($font->getUnderline() !== null) {
<<<<<<< HEAD
=======
            $this->startFont($objWriter, $fontStarted);
>>>>>>> main
            $objWriter->startElement('u');
            $objWriter->writeAttribute('val', $font->getUnderline());
            $objWriter->endElement();
        }

        // Superscript / subscript
        if ($font->getSuperscript() === true || $font->getSubscript() === true) {
<<<<<<< HEAD
=======
            $this->startFont($objWriter, $fontStarted);
>>>>>>> main
            $objWriter->startElement('vertAlign');
            if ($font->getSuperscript() === true) {
                $objWriter->writeAttribute('val', 'superscript');
            } elseif ($font->getSubscript() === true) {
                $objWriter->writeAttribute('val', 'subscript');
            }
            $objWriter->endElement();
        }

        // Size
        if ($font->getSize() !== null) {
<<<<<<< HEAD
=======
            $this->startFont($objWriter, $fontStarted);
>>>>>>> main
            $objWriter->startElement('sz');
            $objWriter->writeAttribute('val', StringHelper::formatNumber($font->getSize()));
            $objWriter->endElement();
        }

        // Foreground color
        if ($font->getColor()->getARGB() !== null) {
<<<<<<< HEAD
=======
            $this->startFont($objWriter, $fontStarted);
>>>>>>> main
            $objWriter->startElement('color');
            $objWriter->writeAttribute('rgb', $font->getColor()->getARGB());
            $objWriter->endElement();
        }

        // Name
        if ($font->getName() !== null) {
<<<<<<< HEAD
=======
            $this->startFont($objWriter, $fontStarted);
>>>>>>> main
            $objWriter->startElement('name');
            $objWriter->writeAttribute('val', $font->getName());
            $objWriter->endElement();
        }

<<<<<<< HEAD
        $objWriter->endElement();
=======
        if (!empty($font->getScheme())) {
            $this->startFont($objWriter, $fontStarted);
            $objWriter->startElement('scheme');
            $objWriter->writeAttribute('val', $font->getScheme());
            $objWriter->endElement();
        }

        if ($fontStarted) {
            $objWriter->endElement();
        }
>>>>>>> main
    }

    /**
     * Write Border.
     */
    private function writeBorder(XMLWriter $objWriter, Borders $borders): void
    {
        // Write border
        $objWriter->startElement('border');
        // Diagonal?
        switch ($borders->getDiagonalDirection()) {
            case Borders::DIAGONAL_UP:
                $objWriter->writeAttribute('diagonalUp', 'true');
                $objWriter->writeAttribute('diagonalDown', 'false');

                break;
            case Borders::DIAGONAL_DOWN:
                $objWriter->writeAttribute('diagonalUp', 'false');
                $objWriter->writeAttribute('diagonalDown', 'true');

                break;
            case Borders::DIAGONAL_BOTH:
                $objWriter->writeAttribute('diagonalUp', 'true');
                $objWriter->writeAttribute('diagonalDown', 'true');

                break;
        }

        // BorderPr
        $this->writeBorderPr($objWriter, 'left', $borders->getLeft());
        $this->writeBorderPr($objWriter, 'right', $borders->getRight());
        $this->writeBorderPr($objWriter, 'top', $borders->getTop());
        $this->writeBorderPr($objWriter, 'bottom', $borders->getBottom());
        $this->writeBorderPr($objWriter, 'diagonal', $borders->getDiagonal());
        $objWriter->endElement();
    }

<<<<<<< HEAD
    /**
     * Write Cell Style Xf.
     */
    private function writeCellStyleXf(XMLWriter $objWriter, \PhpOffice\PhpSpreadsheet\Style\Style $style, Spreadsheet $spreadsheet): void
    {
        // xf
        $objWriter->startElement('xf');
        $objWriter->writeAttribute('xfId', 0);
        $objWriter->writeAttribute('fontId', (int) $this->getParentWriter()->getFontHashTable()->getIndexForHashCode($style->getFont()->getHashCode()));
        if ($style->getQuotePrefix()) {
            $objWriter->writeAttribute('quotePrefix', 1);
        }

        if ($style->getNumberFormat()->getBuiltInFormatCode() === false) {
            $objWriter->writeAttribute('numFmtId', (int) ($this->getParentWriter()->getNumFmtHashTable()->getIndexForHashCode($style->getNumberFormat()->getHashCode()) + 164));
        } else {
            $objWriter->writeAttribute('numFmtId', (int) $style->getNumberFormat()->getBuiltInFormatCode());
        }

        $objWriter->writeAttribute('fillId', (int) $this->getParentWriter()->getFillHashTable()->getIndexForHashCode($style->getFill()->getHashCode()));
        $objWriter->writeAttribute('borderId', (int) $this->getParentWriter()->getBordersHashTable()->getIndexForHashCode($style->getBorders()->getHashCode()));
=======
    /** @var mixed */
    private static $scrutinizerFalse = false;

    /**
     * Write Cell Style Xf.
     */
    private function writeCellStyleXf(XMLWriter $objWriter, \PhpOffice\PhpSpreadsheet\Style\Style $style, Spreadsheet $spreadsheet, string $defaultAlignHash): void
    {
        // xf
        $objWriter->startElement('xf');
        $objWriter->writeAttribute('xfId', '0');
        $objWriter->writeAttribute('fontId', (string) (int) $this->getParentWriter()->getFontHashTable()->getIndexForHashCode($style->getFont()->getHashCode()));
        if ($style->getQuotePrefix()) {
            $objWriter->writeAttribute('quotePrefix', '1');
        }

        if ($style->getNumberFormat()->getBuiltInFormatCode() === self::$scrutinizerFalse) {
            $objWriter->writeAttribute('numFmtId', (string) (int) ($this->getParentWriter()->getNumFmtHashTable()->getIndexForHashCode($style->getNumberFormat()->getHashCode()) + 164));
        } else {
            $objWriter->writeAttribute('numFmtId', (string) (int) $style->getNumberFormat()->getBuiltInFormatCode());
        }

        $objWriter->writeAttribute('fillId', (string) (int) $this->getParentWriter()->getFillHashTable()->getIndexForHashCode($style->getFill()->getHashCode()));
        $objWriter->writeAttribute('borderId', (string) (int) $this->getParentWriter()->getBordersHashTable()->getIndexForHashCode($style->getBorders()->getHashCode()));
>>>>>>> main

        // Apply styles?
        $objWriter->writeAttribute('applyFont', ($spreadsheet->getDefaultStyle()->getFont()->getHashCode() != $style->getFont()->getHashCode()) ? '1' : '0');
        $objWriter->writeAttribute('applyNumberFormat', ($spreadsheet->getDefaultStyle()->getNumberFormat()->getHashCode() != $style->getNumberFormat()->getHashCode()) ? '1' : '0');
        $objWriter->writeAttribute('applyFill', ($spreadsheet->getDefaultStyle()->getFill()->getHashCode() != $style->getFill()->getHashCode()) ? '1' : '0');
        $objWriter->writeAttribute('applyBorder', ($spreadsheet->getDefaultStyle()->getBorders()->getHashCode() != $style->getBorders()->getHashCode()) ? '1' : '0');
<<<<<<< HEAD
        $objWriter->writeAttribute('applyAlignment', ($spreadsheet->getDefaultStyle()->getAlignment()->getHashCode() != $style->getAlignment()->getHashCode()) ? '1' : '0');
=======
        if ($defaultAlignHash !== '' && $defaultAlignHash === $style->getAlignment()->getHashCode()) {
            $applyAlignment = '0';
        } else {
            $applyAlignment = '1';
        }
        $objWriter->writeAttribute('applyAlignment', $applyAlignment);
>>>>>>> main
        if ($style->getProtection()->getLocked() != Protection::PROTECTION_INHERIT || $style->getProtection()->getHidden() != Protection::PROTECTION_INHERIT) {
            $objWriter->writeAttribute('applyProtection', 'true');
        }

        // alignment
<<<<<<< HEAD
        $objWriter->startElement('alignment');
        $objWriter->writeAttribute('horizontal', $style->getAlignment()->getHorizontal());
        $objWriter->writeAttribute('vertical', $style->getAlignment()->getVertical());

        $textRotation = 0;
        if ($style->getAlignment()->getTextRotation() >= 0) {
            $textRotation = $style->getAlignment()->getTextRotation();
        } elseif ($style->getAlignment()->getTextRotation() < 0) {
            $textRotation = 90 - $style->getAlignment()->getTextRotation();
        }
        $objWriter->writeAttribute('textRotation', $textRotation);

        $objWriter->writeAttribute('wrapText', ($style->getAlignment()->getWrapText() ? 'true' : 'false'));
        $objWriter->writeAttribute('shrinkToFit', ($style->getAlignment()->getShrinkToFit() ? 'true' : 'false'));

        if ($style->getAlignment()->getIndent() > 0) {
            $objWriter->writeAttribute('indent', $style->getAlignment()->getIndent());
        }
        if ($style->getAlignment()->getReadOrder() > 0) {
            $objWriter->writeAttribute('readingOrder', $style->getAlignment()->getReadOrder());
        }
        $objWriter->endElement();
=======
        if ($applyAlignment === '1') {
            $objWriter->startElement('alignment');
            $vertical = Alignment::VERTICAL_ALIGNMENT_FOR_XLSX[$style->getAlignment()->getVertical()] ?? '';
            $horizontal = Alignment::HORIZONTAL_ALIGNMENT_FOR_XLSX[$style->getAlignment()->getHorizontal()] ?? '';
            if ($horizontal !== '') {
                $objWriter->writeAttribute('horizontal', $horizontal);
            }
            if ($vertical !== '') {
                $objWriter->writeAttribute('vertical', $vertical);
            }

            if ($style->getAlignment()->getTextRotation() >= 0) {
                $textRotation = $style->getAlignment()->getTextRotation();
            } else {
                $textRotation = 90 - $style->getAlignment()->getTextRotation();
            }
            $objWriter->writeAttribute('textRotation', (string) $textRotation);

            $objWriter->writeAttribute('wrapText', ($style->getAlignment()->getWrapText() ? 'true' : 'false'));
            $objWriter->writeAttribute('shrinkToFit', ($style->getAlignment()->getShrinkToFit() ? 'true' : 'false'));

            if ($style->getAlignment()->getIndent() > 0) {
                $objWriter->writeAttribute('indent', (string) $style->getAlignment()->getIndent());
            }
            if ($style->getAlignment()->getReadOrder() > 0) {
                $objWriter->writeAttribute('readingOrder', (string) $style->getAlignment()->getReadOrder());
            }
            $objWriter->endElement();
        }
>>>>>>> main

        // protection
        if ($style->getProtection()->getLocked() != Protection::PROTECTION_INHERIT || $style->getProtection()->getHidden() != Protection::PROTECTION_INHERIT) {
            $objWriter->startElement('protection');
            if ($style->getProtection()->getLocked() != Protection::PROTECTION_INHERIT) {
                $objWriter->writeAttribute('locked', ($style->getProtection()->getLocked() == Protection::PROTECTION_PROTECTED ? 'true' : 'false'));
            }
            if ($style->getProtection()->getHidden() != Protection::PROTECTION_INHERIT) {
                $objWriter->writeAttribute('hidden', ($style->getProtection()->getHidden() == Protection::PROTECTION_PROTECTED ? 'true' : 'false'));
            }
            $objWriter->endElement();
        }

        $objWriter->endElement();
    }

    /**
     * Write Cell Style Dxf.
     */
    private function writeCellStyleDxf(XMLWriter $objWriter, \PhpOffice\PhpSpreadsheet\Style\Style $style): void
    {
        // dxf
        $objWriter->startElement('dxf');

        // font
        $this->writeFont($objWriter, $style->getFont());

        // numFmt
        $this->writeNumFmt($objWriter, $style->getNumberFormat());

        // fill
        $this->writeFill($objWriter, $style->getFill());

        // alignment
<<<<<<< HEAD
        $objWriter->startElement('alignment');
        if ($style->getAlignment()->getHorizontal() !== null) {
            $objWriter->writeAttribute('horizontal', $style->getAlignment()->getHorizontal());
        }
        if ($style->getAlignment()->getVertical() !== null) {
            $objWriter->writeAttribute('vertical', $style->getAlignment()->getVertical());
        }

        if ($style->getAlignment()->getTextRotation() !== null) {
            $textRotation = 0;
            if ($style->getAlignment()->getTextRotation() >= 0) {
                $textRotation = $style->getAlignment()->getTextRotation();
            } elseif ($style->getAlignment()->getTextRotation() < 0) {
                $textRotation = 90 - $style->getAlignment()->getTextRotation();
            }
            $objWriter->writeAttribute('textRotation', $textRotation);
        }
        $objWriter->endElement();
=======
        $horizontal = Alignment::HORIZONTAL_ALIGNMENT_FOR_XLSX[$style->getAlignment()->getHorizontal()] ?? '';
        $vertical = Alignment::VERTICAL_ALIGNMENT_FOR_XLSX[$style->getAlignment()->getVertical()] ?? '';
        $rotation = $style->getAlignment()->getTextRotation();
        if ($horizontal || $vertical || $rotation !== null) {
            $objWriter->startElement('alignment');
            if ($horizontal) {
                $objWriter->writeAttribute('horizontal', $horizontal);
            }
            if ($vertical) {
                $objWriter->writeAttribute('vertical', $vertical);
            }

            if ($rotation !== null) {
                if ($rotation >= 0) {
                    $textRotation = $rotation;
                } else {
                    $textRotation = 90 - $rotation;
                }
                $objWriter->writeAttribute('textRotation', (string) $textRotation);
            }
            $objWriter->endElement();
        }
>>>>>>> main

        // border
        $this->writeBorder($objWriter, $style->getBorders());

        // protection
<<<<<<< HEAD
        if (($style->getProtection()->getLocked() !== null) || ($style->getProtection()->getHidden() !== null)) {
=======
        if ((!empty($style->getProtection()->getLocked())) || (!empty($style->getProtection()->getHidden()))) {
>>>>>>> main
            if (
                $style->getProtection()->getLocked() !== Protection::PROTECTION_INHERIT ||
                $style->getProtection()->getHidden() !== Protection::PROTECTION_INHERIT
            ) {
                $objWriter->startElement('protection');
                if (
                    ($style->getProtection()->getLocked() !== null) &&
                    ($style->getProtection()->getLocked() !== Protection::PROTECTION_INHERIT)
                ) {
                    $objWriter->writeAttribute('locked', ($style->getProtection()->getLocked() == Protection::PROTECTION_PROTECTED ? 'true' : 'false'));
                }
                if (
                    ($style->getProtection()->getHidden() !== null) &&
                    ($style->getProtection()->getHidden() !== Protection::PROTECTION_INHERIT)
                ) {
                    $objWriter->writeAttribute('hidden', ($style->getProtection()->getHidden() == Protection::PROTECTION_PROTECTED ? 'true' : 'false'));
                }
                $objWriter->endElement();
            }
        }

        $objWriter->endElement();
    }

    /**
     * Write BorderPr.
     *
     * @param string $name Element name
     */
    private function writeBorderPr(XMLWriter $objWriter, $name, Border $border): void
    {
        // Write BorderPr
<<<<<<< HEAD
        if ($border->getBorderStyle() != Border::BORDER_NONE) {
            $objWriter->startElement($name);
            $objWriter->writeAttribute('style', $border->getBorderStyle());

            // color
            $objWriter->startElement('color');
            $objWriter->writeAttribute('rgb', $border->getColor()->getARGB());
            $objWriter->endElement();

            $objWriter->endElement();
        }
=======
        if ($border->getBorderStyle() === Border::BORDER_OMIT) {
            return;
        }
        $objWriter->startElement($name);
        if ($border->getBorderStyle() !== Border::BORDER_NONE) {
            $objWriter->writeAttribute('style', $border->getBorderStyle());

            // color
            if ($border->getColor()->getARGB() !== null) {
                $objWriter->startElement('color');
                $objWriter->writeAttribute('rgb', $border->getColor()->getARGB());
                $objWriter->endElement();
            }
        }
        $objWriter->endElement();
>>>>>>> main
    }

    /**
     * Write NumberFormat.
     *
     * @param int $id Number Format identifier
     */
<<<<<<< HEAD
    private function writeNumFmt(XMLWriter $objWriter, NumberFormat $numberFormat, $id = 0): void
    {
        // Translate formatcode
        $formatCode = $numberFormat->getFormatCode();
=======
    private function writeNumFmt(XMLWriter $objWriter, ?NumberFormat $numberFormat, $id = 0): void
    {
        // Translate formatcode
        $formatCode = ($numberFormat === null) ? null : $numberFormat->getFormatCode();
>>>>>>> main

        // numFmt
        if ($formatCode !== null) {
            $objWriter->startElement('numFmt');
<<<<<<< HEAD
            $objWriter->writeAttribute('numFmtId', ($id + 164));
=======
            $objWriter->writeAttribute('numFmtId', (string) ($id + 164));
>>>>>>> main
            $objWriter->writeAttribute('formatCode', $formatCode);
            $objWriter->endElement();
        }
    }

    /**
     * Get an array of all styles.
     *
     * @return \PhpOffice\PhpSpreadsheet\Style\Style[] All styles in PhpSpreadsheet
     */
    public function allStyles(Spreadsheet $spreadsheet)
    {
        return $spreadsheet->getCellXfCollection();
    }

    /**
     * Get an array of all conditional styles.
     *
     * @return Conditional[] All conditional styles in PhpSpreadsheet
     */
    public function allConditionalStyles(Spreadsheet $spreadsheet)
    {
        // Get an array of all styles
        $aStyles = [];

        $sheetCount = $spreadsheet->getSheetCount();
        for ($i = 0; $i < $sheetCount; ++$i) {
            foreach ($spreadsheet->getSheet($i)->getConditionalStylesCollection() as $conditionalStyles) {
                foreach ($conditionalStyles as $conditionalStyle) {
                    $aStyles[] = $conditionalStyle;
                }
            }
        }

        return $aStyles;
    }

    /**
     * Get an array of all fills.
     *
     * @return Fill[] All fills in PhpSpreadsheet
     */
    public function allFills(Spreadsheet $spreadsheet)
    {
        // Get an array of unique fills
        $aFills = [];

        // Two first fills are predefined
        $fill0 = new Fill();
        $fill0->setFillType(Fill::FILL_NONE);
        $aFills[] = $fill0;

        $fill1 = new Fill();
        $fill1->setFillType(Fill::FILL_PATTERN_GRAY125);
        $aFills[] = $fill1;
        // The remaining fills
        $aStyles = $this->allStyles($spreadsheet);
        /** @var \PhpOffice\PhpSpreadsheet\Style\Style $style */
        foreach ($aStyles as $style) {
            if (!isset($aFills[$style->getFill()->getHashCode()])) {
                $aFills[$style->getFill()->getHashCode()] = $style->getFill();
            }
        }

        return $aFills;
    }

    /**
     * Get an array of all fonts.
     *
     * @return Font[] All fonts in PhpSpreadsheet
     */
    public function allFonts(Spreadsheet $spreadsheet)
    {
        // Get an array of unique fonts
        $aFonts = [];
        $aStyles = $this->allStyles($spreadsheet);

        /** @var \PhpOffice\PhpSpreadsheet\Style\Style $style */
        foreach ($aStyles as $style) {
            if (!isset($aFonts[$style->getFont()->getHashCode()])) {
                $aFonts[$style->getFont()->getHashCode()] = $style->getFont();
            }
        }

        return $aFonts;
    }

    /**
     * Get an array of all borders.
     *
     * @return Borders[] All borders in PhpSpreadsheet
     */
    public function allBorders(Spreadsheet $spreadsheet)
    {
        // Get an array of unique borders
        $aBorders = [];
        $aStyles = $this->allStyles($spreadsheet);

        /** @var \PhpOffice\PhpSpreadsheet\Style\Style $style */
        foreach ($aStyles as $style) {
            if (!isset($aBorders[$style->getBorders()->getHashCode()])) {
                $aBorders[$style->getBorders()->getHashCode()] = $style->getBorders();
            }
        }

        return $aBorders;
    }

    /**
     * Get an array of all number formats.
     *
     * @return NumberFormat[] All number formats in PhpSpreadsheet
     */
    public function allNumberFormats(Spreadsheet $spreadsheet)
    {
        // Get an array of unique number formats
        $aNumFmts = [];
        $aStyles = $this->allStyles($spreadsheet);

        /** @var \PhpOffice\PhpSpreadsheet\Style\Style $style */
        foreach ($aStyles as $style) {
            if ($style->getNumberFormat()->getBuiltInFormatCode() === false && !isset($aNumFmts[$style->getNumberFormat()->getHashCode()])) {
                $aNumFmts[$style->getNumberFormat()->getHashCode()] = $style->getNumberFormat();
            }
        }

        return $aNumFmts;
    }
}
