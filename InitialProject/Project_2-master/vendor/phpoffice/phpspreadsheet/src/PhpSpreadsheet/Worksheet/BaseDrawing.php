<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\IComparable;

class BaseDrawing implements IComparable
{
<<<<<<< HEAD
=======
    const EDIT_AS_ABSOLUTE = 'absolute';
    const EDIT_AS_ONECELL = 'oneCell';
    const EDIT_AS_TWOCELL = 'twoCell';
    private const VALID_EDIT_AS = [
        self::EDIT_AS_ABSOLUTE,
        self::EDIT_AS_ONECELL,
        self::EDIT_AS_TWOCELL,
    ];

    /**
     * The editAs attribute, used only with two cell anchor.
     *
     * @var string
     */
    protected $editAs = '';

>>>>>>> main
    /**
     * Image counter.
     *
     * @var int
     */
    private static $imageCounter = 0;

    /**
     * Image index.
     *
     * @var int
     */
    private $imageIndex = 0;

    /**
     * Name.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $name;
=======
    protected $name = '';
>>>>>>> main

    /**
     * Description.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $description;
=======
    protected $description = '';
>>>>>>> main

    /**
     * Worksheet.
     *
     * @var null|Worksheet
     */
    protected $worksheet;

    /**
     * Coordinates.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $coordinates;
=======
    protected $coordinates = 'A1';
>>>>>>> main

    /**
     * Offset X.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $offsetX;
=======
    protected $offsetX = 0;
>>>>>>> main

    /**
     * Offset Y.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $offsetY;
=======
    protected $offsetY = 0;

    /**
     * Coordinates2.
     *
     * @var string
     */
    protected $coordinates2 = '';

    /**
     * Offset X2.
     *
     * @var int
     */
    protected $offsetX2 = 0;

    /**
     * Offset Y2.
     *
     * @var int
     */
    protected $offsetY2 = 0;
>>>>>>> main

    /**
     * Width.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $width;
=======
    protected $width = 0;
>>>>>>> main

    /**
     * Height.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $height;
=======
    protected $height = 0;

    /**
     * Pixel width of image. See $width for the size the Drawing will be in the sheet.
     *
     * @var int
     */
    protected $imageWidth = 0;

    /**
     * Pixel width of image. See $height for the size the Drawing will be in the sheet.
     *
     * @var int
     */
    protected $imageHeight = 0;
>>>>>>> main

    /**
     * Proportional resize.
     *
     * @var bool
     */
<<<<<<< HEAD
    protected $resizeProportional;
=======
    protected $resizeProportional = true;
>>>>>>> main

    /**
     * Rotation.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $rotation;
=======
    protected $rotation = 0;
>>>>>>> main

    /**
     * Shadow.
     *
     * @var Drawing\Shadow
     */
    protected $shadow;

    /**
     * Image hyperlink.
     *
     * @var null|Hyperlink
     */
    private $hyperlink;

    /**
     * Image type.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $type;
=======
    protected $type = IMAGETYPE_UNKNOWN;
>>>>>>> main

    /**
     * Create a new BaseDrawing.
     */
    public function __construct()
    {
        // Initialise values
<<<<<<< HEAD
        $this->name = '';
        $this->description = '';
        $this->worksheet = null;
        $this->coordinates = 'A1';
        $this->offsetX = 0;
        $this->offsetY = 0;
        $this->width = 0;
        $this->height = 0;
        $this->resizeProportional = true;
        $this->rotation = 0;
        $this->shadow = new Drawing\Shadow();
        $this->type = IMAGETYPE_UNKNOWN;
=======
        $this->setShadow();
>>>>>>> main

        // Set image index
        ++self::$imageCounter;
        $this->imageIndex = self::$imageCounter;
    }

<<<<<<< HEAD
    /**
     * Get image index.
     *
     * @return int
     */
    public function getImageIndex()
=======
    public function getImageIndex(): int
>>>>>>> main
    {
        return $this->imageIndex;
    }

<<<<<<< HEAD
    /**
     * Get Name.
     *
     * @return string
     */
    public function getName()
=======
    public function getName(): string
>>>>>>> main
    {
        return $this->name;
    }

<<<<<<< HEAD
    /**
     * Set Name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
=======
    public function setName(string $name): self
>>>>>>> main
    {
        $this->name = $name;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Description.
     *
     * @return string
     */
    public function getDescription()
=======
    public function getDescription(): string
>>>>>>> main
    {
        return $this->description;
    }

<<<<<<< HEAD
    /**
     * Set Description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
=======
    public function setDescription(string $description): self
>>>>>>> main
    {
        $this->description = $description;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Worksheet.
     *
     * @return null|Worksheet
     */
    public function getWorksheet()
=======
    public function getWorksheet(): ?Worksheet
>>>>>>> main
    {
        return $this->worksheet;
    }

    /**
     * Set Worksheet.
     *
     * @param bool $overrideOld If a Worksheet has already been assigned, overwrite it and remove image from old Worksheet?
<<<<<<< HEAD
     *
     * @return $this
     */
    public function setWorksheet(?Worksheet $worksheet = null, $overrideOld = false)
    {
        if ($this->worksheet === null) {
            // Add drawing to \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
            $this->worksheet = $worksheet;
            $this->worksheet->getCell($this->coordinates);
            $this->worksheet->getDrawingCollection()->append($this);
        } else {
            if ($overrideOld) {
                // Remove drawing from old \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
=======
     */
    public function setWorksheet(?Worksheet $worksheet = null, bool $overrideOld = false): self
    {
        if ($this->worksheet === null) {
            // Add drawing to Worksheet
            if ($worksheet !== null) {
                $this->worksheet = $worksheet;
                if (!($this instanceof Drawing && $this->getPath() === '')) {
                    $this->worksheet->getCell($this->coordinates);
                }
                $this->worksheet->getDrawingCollection()
                    ->append($this);
            }
        } else {
            if ($overrideOld) {
                // Remove drawing from old Worksheet
>>>>>>> main
                $iterator = $this->worksheet->getDrawingCollection()->getIterator();

                while ($iterator->valid()) {
                    if ($iterator->current()->getHashCode() === $this->getHashCode()) {
<<<<<<< HEAD
                        $this->worksheet->getDrawingCollection()->offsetUnset($iterator->key());
=======
                        $this->worksheet->getDrawingCollection()->offsetUnset(/** @scrutinizer ignore-type */ $iterator->key());
>>>>>>> main
                        $this->worksheet = null;

                        break;
                    }
                }

<<<<<<< HEAD
                // Set new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
                $this->setWorksheet($worksheet);
            } else {
                throw new PhpSpreadsheetException('A Worksheet has already been assigned. Drawings can only exist on one \\PhpOffice\\PhpSpreadsheet\\Worksheet.');
=======
                // Set new Worksheet
                $this->setWorksheet($worksheet);
            } else {
                throw new PhpSpreadsheetException('A Worksheet has already been assigned. Drawings can only exist on one Worksheet.');
>>>>>>> main
            }
        }

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Coordinates.
     *
     * @return string
     */
    public function getCoordinates()
=======
    public function getCoordinates(): string
>>>>>>> main
    {
        return $this->coordinates;
    }

<<<<<<< HEAD
    /**
     * Set Coordinates.
     *
     * @param string $coordinates eg: 'A1'
     *
     * @return $this
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
=======
    public function setCoordinates(string $coordinates): self
    {
        $this->coordinates = $coordinates;
        if ($this->worksheet !== null) {
            if (!($this instanceof Drawing && $this->getPath() === '')) {
                $this->worksheet->getCell($this->coordinates);
            }
        }
>>>>>>> main

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get OffsetX.
     *
     * @return int
     */
    public function getOffsetX()
=======
    public function getOffsetX(): int
>>>>>>> main
    {
        return $this->offsetX;
    }

<<<<<<< HEAD
    /**
     * Set OffsetX.
     *
     * @param int $offsetX
     *
     * @return $this
     */
    public function setOffsetX($offsetX)
=======
    public function setOffsetX(int $offsetX): self
>>>>>>> main
    {
        $this->offsetX = $offsetX;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get OffsetY.
     *
     * @return int
     */
    public function getOffsetY()
=======
    public function getOffsetY(): int
>>>>>>> main
    {
        return $this->offsetY;
    }

<<<<<<< HEAD
    /**
     * Set OffsetY.
     *
     * @param int $offsetY
     *
     * @return $this
     */
    public function setOffsetY($offsetY)
=======
    public function setOffsetY(int $offsetY): self
>>>>>>> main
    {
        $this->offsetY = $offsetY;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Width.
     *
     * @return int
     */
    public function getWidth()
=======
    public function getCoordinates2(): string
    {
        return $this->coordinates2;
    }

    public function setCoordinates2(string $coordinates2): self
    {
        $this->coordinates2 = $coordinates2;

        return $this;
    }

    public function getOffsetX2(): int
    {
        return $this->offsetX2;
    }

    public function setOffsetX2(int $offsetX2): self
    {
        $this->offsetX2 = $offsetX2;

        return $this;
    }

    public function getOffsetY2(): int
    {
        return $this->offsetY2;
    }

    public function setOffsetY2(int $offsetY2): self
    {
        $this->offsetY2 = $offsetY2;

        return $this;
    }

    public function getWidth(): int
>>>>>>> main
    {
        return $this->width;
    }

<<<<<<< HEAD
    /**
     * Set Width.
     *
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width)
=======
    public function setWidth(int $width): self
>>>>>>> main
    {
        // Resize proportional?
        if ($this->resizeProportional && $width != 0) {
            $ratio = $this->height / ($this->width != 0 ? $this->width : 1);
            $this->height = (int) round($ratio * $width);
        }

        // Set width
        $this->width = $width;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Height.
     *
     * @return int
     */
    public function getHeight()
=======
    public function getHeight(): int
>>>>>>> main
    {
        return $this->height;
    }

<<<<<<< HEAD
    /**
     * Set Height.
     *
     * @param int $height
     *
     * @return $this
     */
    public function setHeight($height)
=======
    public function setHeight(int $height): self
>>>>>>> main
    {
        // Resize proportional?
        if ($this->resizeProportional && $height != 0) {
            $ratio = $this->width / ($this->height != 0 ? $this->height : 1);
            $this->width = (int) round($ratio * $height);
        }

        // Set height
        $this->height = $height;

        return $this;
    }

    /**
     * Set width and height with proportional resize.
     *
     * Example:
     * <code>
     * $objDrawing->setResizeProportional(true);
     * $objDrawing->setWidthAndHeight(160,120);
     * </code>
     *
<<<<<<< HEAD
     * @param int $width
     * @param int $height
     *
     * @return $this
     *
     * @author Vincent@luo MSN:kele_100@hotmail.com
     */
    public function setWidthAndHeight($width, $height)
=======
     * @author Vincent@luo MSN:kele_100@hotmail.com
     */
    public function setWidthAndHeight(int $width, int $height): self
>>>>>>> main
    {
        $xratio = $width / ($this->width != 0 ? $this->width : 1);
        $yratio = $height / ($this->height != 0 ? $this->height : 1);
        if ($this->resizeProportional && !($width == 0 || $height == 0)) {
            if (($xratio * $this->height) < $height) {
                $this->height = (int) ceil($xratio * $this->height);
                $this->width = $width;
            } else {
                $this->width = (int) ceil($yratio * $this->width);
                $this->height = $height;
            }
        } else {
            $this->width = $width;
            $this->height = $height;
        }

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get ResizeProportional.
     *
     * @return bool
     */
    public function getResizeProportional()
=======
    public function getResizeProportional(): bool
>>>>>>> main
    {
        return $this->resizeProportional;
    }

<<<<<<< HEAD
    /**
     * Set ResizeProportional.
     *
     * @param bool $resizeProportional
     *
     * @return $this
     */
    public function setResizeProportional($resizeProportional)
=======
    public function setResizeProportional(bool $resizeProportional): self
>>>>>>> main
    {
        $this->resizeProportional = $resizeProportional;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Rotation.
     *
     * @return int
     */
    public function getRotation()
=======
    public function getRotation(): int
>>>>>>> main
    {
        return $this->rotation;
    }

<<<<<<< HEAD
    /**
     * Set Rotation.
     *
     * @param int $rotation
     *
     * @return $this
     */
    public function setRotation($rotation)
=======
    public function setRotation(int $rotation): self
>>>>>>> main
    {
        $this->rotation = $rotation;

        return $this;
    }

<<<<<<< HEAD
    /**
     * Get Shadow.
     *
     * @return Drawing\Shadow
     */
    public function getShadow()
=======
    public function getShadow(): Drawing\Shadow
>>>>>>> main
    {
        return $this->shadow;
    }

<<<<<<< HEAD
    /**
     * Set Shadow.
     *
     * @return $this
     */
    public function setShadow(?Drawing\Shadow $shadow = null)
    {
        $this->shadow = $shadow;
=======
    public function setShadow(?Drawing\Shadow $shadow = null): self
    {
        $this->shadow = $shadow ?? new Drawing\Shadow();
>>>>>>> main

        return $this;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        return md5(
            $this->name .
            $this->description .
<<<<<<< HEAD
            $this->worksheet->getHashCode() .
            $this->coordinates .
            $this->offsetX .
            $this->offsetY .
=======
            (($this->worksheet === null) ? '' : (string) $this->worksheet->getHashInt()) .
            $this->coordinates .
            $this->offsetX .
            $this->offsetY .
            $this->coordinates2 .
            $this->offsetX2 .
            $this->offsetY2 .
>>>>>>> main
            $this->width .
            $this->height .
            $this->rotation .
            $this->shadow->getHashCode() .
            __CLASS__
        );
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if ($key == 'worksheet') {
                $this->worksheet = null;
            } elseif (is_object($value)) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
            }
        }
    }

    public function setHyperlink(?Hyperlink $hyperlink = null): void
    {
        $this->hyperlink = $hyperlink;
    }

<<<<<<< HEAD
    /**
     * @return null|Hyperlink
     */
    public function getHyperlink()
=======
    public function getHyperlink(): ?Hyperlink
>>>>>>> main
    {
        return $this->hyperlink;
    }

    /**
     * Set Fact Sizes and Type of Image.
     */
    protected function setSizesAndType(string $path): void
    {
<<<<<<< HEAD
        if ($this->width == 0 && $this->height == 0 && $this->type == IMAGETYPE_UNKNOWN) {
            $imageData = getimagesize($path);

            if (is_array($imageData)) {
                $this->width = $imageData[0];
                $this->height = $imageData[1];
                $this->type = $imageData[2];
            }
        }
=======
        if ($this->imageWidth === 0 && $this->imageHeight === 0 && $this->type === IMAGETYPE_UNKNOWN) {
            $imageData = getimagesize($path);

            if (!empty($imageData)) {
                $this->imageWidth = $imageData[0];
                $this->imageHeight = $imageData[1];
                $this->type = $imageData[2];
            }
        }
        if ($this->width === 0 && $this->height === 0) {
            $this->width = $this->imageWidth;
            $this->height = $this->imageHeight;
        }
>>>>>>> main
    }

    /**
     * Get Image Type.
     */
    public function getType(): int
    {
        return $this->type;
    }
<<<<<<< HEAD
=======

    public function getImageWidth(): int
    {
        return $this->imageWidth;
    }

    public function getImageHeight(): int
    {
        return $this->imageHeight;
    }

    public function getEditAs(): string
    {
        return $this->editAs;
    }

    public function setEditAs(string $editAs): self
    {
        $this->editAs = $editAs;

        return $this;
    }

    public function validEditAs(): bool
    {
        return in_array($this->editAs, self::VALID_EDIT_AS, true);
    }
>>>>>>> main
}
