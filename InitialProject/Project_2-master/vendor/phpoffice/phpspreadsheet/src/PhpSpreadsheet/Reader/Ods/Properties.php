<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Ods;

use PhpOffice\PhpSpreadsheet\Document\Properties as DocumentProperties;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use SimpleXMLElement;

class Properties
{
<<<<<<< HEAD
=======
    /** @var Spreadsheet */
>>>>>>> main
    private $spreadsheet;

    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet = $spreadsheet;
    }

<<<<<<< HEAD
    public function load(SimpleXMLElement $xml, $namespacesMeta): void
=======
    public function load(SimpleXMLElement $xml, array $namespacesMeta): void
>>>>>>> main
    {
        $docProps = $this->spreadsheet->getProperties();
        $officeProperty = $xml->children($namespacesMeta['office']);
        foreach ($officeProperty as $officePropertyData) {
<<<<<<< HEAD
            // @var \SimpleXMLElement $officePropertyData
            if (isset($namespacesMeta['dc'])) {
=======
            if (isset($namespacesMeta['dc'])) {
                /** @scrutinizer ignore-call */
>>>>>>> main
                $officePropertiesDC = $officePropertyData->children($namespacesMeta['dc']);
                $this->setCoreProperties($docProps, $officePropertiesDC);
            }

<<<<<<< HEAD
            $officePropertyMeta = [];
            if (isset($namespacesMeta['dc'])) {
                $officePropertyMeta = $officePropertyData->children($namespacesMeta['meta']);
            }
=======
            $officePropertyMeta = null;
            if (isset($namespacesMeta['dc'])) {
                /** @scrutinizer ignore-call */
                $officePropertyMeta = $officePropertyData->children($namespacesMeta['meta']);
            }
            $officePropertyMeta = $officePropertyMeta ?? [];
>>>>>>> main
            foreach ($officePropertyMeta as $propertyName => $propertyValue) {
                $this->setMetaProperties($namespacesMeta, $propertyValue, $propertyName, $docProps);
            }
        }
    }

    private function setCoreProperties(DocumentProperties $docProps, SimpleXMLElement $officePropertyDC): void
    {
        foreach ($officePropertyDC as $propertyName => $propertyValue) {
            $propertyValue = (string) $propertyValue;
            switch ($propertyName) {
                case 'title':
                    $docProps->setTitle($propertyValue);

                    break;
                case 'subject':
                    $docProps->setSubject($propertyValue);

                    break;
                case 'creator':
                    $docProps->setCreator($propertyValue);
                    $docProps->setLastModifiedBy($propertyValue);

                    break;
                case 'date':
                    $docProps->setModified($propertyValue);

                    break;
                case 'description':
                    $docProps->setDescription($propertyValue);

                    break;
            }
        }
    }

    private function setMetaProperties(
<<<<<<< HEAD
        $namespacesMeta,
        SimpleXMLElement $propertyValue,
        $propertyName,
=======
        array $namespacesMeta,
        SimpleXMLElement $propertyValue,
        string $propertyName,
>>>>>>> main
        DocumentProperties $docProps
    ): void {
        $propertyValueAttributes = $propertyValue->attributes($namespacesMeta['meta']);
        $propertyValue = (string) $propertyValue;
        switch ($propertyName) {
            case 'initial-creator':
                $docProps->setCreator($propertyValue);

                break;
            case 'keyword':
                $docProps->setKeywords($propertyValue);

                break;
            case 'creation-date':
                $docProps->setCreated($propertyValue);

                break;
            case 'user-defined':
                $this->setUserDefinedProperty($propertyValueAttributes, $propertyValue, $docProps);

                break;
        }
    }

<<<<<<< HEAD
=======
    /**
     * @param mixed $propertyValueAttributes
     * @param mixed $propertyValue
     */
>>>>>>> main
    private function setUserDefinedProperty($propertyValueAttributes, $propertyValue, DocumentProperties $docProps): void
    {
        $propertyValueName = '';
        $propertyValueType = DocumentProperties::PROPERTY_TYPE_STRING;
        foreach ($propertyValueAttributes as $key => $value) {
            if ($key == 'name') {
                $propertyValueName = (string) $value;
            } elseif ($key == 'value-type') {
                switch ($value) {
                    case 'date':
                        $propertyValue = DocumentProperties::convertProperty($propertyValue, 'date');
                        $propertyValueType = DocumentProperties::PROPERTY_TYPE_DATE;

                        break;
                    case 'boolean':
                        $propertyValue = DocumentProperties::convertProperty($propertyValue, 'bool');
                        $propertyValueType = DocumentProperties::PROPERTY_TYPE_BOOLEAN;

                        break;
                    case 'float':
                        $propertyValue = DocumentProperties::convertProperty($propertyValue, 'r4');
                        $propertyValueType = DocumentProperties::PROPERTY_TYPE_FLOAT;

                        break;
                    default:
                        $propertyValueType = DocumentProperties::PROPERTY_TYPE_STRING;
                }
            }
        }

        $docProps->setCustomProperty($propertyValueName, $propertyValue, $propertyValueType);
    }
}
