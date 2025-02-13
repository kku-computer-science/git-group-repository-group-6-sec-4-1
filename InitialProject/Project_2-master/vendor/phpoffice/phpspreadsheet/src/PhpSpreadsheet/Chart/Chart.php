<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Chart
{
    /**
     * Chart Name.
     *
     * @var string
     */
    private $name = '';

    /**
     * Worksheet.
     *
<<<<<<< HEAD
     * @var Worksheet
=======
     * @var ?Worksheet
>>>>>>> main
     */
    private $worksheet;

    /**
     * Chart Title.
     *
<<<<<<< HEAD
     * @var Title
=======
     * @var ?Title
>>>>>>> main
     */
    private $title;

    /**
     * Chart Legend.
     *
<<<<<<< HEAD
     * @var Legend
=======
     * @var ?Legend
>>>>>>> main
     */
    private $legend;

    /**
     * X-Axis Label.
     *
<<<<<<< HEAD
     * @var Title
=======
     * @var ?Title
>>>>>>> main
     */
    private $xAxisLabel;

    /**
     * Y-Axis Label.
     *
<<<<<<< HEAD
     * @var Title
=======
     * @var ?Title
>>>>>>> main
     */
    private $yAxisLabel;

    /**
     * Chart Plot Area.
     *
<<<<<<< HEAD
     * @var PlotArea
=======
     * @var ?PlotArea
>>>>>>> main
     */
    private $plotArea;

    /**
     * Plot Visible Only.
     *
     * @var bool
     */
    private $plotVisibleOnly = true;

    /**
     * Display Blanks as.
     *
     * @var string
     */
    private $displayBlanksAs = DataSeries::EMPTY_AS_GAP;

    /**
     * Chart Asix Y as.
     *
     * @var Axis
     */
    private $yAxis;

    /**
     * Chart Asix X as.
     *
     * @var Axis
     */
    private $xAxis;

    /**
<<<<<<< HEAD
     * Chart Major Gridlines as.
     *
     * @var GridLines
     */
    private $majorGridlines;

    /**
     * Chart Minor Gridlines as.
     *
     * @var GridLines
     */
    private $minorGridlines;

    /**
=======
>>>>>>> main
     * Top-Left Cell Position.
     *
     * @var string
     */
    private $topLeftCellRef = 'A1';

    /**
     * Top-Left X-Offset.
     *
     * @var int
     */
    private $topLeftXOffset = 0;

    /**
     * Top-Left Y-Offset.
     *
     * @var int
     */
    private $topLeftYOffset = 0;

    /**
     * Bottom-Right Cell Position.
     *
     * @var string
     */
<<<<<<< HEAD
    private $bottomRightCellRef = 'A1';
=======
    private $bottomRightCellRef = '';
>>>>>>> main

    /**
     * Bottom-Right X-Offset.
     *
     * @var int
     */
    private $bottomRightXOffset = 10;

    /**
     * Bottom-Right Y-Offset.
     *
     * @var int
     */
    private $bottomRightYOffset = 10;

<<<<<<< HEAD
    /**
     * Create a new Chart.
=======
    /** @var ?int */
    private $rotX;

    /** @var ?int */
    private $rotY;

    /** @var ?int */
    private $rAngAx;

    /** @var ?int */
    private $perspective;

    /** @var bool */
    private $oneCellAnchor = false;

    /** @var bool */
    private $autoTitleDeleted = false;

    /** @var bool */
    private $noFill = false;

    /** @var bool */
    private $roundedCorners = false;

    /** @var GridLines */
    private $borderLines;

    /** @var ChartColor */
    private $fillColor;

    /**
     * Create a new Chart.
     * majorGridlines and minorGridlines are deprecated, moved to Axis.
>>>>>>> main
     *
     * @param mixed $name
     * @param mixed $plotVisibleOnly
     * @param string $displayBlanksAs
     */
    public function __construct($name, ?Title $title = null, ?Legend $legend = null, ?PlotArea $plotArea = null, $plotVisibleOnly = true, $displayBlanksAs = DataSeries::EMPTY_AS_GAP, ?Title $xAxisLabel = null, ?Title $yAxisLabel = null, ?Axis $xAxis = null, ?Axis $yAxis = null, ?GridLines $majorGridlines = null, ?GridLines $minorGridlines = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->legend = $legend;
        $this->xAxisLabel = $xAxisLabel;
        $this->yAxisLabel = $yAxisLabel;
        $this->plotArea = $plotArea;
        $this->plotVisibleOnly = $plotVisibleOnly;
        $this->displayBlanksAs = $displayBlanksAs;
<<<<<<< HEAD
        $this->xAxis = $xAxis;
        $this->yAxis = $yAxis;
        $this->majorGridlines = $majorGridlines;
        $this->minorGridlines = $minorGridlines;
=======
        $this->xAxis = $xAxis ?? new Axis();
        $this->yAxis = $yAxis ?? new Axis();
        if ($majorGridlines !== null) {
            $this->yAxis->setMajorGridlines($majorGridlines);
        }
        if ($minorGridlines !== null) {
            $this->yAxis->setMinorGridlines($minorGridlines);
        }
        $this->fillColor = new ChartColor();
        $this->borderLines = new GridLines();
>>>>>>> main
    }

    /**
     * Get Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

<<<<<<< HEAD
    /**
     * Get Worksheet.
     *
     * @return Worksheet
     */
    public function getWorksheet()
=======
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Worksheet.
     */
    public function getWorksheet(): ?Worksheet
>>>>>>> main
    {
        return $this->worksheet;
    }

    /**
     * Set Worksheet.
     *
     * @return $this
     */
    public function setWorksheet(?Worksheet $worksheet = null)
    {
        $this->worksheet = $worksheet;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Title.
     *
     * @return Title
     */
    public function getTitle()
=======
    public function getTitle(): ?Title
>>>>>>> main
    {
        return $this->title;
    }

    /**
     * Set Title.
     *
     * @return $this
     */
    public function setTitle(Title $title)
    {
        $this->title = $title;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Legend.
     *
     * @return Legend
     */
    public function getLegend()
=======
    public function getLegend(): ?Legend
>>>>>>> main
    {
        return $this->legend;
    }

    /**
     * Set Legend.
     *
     * @return $this
     */
    public function setLegend(Legend $legend)
    {
        $this->legend = $legend;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get X-Axis Label.
     *
     * @return Title
     */
    public function getXAxisLabel()
=======
    public function getXAxisLabel(): ?Title
>>>>>>> main
    {
        return $this->xAxisLabel;
    }

    /**
     * Set X-Axis Label.
     *
     * @return $this
     */
    public function setXAxisLabel(Title $label)
    {
        $this->xAxisLabel = $label;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Y-Axis Label.
     *
     * @return Title
     */
    public function getYAxisLabel()
=======
    public function getYAxisLabel(): ?Title
>>>>>>> main
    {
        return $this->yAxisLabel;
    }

    /**
     * Set Y-Axis Label.
     *
     * @return $this
     */
    public function setYAxisLabel(Title $label)
    {
        $this->yAxisLabel = $label;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Plot Area.
     *
     * @return PlotArea
     */
    public function getPlotArea()
=======
    public function getPlotArea(): ?PlotArea
>>>>>>> main
    {
        return $this->plotArea;
    }

    /**
<<<<<<< HEAD
=======
     * Set Plot Area.
     */
    public function setPlotArea(PlotArea $plotArea): self
    {
        $this->plotArea = $plotArea;

        return $this;
    }

    /**
>>>>>>> main
     * Get Plot Visible Only.
     *
     * @return bool
     */
    public function getPlotVisibleOnly()
    {
        return $this->plotVisibleOnly;
    }

    /**
     * Set Plot Visible Only.
     *
     * @param bool $plotVisibleOnly
     *
     * @return $this
     */
    public function setPlotVisibleOnly($plotVisibleOnly)
    {
        $this->plotVisibleOnly = $plotVisibleOnly;

        return $this;
    }

    /**
     * Get Display Blanks as.
     *
     * @return string
     */
    public function getDisplayBlanksAs()
    {
        return $this->displayBlanksAs;
    }

    /**
     * Set Display Blanks as.
     *
     * @param string $displayBlanksAs
     *
     * @return $this
     */
    public function setDisplayBlanksAs($displayBlanksAs)
    {
        $this->displayBlanksAs = $displayBlanksAs;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get yAxis.
     *
     * @return Axis
     */
    public function getChartAxisY()
    {
        if ($this->yAxis !== null) {
            return $this->yAxis;
        }

        return new Axis();
    }

    /**
     * Get xAxis.
     *
     * @return Axis
     */
    public function getChartAxisX()
    {
        if ($this->xAxis !== null) {
            return $this->xAxis;
        }

        return new Axis();
=======
    public function getChartAxisY(): Axis
    {
        return $this->yAxis;
    }

    /**
     * Set yAxis.
     */
    public function setChartAxisY(?Axis $axis): self
    {
        $this->yAxis = $axis ?? new Axis();

        return $this;
    }

    public function getChartAxisX(): Axis
    {
        return $this->xAxis;
    }

    /**
     * Set xAxis.
     */
    public function setChartAxisX(?Axis $axis): self
    {
        $this->xAxis = $axis ?? new Axis();

        return $this;
>>>>>>> main
    }

    /**
     * Get Major Gridlines.
     *
<<<<<<< HEAD
     * @return GridLines
     */
    public function getMajorGridlines()
    {
        if ($this->majorGridlines !== null) {
            return $this->majorGridlines;
        }

        return new GridLines();
=======
     * @deprecated 1.24.0 Use Axis->getMajorGridlines()
     * @see Axis::getMajorGridlines()
     *
     * @codeCoverageIgnore
     */
    public function getMajorGridlines(): ?GridLines
    {
        return $this->yAxis->getMajorGridLines();
>>>>>>> main
    }

    /**
     * Get Minor Gridlines.
     *
<<<<<<< HEAD
     * @return GridLines
     */
    public function getMinorGridlines()
    {
        if ($this->minorGridlines !== null) {
            return $this->minorGridlines;
        }

        return new GridLines();
=======
     * @deprecated 1.24.0 Use Axis->getMinorGridlines()
     * @see Axis::getMinorGridlines()
     *
     * @codeCoverageIgnore
     */
    public function getMinorGridlines(): ?GridLines
    {
        return $this->yAxis->getMinorGridLines();
>>>>>>> main
    }

    /**
     * Set the Top Left position for the chart.
     *
<<<<<<< HEAD
     * @param string $cell
=======
     * @param string $cellAddress
>>>>>>> main
     * @param int $xOffset
     * @param int $yOffset
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setTopLeftPosition($cell, $xOffset = null, $yOffset = null)
    {
        $this->topLeftCellRef = $cell;
=======
    public function setTopLeftPosition($cellAddress, $xOffset = null, $yOffset = null)
    {
        $this->topLeftCellRef = $cellAddress;
>>>>>>> main
        if ($xOffset !== null) {
            $this->setTopLeftXOffset($xOffset);
        }
        if ($yOffset !== null) {
            $this->setTopLeftYOffset($yOffset);
        }

        return $this;
    }

    /**
     * Get the top left position of the chart.
     *
<<<<<<< HEAD
     * @return array{cell: string, xOffset: int, yOffset: int} an associative array containing the cell address, X-Offset and Y-Offset from the top left of that cell
     */
    public function getTopLeftPosition()
=======
     * Returns ['cell' => string cell address, 'xOffset' => int, 'yOffset' => int].
     *
     * @return array{cell: string, xOffset: int, yOffset: int} an associative array containing the cell address, X-Offset and Y-Offset from the top left of that cell
     */
    public function getTopLeftPosition(): array
>>>>>>> main
    {
        return [
            'cell' => $this->topLeftCellRef,
            'xOffset' => $this->topLeftXOffset,
            'yOffset' => $this->topLeftYOffset,
        ];
    }

    /**
     * Get the cell address where the top left of the chart is fixed.
     *
     * @return string
     */
    public function getTopLeftCell()
    {
        return $this->topLeftCellRef;
    }

    /**
     * Set the Top Left cell position for the chart.
     *
<<<<<<< HEAD
     * @param string $cell
     *
     * @return $this
     */
    public function setTopLeftCell($cell)
    {
        $this->topLeftCellRef = $cell;
=======
     * @param string $cellAddress
     *
     * @return $this
     */
    public function setTopLeftCell($cellAddress)
    {
        $this->topLeftCellRef = $cellAddress;
>>>>>>> main

        return $this;
    }

    /**
     * Set the offset position within the Top Left cell for the chart.
     *
<<<<<<< HEAD
     * @param int $xOffset
     * @param int $yOffset
=======
     * @param ?int $xOffset
     * @param ?int $yOffset
>>>>>>> main
     *
     * @return $this
     */
    public function setTopLeftOffset($xOffset, $yOffset)
    {
        if ($xOffset !== null) {
            $this->setTopLeftXOffset($xOffset);
        }

        if ($yOffset !== null) {
            $this->setTopLeftYOffset($yOffset);
        }

        return $this;
    }

    /**
     * Get the offset position within the Top Left cell for the chart.
     *
     * @return int[]
     */
    public function getTopLeftOffset()
    {
        return [
            'X' => $this->topLeftXOffset,
            'Y' => $this->topLeftYOffset,
        ];
    }

<<<<<<< HEAD
=======
    /**
     * @param int $xOffset
     *
     * @return $this
     */
>>>>>>> main
    public function setTopLeftXOffset($xOffset)
    {
        $this->topLeftXOffset = $xOffset;

        return $this;
    }

<<<<<<< HEAD
    public function getTopLeftXOffset()
=======
    public function getTopLeftXOffset(): int
>>>>>>> main
    {
        return $this->topLeftXOffset;
    }

<<<<<<< HEAD
=======
    /**
     * @param int $yOffset
     *
     * @return $this
     */
>>>>>>> main
    public function setTopLeftYOffset($yOffset)
    {
        $this->topLeftYOffset = $yOffset;

        return $this;
    }

<<<<<<< HEAD
    public function getTopLeftYOffset()
=======
    public function getTopLeftYOffset(): int
>>>>>>> main
    {
        return $this->topLeftYOffset;
    }

    /**
     * Set the Bottom Right position of the chart.
     *
<<<<<<< HEAD
     * @param string $cell
=======
     * @param string $cellAddress
>>>>>>> main
     * @param int $xOffset
     * @param int $yOffset
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setBottomRightPosition($cell, $xOffset = null, $yOffset = null)
    {
        $this->bottomRightCellRef = $cell;
=======
    public function setBottomRightPosition($cellAddress = '', $xOffset = null, $yOffset = null)
    {
        $this->bottomRightCellRef = $cellAddress;
>>>>>>> main
        if ($xOffset !== null) {
            $this->setBottomRightXOffset($xOffset);
        }
        if ($yOffset !== null) {
            $this->setBottomRightYOffset($yOffset);
        }

        return $this;
    }

    /**
     * Get the bottom right position of the chart.
     *
     * @return array an associative array containing the cell address, X-Offset and Y-Offset from the top left of that cell
     */
    public function getBottomRightPosition()
    {
        return [
            'cell' => $this->bottomRightCellRef,
            'xOffset' => $this->bottomRightXOffset,
            'yOffset' => $this->bottomRightYOffset,
        ];
    }

<<<<<<< HEAD
    public function setBottomRightCell($cell)
    {
        $this->bottomRightCellRef = $cell;
=======
    /**
     * Set the Bottom Right cell for the chart.
     *
     * @return $this
     */
    public function setBottomRightCell(string $cellAddress = '')
    {
        $this->bottomRightCellRef = $cellAddress;
>>>>>>> main

        return $this;
    }

    /**
     * Get the cell address where the bottom right of the chart is fixed.
<<<<<<< HEAD
     *
     * @return string
     */
    public function getBottomRightCell()
=======
     */
    public function getBottomRightCell(): string
>>>>>>> main
    {
        return $this->bottomRightCellRef;
    }

    /**
     * Set the offset position within the Bottom Right cell for the chart.
     *
<<<<<<< HEAD
     * @param int $xOffset
     * @param int $yOffset
=======
     * @param ?int $xOffset
     * @param ?int $yOffset
>>>>>>> main
     *
     * @return $this
     */
    public function setBottomRightOffset($xOffset, $yOffset)
    {
        if ($xOffset !== null) {
            $this->setBottomRightXOffset($xOffset);
        }

        if ($yOffset !== null) {
            $this->setBottomRightYOffset($yOffset);
        }

        return $this;
    }

    /**
     * Get the offset position within the Bottom Right cell for the chart.
     *
     * @return int[]
     */
    public function getBottomRightOffset()
    {
        return [
            'X' => $this->bottomRightXOffset,
            'Y' => $this->bottomRightYOffset,
        ];
    }

<<<<<<< HEAD
=======
    /**
     * @param int $xOffset
     *
     * @return $this
     */
>>>>>>> main
    public function setBottomRightXOffset($xOffset)
    {
        $this->bottomRightXOffset = $xOffset;

        return $this;
    }

<<<<<<< HEAD
    public function getBottomRightXOffset()
=======
    public function getBottomRightXOffset(): int
>>>>>>> main
    {
        return $this->bottomRightXOffset;
    }

<<<<<<< HEAD
=======
    /**
     * @param int $yOffset
     *
     * @return $this
     */
>>>>>>> main
    public function setBottomRightYOffset($yOffset)
    {
        $this->bottomRightYOffset = $yOffset;

        return $this;
    }

<<<<<<< HEAD
    public function getBottomRightYOffset()
=======
    public function getBottomRightYOffset(): int
>>>>>>> main
    {
        return $this->bottomRightYOffset;
    }

    public function refresh(): void
    {
<<<<<<< HEAD
        if ($this->worksheet !== null) {
=======
        if ($this->worksheet !== null && $this->plotArea !== null) {
>>>>>>> main
            $this->plotArea->refresh($this->worksheet);
        }
    }

    /**
     * Render the chart to given file (or stream).
     *
     * @param string $outputDestination Name of the file render to
     *
     * @return bool true on success
     */
    public function render($outputDestination = null)
    {
        if ($outputDestination == 'php://output') {
            $outputDestination = null;
        }

        $libraryName = Settings::getChartRenderer();
        if ($libraryName === null) {
            return false;
        }

        // Ensure that data series values are up-to-date before we render
        $this->refresh();

        $renderer = new $libraryName($this);

<<<<<<< HEAD
        return $renderer->render($outputDestination);
=======
        return $renderer->render($outputDestination); // @phpstan-ignore-line
    }

    public function getRotX(): ?int
    {
        return $this->rotX;
    }

    public function setRotX(?int $rotX): self
    {
        $this->rotX = $rotX;

        return $this;
    }

    public function getRotY(): ?int
    {
        return $this->rotY;
    }

    public function setRotY(?int $rotY): self
    {
        $this->rotY = $rotY;

        return $this;
    }

    public function getRAngAx(): ?int
    {
        return $this->rAngAx;
    }

    public function setRAngAx(?int $rAngAx): self
    {
        $this->rAngAx = $rAngAx;

        return $this;
    }

    public function getPerspective(): ?int
    {
        return $this->perspective;
    }

    public function setPerspective(?int $perspective): self
    {
        $this->perspective = $perspective;

        return $this;
    }

    public function getOneCellAnchor(): bool
    {
        return $this->oneCellAnchor;
    }

    public function setOneCellAnchor(bool $oneCellAnchor): self
    {
        $this->oneCellAnchor = $oneCellAnchor;

        return $this;
    }

    public function getAutoTitleDeleted(): bool
    {
        return $this->autoTitleDeleted;
    }

    public function setAutoTitleDeleted(bool $autoTitleDeleted): self
    {
        $this->autoTitleDeleted = $autoTitleDeleted;

        return $this;
    }

    public function getNoFill(): bool
    {
        return $this->noFill;
    }

    public function setNoFill(bool $noFill): self
    {
        $this->noFill = $noFill;

        return $this;
    }

    public function getRoundedCorners(): bool
    {
        return $this->roundedCorners;
    }

    public function setRoundedCorners(?bool $roundedCorners): self
    {
        if ($roundedCorners !== null) {
            $this->roundedCorners = $roundedCorners;
        }

        return $this;
    }

    public function getBorderLines(): GridLines
    {
        return $this->borderLines;
    }

    public function setBorderLines(GridLines $borderLines): self
    {
        $this->borderLines = $borderLines;

        return $this;
    }

    public function getFillColor(): ChartColor
    {
        return $this->fillColor;
>>>>>>> main
    }
}
