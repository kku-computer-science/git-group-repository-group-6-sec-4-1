<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

class ConditionalFormatValueObject
{
<<<<<<< HEAD
    private $type;

    private $value;

=======
    /** @var mixed */
    private $type;

    /** @var mixed */
    private $value;

    /** @var mixed */
>>>>>>> main
    private $cellFormula;

    /**
     * ConditionalFormatValueObject constructor.
     *
<<<<<<< HEAD
=======
     * @param mixed $type
     * @param mixed $value
>>>>>>> main
     * @param null|mixed $cellFormula
     */
    public function __construct($type, $value = null, $cellFormula = null)
    {
        $this->type = $type;
        $this->value = $value;
        $this->cellFormula = $cellFormula;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
<<<<<<< HEAD
    public function setType($type)
=======
    public function setType($type): self
>>>>>>> main
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
<<<<<<< HEAD
    public function setValue($value)
=======
    public function setValue($value): self
>>>>>>> main
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCellFormula()
    {
        return $this->cellFormula;
    }

    /**
     * @param mixed $cellFormula
     */
<<<<<<< HEAD
    public function setCellFormula($cellFormula)
=======
    public function setCellFormula($cellFormula): self
>>>>>>> main
    {
        $this->cellFormula = $cellFormula;

        return $this;
    }
}
