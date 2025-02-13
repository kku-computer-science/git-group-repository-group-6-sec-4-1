<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Chart\Axis;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\GridLines;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
=======
use PhpOffice\PhpSpreadsheet\Chart\ChartColor;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Properties;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\TrendLine;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Style\Font;
>>>>>>> main
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;

class Chart extends WriterPart
{
<<<<<<< HEAD
    protected $calculateCellValues;

=======
>>>>>>> main
    /**
     * @var int
     */
    private $seriesIndex;

    /**
     * Write charts to XML format.
     *
     * @param mixed $calculateCellValues
     *
     * @return string XML Output
     */
    public function writeChart(\PhpOffice\PhpSpreadsheet\Chart\Chart $chart, $calculateCellValues = true)
    {
<<<<<<< HEAD
        $this->calculateCellValues = $calculateCellValues;

=======
>>>>>>> main
        // Create XML writer
        $objWriter = null;
        if ($this->getParentWriter()->getUseDiskCaching()) {
            $objWriter = new XMLWriter(XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());
        } else {
            $objWriter = new XMLWriter(XMLWriter::STORAGE_MEMORY);
        }
        //    Ensure that data series values are up-to-date before we save
<<<<<<< HEAD
        if ($this->calculateCellValues) {
=======
        if ($calculateCellValues) {
>>>>>>> main
            $chart->refresh();
        }

        // XML header
        $objWriter->startDocument('1.0', 'UTF-8', 'yes');

        // c:chartSpace
        $objWriter->startElement('c:chartSpace');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns:c', 'http://schemas.openxmlformats.org/drawingml/2006/chart');
        $objWriter->writeAttribute('xmlns:a', 'http://schemas.openxmlformats.org/drawingml/2006/main');
        $objWriter->writeAttribute('xmlns:r', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships');

        $objWriter->startElement('c:date1904');
        $objWriter->writeAttribute('val', 0);
=======
        $objWriter->writeAttribute('xmlns:c', Namespaces::CHART);
        $objWriter->writeAttribute('xmlns:a', Namespaces::DRAWINGML);
        $objWriter->writeAttribute('xmlns:r', Namespaces::SCHEMA_OFFICE_DOCUMENT);

        $objWriter->startElement('c:date1904');
        $objWriter->writeAttribute('val', '0');
>>>>>>> main
        $objWriter->endElement();
        $objWriter->startElement('c:lang');
        $objWriter->writeAttribute('val', 'en-GB');
        $objWriter->endElement();
        $objWriter->startElement('c:roundedCorners');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', 0);
=======
        $objWriter->writeAttribute('val', $chart->getRoundedCorners() ? '1' : '0');
>>>>>>> main
        $objWriter->endElement();

        $this->writeAlternateContent($objWriter);

        $objWriter->startElement('c:chart');

        $this->writeTitle($objWriter, $chart->getTitle());

        $objWriter->startElement('c:autoTitleDeleted');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', 0);
        $objWriter->endElement();

        $this->writePlotArea($objWriter, $chart->getPlotArea(), $chart->getXAxisLabel(), $chart->getYAxisLabel(), $chart->getChartAxisX(), $chart->getChartAxisY(), $chart->getMajorGridlines(), $chart->getMinorGridlines());
=======
        $objWriter->writeAttribute('val', (string) (int) $chart->getAutoTitleDeleted());
        $objWriter->endElement();

        $objWriter->startElement('c:view3D');
        $surface2D = false;
        $plotArea = $chart->getPlotArea();
        if ($plotArea !== null) {
            $seriesArray = $plotArea->getPlotGroup();
            foreach ($seriesArray as $series) {
                if ($series->getPlotType() === DataSeries::TYPE_SURFACECHART) {
                    $surface2D = true;

                    break;
                }
            }
        }
        $this->writeView3D($objWriter, $chart->getRotX(), 'c:rotX', $surface2D, 90);
        $this->writeView3D($objWriter, $chart->getRotY(), 'c:rotY', $surface2D);
        $this->writeView3D($objWriter, $chart->getRAngAx(), 'c:rAngAx', $surface2D);
        $this->writeView3D($objWriter, $chart->getPerspective(), 'c:perspective', $surface2D);
        $objWriter->endElement(); // view3D

        $this->writePlotArea($objWriter, $chart->getPlotArea(), $chart->getXAxisLabel(), $chart->getYAxisLabel(), $chart->getChartAxisX(), $chart->getChartAxisY());
>>>>>>> main

        $this->writeLegend($objWriter, $chart->getLegend());

        $objWriter->startElement('c:plotVisOnly');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', (int) $chart->getPlotVisibleOnly());
=======
        $objWriter->writeAttribute('val', (string) (int) $chart->getPlotVisibleOnly());
>>>>>>> main
        $objWriter->endElement();

        $objWriter->startElement('c:dispBlanksAs');
        $objWriter->writeAttribute('val', $chart->getDisplayBlanksAs());
        $objWriter->endElement();

        $objWriter->startElement('c:showDLblsOverMax');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', 0);
        $objWriter->endElement();

        $objWriter->endElement();

        $this->writePrintSettings($objWriter);

        $objWriter->endElement();
=======
        $objWriter->writeAttribute('val', '0');
        $objWriter->endElement();

        $objWriter->endElement(); // c:chart

        $objWriter->startElement('c:spPr');
        if ($chart->getNoFill()) {
            $objWriter->startElement('a:noFill');
            $objWriter->endElement(); // a:noFill
        }
        $fillColor = $chart->getFillColor();
        if ($fillColor->isUsable()) {
            $this->writeColor($objWriter, $fillColor);
        }
        $borderLines = $chart->getBorderLines();
        $this->writeLineStyles($objWriter, $borderLines);
        $this->writeEffects($objWriter, $borderLines);
        $objWriter->endElement(); // c:spPr

        $this->writePrintSettings($objWriter);

        $objWriter->endElement(); // c:chartSpace
>>>>>>> main

        // Return
        return $objWriter->getData();
    }

<<<<<<< HEAD
=======
    private function writeView3D(XMLWriter $objWriter, ?int $value, string $tag, bool $surface2D, int $default = 0): void
    {
        if ($value === null && $surface2D) {
            $value = $default;
        }
        if ($value !== null) {
            $objWriter->startElement($tag);
            $objWriter->writeAttribute('val', "$value");
            $objWriter->endElement();
        }
    }

>>>>>>> main
    /**
     * Write Chart Title.
     */
    private function writeTitle(XMLWriter $objWriter, ?Title $title = null): void
    {
        if ($title === null) {
            return;
        }

        $objWriter->startElement('c:title');
        $objWriter->startElement('c:tx');
        $objWriter->startElement('c:rich');

        $objWriter->startElement('a:bodyPr');
        $objWriter->endElement();

        $objWriter->startElement('a:lstStyle');
        $objWriter->endElement();

        $objWriter->startElement('a:p');
<<<<<<< HEAD
=======
        $objWriter->startElement('a:pPr');
        $objWriter->startElement('a:defRPr');
        $objWriter->endElement();
        $objWriter->endElement();
>>>>>>> main

        $caption = $title->getCaption();
        if ((is_array($caption)) && (count($caption) > 0)) {
            $caption = $caption[0];
        }
        $this->getParentWriter()->getWriterPartstringtable()->writeRichTextForCharts($objWriter, $caption, 'a');

        $objWriter->endElement();
        $objWriter->endElement();
        $objWriter->endElement();

        $this->writeLayout($objWriter, $title->getLayout());

        $objWriter->startElement('c:overlay');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', 0);
=======
        $objWriter->writeAttribute('val', ($title->getOverlay()) ? '1' : '0');
>>>>>>> main
        $objWriter->endElement();

        $objWriter->endElement();
    }

    /**
     * Write Chart Legend.
     */
    private function writeLegend(XMLWriter $objWriter, ?Legend $legend = null): void
    {
        if ($legend === null) {
            return;
        }

        $objWriter->startElement('c:legend');

        $objWriter->startElement('c:legendPos');
        $objWriter->writeAttribute('val', $legend->getPosition());
        $objWriter->endElement();

        $this->writeLayout($objWriter, $legend->getLayout());

        $objWriter->startElement('c:overlay');
        $objWriter->writeAttribute('val', ($legend->getOverlay()) ? '1' : '0');
        $objWriter->endElement();

<<<<<<< HEAD
=======
        $objWriter->startElement('c:spPr');
        $fillColor = $legend->getFillColor();
        if ($fillColor->isUsable()) {
            $this->writeColor($objWriter, $fillColor);
        }
        $borderLines = $legend->getBorderLines();
        $this->writeLineStyles($objWriter, $borderLines);
        $this->writeEffects($objWriter, $borderLines);
        $objWriter->endElement(); // c:spPr

        $legendText = $legend->getLegendText();
>>>>>>> main
        $objWriter->startElement('c:txPr');
        $objWriter->startElement('a:bodyPr');
        $objWriter->endElement();

        $objWriter->startElement('a:lstStyle');
        $objWriter->endElement();

        $objWriter->startElement('a:p');
        $objWriter->startElement('a:pPr');
<<<<<<< HEAD
        $objWriter->writeAttribute('rtl', 0);

        $objWriter->startElement('a:defRPr');
        $objWriter->endElement();
        $objWriter->endElement();

        $objWriter->startElement('a:endParaRPr');
        $objWriter->writeAttribute('lang', 'en-US');
        $objWriter->endElement();

        $objWriter->endElement();
        $objWriter->endElement();

        $objWriter->endElement();
=======
        $objWriter->writeAttribute('rtl', '0');

        $objWriter->startElement('a:defRPr');
        if ($legendText !== null) {
            $this->writeColor($objWriter, $legendText->getFillColorObject());
            $this->writeEffects($objWriter, $legendText);
        }
        $objWriter->endElement(); // a:defRpr
        $objWriter->endElement(); // a:pPr

        $objWriter->startElement('a:endParaRPr');
        $objWriter->writeAttribute('lang', 'en-US');
        $objWriter->endElement(); // a:endParaRPr

        $objWriter->endElement(); // a:p
        $objWriter->endElement(); // c:txPr

        $objWriter->endElement(); // c:legend
>>>>>>> main
    }

    /**
     * Write Chart Plot Area.
     */
<<<<<<< HEAD
    private function writePlotArea(XMLWriter $objWriter, PlotArea $plotArea, ?Title $xAxisLabel = null, ?Title $yAxisLabel = null, ?Axis $xAxis = null, ?Axis $yAxis = null, ?GridLines $majorGridlines = null, ?GridLines $minorGridlines = null): void
=======
    private function writePlotArea(XMLWriter $objWriter, ?PlotArea $plotArea, ?Title $xAxisLabel = null, ?Title $yAxisLabel = null, ?Axis $xAxis = null, ?Axis $yAxis = null): void
>>>>>>> main
    {
        if ($plotArea === null) {
            return;
        }

<<<<<<< HEAD
        $id1 = $id2 = 0;
=======
        $id1 = $id2 = $id3 = '0';
>>>>>>> main
        $this->seriesIndex = 0;
        $objWriter->startElement('c:plotArea');

        $layout = $plotArea->getLayout();

        $this->writeLayout($objWriter, $layout);

        $chartTypes = self::getChartType($plotArea);
        $catIsMultiLevelSeries = $valIsMultiLevelSeries = false;
        $plotGroupingType = '';
        $chartType = null;
        foreach ($chartTypes as $chartType) {
            $objWriter->startElement('c:' . $chartType);

            $groupCount = $plotArea->getPlotGroupCount();
            $plotGroup = null;
            for ($i = 0; $i < $groupCount; ++$i) {
                $plotGroup = $plotArea->getPlotGroupByIndex($i);
                $groupType = $plotGroup->getPlotType();
                if ($groupType == $chartType) {
                    $plotStyle = $plotGroup->getPlotStyle();
<<<<<<< HEAD
                    if ($groupType === DataSeries::TYPE_RADARCHART) {
                        $objWriter->startElement('c:radarStyle');
                        $objWriter->writeAttribute('val', $plotStyle);
                        $objWriter->endElement();
                    } elseif ($groupType === DataSeries::TYPE_SCATTERCHART) {
                        $objWriter->startElement('c:scatterStyle');
                        $objWriter->writeAttribute('val', $plotStyle);
                        $objWriter->endElement();
=======
                    if (!empty($plotStyle) && $groupType === DataSeries::TYPE_RADARCHART) {
                        $objWriter->startElement('c:radarStyle');
                        $objWriter->writeAttribute('val', $plotStyle);
                        $objWriter->endElement();
                    } elseif (!empty($plotStyle) && $groupType === DataSeries::TYPE_SCATTERCHART) {
                        $objWriter->startElement('c:scatterStyle');
                        $objWriter->writeAttribute('val', $plotStyle);
                        $objWriter->endElement();
                    } elseif ($groupType === DataSeries::TYPE_SURFACECHART_3D || $groupType === DataSeries::TYPE_SURFACECHART) {
                        $objWriter->startElement('c:wireframe');
                        $objWriter->writeAttribute('val', $plotStyle ? '1' : '0');
                        $objWriter->endElement();
>>>>>>> main
                    }

                    $this->writePlotGroup($plotGroup, $chartType, $objWriter, $catIsMultiLevelSeries, $valIsMultiLevelSeries, $plotGroupingType);
                }
            }

            $this->writeDataLabels($objWriter, $layout);

            if ($chartType === DataSeries::TYPE_LINECHART && $plotGroup) {
                //    Line only, Line3D can't be smoothed
                $objWriter->startElement('c:smooth');
<<<<<<< HEAD
                $objWriter->writeAttribute('val', (int) $plotGroup->getSmoothLine());
                $objWriter->endElement();
            } elseif (($chartType === DataSeries::TYPE_BARCHART) || ($chartType === DataSeries::TYPE_BARCHART_3D)) {
                $objWriter->startElement('c:gapWidth');
                $objWriter->writeAttribute('val', 150);
=======
                $objWriter->writeAttribute('val', (string) (int) $plotGroup->getSmoothLine());
                $objWriter->endElement();
            } elseif (($chartType === DataSeries::TYPE_BARCHART) || ($chartType === DataSeries::TYPE_BARCHART_3D)) {
                $objWriter->startElement('c:gapWidth');
                $objWriter->writeAttribute('val', '150');
>>>>>>> main
                $objWriter->endElement();

                if ($plotGroupingType == 'percentStacked' || $plotGroupingType == 'stacked') {
                    $objWriter->startElement('c:overlap');
<<<<<<< HEAD
                    $objWriter->writeAttribute('val', 100);
                    $objWriter->endElement();
                }
            } elseif ($chartType === DataSeries::TYPE_BUBBLECHART) {
                $objWriter->startElement('c:bubbleScale');
                $objWriter->writeAttribute('val', 25);
                $objWriter->endElement();

                $objWriter->startElement('c:showNegBubbles');
                $objWriter->writeAttribute('val', 0);
=======
                    $objWriter->writeAttribute('val', '100');
                    $objWriter->endElement();
                }
            } elseif ($chartType === DataSeries::TYPE_BUBBLECHART) {
                $scale = ($plotGroup === null) ? '' : (string) $plotGroup->getPlotStyle();
                if ($scale !== '') {
                    $objWriter->startElement('c:bubbleScale');
                    $objWriter->writeAttribute('val', $scale);
                    $objWriter->endElement();
                }

                $objWriter->startElement('c:showNegBubbles');
                $objWriter->writeAttribute('val', '0');
>>>>>>> main
                $objWriter->endElement();
            } elseif ($chartType === DataSeries::TYPE_STOCKCHART) {
                $objWriter->startElement('c:hiLowLines');
                $objWriter->endElement();

<<<<<<< HEAD
                $objWriter->startElement('c:upDownBars');

                $objWriter->startElement('c:gapWidth');
                $objWriter->writeAttribute('val', 300);
                $objWriter->endElement();

                $objWriter->startElement('c:upBars');
                $objWriter->endElement();

                $objWriter->startElement('c:downBars');
                $objWriter->endElement();

                $objWriter->endElement();
            }

            //    Generate 2 unique numbers to use for axId values
            $id1 = '75091328';
            $id2 = '75089408';
=======
                $gapWidth = $plotArea->getGapWidth();
                $upBars = $plotArea->getUseUpBars();
                $downBars = $plotArea->getUseDownBars();
                if ($gapWidth !== null || $upBars || $downBars) {
                    $objWriter->startElement('c:upDownBars');
                    if ($gapWidth !== null) {
                        $objWriter->startElement('c:gapWidth');
                        $objWriter->writeAttribute('val', "$gapWidth");
                        $objWriter->endElement();
                    }
                    if ($upBars) {
                        $objWriter->startElement('c:upBars');
                        $objWriter->endElement();
                    }
                    if ($downBars) {
                        $objWriter->startElement('c:downBars');
                        $objWriter->endElement();
                    }
                    $objWriter->endElement(); // c:upDownBars
                }
            }

            //    Generate 3 unique numbers to use for axId values
            $id1 = '110438656';
            $id2 = '110444544';
            $id3 = '110365312'; // used in Surface Chart
>>>>>>> main

            if (($chartType !== DataSeries::TYPE_PIECHART) && ($chartType !== DataSeries::TYPE_PIECHART_3D) && ($chartType !== DataSeries::TYPE_DONUTCHART)) {
                $objWriter->startElement('c:axId');
                $objWriter->writeAttribute('val', $id1);
                $objWriter->endElement();
                $objWriter->startElement('c:axId');
                $objWriter->writeAttribute('val', $id2);
                $objWriter->endElement();
<<<<<<< HEAD
            } else {
                $objWriter->startElement('c:firstSliceAng');
                $objWriter->writeAttribute('val', 0);
=======
                if ($chartType === DataSeries::TYPE_SURFACECHART_3D || $chartType === DataSeries::TYPE_SURFACECHART) {
                    $objWriter->startElement('c:axId');
                    $objWriter->writeAttribute('val', $id3);
                    $objWriter->endElement();
                }
            } else {
                $objWriter->startElement('c:firstSliceAng');
                $objWriter->writeAttribute('val', '0');
>>>>>>> main
                $objWriter->endElement();

                if ($chartType === DataSeries::TYPE_DONUTCHART) {
                    $objWriter->startElement('c:holeSize');
<<<<<<< HEAD
                    $objWriter->writeAttribute('val', 50);
=======
                    $objWriter->writeAttribute('val', '50');
>>>>>>> main
                    $objWriter->endElement();
                }
            }

            $objWriter->endElement();
        }

        if (($chartType !== DataSeries::TYPE_PIECHART) && ($chartType !== DataSeries::TYPE_PIECHART_3D) && ($chartType !== DataSeries::TYPE_DONUTCHART)) {
            if ($chartType === DataSeries::TYPE_BUBBLECHART) {
<<<<<<< HEAD
                $this->writeValueAxis($objWriter, $xAxisLabel, $chartType, $id1, $id2, $catIsMultiLevelSeries, $xAxis, $majorGridlines, $minorGridlines);
            } else {
                $this->writeCategoryAxis($objWriter, $xAxisLabel, $id1, $id2, $catIsMultiLevelSeries, $xAxis);
            }

            $this->writeValueAxis($objWriter, $yAxisLabel, $chartType, $id1, $id2, $valIsMultiLevelSeries, $yAxis, $majorGridlines, $minorGridlines);
        }

        $objWriter->endElement();
=======
                $this->writeValueAxis($objWriter, $xAxisLabel, $chartType, $id2, $id1, $catIsMultiLevelSeries, $xAxis ?? new Axis());
            } else {
                $this->writeCategoryAxis($objWriter, $xAxisLabel, $id1, $id2, $catIsMultiLevelSeries, $xAxis ?? new Axis());
            }

            $this->writeValueAxis($objWriter, $yAxisLabel, $chartType, $id1, $id2, $valIsMultiLevelSeries, $yAxis ?? new Axis());
            if ($chartType === DataSeries::TYPE_SURFACECHART_3D || $chartType === DataSeries::TYPE_SURFACECHART) {
                $this->writeSerAxis($objWriter, $id2, $id3);
            }
        }
        $stops = $plotArea->getGradientFillStops();
        if ($plotArea->getNoFill() || !empty($stops)) {
            $objWriter->startElement('c:spPr');
            if ($plotArea->getNoFill()) {
                $objWriter->startElement('a:noFill');
                $objWriter->endElement(); // a:noFill
            }
            if (!empty($stops)) {
                $objWriter->startElement('a:gradFill');
                $objWriter->startElement('a:gsLst');
                foreach ($stops as $stop) {
                    $objWriter->startElement('a:gs');
                    $objWriter->writeAttribute('pos', (string) (Properties::PERCENTAGE_MULTIPLIER * (float) $stop[0]));
                    $this->writeColor($objWriter, $stop[1], false);
                    $objWriter->endElement(); // a:gs
                }
                $objWriter->endElement(); // a:gsLst
                $angle = $plotArea->getGradientFillAngle();
                if ($angle !== null) {
                    $objWriter->startElement('a:lin');
                    $objWriter->writeAttribute('ang', Properties::angleToXml($angle));
                    $objWriter->endElement(); // a:lin
                }
                $objWriter->endElement(); // a:gradFill
            }
            $objWriter->endElement(); // c:spPr
        }

        $objWriter->endElement(); // c:plotArea
    }

    private function writeDataLabelsBool(XMLWriter $objWriter, string $name, ?bool $value): void
    {
        if ($value !== null) {
            $objWriter->startElement("c:$name");
            $objWriter->writeAttribute('val', $value ? '1' : '0');
            $objWriter->endElement();
        }
>>>>>>> main
    }

    /**
     * Write Data Labels.
     */
    private function writeDataLabels(XMLWriter $objWriter, ?Layout $chartLayout = null): void
    {
<<<<<<< HEAD
        $objWriter->startElement('c:dLbls');

        $objWriter->startElement('c:showLegendKey');
        $showLegendKey = (empty($chartLayout)) ? 0 : $chartLayout->getShowLegendKey();
        $objWriter->writeAttribute('val', ((empty($showLegendKey)) ? 0 : 1));
        $objWriter->endElement();

        $objWriter->startElement('c:showVal');
        $showVal = (empty($chartLayout)) ? 0 : $chartLayout->getShowVal();
        $objWriter->writeAttribute('val', ((empty($showVal)) ? 0 : 1));
        $objWriter->endElement();

        $objWriter->startElement('c:showCatName');
        $showCatName = (empty($chartLayout)) ? 0 : $chartLayout->getShowCatName();
        $objWriter->writeAttribute('val', ((empty($showCatName)) ? 0 : 1));
        $objWriter->endElement();

        $objWriter->startElement('c:showSerName');
        $showSerName = (empty($chartLayout)) ? 0 : $chartLayout->getShowSerName();
        $objWriter->writeAttribute('val', ((empty($showSerName)) ? 0 : 1));
        $objWriter->endElement();

        $objWriter->startElement('c:showPercent');
        $showPercent = (empty($chartLayout)) ? 0 : $chartLayout->getShowPercent();
        $objWriter->writeAttribute('val', ((empty($showPercent)) ? 0 : 1));
        $objWriter->endElement();

        $objWriter->startElement('c:showBubbleSize');
        $showBubbleSize = (empty($chartLayout)) ? 0 : $chartLayout->getShowBubbleSize();
        $objWriter->writeAttribute('val', ((empty($showBubbleSize)) ? 0 : 1));
        $objWriter->endElement();

        $objWriter->startElement('c:showLeaderLines');
        $showLeaderLines = (empty($chartLayout)) ? 1 : $chartLayout->getShowLeaderLines();
        $objWriter->writeAttribute('val', ((empty($showLeaderLines)) ? 0 : 1));
        $objWriter->endElement();

        $objWriter->endElement();
=======
        if (!isset($chartLayout)) {
            return;
        }
        $objWriter->startElement('c:dLbls');

        $fillColor = $chartLayout->getLabelFillColor();
        $borderColor = $chartLayout->getLabelBorderColor();
        if ($fillColor && $fillColor->isUsable()) {
            $objWriter->startElement('c:spPr');
            $this->writeColor($objWriter, $fillColor);
            if ($borderColor && $borderColor->isUsable()) {
                $objWriter->startElement('a:ln');
                $this->writeColor($objWriter, $borderColor);
                $objWriter->endElement(); // a:ln
            }
            $objWriter->endElement(); // c:spPr
        }
        $labelFont = $chartLayout->getLabelFont();
        if ($labelFont !== null) {
            $objWriter->startElement('c:txPr');

            $objWriter->startElement('a:bodyPr');
            $objWriter->writeAttribute('wrap', 'square');
            $objWriter->writeAttribute('lIns', '38100');
            $objWriter->writeAttribute('tIns', '19050');
            $objWriter->writeAttribute('rIns', '38100');
            $objWriter->writeAttribute('bIns', '19050');
            $objWriter->writeAttribute('anchor', 'ctr');
            $objWriter->startElement('a:spAutoFit');
            $objWriter->endElement(); // a:spAutoFit
            $objWriter->endElement(); // a:bodyPr

            $objWriter->startElement('a:lstStyle');
            $objWriter->endElement(); // a:lstStyle
            $this->writeLabelFont($objWriter, $labelFont, $chartLayout->getLabelEffects());

            $objWriter->endElement(); // c:txPr
        }

        if ($chartLayout->getNumFmtCode() !== '') {
            $objWriter->startElement('c:numFmt');
            $objWriter->writeAttribute('formatCode', $chartLayout->getnumFmtCode());
            $objWriter->writeAttribute('sourceLinked', (string) (int) $chartLayout->getnumFmtLinked());
            $objWriter->endElement(); // c:numFmt
        }
        if ($chartLayout->getDLblPos() !== '') {
            $objWriter->startElement('c:dLblPos');
            $objWriter->writeAttribute('val', $chartLayout->getDLblPos());
            $objWriter->endElement(); // c:dLblPos
        }
        $this->writeDataLabelsBool($objWriter, 'showLegendKey', $chartLayout->getShowLegendKey());
        $this->writeDataLabelsBool($objWriter, 'showVal', $chartLayout->getShowVal());
        $this->writeDataLabelsBool($objWriter, 'showCatName', $chartLayout->getShowCatName());
        $this->writeDataLabelsBool($objWriter, 'showSerName', $chartLayout->getShowSerName());
        $this->writeDataLabelsBool($objWriter, 'showPercent', $chartLayout->getShowPercent());
        $this->writeDataLabelsBool($objWriter, 'showBubbleSize', $chartLayout->getShowBubbleSize());
        $this->writeDataLabelsBool($objWriter, 'showLeaderLines', $chartLayout->getShowLeaderLines());

        $objWriter->endElement(); // c:dLbls
>>>>>>> main
    }

    /**
     * Write Category Axis.
     *
     * @param string $id1
     * @param string $id2
     * @param bool $isMultiLevelSeries
     */
    private function writeCategoryAxis(XMLWriter $objWriter, ?Title $xAxisLabel, $id1, $id2, $isMultiLevelSeries, Axis $yAxis): void
    {
<<<<<<< HEAD
        $objWriter->startElement('c:catAx');

        if ($id1 > 0) {
=======
        // N.B. writeCategoryAxis may be invoked with the last parameter($yAxis) using $xAxis for ScatterChart, etc
        // In that case, xAxis may contain values like the yAxis, or it may be a date axis (LINECHART).
        $axisType = $yAxis->getAxisType();
        if ($axisType !== '') {
            $objWriter->startElement("c:$axisType");
        } elseif ($yAxis->getAxisIsNumericFormat()) {
            $objWriter->startElement('c:' . Axis::AXIS_TYPE_VALUE);
        } else {
            $objWriter->startElement('c:' . Axis::AXIS_TYPE_CATEGORY);
        }
        $majorGridlines = $yAxis->getMajorGridlines();
        $minorGridlines = $yAxis->getMinorGridlines();

        if ($id1 !== '0') {
>>>>>>> main
            $objWriter->startElement('c:axId');
            $objWriter->writeAttribute('val', $id1);
            $objWriter->endElement();
        }

        $objWriter->startElement('c:scaling');
<<<<<<< HEAD
        $objWriter->startElement('c:orientation');
        $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('orientation'));
        $objWriter->endElement();
        $objWriter->endElement();

        $objWriter->startElement('c:delete');
        $objWriter->writeAttribute('val', 0);
=======
        if ($yAxis->getAxisOptionsProperty('maximum') !== null) {
            $objWriter->startElement('c:max');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('maximum'));
            $objWriter->endElement();
        }
        if ($yAxis->getAxisOptionsProperty('minimum') !== null) {
            $objWriter->startElement('c:min');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('minimum'));
            $objWriter->endElement();
        }
        if (!empty($yAxis->getAxisOptionsProperty('orientation'))) {
            $objWriter->startElement('c:orientation');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('orientation'));
            $objWriter->endElement();
        }
        $objWriter->endElement(); // c:scaling

        $objWriter->startElement('c:delete');
        $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('hidden') ?? '0');
>>>>>>> main
        $objWriter->endElement();

        $objWriter->startElement('c:axPos');
        $objWriter->writeAttribute('val', 'b');
        $objWriter->endElement();

<<<<<<< HEAD
=======
        if ($majorGridlines !== null) {
            $objWriter->startElement('c:majorGridlines');
            $objWriter->startElement('c:spPr');
            $this->writeLineStyles($objWriter, $majorGridlines);
            $this->writeEffects($objWriter, $majorGridlines);
            $objWriter->endElement(); //end spPr
            $objWriter->endElement(); //end majorGridLines
        }

        if ($minorGridlines !== null && $minorGridlines->getObjectState()) {
            $objWriter->startElement('c:minorGridlines');
            $objWriter->startElement('c:spPr');
            $this->writeLineStyles($objWriter, $minorGridlines);
            $this->writeEffects($objWriter, $minorGridlines);
            $objWriter->endElement(); //end spPr
            $objWriter->endElement(); //end minorGridLines
        }

>>>>>>> main
        if ($xAxisLabel !== null) {
            $objWriter->startElement('c:title');
            $objWriter->startElement('c:tx');
            $objWriter->startElement('c:rich');

            $objWriter->startElement('a:bodyPr');
            $objWriter->endElement();

            $objWriter->startElement('a:lstStyle');
            $objWriter->endElement();

            $objWriter->startElement('a:p');
<<<<<<< HEAD
            $objWriter->startElement('a:r');
=======
>>>>>>> main

            $caption = $xAxisLabel->getCaption();
            if (is_array($caption)) {
                $caption = $caption[0];
            }
<<<<<<< HEAD
            $objWriter->startElement('a:t');
            $objWriter->writeRawData(StringHelper::controlCharacterPHP2OOXML($caption));
            $objWriter->endElement();
=======
            $this->getParentWriter()->getWriterPartstringtable()->writeRichTextForCharts($objWriter, $caption, 'a');
>>>>>>> main

            $objWriter->endElement();
            $objWriter->endElement();
            $objWriter->endElement();
<<<<<<< HEAD
            $objWriter->endElement();
=======
>>>>>>> main

            $layout = $xAxisLabel->getLayout();
            $this->writeLayout($objWriter, $layout);

            $objWriter->startElement('c:overlay');
<<<<<<< HEAD
            $objWriter->writeAttribute('val', 0);
=======
            $objWriter->writeAttribute('val', '0');
>>>>>>> main
            $objWriter->endElement();

            $objWriter->endElement();
        }

        $objWriter->startElement('c:numFmt');
        $objWriter->writeAttribute('formatCode', $yAxis->getAxisNumberFormat());
        $objWriter->writeAttribute('sourceLinked', $yAxis->getAxisNumberSourceLinked());
        $objWriter->endElement();

<<<<<<< HEAD
        $objWriter->startElement('c:majorTickMark');
        $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('major_tick_mark'));
        $objWriter->endElement();

        $objWriter->startElement('c:minorTickMark');
        $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('minor_tick_mark'));
        $objWriter->endElement();

        $objWriter->startElement('c:tickLblPos');
        $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('axis_labels'));
        $objWriter->endElement();

        if ($id2 > 0) {
=======
        if (!empty($yAxis->getAxisOptionsProperty('major_tick_mark'))) {
            $objWriter->startElement('c:majorTickMark');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('major_tick_mark'));
            $objWriter->endElement();
        }

        if (!empty($yAxis->getAxisOptionsProperty('minor_tick_mark'))) {
            $objWriter->startElement('c:minorTickMark');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('minor_tick_mark'));
            $objWriter->endElement();
        }

        if (!empty($yAxis->getAxisOptionsProperty('axis_labels'))) {
            $objWriter->startElement('c:tickLblPos');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('axis_labels'));
            $objWriter->endElement();
        }

        $textRotation = $yAxis->getAxisOptionsProperty('textRotation');
        $axisText = $yAxis->getAxisText();

        if ($axisText !== null || is_numeric($textRotation)) {
            $objWriter->startElement('c:txPr');
            $objWriter->startElement('a:bodyPr');
            if (is_numeric($textRotation)) {
                $objWriter->writeAttribute('rot', Properties::angleToXml((float) $textRotation));
            }
            $objWriter->endElement(); // a:bodyPr
            $objWriter->startElement('a:lstStyle');
            $objWriter->endElement(); // a:lstStyle
            $this->writeLabelFont($objWriter, ($axisText === null) ? null : $axisText->getFont(), $axisText);
            $objWriter->endElement(); // c:txPr
        }

        $objWriter->startElement('c:spPr');
        $this->writeColor($objWriter, $yAxis->getFillColorObject());
        $this->writeLineStyles($objWriter, $yAxis, $yAxis->getNoFill());
        $this->writeEffects($objWriter, $yAxis);
        $objWriter->endElement(); // spPr

        if ($yAxis->getAxisOptionsProperty('major_unit') !== null) {
            $objWriter->startElement('c:majorUnit');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('major_unit'));
            $objWriter->endElement();
        }

        if ($yAxis->getAxisOptionsProperty('minor_unit') !== null) {
            $objWriter->startElement('c:minorUnit');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('minor_unit'));
            $objWriter->endElement();
        }

        if ($id2 !== '0') {
>>>>>>> main
            $objWriter->startElement('c:crossAx');
            $objWriter->writeAttribute('val', $id2);
            $objWriter->endElement();

<<<<<<< HEAD
            $objWriter->startElement('c:crosses');
            $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('horizontal_crosses'));
            $objWriter->endElement();
        }

        $objWriter->startElement('c:auto');
        $objWriter->writeAttribute('val', 1);
=======
            if (!empty($yAxis->getAxisOptionsProperty('horizontal_crosses'))) {
                $objWriter->startElement('c:crosses');
                $objWriter->writeAttribute('val', $yAxis->getAxisOptionsProperty('horizontal_crosses'));
                $objWriter->endElement();
            }
        }

        $objWriter->startElement('c:auto');
        // LineChart with dateAx wants '0'
        $objWriter->writeAttribute('val', ($axisType === Axis::AXIS_TYPE_DATE) ? '0' : '1');
>>>>>>> main
        $objWriter->endElement();

        $objWriter->startElement('c:lblAlgn');
        $objWriter->writeAttribute('val', 'ctr');
        $objWriter->endElement();

        $objWriter->startElement('c:lblOffset');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', 100);
        $objWriter->endElement();

        if ($isMultiLevelSeries) {
            $objWriter->startElement('c:noMultiLvlLbl');
            $objWriter->writeAttribute('val', 0);
=======
        $objWriter->writeAttribute('val', '100');
        $objWriter->endElement();

        if ($axisType === Axis::AXIS_TYPE_DATE) {
            $property = 'baseTimeUnit';
            $propertyVal = $yAxis->getAxisOptionsProperty($property);
            if (!empty($propertyVal)) {
                $objWriter->startElement("c:$property");
                $objWriter->writeAttribute('val', $propertyVal);
                $objWriter->endElement();
            }
            $property = 'majorTimeUnit';
            $propertyVal = $yAxis->getAxisOptionsProperty($property);
            if (!empty($propertyVal)) {
                $objWriter->startElement("c:$property");
                $objWriter->writeAttribute('val', $propertyVal);
                $objWriter->endElement();
            }
            $property = 'minorTimeUnit';
            $propertyVal = $yAxis->getAxisOptionsProperty($property);
            if (!empty($propertyVal)) {
                $objWriter->startElement("c:$property");
                $objWriter->writeAttribute('val', $propertyVal);
                $objWriter->endElement();
            }
        }

        if ($isMultiLevelSeries) {
            $objWriter->startElement('c:noMultiLvlLbl');
            $objWriter->writeAttribute('val', '0');
>>>>>>> main
            $objWriter->endElement();
        }
        $objWriter->endElement();
    }

    /**
     * Write Value Axis.
     *
     * @param null|string $groupType Chart type
     * @param string $id1
     * @param string $id2
     * @param bool $isMultiLevelSeries
     */
<<<<<<< HEAD
    private function writeValueAxis(XMLWriter $objWriter, ?Title $yAxisLabel, $groupType, $id1, $id2, $isMultiLevelSeries, Axis $xAxis, GridLines $majorGridlines, GridLines $minorGridlines): void
    {
        $objWriter->startElement('c:valAx');

        if ($id2 > 0) {
=======
    private function writeValueAxis(XMLWriter $objWriter, ?Title $yAxisLabel, $groupType, $id1, $id2, $isMultiLevelSeries, Axis $xAxis): void
    {
        $objWriter->startElement('c:' . Axis::AXIS_TYPE_VALUE);
        $majorGridlines = $xAxis->getMajorGridlines();
        $minorGridlines = $xAxis->getMinorGridlines();

        if ($id2 !== '0') {
>>>>>>> main
            $objWriter->startElement('c:axId');
            $objWriter->writeAttribute('val', $id2);
            $objWriter->endElement();
        }

        $objWriter->startElement('c:scaling');

        if ($xAxis->getAxisOptionsProperty('maximum') !== null) {
            $objWriter->startElement('c:max');
            $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('maximum'));
            $objWriter->endElement();
        }

        if ($xAxis->getAxisOptionsProperty('minimum') !== null) {
            $objWriter->startElement('c:min');
            $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('minimum'));
            $objWriter->endElement();
        }

<<<<<<< HEAD
        $objWriter->startElement('c:orientation');
        $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('orientation'));

        $objWriter->endElement();
        $objWriter->endElement();

        $objWriter->startElement('c:delete');
        $objWriter->writeAttribute('val', 0);
=======
        if (!empty($xAxis->getAxisOptionsProperty('orientation'))) {
            $objWriter->startElement('c:orientation');
            $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('orientation'));
            $objWriter->endElement();
        }

        $objWriter->endElement(); // c:scaling

        $objWriter->startElement('c:delete');
        $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('hidden') ?? '0');
>>>>>>> main
        $objWriter->endElement();

        $objWriter->startElement('c:axPos');
        $objWriter->writeAttribute('val', 'l');
        $objWriter->endElement();

<<<<<<< HEAD
        $objWriter->startElement('c:majorGridlines');
        $objWriter->startElement('c:spPr');

        if ($majorGridlines->getLineColorProperty('value') !== null) {
            $objWriter->startElement('a:ln');
            $objWriter->writeAttribute('w', $majorGridlines->getLineStyleProperty('width'));
            $objWriter->startElement('a:solidFill');
            $objWriter->startElement("a:{$majorGridlines->getLineColorProperty('type')}");
            $objWriter->writeAttribute('val', $majorGridlines->getLineColorProperty('value'));
            $objWriter->startElement('a:alpha');
            $objWriter->writeAttribute('val', $majorGridlines->getLineColorProperty('alpha'));
            $objWriter->endElement(); //end alpha
            $objWriter->endElement(); //end srgbClr
            $objWriter->endElement(); //end solidFill

            $objWriter->startElement('a:prstDash');
            $objWriter->writeAttribute('val', $majorGridlines->getLineStyleProperty('dash'));
            $objWriter->endElement();

            if ($majorGridlines->getLineStyleProperty('join') == 'miter') {
                $objWriter->startElement('a:miter');
                $objWriter->writeAttribute('lim', '800000');
                $objWriter->endElement();
            } else {
                $objWriter->startElement('a:bevel');
                $objWriter->endElement();
            }

            if ($majorGridlines->getLineStyleProperty(['arrow', 'head', 'type']) !== null) {
                $objWriter->startElement('a:headEnd');
                $objWriter->writeAttribute('type', $majorGridlines->getLineStyleProperty(['arrow', 'head', 'type']));
                $objWriter->writeAttribute('w', $majorGridlines->getLineStyleArrowParameters('head', 'w'));
                $objWriter->writeAttribute('len', $majorGridlines->getLineStyleArrowParameters('head', 'len'));
                $objWriter->endElement();
            }

            if ($majorGridlines->getLineStyleProperty(['arrow', 'end', 'type']) !== null) {
                $objWriter->startElement('a:tailEnd');
                $objWriter->writeAttribute('type', $majorGridlines->getLineStyleProperty(['arrow', 'end', 'type']));
                $objWriter->writeAttribute('w', $majorGridlines->getLineStyleArrowParameters('end', 'w'));
                $objWriter->writeAttribute('len', $majorGridlines->getLineStyleArrowParameters('end', 'len'));
                $objWriter->endElement();
            }
            $objWriter->endElement(); //end ln
        }
        $objWriter->startElement('a:effectLst');

        if ($majorGridlines->getGlowSize() !== null) {
            $objWriter->startElement('a:glow');
            $objWriter->writeAttribute('rad', $majorGridlines->getGlowSize());
            $objWriter->startElement("a:{$majorGridlines->getGlowColor('type')}");
            $objWriter->writeAttribute('val', $majorGridlines->getGlowColor('value'));
            $objWriter->startElement('a:alpha');
            $objWriter->writeAttribute('val', $majorGridlines->getGlowColor('alpha'));
            $objWriter->endElement(); //end alpha
            $objWriter->endElement(); //end schemeClr
            $objWriter->endElement(); //end glow
        }

        if ($majorGridlines->getShadowProperty('presets') !== null) {
            $objWriter->startElement("a:{$majorGridlines->getShadowProperty('effect')}");
            if ($majorGridlines->getShadowProperty('blur') !== null) {
                $objWriter->writeAttribute('blurRad', $majorGridlines->getShadowProperty('blur'));
            }
            if ($majorGridlines->getShadowProperty('distance') !== null) {
                $objWriter->writeAttribute('dist', $majorGridlines->getShadowProperty('distance'));
            }
            if ($majorGridlines->getShadowProperty('direction') !== null) {
                $objWriter->writeAttribute('dir', $majorGridlines->getShadowProperty('direction'));
            }
            if ($majorGridlines->getShadowProperty('algn') !== null) {
                $objWriter->writeAttribute('algn', $majorGridlines->getShadowProperty('algn'));
            }
            if ($majorGridlines->getShadowProperty(['size', 'sx']) !== null) {
                $objWriter->writeAttribute('sx', $majorGridlines->getShadowProperty(['size', 'sx']));
            }
            if ($majorGridlines->getShadowProperty(['size', 'sy']) !== null) {
                $objWriter->writeAttribute('sy', $majorGridlines->getShadowProperty(['size', 'sy']));
            }
            if ($majorGridlines->getShadowProperty(['size', 'kx']) !== null) {
                $objWriter->writeAttribute('kx', $majorGridlines->getShadowProperty(['size', 'kx']));
            }
            if ($majorGridlines->getShadowProperty('rotWithShape') !== null) {
                $objWriter->writeAttribute('rotWithShape', $majorGridlines->getShadowProperty('rotWithShape'));
            }
            $objWriter->startElement("a:{$majorGridlines->getShadowProperty(['color', 'type'])}");
            $objWriter->writeAttribute('val', $majorGridlines->getShadowProperty(['color', 'value']));

            $objWriter->startElement('a:alpha');
            $objWriter->writeAttribute('val', $majorGridlines->getShadowProperty(['color', 'alpha']));
            $objWriter->endElement(); //end alpha

            $objWriter->endElement(); //end color:type
            $objWriter->endElement(); //end shadow
        }

        if ($majorGridlines->getSoftEdgesSize() !== null) {
            $objWriter->startElement('a:softEdge');
            $objWriter->writeAttribute('rad', $majorGridlines->getSoftEdgesSize());
            $objWriter->endElement(); //end softEdge
        }

        $objWriter->endElement(); //end effectLst
        $objWriter->endElement(); //end spPr
        $objWriter->endElement(); //end majorGridLines

        if ($minorGridlines->getObjectState()) {
            $objWriter->startElement('c:minorGridlines');
            $objWriter->startElement('c:spPr');

            if ($minorGridlines->getLineColorProperty('value') !== null) {
                $objWriter->startElement('a:ln');
                $objWriter->writeAttribute('w', $minorGridlines->getLineStyleProperty('width'));
                $objWriter->startElement('a:solidFill');
                $objWriter->startElement("a:{$minorGridlines->getLineColorProperty('type')}");
                $objWriter->writeAttribute('val', $minorGridlines->getLineColorProperty('value'));
                $objWriter->startElement('a:alpha');
                $objWriter->writeAttribute('val', $minorGridlines->getLineColorProperty('alpha'));
                $objWriter->endElement(); //end alpha
                $objWriter->endElement(); //end srgbClr
                $objWriter->endElement(); //end solidFill

                $objWriter->startElement('a:prstDash');
                $objWriter->writeAttribute('val', $minorGridlines->getLineStyleProperty('dash'));
                $objWriter->endElement();

                if ($minorGridlines->getLineStyleProperty('join') == 'miter') {
                    $objWriter->startElement('a:miter');
                    $objWriter->writeAttribute('lim', '800000');
                    $objWriter->endElement();
                } else {
                    $objWriter->startElement('a:bevel');
                    $objWriter->endElement();
                }

                if ($minorGridlines->getLineStyleProperty(['arrow', 'head', 'type']) !== null) {
                    $objWriter->startElement('a:headEnd');
                    $objWriter->writeAttribute('type', $minorGridlines->getLineStyleProperty(['arrow', 'head', 'type']));
                    $objWriter->writeAttribute('w', $minorGridlines->getLineStyleArrowParameters('head', 'w'));
                    $objWriter->writeAttribute('len', $minorGridlines->getLineStyleArrowParameters('head', 'len'));
                    $objWriter->endElement();
                }

                if ($minorGridlines->getLineStyleProperty(['arrow', 'end', 'type']) !== null) {
                    $objWriter->startElement('a:tailEnd');
                    $objWriter->writeAttribute('type', $minorGridlines->getLineStyleProperty(['arrow', 'end', 'type']));
                    $objWriter->writeAttribute('w', $minorGridlines->getLineStyleArrowParameters('end', 'w'));
                    $objWriter->writeAttribute('len', $minorGridlines->getLineStyleArrowParameters('end', 'len'));
                    $objWriter->endElement();
                }
                $objWriter->endElement(); //end ln
            }

            $objWriter->startElement('a:effectLst');

            if ($minorGridlines->getGlowSize() !== null) {
                $objWriter->startElement('a:glow');
                $objWriter->writeAttribute('rad', $minorGridlines->getGlowSize());
                $objWriter->startElement("a:{$minorGridlines->getGlowColor('type')}");
                $objWriter->writeAttribute('val', $minorGridlines->getGlowColor('value'));
                $objWriter->startElement('a:alpha');
                $objWriter->writeAttribute('val', $minorGridlines->getGlowColor('alpha'));
                $objWriter->endElement(); //end alpha
                $objWriter->endElement(); //end schemeClr
                $objWriter->endElement(); //end glow
            }

            if ($minorGridlines->getShadowProperty('presets') !== null) {
                $objWriter->startElement("a:{$minorGridlines->getShadowProperty('effect')}");
                if ($minorGridlines->getShadowProperty('blur') !== null) {
                    $objWriter->writeAttribute('blurRad', $minorGridlines->getShadowProperty('blur'));
                }
                if ($minorGridlines->getShadowProperty('distance') !== null) {
                    $objWriter->writeAttribute('dist', $minorGridlines->getShadowProperty('distance'));
                }
                if ($minorGridlines->getShadowProperty('direction') !== null) {
                    $objWriter->writeAttribute('dir', $minorGridlines->getShadowProperty('direction'));
                }
                if ($minorGridlines->getShadowProperty('algn') !== null) {
                    $objWriter->writeAttribute('algn', $minorGridlines->getShadowProperty('algn'));
                }
                if ($minorGridlines->getShadowProperty(['size', 'sx']) !== null) {
                    $objWriter->writeAttribute('sx', $minorGridlines->getShadowProperty(['size', 'sx']));
                }
                if ($minorGridlines->getShadowProperty(['size', 'sy']) !== null) {
                    $objWriter->writeAttribute('sy', $minorGridlines->getShadowProperty(['size', 'sy']));
                }
                if ($minorGridlines->getShadowProperty(['size', 'kx']) !== null) {
                    $objWriter->writeAttribute('kx', $minorGridlines->getShadowProperty(['size', 'kx']));
                }
                if ($minorGridlines->getShadowProperty('rotWithShape') !== null) {
                    $objWriter->writeAttribute('rotWithShape', $minorGridlines->getShadowProperty('rotWithShape'));
                }
                $objWriter->startElement("a:{$minorGridlines->getShadowProperty(['color', 'type'])}");
                $objWriter->writeAttribute('val', $minorGridlines->getShadowProperty(['color', 'value']));
                $objWriter->startElement('a:alpha');
                $objWriter->writeAttribute('val', $minorGridlines->getShadowProperty(['color', 'alpha']));
                $objWriter->endElement(); //end alpha
                $objWriter->endElement(); //end color:type
                $objWriter->endElement(); //end shadow
            }

            if ($minorGridlines->getSoftEdgesSize() !== null) {
                $objWriter->startElement('a:softEdge');
                $objWriter->writeAttribute('rad', $minorGridlines->getSoftEdgesSize());
                $objWriter->endElement(); //end softEdge
            }

            $objWriter->endElement(); //end effectLst
=======
        if ($majorGridlines !== null) {
            $objWriter->startElement('c:majorGridlines');
            $objWriter->startElement('c:spPr');
            $this->writeLineStyles($objWriter, $majorGridlines);
            $this->writeEffects($objWriter, $majorGridlines);
            $objWriter->endElement(); //end spPr
            $objWriter->endElement(); //end majorGridLines
        }

        if ($minorGridlines !== null && $minorGridlines->getObjectState()) {
            $objWriter->startElement('c:minorGridlines');
            $objWriter->startElement('c:spPr');
            $this->writeLineStyles($objWriter, $minorGridlines);
            $this->writeEffects($objWriter, $minorGridlines);
>>>>>>> main
            $objWriter->endElement(); //end spPr
            $objWriter->endElement(); //end minorGridLines
        }

        if ($yAxisLabel !== null) {
            $objWriter->startElement('c:title');
            $objWriter->startElement('c:tx');
            $objWriter->startElement('c:rich');

            $objWriter->startElement('a:bodyPr');
            $objWriter->endElement();

            $objWriter->startElement('a:lstStyle');
            $objWriter->endElement();

            $objWriter->startElement('a:p');
<<<<<<< HEAD
            $objWriter->startElement('a:r');
=======
>>>>>>> main

            $caption = $yAxisLabel->getCaption();
            if (is_array($caption)) {
                $caption = $caption[0];
            }
<<<<<<< HEAD

            $objWriter->startElement('a:t');
            $objWriter->writeRawData(StringHelper::controlCharacterPHP2OOXML($caption));
            $objWriter->endElement();

            $objWriter->endElement();
=======
            $this->getParentWriter()->getWriterPartstringtable()->writeRichTextForCharts($objWriter, $caption, 'a');

>>>>>>> main
            $objWriter->endElement();
            $objWriter->endElement();
            $objWriter->endElement();

            if ($groupType !== DataSeries::TYPE_BUBBLECHART) {
                $layout = $yAxisLabel->getLayout();
                $this->writeLayout($objWriter, $layout);
            }

            $objWriter->startElement('c:overlay');
<<<<<<< HEAD
            $objWriter->writeAttribute('val', 0);
=======
            $objWriter->writeAttribute('val', '0');
>>>>>>> main
            $objWriter->endElement();

            $objWriter->endElement();
        }

        $objWriter->startElement('c:numFmt');
        $objWriter->writeAttribute('formatCode', $xAxis->getAxisNumberFormat());
        $objWriter->writeAttribute('sourceLinked', $xAxis->getAxisNumberSourceLinked());
        $objWriter->endElement();

<<<<<<< HEAD
        $objWriter->startElement('c:majorTickMark');
        $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('major_tick_mark'));
        $objWriter->endElement();

        $objWriter->startElement('c:minorTickMark');
        $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('minor_tick_mark'));
        $objWriter->endElement();

        $objWriter->startElement('c:tickLblPos');
        $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('axis_labels'));
        $objWriter->endElement();

        $objWriter->startElement('c:spPr');

        if ($xAxis->getFillProperty('value') !== null) {
            $objWriter->startElement('a:solidFill');
            $objWriter->startElement('a:' . $xAxis->getFillProperty('type'));
            $objWriter->writeAttribute('val', $xAxis->getFillProperty('value'));
            $objWriter->startElement('a:alpha');
            $objWriter->writeAttribute('val', $xAxis->getFillProperty('alpha'));
            $objWriter->endElement();
            $objWriter->endElement();
            $objWriter->endElement();
        }

        $objWriter->startElement('a:ln');

        $objWriter->writeAttribute('w', $xAxis->getLineStyleProperty('width'));
        $objWriter->writeAttribute('cap', $xAxis->getLineStyleProperty('cap'));
        $objWriter->writeAttribute('cmpd', $xAxis->getLineStyleProperty('compound'));

        if ($xAxis->getLineProperty('value') !== null) {
            $objWriter->startElement('a:solidFill');
            $objWriter->startElement('a:' . $xAxis->getLineProperty('type'));
            $objWriter->writeAttribute('val', $xAxis->getLineProperty('value'));
            $objWriter->startElement('a:alpha');
            $objWriter->writeAttribute('val', $xAxis->getLineProperty('alpha'));
            $objWriter->endElement();
            $objWriter->endElement();
            $objWriter->endElement();
        }

        $objWriter->startElement('a:prstDash');
        $objWriter->writeAttribute('val', $xAxis->getLineStyleProperty('dash'));
        $objWriter->endElement();

        if ($xAxis->getLineStyleProperty('join') == 'miter') {
            $objWriter->startElement('a:miter');
            $objWriter->writeAttribute('lim', '800000');
            $objWriter->endElement();
        } else {
            $objWriter->startElement('a:bevel');
            $objWriter->endElement();
        }

        if ($xAxis->getLineStyleProperty(['arrow', 'head', 'type']) !== null) {
            $objWriter->startElement('a:headEnd');
            $objWriter->writeAttribute('type', $xAxis->getLineStyleProperty(['arrow', 'head', 'type']));
            $objWriter->writeAttribute('w', $xAxis->getLineStyleArrowWidth('head'));
            $objWriter->writeAttribute('len', $xAxis->getLineStyleArrowLength('head'));
            $objWriter->endElement();
        }

        if ($xAxis->getLineStyleProperty(['arrow', 'end', 'type']) !== null) {
            $objWriter->startElement('a:tailEnd');
            $objWriter->writeAttribute('type', $xAxis->getLineStyleProperty(['arrow', 'end', 'type']));
            $objWriter->writeAttribute('w', $xAxis->getLineStyleArrowWidth('end'));
            $objWriter->writeAttribute('len', $xAxis->getLineStyleArrowLength('end'));
            $objWriter->endElement();
        }

        $objWriter->endElement();

        $objWriter->startElement('a:effectLst');

        if ($xAxis->getGlowProperty('size') !== null) {
            $objWriter->startElement('a:glow');
            $objWriter->writeAttribute('rad', $xAxis->getGlowProperty('size'));
            $objWriter->startElement("a:{$xAxis->getGlowProperty(['color', 'type'])}");
            $objWriter->writeAttribute('val', $xAxis->getGlowProperty(['color', 'value']));
            $objWriter->startElement('a:alpha');
            $objWriter->writeAttribute('val', $xAxis->getGlowProperty(['color', 'alpha']));
            $objWriter->endElement();
            $objWriter->endElement();
            $objWriter->endElement();
        }

        if ($xAxis->getShadowProperty('presets') !== null) {
            $objWriter->startElement("a:{$xAxis->getShadowProperty('effect')}");

            if ($xAxis->getShadowProperty('blur') !== null) {
                $objWriter->writeAttribute('blurRad', $xAxis->getShadowProperty('blur'));
            }
            if ($xAxis->getShadowProperty('distance') !== null) {
                $objWriter->writeAttribute('dist', $xAxis->getShadowProperty('distance'));
            }
            if ($xAxis->getShadowProperty('direction') !== null) {
                $objWriter->writeAttribute('dir', $xAxis->getShadowProperty('direction'));
            }
            if ($xAxis->getShadowProperty('algn') !== null) {
                $objWriter->writeAttribute('algn', $xAxis->getShadowProperty('algn'));
            }
            if ($xAxis->getShadowProperty(['size', 'sx']) !== null) {
                $objWriter->writeAttribute('sx', $xAxis->getShadowProperty(['size', 'sx']));
            }
            if ($xAxis->getShadowProperty(['size', 'sy']) !== null) {
                $objWriter->writeAttribute('sy', $xAxis->getShadowProperty(['size', 'sy']));
            }
            if ($xAxis->getShadowProperty(['size', 'kx']) !== null) {
                $objWriter->writeAttribute('kx', $xAxis->getShadowProperty(['size', 'kx']));
            }
            if ($xAxis->getShadowProperty('rotWithShape') !== null) {
                $objWriter->writeAttribute('rotWithShape', $xAxis->getShadowProperty('rotWithShape'));
            }

            $objWriter->startElement("a:{$xAxis->getShadowProperty(['color', 'type'])}");
            $objWriter->writeAttribute('val', $xAxis->getShadowProperty(['color', 'value']));
            $objWriter->startElement('a:alpha');
            $objWriter->writeAttribute('val', $xAxis->getShadowProperty(['color', 'alpha']));
            $objWriter->endElement();
            $objWriter->endElement();

            $objWriter->endElement();
        }

        if ($xAxis->getSoftEdgesSize() !== null) {
            $objWriter->startElement('a:softEdge');
            $objWriter->writeAttribute('rad', $xAxis->getSoftEdgesSize());
            $objWriter->endElement();
        }

        $objWriter->endElement(); //effectList
        $objWriter->endElement(); //end spPr

        if ($id1 > 0) {
            $objWriter->startElement('c:crossAx');
            $objWriter->writeAttribute('val', $id2);
=======
        if (!empty($xAxis->getAxisOptionsProperty('major_tick_mark'))) {
            $objWriter->startElement('c:majorTickMark');
            $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('major_tick_mark'));
            $objWriter->endElement();
        }

        if (!empty($xAxis->getAxisOptionsProperty('minor_tick_mark'))) {
            $objWriter->startElement('c:minorTickMark');
            $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('minor_tick_mark'));
            $objWriter->endElement();
        }

        if (!empty($xAxis->getAxisOptionsProperty('axis_labels'))) {
            $objWriter->startElement('c:tickLblPos');
            $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('axis_labels'));
            $objWriter->endElement();
        }

        $textRotation = $xAxis->getAxisOptionsProperty('textRotation');
        $axisText = $xAxis->getAxisText();

        if ($axisText !== null || is_numeric($textRotation)) {
            $objWriter->startElement('c:txPr');
            $objWriter->startElement('a:bodyPr');
            if (is_numeric($textRotation)) {
                $objWriter->writeAttribute('rot', Properties::angleToXml((float) $textRotation));
            }
            $objWriter->endElement(); // a:bodyPr
            $objWriter->startElement('a:lstStyle');
            $objWriter->endElement(); // a:lstStyle

            $this->writeLabelFont($objWriter, ($axisText === null) ? null : $axisText->getFont(), $axisText);

            $objWriter->endElement(); // c:txPr
        }

        $objWriter->startElement('c:spPr');
        $this->writeColor($objWriter, $xAxis->getFillColorObject());
        $this->writeLineStyles($objWriter, $xAxis, $xAxis->getNoFill());
        $this->writeEffects($objWriter, $xAxis);
        $objWriter->endElement(); //end spPr

        if ($id1 !== '0') {
            $objWriter->startElement('c:crossAx');
            $objWriter->writeAttribute('val', $id1);
>>>>>>> main
            $objWriter->endElement();

            if ($xAxis->getAxisOptionsProperty('horizontal_crosses_value') !== null) {
                $objWriter->startElement('c:crossesAt');
                $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('horizontal_crosses_value'));
                $objWriter->endElement();
            } else {
<<<<<<< HEAD
                $objWriter->startElement('c:crosses');
                $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('horizontal_crosses'));
                $objWriter->endElement();
            }

            $objWriter->startElement('c:crossBetween');
            $objWriter->writeAttribute('val', 'midCat');
            $objWriter->endElement();
=======
                $crosses = $xAxis->getAxisOptionsProperty('horizontal_crosses');
                if ($crosses) {
                    $objWriter->startElement('c:crosses');
                    $objWriter->writeAttribute('val', $crosses);
                    $objWriter->endElement();
                }
            }

            $crossBetween = $xAxis->getCrossBetween();
            if ($crossBetween !== '') {
                $objWriter->startElement('c:crossBetween');
                $objWriter->writeAttribute('val', $crossBetween);
                $objWriter->endElement();
            }
>>>>>>> main

            if ($xAxis->getAxisOptionsProperty('major_unit') !== null) {
                $objWriter->startElement('c:majorUnit');
                $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('major_unit'));
                $objWriter->endElement();
            }

            if ($xAxis->getAxisOptionsProperty('minor_unit') !== null) {
                $objWriter->startElement('c:minorUnit');
                $objWriter->writeAttribute('val', $xAxis->getAxisOptionsProperty('minor_unit'));
                $objWriter->endElement();
            }
        }

        if ($isMultiLevelSeries) {
            if ($groupType !== DataSeries::TYPE_BUBBLECHART) {
                $objWriter->startElement('c:noMultiLvlLbl');
<<<<<<< HEAD
                $objWriter->writeAttribute('val', 0);
=======
                $objWriter->writeAttribute('val', '0');
>>>>>>> main
                $objWriter->endElement();
            }
        }

        $objWriter->endElement();
    }

    /**
<<<<<<< HEAD
=======
     * Write Ser Axis, for Surface chart.
     */
    private function writeSerAxis(XMLWriter $objWriter, string $id2, string $id3): void
    {
        $objWriter->startElement('c:serAx');

        $objWriter->startElement('c:axId');
        $objWriter->writeAttribute('val', $id3);
        $objWriter->endElement(); // axId

        $objWriter->startElement('c:scaling');
        $objWriter->startElement('c:orientation');
        $objWriter->writeAttribute('val', 'minMax');
        $objWriter->endElement(); // orientation
        $objWriter->endElement(); // scaling

        $objWriter->startElement('c:delete');
        $objWriter->writeAttribute('val', '0');
        $objWriter->endElement(); // delete

        $objWriter->startElement('c:axPos');
        $objWriter->writeAttribute('val', 'b');
        $objWriter->endElement(); // axPos

        $objWriter->startElement('c:majorTickMark');
        $objWriter->writeAttribute('val', 'out');
        $objWriter->endElement(); // majorTickMark

        $objWriter->startElement('c:minorTickMark');
        $objWriter->writeAttribute('val', 'none');
        $objWriter->endElement(); // minorTickMark

        $objWriter->startElement('c:tickLblPos');
        $objWriter->writeAttribute('val', 'nextTo');
        $objWriter->endElement(); // tickLblPos

        $objWriter->startElement('c:crossAx');
        $objWriter->writeAttribute('val', $id2);
        $objWriter->endElement(); // crossAx

        $objWriter->startElement('c:crosses');
        $objWriter->writeAttribute('val', 'autoZero');
        $objWriter->endElement(); // crosses

        $objWriter->endElement(); //serAx
    }

    /**
>>>>>>> main
     * Get the data series type(s) for a chart plot series.
     *
     * @return string[]
     */
    private static function getChartType(PlotArea $plotArea): array
    {
        $groupCount = $plotArea->getPlotGroupCount();

        if ($groupCount == 1) {
            $chartType = [$plotArea->getPlotGroupByIndex(0)->getPlotType()];
        } else {
            $chartTypes = [];
            for ($i = 0; $i < $groupCount; ++$i) {
                $chartTypes[] = $plotArea->getPlotGroupByIndex($i)->getPlotType();
            }
            $chartType = array_unique($chartTypes);
            if (count($chartTypes) == 0) {
                throw new WriterException('Chart is not yet implemented');
            }
        }

        return $chartType;
    }

    /**
     * Method writing plot series values.
<<<<<<< HEAD
     *
     * @param int $val value for idx (default: 3)
     * @param string $fillColor hex color (default: FF9900)
     */
    private function writePlotSeriesValuesElement(XMLWriter $objWriter, $val = 3, $fillColor = 'FF9900'): void
    {
        $objWriter->startElement('c:dPt');
        $objWriter->startElement('c:idx');
        $objWriter->writeAttribute('val', $val);
        $objWriter->endElement();

        $objWriter->startElement('c:bubble3D');
        $objWriter->writeAttribute('val', 0);
        $objWriter->endElement();

        $objWriter->startElement('c:spPr');
        $objWriter->startElement('a:solidFill');
        $objWriter->startElement('a:srgbClr');
        $objWriter->writeAttribute('val', $fillColor);
        $objWriter->endElement();
        $objWriter->endElement();
        $objWriter->endElement();
        $objWriter->endElement();
=======
     */
    private function writePlotSeriesValuesElement(XMLWriter $objWriter, int $val, ?ChartColor $fillColor): void
    {
        if ($fillColor === null || !$fillColor->isUsable()) {
            return;
        }
        $objWriter->startElement('c:dPt');

        $objWriter->startElement('c:idx');
        $objWriter->writeAttribute('val', "$val");
        $objWriter->endElement(); // c:idx

        $objWriter->startElement('c:spPr');
        $this->writeColor($objWriter, $fillColor);
        $objWriter->endElement(); // c:spPr

        $objWriter->endElement(); // c:dPt
>>>>>>> main
    }

    /**
     * Write Plot Group (series of related plots).
     *
     * @param string $groupType Type of plot for dataseries
     * @param bool $catIsMultiLevelSeries Is category a multi-series category
     * @param bool $valIsMultiLevelSeries Is value set a multi-series set
     * @param string $plotGroupingType Type of grouping for multi-series values
     */
<<<<<<< HEAD
    private function writePlotGroup(?DataSeries $plotGroup, $groupType, XMLWriter $objWriter, &$catIsMultiLevelSeries, &$valIsMultiLevelSeries, &$plotGroupingType): void
=======
    private function writePlotGroup(?DataSeries $plotGroup, string $groupType, XMLWriter $objWriter, &$catIsMultiLevelSeries, &$valIsMultiLevelSeries, &$plotGroupingType): void
>>>>>>> main
    {
        if ($plotGroup === null) {
            return;
        }

        if (($groupType == DataSeries::TYPE_BARCHART) || ($groupType == DataSeries::TYPE_BARCHART_3D)) {
            $objWriter->startElement('c:barDir');
            $objWriter->writeAttribute('val', $plotGroup->getPlotDirection());
            $objWriter->endElement();
        }

<<<<<<< HEAD
        if ($plotGroup->getPlotGrouping() !== null) {
            $plotGroupingType = $plotGroup->getPlotGrouping();
=======
        $plotGroupingType = $plotGroup->getPlotGrouping();
        if ($plotGroupingType !== null && $groupType !== DataSeries::TYPE_SURFACECHART && $groupType !== DataSeries::TYPE_SURFACECHART_3D) {
>>>>>>> main
            $objWriter->startElement('c:grouping');
            $objWriter->writeAttribute('val', $plotGroupingType);
            $objWriter->endElement();
        }

        //    Get these details before the loop, because we can use the count to check for varyColors
        $plotSeriesOrder = $plotGroup->getPlotOrder();
        $plotSeriesCount = count($plotSeriesOrder);

        if (($groupType !== DataSeries::TYPE_RADARCHART) && ($groupType !== DataSeries::TYPE_STOCKCHART)) {
            if ($groupType !== DataSeries::TYPE_LINECHART) {
                if (($groupType == DataSeries::TYPE_PIECHART) || ($groupType == DataSeries::TYPE_PIECHART_3D) || ($groupType == DataSeries::TYPE_DONUTCHART) || ($plotSeriesCount > 1)) {
                    $objWriter->startElement('c:varyColors');
<<<<<<< HEAD
                    $objWriter->writeAttribute('val', 1);
                    $objWriter->endElement();
                } else {
                    $objWriter->startElement('c:varyColors');
                    $objWriter->writeAttribute('val', 0);
=======
                    $objWriter->writeAttribute('val', '1');
                    $objWriter->endElement();
                } else {
                    $objWriter->startElement('c:varyColors');
                    $objWriter->writeAttribute('val', '0');
>>>>>>> main
                    $objWriter->endElement();
                }
            }
        }

        $plotSeriesIdx = 0;
        foreach ($plotSeriesOrder as $plotSeriesIdx => $plotSeriesRef) {
            $objWriter->startElement('c:ser');

<<<<<<< HEAD
            $plotLabel = $plotGroup->getPlotLabelByIndex($plotSeriesIdx);
            if ($plotLabel && $groupType !== DataSeries::TYPE_LINECHART) {
                $fillColor = $plotLabel->getFillColor();
                if ($fillColor !== null && !is_array($fillColor)) {
                    $objWriter->startElement('c:spPr');
                    $objWriter->startElement('a:solidFill');
                    $objWriter->startElement('a:srgbClr');
                    $objWriter->writeAttribute('val', $fillColor);
                    $objWriter->endElement();
                    $objWriter->endElement();
                    $objWriter->endElement();
                }
            }

            $objWriter->startElement('c:idx');
            $objWriter->writeAttribute('val', $this->seriesIndex + $plotSeriesIdx);
            $objWriter->endElement();

            $objWriter->startElement('c:order');
            $objWriter->writeAttribute('val', $this->seriesIndex + $plotSeriesRef);
            $objWriter->endElement();

            //    Values
            $plotSeriesValues = $plotGroup->getPlotValuesByIndex($plotSeriesRef);

            if (($groupType == DataSeries::TYPE_PIECHART) || ($groupType == DataSeries::TYPE_PIECHART_3D) || ($groupType == DataSeries::TYPE_DONUTCHART)) {
                $fillColorValues = $plotSeriesValues->getFillColor();
                if ($fillColorValues !== null && is_array($fillColorValues)) {
                    foreach ($plotSeriesValues->getDataValues() as $dataKey => $dataValue) {
                        $this->writePlotSeriesValuesElement($objWriter, $dataKey, ($fillColorValues[$dataKey] ?? 'FF9900'));
                    }
                } else {
                    $this->writePlotSeriesValuesElement($objWriter);
                }
            }

            //    Labels
            $plotSeriesLabel = $plotGroup->getPlotLabelByIndex($plotSeriesRef);
=======
            $objWriter->startElement('c:idx');
            $adder = array_key_exists(0, $plotSeriesOrder) ? $this->seriesIndex : 0;
            $objWriter->writeAttribute('val', (string) ($adder + $plotSeriesIdx));
            $objWriter->endElement();

            $objWriter->startElement('c:order');
            $objWriter->writeAttribute('val', (string) ($adder + $plotSeriesRef));
            $objWriter->endElement();

            $plotLabel = $plotGroup->getPlotLabelByIndex($plotSeriesIdx);
            $labelFill = null;
            if ($plotLabel && $groupType === DataSeries::TYPE_LINECHART) {
                $labelFill = $plotLabel->getFillColorObject();
                $labelFill = ($labelFill instanceof ChartColor) ? $labelFill : null;
            }

            //    Values
            $plotSeriesValues = $plotGroup->getPlotValuesByIndex($plotSeriesIdx);

            if ($plotSeriesValues !== false && in_array($groupType, self::CUSTOM_COLOR_TYPES, true)) {
                $fillColorValues = $plotSeriesValues->getFillColorObject();
                if ($fillColorValues !== null && is_array($fillColorValues)) {
                    foreach ($plotSeriesValues->getDataValues() as $dataKey => $dataValue) {
                        $this->writePlotSeriesValuesElement($objWriter, $dataKey, $fillColorValues[$dataKey] ?? null);
                    }
                }
            }
            if ($plotSeriesValues !== false && $plotSeriesValues->getLabelLayout()) {
                $this->writeDataLabels($objWriter, $plotSeriesValues->getLabelLayout());
            }

            //    Labels
            $plotSeriesLabel = $plotGroup->getPlotLabelByIndex($plotSeriesIdx);
>>>>>>> main
            if ($plotSeriesLabel && ($plotSeriesLabel->getPointCount() > 0)) {
                $objWriter->startElement('c:tx');
                $objWriter->startElement('c:strRef');
                $this->writePlotSeriesLabel($plotSeriesLabel, $objWriter);
                $objWriter->endElement();
                $objWriter->endElement();
            }

            //    Formatting for the points
<<<<<<< HEAD
            if (($groupType == DataSeries::TYPE_LINECHART) || ($groupType == DataSeries::TYPE_STOCKCHART)) {
                $plotLineWidth = 12700;
                if ($plotSeriesValues) {
                    $plotLineWidth = $plotSeriesValues->getLineWidth();
                }

                $objWriter->startElement('c:spPr');
                $objWriter->startElement('a:ln');
                $objWriter->writeAttribute('w', $plotLineWidth);
                if ($groupType == DataSeries::TYPE_STOCKCHART) {
                    $objWriter->startElement('a:noFill');
                    $objWriter->endElement();
                } elseif ($plotLabel) {
                    $fillColor = $plotLabel->getFillColor();
                    if (is_string($fillColor)) {
                        $objWriter->startElement('a:solidFill');
                        $objWriter->startElement('a:srgbClr');
                        $objWriter->writeAttribute('val', $fillColor);
                        $objWriter->endElement();
                        $objWriter->endElement();
                    }
                }
                $objWriter->endElement();
                $objWriter->endElement();
=======
            if (
                $plotSeriesValues !== false
            ) {
                $objWriter->startElement('c:spPr');
                if ($plotLabel && $groupType !== DataSeries::TYPE_LINECHART) {
                    $fillColor = $plotLabel->getFillColorObject();
                    if ($fillColor !== null && !is_array($fillColor) && $fillColor->isUsable()) {
                        $this->writeColor($objWriter, $fillColor);
                    }
                }
                $fillObject = $labelFill ?? $plotSeriesValues->getFillColorObject();
                $callLineStyles = true;
                if ($fillObject instanceof ChartColor && $fillObject->isUsable()) {
                    if ($groupType === DataSeries::TYPE_LINECHART) {
                        $objWriter->startElement('a:ln');
                        $callLineStyles = false;
                    }
                    $this->writeColor($objWriter, $fillObject);
                    if (!$callLineStyles) {
                        $objWriter->endElement(); // a:ln
                    }
                }
                $nofill = $groupType === DataSeries::TYPE_STOCKCHART || (($groupType === DataSeries::TYPE_SCATTERCHART || $groupType === DataSeries::TYPE_LINECHART) && !$plotSeriesValues->getScatterLines());
                if ($callLineStyles) {
                    $this->writeLineStyles($objWriter, $plotSeriesValues, $nofill);
                    $this->writeEffects($objWriter, $plotSeriesValues);
                }
                $objWriter->endElement(); // c:spPr
>>>>>>> main
            }

            if ($plotSeriesValues) {
                $plotSeriesMarker = $plotSeriesValues->getPointMarker();
<<<<<<< HEAD
                if ($plotSeriesMarker) {
                    $objWriter->startElement('c:marker');
                    $objWriter->startElement('c:symbol');
                    $objWriter->writeAttribute('val', $plotSeriesMarker);
=======
                $markerFillColor = $plotSeriesValues->getMarkerFillColor();
                $fillUsed = $markerFillColor->IsUsable();
                $markerBorderColor = $plotSeriesValues->getMarkerBorderColor();
                $borderUsed = $markerBorderColor->isUsable();
                if ($plotSeriesMarker || $fillUsed || $borderUsed) {
                    $objWriter->startElement('c:marker');
                    $objWriter->startElement('c:symbol');
                    if ($plotSeriesMarker) {
                        $objWriter->writeAttribute('val', $plotSeriesMarker);
                    }
>>>>>>> main
                    $objWriter->endElement();

                    if ($plotSeriesMarker !== 'none') {
                        $objWriter->startElement('c:size');
<<<<<<< HEAD
                        $objWriter->writeAttribute('val', 3);
                        $objWriter->endElement();
=======
                        $objWriter->writeAttribute('val', (string) $plotSeriesValues->getPointSize());
                        $objWriter->endElement(); // c:size
                        $objWriter->startElement('c:spPr');
                        $this->writeColor($objWriter, $markerFillColor);
                        if ($borderUsed) {
                            $objWriter->startElement('a:ln');
                            $this->writeColor($objWriter, $markerBorderColor);
                            $objWriter->endElement(); // a:ln
                        }
                        $objWriter->endElement(); // spPr
>>>>>>> main
                    }

                    $objWriter->endElement();
                }
            }

            if (($groupType === DataSeries::TYPE_BARCHART) || ($groupType === DataSeries::TYPE_BARCHART_3D) || ($groupType === DataSeries::TYPE_BUBBLECHART)) {
                $objWriter->startElement('c:invertIfNegative');
<<<<<<< HEAD
                $objWriter->writeAttribute('val', 0);
                $objWriter->endElement();
            }

            //    Category Labels
            $plotSeriesCategory = $plotGroup->getPlotCategoryByIndex($plotSeriesRef);
=======
                $objWriter->writeAttribute('val', '0');
                $objWriter->endElement();
            }
            // Trendlines
            if ($plotSeriesValues !== false) {
                foreach ($plotSeriesValues->getTrendLines() as $trendLine) {
                    $trendLineType = $trendLine->getTrendLineType();
                    $order = $trendLine->getOrder();
                    $period = $trendLine->getPeriod();
                    $dispRSqr = $trendLine->getDispRSqr();
                    $dispEq = $trendLine->getDispEq();
                    $forward = $trendLine->getForward();
                    $backward = $trendLine->getBackward();
                    $intercept = $trendLine->getIntercept();
                    $name = $trendLine->getName();
                    $trendLineColor = $trendLine->getLineColor(); // ChartColor

                    $objWriter->startElement('c:trendline'); // N.B. lowercase 'ell'
                    if ($name !== '') {
                        $objWriter->startElement('c:name');
                        $objWriter->writeRawData($name);
                        $objWriter->endElement(); // c:name
                    }
                    $objWriter->startElement('c:spPr');

                    if (!$trendLineColor->isUsable()) {
                        // use dataSeriesValues line color as a backup if $trendLineColor is null
                        $dsvLineColor = $plotSeriesValues->getLineColor();
                        if ($dsvLineColor->isUsable()) {
                            $trendLine
                                ->getLineColor()
                                ->setColorProperties($dsvLineColor->getValue(), $dsvLineColor->getAlpha(), $dsvLineColor->getType());
                        }
                    } // otherwise, hope Excel does the right thing

                    $this->writeLineStyles($objWriter, $trendLine, false); // suppress noFill

                    $objWriter->endElement(); // spPr

                    $objWriter->startElement('c:trendlineType'); // N.B lowercase 'ell'
                    $objWriter->writeAttribute('val', $trendLineType);
                    $objWriter->endElement(); // trendlineType
                    if ($backward !== 0.0) {
                        $objWriter->startElement('c:backward');
                        $objWriter->writeAttribute('val', "$backward");
                        $objWriter->endElement(); // c:backward
                    }
                    if ($forward !== 0.0) {
                        $objWriter->startElement('c:forward');
                        $objWriter->writeAttribute('val', "$forward");
                        $objWriter->endElement(); // c:forward
                    }
                    if ($intercept !== 0.0) {
                        $objWriter->startElement('c:intercept');
                        $objWriter->writeAttribute('val', "$intercept");
                        $objWriter->endElement(); // c:intercept
                    }
                    if ($trendLineType == TrendLine::TRENDLINE_POLYNOMIAL) {
                        $objWriter->startElement('c:order');
                        $objWriter->writeAttribute('val', $order);
                        $objWriter->endElement(); // order
                    }
                    if ($trendLineType == TrendLine::TRENDLINE_MOVING_AVG) {
                        $objWriter->startElement('c:period');
                        $objWriter->writeAttribute('val', $period);
                        $objWriter->endElement(); // period
                    }
                    $objWriter->startElement('c:dispRSqr');
                    $objWriter->writeAttribute('val', $dispRSqr ? '1' : '0');
                    $objWriter->endElement();
                    $objWriter->startElement('c:dispEq');
                    $objWriter->writeAttribute('val', $dispEq ? '1' : '0');
                    $objWriter->endElement();
                    if ($groupType === DataSeries::TYPE_SCATTERCHART || $groupType === DataSeries::TYPE_LINECHART) {
                        $objWriter->startElement('c:trendlineLbl');
                        $objWriter->startElement('c:numFmt');
                        $objWriter->writeAttribute('formatCode', 'General');
                        $objWriter->writeAttribute('sourceLinked', '0');
                        $objWriter->endElement();  // numFmt
                        $objWriter->endElement();  // trendlineLbl
                    }

                    $objWriter->endElement(); // trendline
                }
            }

            //    Category Labels
            $plotSeriesCategory = $plotGroup->getPlotCategoryByIndex($plotSeriesIdx);
>>>>>>> main
            if ($plotSeriesCategory && ($plotSeriesCategory->getPointCount() > 0)) {
                $catIsMultiLevelSeries = $catIsMultiLevelSeries || $plotSeriesCategory->isMultiLevelSeries();

                if (($groupType == DataSeries::TYPE_PIECHART) || ($groupType == DataSeries::TYPE_PIECHART_3D) || ($groupType == DataSeries::TYPE_DONUTCHART)) {
<<<<<<< HEAD
                    if ($plotGroup->getPlotStyle() !== null) {
                        $plotStyle = $plotGroup->getPlotStyle();
                        if ($plotStyle) {
                            $objWriter->startElement('c:explosion');
                            $objWriter->writeAttribute('val', 25);
                            $objWriter->endElement();
                        }
=======
                    $plotStyle = $plotGroup->getPlotStyle();
                    if (is_numeric($plotStyle)) {
                        $objWriter->startElement('c:explosion');
                        $objWriter->writeAttribute('val', $plotStyle);
                        $objWriter->endElement();
>>>>>>> main
                    }
                }

                if (($groupType === DataSeries::TYPE_BUBBLECHART) || ($groupType === DataSeries::TYPE_SCATTERCHART)) {
                    $objWriter->startElement('c:xVal');
                } else {
                    $objWriter->startElement('c:cat');
                }

<<<<<<< HEAD
                $this->writePlotSeriesValues($plotSeriesCategory, $objWriter, $groupType, 'str');
=======
                // xVals (Categories) are not always 'str'
                // Test X-axis Label's Datatype to decide 'str' vs 'num'
                $CategoryDatatype = $plotSeriesCategory->getDataType();
                if ($CategoryDatatype == DataSeriesValues::DATASERIES_TYPE_NUMBER) {
                    $this->writePlotSeriesValues($plotSeriesCategory, $objWriter, $groupType, 'num');
                } else {
                    $this->writePlotSeriesValues($plotSeriesCategory, $objWriter, $groupType, 'str');
                }
>>>>>>> main
                $objWriter->endElement();
            }

            //    Values
            if ($plotSeriesValues) {
                $valIsMultiLevelSeries = $valIsMultiLevelSeries || $plotSeriesValues->isMultiLevelSeries();

                if (($groupType === DataSeries::TYPE_BUBBLECHART) || ($groupType === DataSeries::TYPE_SCATTERCHART)) {
                    $objWriter->startElement('c:yVal');
                } else {
                    $objWriter->startElement('c:val');
                }

                $this->writePlotSeriesValues($plotSeriesValues, $objWriter, $groupType, 'num');
                $objWriter->endElement();
<<<<<<< HEAD
            }

            if ($groupType === DataSeries::TYPE_BUBBLECHART) {
                $this->writeBubbles($plotSeriesValues, $objWriter);
=======
                if ($groupType === DataSeries::TYPE_SCATTERCHART && $plotGroup->getPlotStyle() === 'smoothMarker') {
                    $objWriter->startElement('c:smooth');
                    $objWriter->writeAttribute('val', $plotSeriesValues->getSmoothLine() ? '1' : '0');
                    $objWriter->endElement();
                }
            }

            if ($groupType === DataSeries::TYPE_BUBBLECHART) {
                if (!empty($plotGroup->getPlotBubbleSizes()[$plotSeriesIdx])) {
                    $objWriter->startElement('c:bubbleSize');
                    $this->writePlotSeriesValues(
                        $plotGroup->getPlotBubbleSizes()[$plotSeriesIdx],
                        $objWriter,
                        $groupType,
                        'num'
                    );
                    $objWriter->endElement();
                    if ($plotSeriesValues !== false) {
                        $objWriter->startElement('c:bubble3D');
                        $objWriter->writeAttribute('val', $plotSeriesValues->getBubble3D() ? '1' : '0');
                        $objWriter->endElement();
                    }
                } elseif ($plotSeriesValues !== false) {
                    $this->writeBubbles($plotSeriesValues, $objWriter);
                }
>>>>>>> main
            }

            $objWriter->endElement();
        }

        $this->seriesIndex += $plotSeriesIdx + 1;
    }

    /**
     * Write Plot Series Label.
     */
    private function writePlotSeriesLabel(?DataSeriesValues $plotSeriesLabel, XMLWriter $objWriter): void
    {
        if ($plotSeriesLabel === null) {
            return;
        }

        $objWriter->startElement('c:f');
        $objWriter->writeRawData($plotSeriesLabel->getDataSource());
        $objWriter->endElement();

        $objWriter->startElement('c:strCache');
        $objWriter->startElement('c:ptCount');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', $plotSeriesLabel->getPointCount());
=======
        $objWriter->writeAttribute('val', (string) $plotSeriesLabel->getPointCount());
>>>>>>> main
        $objWriter->endElement();

        foreach ($plotSeriesLabel->getDataValues() as $plotLabelKey => $plotLabelValue) {
            $objWriter->startElement('c:pt');
            $objWriter->writeAttribute('idx', $plotLabelKey);

            $objWriter->startElement('c:v');
            $objWriter->writeRawData($plotLabelValue);
            $objWriter->endElement();
            $objWriter->endElement();
        }
        $objWriter->endElement();
    }

    /**
     * Write Plot Series Values.
     *
     * @param string $groupType Type of plot for dataseries
     * @param string $dataType Datatype of series values
     */
    private function writePlotSeriesValues(?DataSeriesValues $plotSeriesValues, XMLWriter $objWriter, $groupType, $dataType = 'str'): void
    {
        if ($plotSeriesValues === null) {
            return;
        }

        if ($plotSeriesValues->isMultiLevelSeries()) {
            $levelCount = $plotSeriesValues->multiLevelCount();

            $objWriter->startElement('c:multiLvlStrRef');

            $objWriter->startElement('c:f');
            $objWriter->writeRawData($plotSeriesValues->getDataSource());
            $objWriter->endElement();

            $objWriter->startElement('c:multiLvlStrCache');

            $objWriter->startElement('c:ptCount');
<<<<<<< HEAD
            $objWriter->writeAttribute('val', $plotSeriesValues->getPointCount());
=======
            $objWriter->writeAttribute('val', (string) $plotSeriesValues->getPointCount());
>>>>>>> main
            $objWriter->endElement();

            for ($level = 0; $level < $levelCount; ++$level) {
                $objWriter->startElement('c:lvl');

                foreach ($plotSeriesValues->getDataValues() as $plotSeriesKey => $plotSeriesValue) {
                    if (isset($plotSeriesValue[$level])) {
                        $objWriter->startElement('c:pt');
                        $objWriter->writeAttribute('idx', $plotSeriesKey);

                        $objWriter->startElement('c:v');
                        $objWriter->writeRawData($plotSeriesValue[$level]);
                        $objWriter->endElement();
                        $objWriter->endElement();
                    }
                }

                $objWriter->endElement();
            }

            $objWriter->endElement();

            $objWriter->endElement();
        } else {
            $objWriter->startElement('c:' . $dataType . 'Ref');

            $objWriter->startElement('c:f');
            $objWriter->writeRawData($plotSeriesValues->getDataSource());
            $objWriter->endElement();

<<<<<<< HEAD
            $objWriter->startElement('c:' . $dataType . 'Cache');

            if (($groupType != DataSeries::TYPE_PIECHART) && ($groupType != DataSeries::TYPE_PIECHART_3D) && ($groupType != DataSeries::TYPE_DONUTCHART)) {
                if (($plotSeriesValues->getFormatCode() !== null) && ($plotSeriesValues->getFormatCode() !== '')) {
                    $objWriter->startElement('c:formatCode');
                    $objWriter->writeRawData($plotSeriesValues->getFormatCode());
                    $objWriter->endElement();
                }
            }

            $objWriter->startElement('c:ptCount');
            $objWriter->writeAttribute('val', $plotSeriesValues->getPointCount());
            $objWriter->endElement();

            $dataValues = $plotSeriesValues->getDataValues();
            if (!empty($dataValues)) {
                if (is_array($dataValues)) {
=======
            $count = $plotSeriesValues->getPointCount();
            $source = $plotSeriesValues->getDataSource();
            $values = $plotSeriesValues->getDataValues();
            if ($count > 1 || ($count === 1 && array_key_exists(0, $values) && "=$source" !== (string) $values[0])) {
                $objWriter->startElement('c:' . $dataType . 'Cache');

                if (($groupType != DataSeries::TYPE_PIECHART) && ($groupType != DataSeries::TYPE_PIECHART_3D) && ($groupType != DataSeries::TYPE_DONUTCHART)) {
                    if (($plotSeriesValues->getFormatCode() !== null) && ($plotSeriesValues->getFormatCode() !== '')) {
                        $objWriter->startElement('c:formatCode');
                        $objWriter->writeRawData($plotSeriesValues->getFormatCode());
                        $objWriter->endElement();
                    }
                }

                $objWriter->startElement('c:ptCount');
                $objWriter->writeAttribute('val', (string) $plotSeriesValues->getPointCount());
                $objWriter->endElement();

                $dataValues = $plotSeriesValues->getDataValues();
                if (!empty($dataValues)) {
>>>>>>> main
                    foreach ($dataValues as $plotSeriesKey => $plotSeriesValue) {
                        $objWriter->startElement('c:pt');
                        $objWriter->writeAttribute('idx', $plotSeriesKey);

                        $objWriter->startElement('c:v');
                        $objWriter->writeRawData($plotSeriesValue);
                        $objWriter->endElement();
                        $objWriter->endElement();
                    }
                }
<<<<<<< HEAD
            }

            $objWriter->endElement();

            $objWriter->endElement();
        }
    }

=======

                $objWriter->endElement(); // *Cache
            }

            $objWriter->endElement(); // *Ref
        }
    }

    private const CUSTOM_COLOR_TYPES = [
        DataSeries::TYPE_BARCHART,
        DataSeries::TYPE_BARCHART_3D,
        DataSeries::TYPE_PIECHART,
        DataSeries::TYPE_PIECHART_3D,
        DataSeries::TYPE_DONUTCHART,
    ];

>>>>>>> main
    /**
     * Write Bubble Chart Details.
     */
    private function writeBubbles(?DataSeriesValues $plotSeriesValues, XMLWriter $objWriter): void
    {
        if ($plotSeriesValues === null) {
            return;
        }

        $objWriter->startElement('c:bubbleSize');
        $objWriter->startElement('c:numLit');

        $objWriter->startElement('c:formatCode');
        $objWriter->writeRawData('General');
        $objWriter->endElement();

        $objWriter->startElement('c:ptCount');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', $plotSeriesValues->getPointCount());
=======
        $objWriter->writeAttribute('val', (string) $plotSeriesValues->getPointCount());
>>>>>>> main
        $objWriter->endElement();

        $dataValues = $plotSeriesValues->getDataValues();
        if (!empty($dataValues)) {
<<<<<<< HEAD
            if (is_array($dataValues)) {
                foreach ($dataValues as $plotSeriesKey => $plotSeriesValue) {
                    $objWriter->startElement('c:pt');
                    $objWriter->writeAttribute('idx', $plotSeriesKey);
                    $objWriter->startElement('c:v');
                    $objWriter->writeRawData(1);
                    $objWriter->endElement();
                    $objWriter->endElement();
                }
=======
            foreach ($dataValues as $plotSeriesKey => $plotSeriesValue) {
                $objWriter->startElement('c:pt');
                $objWriter->writeAttribute('idx', $plotSeriesKey);
                $objWriter->startElement('c:v');
                $objWriter->writeRawData('1');
                $objWriter->endElement();
                $objWriter->endElement();
>>>>>>> main
            }
        }

        $objWriter->endElement();
        $objWriter->endElement();

        $objWriter->startElement('c:bubble3D');
<<<<<<< HEAD
        $objWriter->writeAttribute('val', 0);
=======
        $objWriter->writeAttribute('val', $plotSeriesValues->getBubble3D() ? '1' : '0');
>>>>>>> main
        $objWriter->endElement();
    }

    /**
     * Write Layout.
     */
    private function writeLayout(XMLWriter $objWriter, ?Layout $layout = null): void
    {
        $objWriter->startElement('c:layout');

        if ($layout !== null) {
            $objWriter->startElement('c:manualLayout');

            $layoutTarget = $layout->getLayoutTarget();
            if ($layoutTarget !== null) {
                $objWriter->startElement('c:layoutTarget');
                $objWriter->writeAttribute('val', $layoutTarget);
                $objWriter->endElement();
            }

            $xMode = $layout->getXMode();
            if ($xMode !== null) {
                $objWriter->startElement('c:xMode');
                $objWriter->writeAttribute('val', $xMode);
                $objWriter->endElement();
            }

            $yMode = $layout->getYMode();
            if ($yMode !== null) {
                $objWriter->startElement('c:yMode');
                $objWriter->writeAttribute('val', $yMode);
                $objWriter->endElement();
            }

            $x = $layout->getXPosition();
            if ($x !== null) {
                $objWriter->startElement('c:x');
<<<<<<< HEAD
                $objWriter->writeAttribute('val', $x);
=======
                $objWriter->writeAttribute('val', "$x");
>>>>>>> main
                $objWriter->endElement();
            }

            $y = $layout->getYPosition();
            if ($y !== null) {
                $objWriter->startElement('c:y');
<<<<<<< HEAD
                $objWriter->writeAttribute('val', $y);
=======
                $objWriter->writeAttribute('val', "$y");
>>>>>>> main
                $objWriter->endElement();
            }

            $w = $layout->getWidth();
            if ($w !== null) {
                $objWriter->startElement('c:w');
<<<<<<< HEAD
                $objWriter->writeAttribute('val', $w);
=======
                $objWriter->writeAttribute('val', "$w");
>>>>>>> main
                $objWriter->endElement();
            }

            $h = $layout->getHeight();
            if ($h !== null) {
                $objWriter->startElement('c:h');
<<<<<<< HEAD
                $objWriter->writeAttribute('val', $h);
=======
                $objWriter->writeAttribute('val', "$h");
>>>>>>> main
                $objWriter->endElement();
            }

            $objWriter->endElement();
        }

        $objWriter->endElement();
    }

    /**
     * Write Alternate Content block.
     */
    private function writeAlternateContent(XMLWriter $objWriter): void
    {
        $objWriter->startElement('mc:AlternateContent');
<<<<<<< HEAD
        $objWriter->writeAttribute('xmlns:mc', 'http://schemas.openxmlformats.org/markup-compatibility/2006');

        $objWriter->startElement('mc:Choice');
        $objWriter->writeAttribute('xmlns:c14', 'http://schemas.microsoft.com/office/drawing/2007/8/2/chart');
        $objWriter->writeAttribute('Requires', 'c14');
=======
        $objWriter->writeAttribute('xmlns:mc', Namespaces::COMPATIBILITY);

        $objWriter->startElement('mc:Choice');
        $objWriter->writeAttribute('Requires', 'c14');
        $objWriter->writeAttribute('xmlns:c14', Namespaces::CHART_ALTERNATE);
>>>>>>> main

        $objWriter->startElement('c14:style');
        $objWriter->writeAttribute('val', '102');
        $objWriter->endElement();
        $objWriter->endElement();

        $objWriter->startElement('mc:Fallback');
        $objWriter->startElement('c:style');
        $objWriter->writeAttribute('val', '2');
        $objWriter->endElement();
        $objWriter->endElement();

        $objWriter->endElement();
    }

    /**
     * Write Printer Settings.
     */
    private function writePrintSettings(XMLWriter $objWriter): void
    {
        $objWriter->startElement('c:printSettings');

        $objWriter->startElement('c:headerFooter');
        $objWriter->endElement();

        $objWriter->startElement('c:pageMargins');
<<<<<<< HEAD
        $objWriter->writeAttribute('footer', 0.3);
        $objWriter->writeAttribute('header', 0.3);
        $objWriter->writeAttribute('r', 0.7);
        $objWriter->writeAttribute('l', 0.7);
        $objWriter->writeAttribute('t', 0.75);
        $objWriter->writeAttribute('b', 0.75);
=======
        $objWriter->writeAttribute('footer', '0.3');
        $objWriter->writeAttribute('header', '0.3');
        $objWriter->writeAttribute('r', '0.7');
        $objWriter->writeAttribute('l', '0.7');
        $objWriter->writeAttribute('t', '0.75');
        $objWriter->writeAttribute('b', '0.75');
>>>>>>> main
        $objWriter->endElement();

        $objWriter->startElement('c:pageSetup');
        $objWriter->writeAttribute('orientation', 'portrait');
        $objWriter->endElement();

        $objWriter->endElement();
    }
<<<<<<< HEAD
=======

    private function writeEffects(XMLWriter $objWriter, Properties $yAxis): void
    {
        if (
            !empty($yAxis->getSoftEdgesSize())
            || !empty($yAxis->getShadowProperty('effect'))
            || !empty($yAxis->getGlowProperty('size'))
        ) {
            $objWriter->startElement('a:effectLst');
            $this->writeGlow($objWriter, $yAxis);
            $this->writeShadow($objWriter, $yAxis);
            $this->writeSoftEdge($objWriter, $yAxis);
            $objWriter->endElement(); // effectLst
        }
    }

    private function writeShadow(XMLWriter $objWriter, Properties $xAxis): void
    {
        if (empty($xAxis->getShadowProperty('effect'))) {
            return;
        }
        /** @var string */
        $effect = $xAxis->getShadowProperty('effect');
        $objWriter->startElement("a:$effect");

        if (is_numeric($xAxis->getShadowProperty('blur'))) {
            $objWriter->writeAttribute('blurRad', Properties::pointsToXml((float) $xAxis->getShadowProperty('blur')));
        }
        if (is_numeric($xAxis->getShadowProperty('distance'))) {
            $objWriter->writeAttribute('dist', Properties::pointsToXml((float) $xAxis->getShadowProperty('distance')));
        }
        if (is_numeric($xAxis->getShadowProperty('direction'))) {
            $objWriter->writeAttribute('dir', Properties::angleToXml((float) $xAxis->getShadowProperty('direction')));
        }
        $algn = $xAxis->getShadowProperty('algn');
        if (is_string($algn) && $algn !== '') {
            $objWriter->writeAttribute('algn', $algn);
        }
        foreach (['sx', 'sy'] as $sizeType) {
            $sizeValue = $xAxis->getShadowProperty(['size', $sizeType]);
            if (is_numeric($sizeValue)) {
                $objWriter->writeAttribute($sizeType, Properties::tenthOfPercentToXml((float) $sizeValue));
            }
        }
        foreach (['kx', 'ky'] as $sizeType) {
            $sizeValue = $xAxis->getShadowProperty(['size', $sizeType]);
            if (is_numeric($sizeValue)) {
                $objWriter->writeAttribute($sizeType, Properties::angleToXml((float) $sizeValue));
            }
        }
        $rotWithShape = $xAxis->getShadowProperty('rotWithShape');
        if (is_numeric($rotWithShape)) {
            $objWriter->writeAttribute('rotWithShape', (string) (int) $rotWithShape);
        }

        $this->writeColor($objWriter, $xAxis->getShadowColorObject(), false);

        $objWriter->endElement();
    }

    private function writeGlow(XMLWriter $objWriter, Properties $yAxis): void
    {
        $size = $yAxis->getGlowProperty('size');
        if (empty($size)) {
            return;
        }
        $objWriter->startElement('a:glow');
        $objWriter->writeAttribute('rad', Properties::pointsToXml((float) $size));
        $this->writeColor($objWriter, $yAxis->getGlowColorObject(), false);
        $objWriter->endElement(); // glow
    }

    private function writeSoftEdge(XMLWriter $objWriter, Properties $yAxis): void
    {
        $softEdgeSize = $yAxis->getSoftEdgesSize();
        if (empty($softEdgeSize)) {
            return;
        }
        $objWriter->startElement('a:softEdge');
        $objWriter->writeAttribute('rad', Properties::pointsToXml((float) $softEdgeSize));
        $objWriter->endElement(); //end softEdge
    }

    private function writeLineStyles(XMLWriter $objWriter, Properties $gridlines, bool $noFill = false): void
    {
        $objWriter->startElement('a:ln');
        $widthTemp = $gridlines->getLineStyleProperty('width');
        if (is_numeric($widthTemp)) {
            $objWriter->writeAttribute('w', Properties::pointsToXml((float) $widthTemp));
        }
        $this->writeNotEmpty($objWriter, 'cap', $gridlines->getLineStyleProperty('cap'));
        $this->writeNotEmpty($objWriter, 'cmpd', $gridlines->getLineStyleProperty('compound'));
        if ($noFill) {
            $objWriter->startElement('a:noFill');
            $objWriter->endElement();
        } else {
            $this->writeColor($objWriter, $gridlines->getLineColor());
        }

        $dash = $gridlines->getLineStyleProperty('dash');
        if (!empty($dash)) {
            $objWriter->startElement('a:prstDash');
            $this->writeNotEmpty($objWriter, 'val', $dash);
            $objWriter->endElement();
        }

        if ($gridlines->getLineStyleProperty('join') === 'miter') {
            $objWriter->startElement('a:miter');
            $objWriter->writeAttribute('lim', '800000');
            $objWriter->endElement();
        } elseif ($gridlines->getLineStyleProperty('join') === 'bevel') {
            $objWriter->startElement('a:bevel');
            $objWriter->endElement();
        }

        if ($gridlines->getLineStyleProperty(['arrow', 'head', 'type'])) {
            $objWriter->startElement('a:headEnd');
            $objWriter->writeAttribute('type', $gridlines->getLineStyleProperty(['arrow', 'head', 'type']));
            $this->writeNotEmpty($objWriter, 'w', $gridlines->getLineStyleArrowWidth('head'));
            $this->writeNotEmpty($objWriter, 'len', $gridlines->getLineStyleArrowLength('head'));
            $objWriter->endElement();
        }

        if ($gridlines->getLineStyleProperty(['arrow', 'end', 'type'])) {
            $objWriter->startElement('a:tailEnd');
            $objWriter->writeAttribute('type', $gridlines->getLineStyleProperty(['arrow', 'end', 'type']));
            $this->writeNotEmpty($objWriter, 'w', $gridlines->getLineStyleArrowWidth('end'));
            $this->writeNotEmpty($objWriter, 'len', $gridlines->getLineStyleArrowLength('end'));
            $objWriter->endElement();
        }
        $objWriter->endElement(); //end ln
    }

    private function writeNotEmpty(XMLWriter $objWriter, string $name, ?string $value): void
    {
        if ($value !== null && $value !== '') {
            $objWriter->writeAttribute($name, $value);
        }
    }

    private function writeColor(XMLWriter $objWriter, ChartColor $chartColor, bool $solidFill = true): void
    {
        $type = $chartColor->getType();
        $value = $chartColor->getValue();
        if (!empty($type) && !empty($value)) {
            if ($solidFill) {
                $objWriter->startElement('a:solidFill');
            }
            $objWriter->startElement("a:$type");
            $objWriter->writeAttribute('val', $value);
            $alpha = $chartColor->getAlpha();
            if (is_numeric($alpha)) {
                $objWriter->startElement('a:alpha');
                $objWriter->writeAttribute('val', ChartColor::alphaToXml((int) $alpha));
                $objWriter->endElement(); // a:alpha
            }
            $brightness = $chartColor->getBrightness();
            if (is_numeric($brightness)) {
                $brightness = (int) $brightness;
                $lumOff = 100 - $brightness;
                $objWriter->startElement('a:lumMod');
                $objWriter->writeAttribute('val', ChartColor::alphaToXml($brightness));
                $objWriter->endElement(); // a:lumMod
                $objWriter->startElement('a:lumOff');
                $objWriter->writeAttribute('val', ChartColor::alphaToXml($lumOff));
                $objWriter->endElement(); // a:lumOff
            }
            $objWriter->endElement(); //a:srgbClr/schemeClr/prstClr
            if ($solidFill) {
                $objWriter->endElement(); //a:solidFill
            }
        }
    }

    private function writeLabelFont(XMLWriter $objWriter, ?Font $labelFont, ?Properties $axisText): void
    {
        $objWriter->startElement('a:p');
        $objWriter->startElement('a:pPr');
        $objWriter->startElement('a:defRPr');
        if ($labelFont !== null) {
            $fontSize = $labelFont->getSize();
            if (is_numeric($fontSize)) {
                $fontSize *= (($fontSize < 100) ? 100 : 1);
                $objWriter->writeAttribute('sz', (string) $fontSize);
            }
            if ($labelFont->getBold() === true) {
                $objWriter->writeAttribute('b', '1');
            }
            if ($labelFont->getItalic() === true) {
                $objWriter->writeAttribute('i', '1');
            }
            $fontColor = $labelFont->getChartColor();
            if ($fontColor !== null) {
                $this->writeColor($objWriter, $fontColor);
            }
        }
        if ($axisText !== null) {
            $this->writeEffects($objWriter, $axisText);
        }
        if ($labelFont !== null) {
            if (!empty($labelFont->getLatin())) {
                $objWriter->startElement('a:latin');
                $objWriter->writeAttribute('typeface', $labelFont->getLatin());
                $objWriter->endElement();
            }
            if (!empty($labelFont->getEastAsian())) {
                $objWriter->startElement('a:eastAsian');
                $objWriter->writeAttribute('typeface', $labelFont->getEastAsian());
                $objWriter->endElement();
            }
            if (!empty($labelFont->getComplexScript())) {
                $objWriter->startElement('a:complexScript');
                $objWriter->writeAttribute('typeface', $labelFont->getComplexScript());
                $objWriter->endElement();
            }
        }
        $objWriter->endElement(); // a:defRPr
        $objWriter->endElement(); // a:pPr
        $objWriter->endElement(); // a:p
    }
>>>>>>> main
}
