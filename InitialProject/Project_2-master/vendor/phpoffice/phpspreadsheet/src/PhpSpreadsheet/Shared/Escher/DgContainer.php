<?php

namespace PhpOffice\PhpSpreadsheet\Shared\Escher;

<<<<<<< HEAD
=======
use PhpOffice\PhpSpreadsheet\Exception as SpreadsheetException;

>>>>>>> main
class DgContainer
{
    /**
     * Drawing index, 1-based.
     *
<<<<<<< HEAD
     * @var int
=======
     * @var ?int
>>>>>>> main
     */
    private $dgId;

    /**
     * Last shape index in this drawing.
     *
<<<<<<< HEAD
     * @var int
     */
    private $lastSpId;

    private $spgrContainer;

    public function getDgId()
=======
     * @var ?int
     */
    private $lastSpId;

    /** @var ?DgContainer\SpgrContainer */
    private $spgrContainer;

    public function getDgId(): ?int
>>>>>>> main
    {
        return $this->dgId;
    }

<<<<<<< HEAD
    public function setDgId($value): void
=======
    public function setDgId(int $value): void
>>>>>>> main
    {
        $this->dgId = $value;
    }

<<<<<<< HEAD
    public function getLastSpId()
=======
    public function getLastSpId(): ?int
>>>>>>> main
    {
        return $this->lastSpId;
    }

<<<<<<< HEAD
    public function setLastSpId($value): void
=======
    public function setLastSpId(int $value): void
>>>>>>> main
    {
        $this->lastSpId = $value;
    }

<<<<<<< HEAD
    public function getSpgrContainer()
=======
    public function getSpgrContainer(): ?DgContainer\SpgrContainer
>>>>>>> main
    {
        return $this->spgrContainer;
    }

<<<<<<< HEAD
    public function setSpgrContainer($spgrContainer)
=======
    public function getSpgrContainerOrThrow(): DgContainer\SpgrContainer
    {
        if ($this->spgrContainer !== null) {
            return $this->spgrContainer;
        }

        throw new SpreadsheetException('spgrContainer is unexpectedly null');
    }

    /** @param DgContainer\SpgrContainer $spgrContainer */
    public function setSpgrContainer($spgrContainer): DgContainer\SpgrContainer
>>>>>>> main
    {
        return $this->spgrContainer = $spgrContainer;
    }
}
