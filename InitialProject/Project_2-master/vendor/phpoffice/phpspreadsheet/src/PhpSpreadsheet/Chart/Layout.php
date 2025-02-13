<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Style\Font;

>>>>>>> main
class Layout
{
    /**
     * layoutTarget.
     *
<<<<<<< HEAD
     * @var string
=======
     * @var ?string
>>>>>>> main
     */
    private $layoutTarget;

    /**
     * X Mode.
     *
<<<<<<< HEAD
     * @var string
=======
     * @var ?string
>>>>>>> main
     */
    private $xMode;

    /**
     * Y Mode.
     *
<<<<<<< HEAD
     * @var string
=======
     * @var ?string
>>>>>>> main
     */
    private $yMode;

    /**
     * X-Position.
     *
<<<<<<< HEAD
     * @var float
=======
     * @var ?float
>>>>>>> main
     */
    private $xPos;

    /**
     * Y-Position.
     *
<<<<<<< HEAD
     * @var float
=======
     * @var ?float
>>>>>>> main
     */
    private $yPos;

    /**
     * width.
     *
<<<<<<< HEAD
     * @var float
=======
     * @var ?float
>>>>>>> main
     */
    private $width;

    /**
     * height.
     *
<<<<<<< HEAD
     * @var float
=======
     * @var ?float
>>>>>>> main
     */
    private $height;

    /**
<<<<<<< HEAD
     * show legend key
     * Specifies that legend keys should be shown in data labels.
     *
     * @var bool
=======
     * Position - t=top.
     *
     * @var string
     */
    private $dLblPos = '';

    /** @var string */
    private $numFmtCode = '';

    /** @var bool */
    private $numFmtLinked = false;

    /**
     * show legend key
     * Specifies that legend keys should be shown in data labels.
     *
     * @var ?bool
>>>>>>> main
     */
    private $showLegendKey;

    /**
     * show value
     * Specifies that the value should be shown in a data label.
     *
<<<<<<< HEAD
     * @var bool
=======
     * @var ?bool
>>>>>>> main
     */
    private $showVal;

    /**
     * show category name
     * Specifies that the category name should be shown in the data label.
     *
<<<<<<< HEAD
     * @var bool
=======
     * @var ?bool
>>>>>>> main
     */
    private $showCatName;

    /**
     * show data series name
     * Specifies that the series name should be shown in the data label.
     *
<<<<<<< HEAD
     * @var bool
=======
     * @var ?bool
>>>>>>> main
     */
    private $showSerName;

    /**
     * show percentage
     * Specifies that the percentage should be shown in the data label.
     *
<<<<<<< HEAD
     * @var bool
=======
     * @var ?bool
>>>>>>> main
     */
    private $showPercent;

    /**
     * show bubble size.
     *
<<<<<<< HEAD
     * @var bool
=======
     * @var ?bool
>>>>>>> main
     */
    private $showBubbleSize;

    /**
     * show leader lines
     * Specifies that leader lines should be shown for the data label.
     *
<<<<<<< HEAD
     * @var bool
     */
    private $showLeaderLines;

=======
     * @var ?bool
     */
    private $showLeaderLines;

    /** @var ?ChartColor */
    private $labelFillColor;

    /** @var ?ChartColor */
    private $labelBorderColor;

    /** @var ?Font */
    private $labelFont;

    /** @var Properties */
    private $labelEffects;

>>>>>>> main
    /**
     * Create a new Layout.
     */
    public function __construct(array $layout = [])
    {
        if (isset($layout['layoutTarget'])) {
            $this->layoutTarget = $layout['layoutTarget'];
        }
        if (isset($layout['xMode'])) {
            $this->xMode = $layout['xMode'];
        }
        if (isset($layout['yMode'])) {
            $this->yMode = $layout['yMode'];
        }
        if (isset($layout['x'])) {
            $this->xPos = (float) $layout['x'];
        }
        if (isset($layout['y'])) {
            $this->yPos = (float) $layout['y'];
        }
        if (isset($layout['w'])) {
            $this->width = (float) $layout['w'];
        }
        if (isset($layout['h'])) {
            $this->height = (float) $layout['h'];
        }
<<<<<<< HEAD
=======
        if (isset($layout['dLblPos'])) {
            $this->dLblPos = (string) $layout['dLblPos'];
        }
        if (isset($layout['numFmtCode'])) {
            $this->numFmtCode = (string) $layout['numFmtCode'];
        }
        $this->initBoolean($layout, 'showLegendKey');
        $this->initBoolean($layout, 'showVal');
        $this->initBoolean($layout, 'showCatName');
        $this->initBoolean($layout, 'showSerName');
        $this->initBoolean($layout, 'showPercent');
        $this->initBoolean($layout, 'showBubbleSize');
        $this->initBoolean($layout, 'showLeaderLines');
        $this->initBoolean($layout, 'numFmtLinked');
        $this->initColor($layout, 'labelFillColor');
        $this->initColor($layout, 'labelBorderColor');
        $labelFont = $layout['labelFont'] ?? null;
        if ($labelFont instanceof Font) {
            $this->labelFont = $labelFont;
        }
        $labelFontColor = $layout['labelFontColor'] ?? null;
        if ($labelFontColor instanceof ChartColor) {
            $this->setLabelFontColor($labelFontColor);
        }
        $labelEffects = $layout['labelEffects'] ?? null;
        if ($labelEffects instanceof Properties) {
            $this->labelEffects = $labelEffects;
        }
    }

    private function initBoolean(array $layout, string $name): void
    {
        if (isset($layout[$name])) {
            $this->$name = (bool) $layout[$name];
        }
    }

    private function initColor(array $layout, string $name): void
    {
        if (isset($layout[$name]) && $layout[$name] instanceof ChartColor) {
            $this->$name = $layout[$name];
        }
>>>>>>> main
    }

    /**
     * Get Layout Target.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return ?string
>>>>>>> main
     */
    public function getLayoutTarget()
    {
        return $this->layoutTarget;
    }

    /**
     * Set Layout Target.
     *
<<<<<<< HEAD
     * @param string $target
=======
     * @param ?string $target
>>>>>>> main
     *
     * @return $this
     */
    public function setLayoutTarget($target)
    {
        $this->layoutTarget = $target;

        return $this;
    }

    /**
     * Get X-Mode.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return ?string
>>>>>>> main
     */
    public function getXMode()
    {
        return $this->xMode;
    }

    /**
     * Set X-Mode.
     *
<<<<<<< HEAD
     * @param string $mode
=======
     * @param ?string $mode
>>>>>>> main
     *
     * @return $this
     */
    public function setXMode($mode)
    {
        $this->xMode = (string) $mode;

        return $this;
    }

    /**
     * Get Y-Mode.
     *
<<<<<<< HEAD
     * @return string
=======
     * @return ?string
>>>>>>> main
     */
    public function getYMode()
    {
        return $this->yMode;
    }

    /**
     * Set Y-Mode.
     *
<<<<<<< HEAD
     * @param string $mode
=======
     * @param ?string $mode
>>>>>>> main
     *
     * @return $this
     */
    public function setYMode($mode)
    {
        $this->yMode = (string) $mode;

        return $this;
    }

    /**
     * Get X-Position.
     *
<<<<<<< HEAD
     * @return number
=======
     * @return null|float|int
>>>>>>> main
     */
    public function getXPosition()
    {
        return $this->xPos;
    }

    /**
     * Set X-Position.
     *
<<<<<<< HEAD
     * @param float $position
=======
     * @param ?float $position
>>>>>>> main
     *
     * @return $this
     */
    public function setXPosition($position)
    {
        $this->xPos = (float) $position;

        return $this;
    }

    /**
     * Get Y-Position.
     *
<<<<<<< HEAD
     * @return number
=======
     * @return null|float
>>>>>>> main
     */
    public function getYPosition()
    {
        return $this->yPos;
    }

    /**
     * Set Y-Position.
     *
<<<<<<< HEAD
     * @param float $position
=======
     * @param ?float $position
>>>>>>> main
     *
     * @return $this
     */
    public function setYPosition($position)
    {
        $this->yPos = (float) $position;

        return $this;
    }

    /**
     * Get Width.
     *
<<<<<<< HEAD
     * @return number
=======
     * @return ?float
>>>>>>> main
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set Width.
     *
<<<<<<< HEAD
     * @param float $width
=======
     * @param ?float $width
>>>>>>> main
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get Height.
     *
<<<<<<< HEAD
     * @return number
=======
     * @return null|float
>>>>>>> main
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set Height.
     *
<<<<<<< HEAD
     * @param float $height
=======
     * @param ?float $height
>>>>>>> main
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get show legend key.
     *
     * @return bool
     */
    public function getShowLegendKey()
=======
    public function getShowLegendKey(): ?bool
>>>>>>> main
    {
        return $this->showLegendKey;
    }

    /**
     * Set show legend key
     * Specifies that legend keys should be shown in data labels.
<<<<<<< HEAD
     *
     * @param bool $showLegendKey Show legend key
     *
     * @return $this
     */
    public function setShowLegendKey($showLegendKey)
=======
     */
    public function setShowLegendKey(?bool $showLegendKey): self
>>>>>>> main
    {
        $this->showLegendKey = $showLegendKey;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get show value.
     *
     * @return bool
     */
    public function getShowVal()
=======
    public function getShowVal(): ?bool
>>>>>>> main
    {
        return $this->showVal;
    }

    /**
     * Set show val
     * Specifies that the value should be shown in data labels.
<<<<<<< HEAD
     *
     * @param bool $showDataLabelValues Show val
     *
     * @return $this
     */
    public function setShowVal($showDataLabelValues)
=======
     */
    public function setShowVal(?bool $showDataLabelValues): self
>>>>>>> main
    {
        $this->showVal = $showDataLabelValues;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get show category name.
     *
     * @return bool
     */
    public function getShowCatName()
=======
    public function getShowCatName(): ?bool
>>>>>>> main
    {
        return $this->showCatName;
    }

    /**
     * Set show cat name
     * Specifies that the category name should be shown in data labels.
<<<<<<< HEAD
     *
     * @param bool $showCategoryName Show cat name
     *
     * @return $this
     */
    public function setShowCatName($showCategoryName)
=======
     */
    public function setShowCatName(?bool $showCategoryName): self
>>>>>>> main
    {
        $this->showCatName = $showCategoryName;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get show data series name.
     *
     * @return bool
     */
    public function getShowSerName()
=======
    public function getShowSerName(): ?bool
>>>>>>> main
    {
        return $this->showSerName;
    }

    /**
<<<<<<< HEAD
     * Set show ser name
     * Specifies that the series name should be shown in data labels.
     *
     * @param bool $showSeriesName Show series name
     *
     * @return $this
     */
    public function setShowSerName($showSeriesName)
=======
     * Set show data series name.
     * Specifies that the series name should be shown in data labels.
     */
    public function setShowSerName(?bool $showSeriesName): self
>>>>>>> main
    {
        $this->showSerName = $showSeriesName;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get show percentage.
     *
     * @return bool
     */
    public function getShowPercent()
=======
    public function getShowPercent(): ?bool
>>>>>>> main
    {
        return $this->showPercent;
    }

    /**
<<<<<<< HEAD
     * Set show percentage
     * Specifies that the percentage should be shown in data labels.
     *
     * @param bool $showPercentage Show percentage
     *
     * @return $this
     */
    public function setShowPercent($showPercentage)
=======
     * Set show percentage.
     * Specifies that the percentage should be shown in data labels.
     */
    public function setShowPercent(?bool $showPercentage): self
>>>>>>> main
    {
        $this->showPercent = $showPercentage;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get show bubble size.
     *
     * @return bool
     */
    public function getShowBubbleSize()
=======
    public function getShowBubbleSize(): ?bool
>>>>>>> main
    {
        return $this->showBubbleSize;
    }

    /**
<<<<<<< HEAD
     * Set show bubble size
     * Specifies that the bubble size should be shown in data labels.
     *
     * @param bool $showBubbleSize Show bubble size
     *
     * @return $this
     */
    public function setShowBubbleSize($showBubbleSize)
=======
     * Set show bubble size.
     * Specifies that the bubble size should be shown in data labels.
     */
    public function setShowBubbleSize(?bool $showBubbleSize): self
>>>>>>> main
    {
        $this->showBubbleSize = $showBubbleSize;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get show leader lines.
     *
     * @return bool
     */
    public function getShowLeaderLines()
=======
    public function getShowLeaderLines(): ?bool
>>>>>>> main
    {
        return $this->showLeaderLines;
    }

    /**
<<<<<<< HEAD
     * Set show leader lines
     * Specifies that leader lines should be shown in data labels.
     *
     * @param bool $showLeaderLines Show leader lines
     *
     * @return $this
     */
    public function setShowLeaderLines($showLeaderLines)
=======
     * Set show leader lines.
     * Specifies that leader lines should be shown in data labels.
     */
    public function setShowLeaderLines(?bool $showLeaderLines): self
>>>>>>> main
    {
        $this->showLeaderLines = $showLeaderLines;

        return $this;
    }
<<<<<<< HEAD
=======

    public function getLabelFillColor(): ?ChartColor
    {
        return $this->labelFillColor;
    }

    public function setLabelFillColor(?ChartColor $chartColor): self
    {
        $this->labelFillColor = $chartColor;

        return $this;
    }

    public function getLabelBorderColor(): ?ChartColor
    {
        return $this->labelBorderColor;
    }

    public function setLabelBorderColor(?ChartColor $chartColor): self
    {
        $this->labelBorderColor = $chartColor;

        return $this;
    }

    public function getLabelFont(): ?Font
    {
        return $this->labelFont;
    }

    public function getLabelEffects(): ?Properties
    {
        return $this->labelEffects;
    }

    public function getLabelFontColor(): ?ChartColor
    {
        if ($this->labelFont === null) {
            return null;
        }

        return $this->labelFont->getChartColor();
    }

    public function setLabelFontColor(?ChartColor $chartColor): self
    {
        if ($this->labelFont === null) {
            $this->labelFont = new Font();
            $this->labelFont->setSize(null, true);
        }
        $this->labelFont->setChartColorFromObject($chartColor);

        return $this;
    }

    public function getDLblPos(): string
    {
        return $this->dLblPos;
    }

    public function setDLblPos(string $dLblPos): self
    {
        $this->dLblPos = $dLblPos;

        return $this;
    }

    public function getNumFmtCode(): string
    {
        return $this->numFmtCode;
    }

    public function setNumFmtCode(string $numFmtCode): self
    {
        $this->numFmtCode = $numFmtCode;

        return $this;
    }

    public function getNumFmtLinked(): bool
    {
        return $this->numFmtLinked;
    }

    public function setNumFmtLinked(bool $numFmtLinked): self
    {
        $this->numFmtLinked = $numFmtLinked;

        return $this;
    }
>>>>>>> main
}
