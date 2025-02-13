<?php

namespace PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer;

use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer;

class BSE
{
    const BLIPTYPE_ERROR = 0x00;
    const BLIPTYPE_UNKNOWN = 0x01;
    const BLIPTYPE_EMF = 0x02;
    const BLIPTYPE_WMF = 0x03;
    const BLIPTYPE_PICT = 0x04;
    const BLIPTYPE_JPEG = 0x05;
    const BLIPTYPE_PNG = 0x06;
    const BLIPTYPE_DIB = 0x07;
    const BLIPTYPE_TIFF = 0x11;
    const BLIPTYPE_CMYKJPEG = 0x12;

    /**
     * The parent BLIP Store Entry Container.
<<<<<<< HEAD
     *
     * @var BstoreContainer
     */
    private $parent;
=======
     * Property is never currently read.
     *
     * @var BstoreContainer
     */
    private $parent; // @phpstan-ignore-line
>>>>>>> main

    /**
     * The BLIP (Big Large Image or Picture).
     *
<<<<<<< HEAD
     * @var BSE\Blip
=======
     * @var ?BSE\Blip
>>>>>>> main
     */
    private $blip;

    /**
     * The BLIP type.
     *
     * @var int
     */
    private $blipType;

    /**
     * Set parent BLIP Store Entry Container.
     */
    public function setParent(BstoreContainer $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * Get the BLIP.
     *
<<<<<<< HEAD
     * @return BSE\Blip
=======
     * @return ?BSE\Blip
>>>>>>> main
     */
    public function getBlip()
    {
        return $this->blip;
    }

    /**
     * Set the BLIP.
     */
    public function setBlip(BSE\Blip $blip): void
    {
        $this->blip = $blip;
        $blip->setParent($this);
    }

    /**
     * Get the BLIP type.
     *
     * @return int
     */
    public function getBlipType()
    {
        return $this->blipType;
    }

    /**
     * Set the BLIP type.
     *
     * @param int $blipType
     */
    public function setBlipType($blipType): void
    {
        $this->blipType = $blipType;
    }
}
