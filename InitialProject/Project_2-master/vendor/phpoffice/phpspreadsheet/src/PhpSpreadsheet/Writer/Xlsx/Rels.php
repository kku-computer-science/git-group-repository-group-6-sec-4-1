<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xlsx;

<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
>>>>>>> main
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;

class Rels extends WriterPart
{
    /**
     * Write relationships to XML format.
     *
     * @return string XML Output
     */
    public function writeRelationships(Spreadsheet $spreadsheet)
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

        // Relationships
        $objWriter->startElement('Relationships');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');
=======
        $objWriter->writeAttribute('xmlns', Namespaces::RELATIONSHIPS);
>>>>>>> main

        $customPropertyList = $spreadsheet->getProperties()->getCustomProperties();
        if (!empty($customPropertyList)) {
            // Relationship docProps/app.xml
            $this->writeRelationship(
                $objWriter,
                4,
<<<<<<< HEAD
                'http://schemas.openxmlformats.org/officeDocument/2006/relationships/custom-properties',
=======
                Namespaces::RELATIONSHIPS_CUSTOM_PROPERTIES,
>>>>>>> main
                'docProps/custom.xml'
            );
        }

        // Relationship docProps/app.xml
        $this->writeRelationship(
            $objWriter,
            3,
<<<<<<< HEAD
            'http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties',
=======
            Namespaces::RELATIONSHIPS_EXTENDED_PROPERTIES,
>>>>>>> main
            'docProps/app.xml'
        );

        // Relationship docProps/core.xml
        $this->writeRelationship(
            $objWriter,
            2,
<<<<<<< HEAD
            'http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties',
=======
            Namespaces::CORE_PROPERTIES,
>>>>>>> main
            'docProps/core.xml'
        );

        // Relationship xl/workbook.xml
        $this->writeRelationship(
            $objWriter,
            1,
<<<<<<< HEAD
            'http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument',
            'xl/workbook.xml'
        );
        // a custom UI in workbook ?
=======
            Namespaces::OFFICE_DOCUMENT,
            'xl/workbook.xml'
        );
        // a custom UI in workbook ?
        $target = $spreadsheet->getRibbonXMLData('target');
>>>>>>> main
        if ($spreadsheet->hasRibbon()) {
            $this->writeRelationShip(
                $objWriter,
                5,
<<<<<<< HEAD
                'http://schemas.microsoft.com/office/2006/relationships/ui/extensibility',
                $spreadsheet->getRibbonXMLData('target')
=======
                Namespaces::EXTENSIBILITY,
                is_string($target) ? $target : ''
>>>>>>> main
            );
        }

        $objWriter->endElement();

        return $objWriter->getData();
    }

    /**
     * Write workbook relationships to XML format.
     *
     * @return string XML Output
     */
    public function writeWorkbookRelationships(Spreadsheet $spreadsheet)
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

        // Relationships
        $objWriter->startElement('Relationships');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');
=======
        $objWriter->writeAttribute('xmlns', Namespaces::RELATIONSHIPS);
>>>>>>> main

        // Relationship styles.xml
        $this->writeRelationship(
            $objWriter,
            1,
<<<<<<< HEAD
            'http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles',
=======
            Namespaces::STYLES,
>>>>>>> main
            'styles.xml'
        );

        // Relationship theme/theme1.xml
        $this->writeRelationship(
            $objWriter,
            2,
<<<<<<< HEAD
            'http://schemas.openxmlformats.org/officeDocument/2006/relationships/theme',
=======
            Namespaces::THEME2,
>>>>>>> main
            'theme/theme1.xml'
        );

        // Relationship sharedStrings.xml
        $this->writeRelationship(
            $objWriter,
            3,
<<<<<<< HEAD
            'http://schemas.openxmlformats.org/officeDocument/2006/relationships/sharedStrings',
=======
            Namespaces::SHARED_STRINGS,
>>>>>>> main
            'sharedStrings.xml'
        );

        // Relationships with sheets
        $sheetCount = $spreadsheet->getSheetCount();
        for ($i = 0; $i < $sheetCount; ++$i) {
            $this->writeRelationship(
                $objWriter,
                ($i + 1 + 3),
<<<<<<< HEAD
                'http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet',
=======
                Namespaces::WORKSHEET,
>>>>>>> main
                'worksheets/sheet' . ($i + 1) . '.xml'
            );
        }
        // Relationships for vbaProject if needed
        // id : just after the last sheet
        if ($spreadsheet->hasMacros()) {
            $this->writeRelationShip(
                $objWriter,
                ($i + 1 + 3),
<<<<<<< HEAD
                'http://schemas.microsoft.com/office/2006/relationships/vbaProject',
=======
                Namespaces::VBA,
>>>>>>> main
                'vbaProject.bin'
            );
            ++$i; //increment i if needed for an another relation
        }

        $objWriter->endElement();

        return $objWriter->getData();
    }

    /**
     * Write worksheet relationships to XML format.
     *
     * Numbering is as follows:
     *     rId1                 - Drawings
     *  rId_hyperlink_x     - Hyperlinks
     *
     * @param int $worksheetId
     * @param bool $includeCharts Flag indicating if we should write charts
<<<<<<< HEAD
     *
     * @return string XML Output
     */
    public function writeWorksheetRelationships(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet, $worksheetId = 1, $includeCharts = false)
=======
     * @param int $tableRef Table ID
     *
     * @return string XML Output
     */
    public function writeWorksheetRelationships(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet, $worksheetId = 1, $includeCharts = false, $tableRef = 1)
>>>>>>> main
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

        // Relationships
        $objWriter->startElement('Relationships');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');

        // Write drawing relationships?
        $drawingOriginalIds = [];
        $unparsedLoadedData = $worksheet->getParent()->getUnparsedLoadedData();
=======
        $objWriter->writeAttribute('xmlns', Namespaces::RELATIONSHIPS);

        // Write drawing relationships?
        $drawingOriginalIds = [];
        $unparsedLoadedData = $worksheet->getParentOrThrow()->getUnparsedLoadedData();
>>>>>>> main
        if (isset($unparsedLoadedData['sheets'][$worksheet->getCodeName()]['drawingOriginalIds'])) {
            $drawingOriginalIds = $unparsedLoadedData['sheets'][$worksheet->getCodeName()]['drawingOriginalIds'];
        }

        if ($includeCharts) {
            $charts = $worksheet->getChartCollection();
        } else {
            $charts = [];
        }

        if (($worksheet->getDrawingCollection()->count() > 0) || (count($charts) > 0) || $drawingOriginalIds) {
            $rId = 1;

            // Use original $relPath to get original $rId.
            // Take first. In future can be overwritten.
            // (! synchronize with \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet::writeDrawings)
            reset($drawingOriginalIds);
            $relPath = key($drawingOriginalIds);
            if (isset($drawingOriginalIds[$relPath])) {
                $rId = (int) (substr($drawingOriginalIds[$relPath], 3));
            }

            // Generate new $relPath to write drawing relationship
            $relPath = '../drawings/drawing' . $worksheetId . '.xml';
            $this->writeRelationship(
                $objWriter,
                $rId,
<<<<<<< HEAD
                'http://schemas.openxmlformats.org/officeDocument/2006/relationships/drawing',
=======
                Namespaces::RELATIONSHIPS_DRAWING,
>>>>>>> main
                $relPath
            );
        }

        // Write hyperlink relationships?
        $i = 1;
        foreach ($worksheet->getHyperlinkCollection() as $hyperlink) {
            if (!$hyperlink->isInternal()) {
                $this->writeRelationship(
                    $objWriter,
                    '_hyperlink_' . $i,
<<<<<<< HEAD
                    'http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink',
=======
                    Namespaces::HYPERLINK,
>>>>>>> main
                    $hyperlink->getUrl(),
                    'External'
                );

                ++$i;
            }
        }

        // Write comments relationship?
        $i = 1;
<<<<<<< HEAD
        if (count($worksheet->getComments()) > 0) {
            $this->writeRelationship(
                $objWriter,
                '_comments_vml' . $i,
                'http://schemas.openxmlformats.org/officeDocument/2006/relationships/vmlDrawing',
                '../drawings/vmlDrawing' . $worksheetId . '.vml'
            );

            $this->writeRelationship(
                $objWriter,
                '_comments' . $i,
                'http://schemas.openxmlformats.org/officeDocument/2006/relationships/comments',
=======
        if (count($worksheet->getComments()) > 0 || isset($unparsedLoadedData['sheets'][$worksheet->getCodeName()]['legacyDrawing'])) {
            $this->writeRelationship(
                $objWriter,
                '_comments_vml' . $i,
                Namespaces::VML,
                '../drawings/vmlDrawing' . $worksheetId . '.vml'
            );
        }

        if (count($worksheet->getComments()) > 0) {
            $this->writeRelationship(
                $objWriter,
                '_comments' . $i,
                Namespaces::COMMENTS,
>>>>>>> main
                '../comments' . $worksheetId . '.xml'
            );
        }

<<<<<<< HEAD
=======
        // Write Table
        $tableCount = $worksheet->getTableCollection()->count();
        for ($i = 1; $i <= $tableCount; ++$i) {
            $this->writeRelationship(
                $objWriter,
                '_table_' . $i,
                Namespaces::RELATIONSHIPS_TABLE,
                '../tables/table' . $tableRef++ . '.xml'
            );
        }

>>>>>>> main
        // Write header/footer relationship?
        $i = 1;
        if (count($worksheet->getHeaderFooter()->getImages()) > 0) {
            $this->writeRelationship(
                $objWriter,
                '_headerfooter_vml' . $i,
<<<<<<< HEAD
                'http://schemas.openxmlformats.org/officeDocument/2006/relationships/vmlDrawing',
=======
                Namespaces::VML,
>>>>>>> main
                '../drawings/vmlDrawingHF' . $worksheetId . '.vml'
            );
        }

<<<<<<< HEAD
        $this->writeUnparsedRelationship($worksheet, $objWriter, 'ctrlProps', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/ctrlProp');
        $this->writeUnparsedRelationship($worksheet, $objWriter, 'vmlDrawings', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/vmlDrawing');
        $this->writeUnparsedRelationship($worksheet, $objWriter, 'printerSettings', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/printerSettings');
=======
        $this->writeUnparsedRelationship($worksheet, $objWriter, 'ctrlProps', Namespaces::RELATIONSHIPS_CTRLPROP);
        $this->writeUnparsedRelationship($worksheet, $objWriter, 'vmlDrawings', Namespaces::VML);
        $this->writeUnparsedRelationship($worksheet, $objWriter, 'printerSettings', Namespaces::RELATIONSHIPS_PRINTER_SETTINGS);
>>>>>>> main

        $objWriter->endElement();

        return $objWriter->getData();
    }

<<<<<<< HEAD
    private function writeUnparsedRelationship(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet, XMLWriter $objWriter, $relationship, $type): void
    {
        $unparsedLoadedData = $worksheet->getParent()->getUnparsedLoadedData();
=======
    private function writeUnparsedRelationship(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet, XMLWriter $objWriter, string $relationship, string $type): void
    {
        $unparsedLoadedData = $worksheet->getParentOrThrow()->getUnparsedLoadedData();
>>>>>>> main
        if (!isset($unparsedLoadedData['sheets'][$worksheet->getCodeName()][$relationship])) {
            return;
        }

        foreach ($unparsedLoadedData['sheets'][$worksheet->getCodeName()][$relationship] as $rId => $value) {
<<<<<<< HEAD
            $this->writeRelationship(
                $objWriter,
                $rId,
                $type,
                $value['relFilePath']
            );
=======
            if (substr($rId, 0, 17) !== '_headerfooter_vml') {
                $this->writeRelationship(
                    $objWriter,
                    $rId,
                    $type,
                    $value['relFilePath']
                );
            }
>>>>>>> main
        }
    }

    /**
     * Write drawing relationships to XML format.
     *
     * @param int $chartRef Chart ID
     * @param bool $includeCharts Flag indicating if we should write charts
     *
     * @return string XML Output
     */
    public function writeDrawingRelationships(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet, &$chartRef, $includeCharts = false)
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

        // Relationships
        $objWriter->startElement('Relationships');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');
=======
        $objWriter->writeAttribute('xmlns', Namespaces::RELATIONSHIPS);
>>>>>>> main

        // Loop through images and write relationships
        $i = 1;
        $iterator = $worksheet->getDrawingCollection()->getIterator();
        while ($iterator->valid()) {
            $drawing = $iterator->current();
            if (
                $drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\Drawing
                || $drawing instanceof MemoryDrawing
            ) {
                // Write relationship for image drawing
                $this->writeRelationship(
                    $objWriter,
                    $i,
<<<<<<< HEAD
                    'http://schemas.openxmlformats.org/officeDocument/2006/relationships/image',
=======
                    Namespaces::IMAGE,
>>>>>>> main
                    '../media/' . $drawing->getIndexedFilename()
                );

                $i = $this->writeDrawingHyperLink($objWriter, $drawing, $i);
            }

            $iterator->next();
            ++$i;
        }

        if ($includeCharts) {
            // Loop through charts and write relationships
            $chartCount = $worksheet->getChartCount();
            if ($chartCount > 0) {
                for ($c = 0; $c < $chartCount; ++$c) {
                    $this->writeRelationship(
                        $objWriter,
                        $i++,
<<<<<<< HEAD
                        'http://schemas.openxmlformats.org/officeDocument/2006/relationships/chart',
=======
                        Namespaces::RELATIONSHIPS_CHART,
>>>>>>> main
                        '../charts/chart' . ++$chartRef . '.xml'
                    );
                }
            }
        }

        $objWriter->endElement();

        return $objWriter->getData();
    }

    /**
     * Write header/footer drawing relationships to XML format.
     *
     * @return string XML Output
     */
    public function writeHeaderFooterDrawingRelationships(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet)
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

        // Relationships
        $objWriter->startElement('Relationships');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');
=======
        $objWriter->writeAttribute('xmlns', Namespaces::RELATIONSHIPS);
>>>>>>> main

        // Loop through images and write relationships
        foreach ($worksheet->getHeaderFooter()->getImages() as $key => $value) {
            // Write relationship for image drawing
            $this->writeRelationship(
                $objWriter,
                $key,
<<<<<<< HEAD
                'http://schemas.openxmlformats.org/officeDocument/2006/relationships/image',
=======
                Namespaces::IMAGE,
>>>>>>> main
                '../media/' . $value->getIndexedFilename()
            );
        }

        $objWriter->endElement();

        return $objWriter->getData();
    }

    public function writeVMLDrawingRelationships(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet): string
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

        // Relationships
        $objWriter->startElement('Relationships');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');
=======
        $objWriter->writeAttribute('xmlns', Namespaces::RELATIONSHIPS);
>>>>>>> main

        // Loop through images and write relationships
        foreach ($worksheet->getComments() as $comment) {
            if (!$comment->hasBackgroundImage()) {
                continue;
            }

            $bgImage = $comment->getBackgroundImage();
            $this->writeRelationship(
                $objWriter,
                $bgImage->getImageIndex(),
<<<<<<< HEAD
                'http://schemas.openxmlformats.org/officeDocument/2006/relationships/image',
=======
                Namespaces::IMAGE,
>>>>>>> main
                '../media/' . $bgImage->getMediaFilename()
            );
        }

        $objWriter->endElement();

        return $objWriter->getData();
    }

    /**
     * Write Override content type.
     *
<<<<<<< HEAD
     * @param int $id Relationship ID. rId will be prepended!
=======
     * @param int|string $id Relationship ID. rId will be prepended!
>>>>>>> main
     * @param string $type Relationship type
     * @param string $target Relationship target
     * @param string $targetMode Relationship target mode
     */
    private function writeRelationship(XMLWriter $objWriter, $id, $type, $target, $targetMode = ''): void
    {
        if ($type != '' && $target != '') {
            // Write relationship
            $objWriter->startElement('Relationship');
            $objWriter->writeAttribute('Id', 'rId' . $id);
            $objWriter->writeAttribute('Type', $type);
            $objWriter->writeAttribute('Target', $target);

            if ($targetMode != '') {
                $objWriter->writeAttribute('TargetMode', $targetMode);
            }

            $objWriter->endElement();
        } else {
            throw new WriterException('Invalid parameters passed.');
        }
    }

    private function writeDrawingHyperLink(XMLWriter $objWriter, BaseDrawing $drawing, int $i): int
    {
        if ($drawing->getHyperlink() === null) {
            return $i;
        }

        ++$i;
        $this->writeRelationship(
            $objWriter,
            $i,
<<<<<<< HEAD
            'http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink',
=======
            Namespaces::HYPERLINK,
>>>>>>> main
            $drawing->getHyperlink()->getUrl(),
            $drawing->getHyperlink()->getTypeHyperlink()
        );

        return $i;
    }
}
