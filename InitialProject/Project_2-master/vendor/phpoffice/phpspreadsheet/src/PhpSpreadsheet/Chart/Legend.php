<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

class Legend
{
    /** Legend positions */
    const XL_LEGEND_POSITION_BOTTOM = -4107; //    Below the chart.
    const XL_LEGEND_POSITION_CORNER = 2; //    In the upper right-hand corner of the chart border.
    const XL_LEGEND_POSITION_CUSTOM = -4161; //    A custom position.
    const XL_LEGEND_POSITION_LEFT = -4131; //    Left of the chart.
    const XL_LEGEND_POSITION_RIGHT = -4152; //    Right of the chart.
    const XL_LEGEND_POSITION_TOP = -4160; //    Above the chart.

    const POSITION_RIGHT = 'r';
    const POSITION_LEFT = 'l';
    const POSITION_BOTTOM = 'b';
    const POSITION_TOP = 't';
    const POSITION_TOPRIGHT = 'tr';

<<<<<<< HEAD
    private static $positionXLref = [
=======
    const POSITION_XLREF = [
>>>>>>> main
        self::XL_LEGEND_POSITION_BOTTOM => self::POSITION_BOTTOM,
        self::XL_LEGEND_POSITION_CORNER => self::POSITION_TOPRIGHT,
        self::XL_LEGEND_POSITION_CUSTOM => '??',
        self::XL_LEGEND_POSITION_LEFT => self::POSITION_LEFT,
        self::XL_LEGEND_POSITION_RIGHT => self::POSITION_RIGHT,
        self::XL_LEGEND_POSITION_TOP => self::POSITION_TOP,
    ];

    /**
     * Legend position.
     *
     * @var string
     */
    private $position = self::POSITION_RIGHT;

    /**
     * Allow overlay of other elements?
     *
     * @var bool
     */
    private $overlay = true;

    /**
     * Legend Layout.
     *
<<<<<<< HEAD
     * @var Layout
     */
    private $layout;

=======
     * @var ?Layout
     */
    private $layout;

    /** @var GridLines */
    private $borderLines;

    /** @var ChartColor */
    private $fillColor;

    /** @var ?AxisText */
    private $legendText;

>>>>>>> main
    /**
     * Create a new Legend.
     *
     * @param string $position
<<<<<<< HEAD
=======
     * @param ?Layout $layout
>>>>>>> main
     * @param bool $overlay
     */
    public function __construct($position = self::POSITION_RIGHT, ?Layout $layout = null, $overlay = false)
    {
        $this->setPosition($position);
        $this->layout = $layout;
        $this->setOverlay($overlay);
<<<<<<< HEAD
=======
        $this->borderLines = new GridLines();
        $this->fillColor = new ChartColor();
    }

    public function getFillColor(): ChartColor
    {
        return $this->fillColor;
>>>>>>> main
    }

    /**
     * Get legend position as an excel string value.
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Get legend position using an excel string value.
     *
     * @param string $position see self::POSITION_*
     *
     * @return bool
     */
    public function setPosition($position)
    {
<<<<<<< HEAD
        if (!in_array($position, self::$positionXLref)) {
=======
        if (!in_array($position, self::POSITION_XLREF)) {
>>>>>>> main
            return false;
        }

        $this->position = $position;

        return true;
    }

    /**
     * Get legend position as an Excel internal numeric value.
     *
<<<<<<< HEAD
     * @return int
     */
    public function getPositionXL()
    {
        return array_search($this->position, self::$positionXLref);
=======
     * @return false|int
     */
    public function getPositionXL()
    {
        // Scrutinizer thinks the following could return string. It is wrong.
        return array_search($this->position, self::POSITION_XLREF);
>>>>>>> main
    }

    /**
     * Set legend position using an Excel internal numeric value.
     *
     * @param int $positionXL see self::XL_LEGEND_POSITION_*
     *
     * @return bool
     */
    public function setPositionXL($positionXL)
    {
<<<<<<< HEAD
        if (!isset(self::$positionXLref[$positionXL])) {
            return false;
        }

        $this->position = self::$positionXLref[$positionXL];
=======
        if (!isset(self::POSITION_XLREF[$positionXL])) {
            return false;
        }

        $this->position = self::POSITION_XLREF[$positionXL];
>>>>>>> main

        return true;
    }

    /**
     * Get allow overlay of other elements?
     *
     * @return bool
     */
    public function getOverlay()
    {
        return $this->overlay;
    }

    /**
     * Set allow overlay of other elements?
     *
     * @param bool $overlay
     */
    public function setOverlay($overlay): void
    {
        $this->overlay = $overlay;
    }

    /**
     * Get Layout.
     *
<<<<<<< HEAD
     * @return Layout
=======
     * @return ?Layout
>>>>>>> main
     */
    public function getLayout()
    {
        return $this->layout;
    }
<<<<<<< HEAD
=======

    public function getLegendText(): ?AxisText
    {
        return $this->legendText;
    }

    public function setLegendText(?AxisText $legendText): self
    {
        $this->legendText = $legendText;

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
>>>>>>> main
}
