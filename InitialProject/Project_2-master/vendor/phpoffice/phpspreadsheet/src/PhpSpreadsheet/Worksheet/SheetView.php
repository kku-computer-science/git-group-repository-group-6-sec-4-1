<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

class SheetView
{
    // Sheet View types
    const SHEETVIEW_NORMAL = 'normal';
    const SHEETVIEW_PAGE_LAYOUT = 'pageLayout';
    const SHEETVIEW_PAGE_BREAK_PREVIEW = 'pageBreakPreview';

<<<<<<< HEAD
    private static $sheetViewTypes = [
=======
    private const SHEET_VIEW_TYPES = [
>>>>>>> main
        self::SHEETVIEW_NORMAL,
        self::SHEETVIEW_PAGE_LAYOUT,
        self::SHEETVIEW_PAGE_BREAK_PREVIEW,
    ];

    /**
     * ZoomScale.
     *
     * Valid values range from 10 to 400.
     *
<<<<<<< HEAD
     * @var int
=======
     * @var ?int
>>>>>>> main
     */
    private $zoomScale = 100;

    /**
     * ZoomScaleNormal.
     *
     * Valid values range from 10 to 400.
     *
<<<<<<< HEAD
     * @var int
=======
     * @var ?int
>>>>>>> main
     */
    private $zoomScaleNormal = 100;

    /**
     * ShowZeros.
     *
     * If true, "null" values from a calculation will be shown as "0". This is the default Excel behaviour and can be changed
     * with the advanced worksheet option "Show a zero in cells that have zero value"
     *
     * @var bool
     */
    private $showZeros = true;

    /**
     * View.
     *
     * Valid values range from 10 to 400.
     *
     * @var string
     */
    private $sheetviewType = self::SHEETVIEW_NORMAL;

    /**
     * Create a new SheetView.
     */
    public function __construct()
    {
    }

    /**
     * Get ZoomScale.
     *
<<<<<<< HEAD
     * @return int
=======
     * @return ?int
>>>>>>> main
     */
    public function getZoomScale()
    {
        return $this->zoomScale;
    }

    /**
     * Set ZoomScale.
     * Valid values range from 10 to 400.
     *
<<<<<<< HEAD
     * @param int $zoomScale
=======
     * @param ?int $zoomScale
>>>>>>> main
     *
     * @return $this
     */
    public function setZoomScale($zoomScale)
    {
        // Microsoft Office Excel 2007 only allows setting a scale between 10 and 400 via the user interface,
        // but it is apparently still able to handle any scale >= 1
<<<<<<< HEAD
        if (($zoomScale >= 1) || $zoomScale === null) {
=======
        if ($zoomScale === null || $zoomScale >= 1) {
>>>>>>> main
            $this->zoomScale = $zoomScale;
        } else {
            throw new PhpSpreadsheetException('Scale must be greater than or equal to 1.');
        }

        return $this;
    }

    /**
     * Get ZoomScaleNormal.
     *
<<<<<<< HEAD
     * @return int
=======
     * @return ?int
>>>>>>> main
     */
    public function getZoomScaleNormal()
    {
        return $this->zoomScaleNormal;
    }

    /**
     * Set ZoomScale.
     * Valid values range from 10 to 400.
     *
<<<<<<< HEAD
     * @param int $zoomScaleNormal
=======
     * @param ?int $zoomScaleNormal
>>>>>>> main
     *
     * @return $this
     */
    public function setZoomScaleNormal($zoomScaleNormal)
    {
<<<<<<< HEAD
        if (($zoomScaleNormal >= 1) || $zoomScaleNormal === null) {
=======
        if ($zoomScaleNormal === null || $zoomScaleNormal >= 1) {
>>>>>>> main
            $this->zoomScaleNormal = $zoomScaleNormal;
        } else {
            throw new PhpSpreadsheetException('Scale must be greater than or equal to 1.');
        }

        return $this;
    }

    /**
     * Set ShowZeroes setting.
     *
     * @param bool $showZeros
     */
    public function setShowZeros($showZeros): void
    {
        $this->showZeros = $showZeros;
    }

    /**
     * @return bool
     */
    public function getShowZeros()
    {
        return $this->showZeros;
    }

    /**
     * Get View.
     *
     * @return string
     */
    public function getView()
    {
        return $this->sheetviewType;
    }

    /**
     * Set View.
     *
     * Valid values are
     *        'normal'            self::SHEETVIEW_NORMAL
     *        'pageLayout'        self::SHEETVIEW_PAGE_LAYOUT
     *        'pageBreakPreview'  self::SHEETVIEW_PAGE_BREAK_PREVIEW
     *
<<<<<<< HEAD
     * @param string $sheetViewType
=======
     * @param ?string $sheetViewType
>>>>>>> main
     *
     * @return $this
     */
    public function setView($sheetViewType)
    {
        // MS Excel 2007 allows setting the view to 'normal', 'pageLayout' or 'pageBreakPreview' via the user interface
        if ($sheetViewType === null) {
            $sheetViewType = self::SHEETVIEW_NORMAL;
        }
<<<<<<< HEAD
        if (in_array($sheetViewType, self::$sheetViewTypes)) {
=======
        if (in_array($sheetViewType, self::SHEET_VIEW_TYPES)) {
>>>>>>> main
            $this->sheetviewType = $sheetViewType;
        } else {
            throw new PhpSpreadsheetException('Invalid sheetview layout type.');
        }

        return $this;
    }
<<<<<<< HEAD

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if (is_object($value)) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
            }
        }
    }
=======
>>>>>>> main
}
