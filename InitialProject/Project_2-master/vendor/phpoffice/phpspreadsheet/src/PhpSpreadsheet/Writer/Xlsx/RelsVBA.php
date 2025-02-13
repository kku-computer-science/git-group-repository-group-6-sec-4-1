<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xlsx;

<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
=======
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
>>>>>>> main

class RelsVBA extends WriterPart
{
    /**
     * Write relationships for a signed VBA Project.
     *
     * @return string XML Output
     */
<<<<<<< HEAD
    public function writeVBARelationships(Spreadsheet $spreadsheet)
=======
    public function writeVBARelationships()
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
        $objWriter->startElement('Relationship');
        $objWriter->writeAttribute('Id', 'rId1');
        $objWriter->writeAttribute('Type', 'http://schemas.microsoft.com/office/2006/relationships/vbaProjectSignature');
=======
        $objWriter->writeAttribute('xmlns', Namespaces::RELATIONSHIPS);
        $objWriter->startElement('Relationship');
        $objWriter->writeAttribute('Id', 'rId1');
        $objWriter->writeAttribute('Type', Namespaces::VBA_SIGNATURE);
>>>>>>> main
        $objWriter->writeAttribute('Target', 'vbaProjectSignature.bin');
        $objWriter->endElement();
        $objWriter->endElement();

        return $objWriter->getData();
    }
}
