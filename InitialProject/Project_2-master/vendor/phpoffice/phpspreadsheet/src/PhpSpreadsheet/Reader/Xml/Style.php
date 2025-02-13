<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml;

<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Style\Protection;
>>>>>>> main
use SimpleXMLElement;

class Style
{
    /**
     * Formats.
     *
     * @var array
     */
    protected $styles = [];

    public function parseStyles(SimpleXMLElement $xml, array $namespaces): array
    {
<<<<<<< HEAD
        if (!isset($xml->Styles)) {
=======
        if (!isset($xml->Styles) || !is_iterable($xml->Styles[0])) {
>>>>>>> main
            return [];
        }

        $alignmentStyleParser = new Style\Alignment();
        $borderStyleParser = new Style\Border();
        $fontStyleParser = new Style\Font();
        $fillStyleParser = new Style\Fill();
        $numberFormatStyleParser = new Style\NumberFormat();

        foreach ($xml->Styles[0] as $style) {
            $style_ss = self::getAttributes($style, $namespaces['ss']);
            $styleID = (string) $style_ss['ID'];
            $this->styles[$styleID] = $this->styles['Default'] ?? [];

<<<<<<< HEAD
            $alignment = $border = $font = $fill = $numberFormat = [];

            foreach ($style as $styleType => $styleDatax) {
                $styleData = $styleDatax ?? new SimpleXMLElement('<xml></xml>');
=======
            $alignment = $border = $font = $fill = $numberFormat = $protection = [];

            foreach ($style as $styleType => $styleDatax) {
                $styleData = self::getSxml($styleDatax);
>>>>>>> main
                $styleAttributes = $styleData->attributes($namespaces['ss']);

                switch ($styleType) {
                    case 'Alignment':
                        if ($styleAttributes) {
                            $alignment = $alignmentStyleParser->parseStyle($styleAttributes);
                        }

                        break;
                    case 'Borders':
                        $border = $borderStyleParser->parseStyle($styleData, $namespaces);

                        break;
                    case 'Font':
                        if ($styleAttributes) {
                            $font = $fontStyleParser->parseStyle($styleAttributes);
                        }

                        break;
                    case 'Interior':
                        if ($styleAttributes) {
                            $fill = $fillStyleParser->parseStyle($styleAttributes);
                        }

                        break;
                    case 'NumberFormat':
                        if ($styleAttributes) {
                            $numberFormat = $numberFormatStyleParser->parseStyle($styleAttributes);
                        }

                        break;
<<<<<<< HEAD
                }
            }

            $this->styles[$styleID] = array_merge($alignment, $border, $font, $fill, $numberFormat);
=======
                    case 'Protection':
                        $locked = $hidden = null;
                        $styleAttributesP = $styleData->attributes($namespaces['x']);
                        if (isset($styleAttributes['Protected'])) {
                            $locked = ((bool) (string) $styleAttributes['Protected']) ? Protection::PROTECTION_PROTECTED : Protection::PROTECTION_UNPROTECTED;
                        }
                        if (isset($styleAttributesP['HideFormula'])) {
                            $hidden = ((bool) (string) $styleAttributesP['HideFormula']) ? Protection::PROTECTION_PROTECTED : Protection::PROTECTION_UNPROTECTED;
                        }
                        if ($locked !== null || $hidden !== null) {
                            $protection['protection'] = [];
                            if ($locked !== null) {
                                $protection['protection']['locked'] = $locked;
                            }
                            if ($hidden !== null) {
                                $protection['protection']['hidden'] = $hidden;
                            }
                        }

                        break;
                }
            }

            $this->styles[$styleID] = array_merge($alignment, $border, $font, $fill, $numberFormat, $protection);
>>>>>>> main
        }

        return $this->styles;
    }

<<<<<<< HEAD
    protected static function getAttributes(?SimpleXMLElement $simple, string $node): SimpleXMLElement
    {
        return ($simple === null)
            ? new SimpleXMLElement('<xml></xml>')
            : ($simple->attributes($node) ?? new SimpleXMLElement('<xml></xml>'));
=======
    private static function getAttributes(?SimpleXMLElement $simple, string $node): SimpleXMLElement
    {
        return ($simple === null) ? new SimpleXMLElement('<xml></xml>') : ($simple->attributes($node) ?? new SimpleXMLElement('<xml></xml>'));
    }

    private static function getSxml(?SimpleXMLElement $simple): SimpleXMLElement
    {
        return ($simple !== null) ? $simple : new SimpleXMLElement('<xml></xml>');
>>>>>>> main
    }
}
