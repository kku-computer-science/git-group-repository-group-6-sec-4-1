<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Helper\Dimension as CssDimension;

class RowDimension extends Dimension
{
    /**
     * Row index.
     *
<<<<<<< HEAD
     * @var int
=======
     * @var ?int
>>>>>>> main
     */
    private $rowIndex;

    /**
     * Row height (in pt).
     *
     * When this is set to a negative value, the row height should be ignored by IWriter
     *
     * @var float
     */
    private $height = -1;

    /**
     * ZeroHeight for Row?
     *
     * @var bool
     */
    private $zeroHeight = false;

    /**
     * Create a new RowDimension.
     *
<<<<<<< HEAD
     * @param int $index Numeric row index
=======
     * @param ?int $index Numeric row index
>>>>>>> main
     */
    public function __construct($index = 0)
    {
        // Initialise values
        $this->rowIndex = $index;

        // set dimension as unformatted by default
        parent::__construct(null);
    }

    /**
     * Get Row Index.
     */
<<<<<<< HEAD
    public function getRowIndex(): int
=======
    public function getRowIndex(): ?int
>>>>>>> main
    {
        return $this->rowIndex;
    }

    /**
     * Set Row Index.
     *
     * @return $this
     */
    public function setRowIndex(int $index)
    {
        $this->rowIndex = $index;

        return $this;
    }

    /**
     * Get Row Height.
<<<<<<< HEAD
     * By default, this will be in points; but this method accepts a unit of measure
     *    argument, and will convert the value to the specified UoM.
=======
     * By default, this will be in points; but this method also accepts an optional unit of measure
     *    argument, and will convert the value from points to the specified UoM.
     *    A value of -1 tells Excel to display this column in its default height.
>>>>>>> main
     *
     * @return float
     */
    public function getRowHeight(?string $unitOfMeasure = null)
    {
        return ($unitOfMeasure === null || $this->height < 0)
            ? $this->height
            : (new CssDimension($this->height . CssDimension::UOM_POINTS))->toUnit($unitOfMeasure);
    }

    /**
     * Set Row Height.
     *
<<<<<<< HEAD
     * @param float $height in points
     * By default, this will be the passed argument value; but this method accepts a unit of measure
=======
     * @param float $height in points. A value of -1 tells Excel to display this column in its default height.
     * By default, this will be the passed argument value; but this method also accepts an optional unit of measure
>>>>>>> main
     *    argument, and will convert the passed argument value to points from the specified UoM
     *
     * @return $this
     */
    public function setRowHeight($height, ?string $unitOfMeasure = null)
    {
        $this->height = ($unitOfMeasure === null || $height < 0)
            ? $height
            : (new CssDimension("{$height}{$unitOfMeasure}"))->height();

        return $this;
    }

    /**
     * Get ZeroHeight.
     */
    public function getZeroHeight(): bool
    {
        return $this->zeroHeight;
    }

    /**
     * Set ZeroHeight.
     *
     * @return $this
     */
    public function setZeroHeight(bool $zeroHeight)
    {
        $this->zeroHeight = $zeroHeight;

        return $this;
    }
}
