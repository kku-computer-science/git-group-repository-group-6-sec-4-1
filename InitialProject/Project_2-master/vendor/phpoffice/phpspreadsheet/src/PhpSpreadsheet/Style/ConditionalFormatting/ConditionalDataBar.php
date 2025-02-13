<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

class ConditionalDataBar
{
    /** <dataBar> attribute  */

    /** @var null|bool */
    private $showValue;

    /** <dataBar> children */

<<<<<<< HEAD
    /** @var ConditionalFormatValueObject */
    private $minimumConditionalFormatValueObject;

    /** @var ConditionalFormatValueObject */
=======
    /** @var ?ConditionalFormatValueObject */
    private $minimumConditionalFormatValueObject;

    /** @var ?ConditionalFormatValueObject */
>>>>>>> main
    private $maximumConditionalFormatValueObject;

    /** @var string */
    private $color;

    /** <extLst> */

<<<<<<< HEAD
    /** @var ConditionalFormattingRuleExtension */
=======
    /** @var ?ConditionalFormattingRuleExtension */
>>>>>>> main
    private $conditionalFormattingRuleExt;

    /**
     * @return null|bool
     */
    public function getShowValue()
    {
        return $this->showValue;
    }

    /**
     * @param bool $showValue
     */
<<<<<<< HEAD
    public function setShowValue($showValue)
=======
    public function setShowValue($showValue): self
>>>>>>> main
    {
        $this->showValue = $showValue;

        return $this;
    }

<<<<<<< HEAD
    /**
     * @return ConditionalFormatValueObject
     */
    public function getMinimumConditionalFormatValueObject()
=======
    public function getMinimumConditionalFormatValueObject(): ?ConditionalFormatValueObject
>>>>>>> main
    {
        return $this->minimumConditionalFormatValueObject;
    }

<<<<<<< HEAD
    public function setMinimumConditionalFormatValueObject(ConditionalFormatValueObject $minimumConditionalFormatValueObject)
=======
    public function setMinimumConditionalFormatValueObject(ConditionalFormatValueObject $minimumConditionalFormatValueObject): self
>>>>>>> main
    {
        $this->minimumConditionalFormatValueObject = $minimumConditionalFormatValueObject;

        return $this;
    }

<<<<<<< HEAD
    /**
     * @return ConditionalFormatValueObject
     */
    public function getMaximumConditionalFormatValueObject()
=======
    public function getMaximumConditionalFormatValueObject(): ?ConditionalFormatValueObject
>>>>>>> main
    {
        return $this->maximumConditionalFormatValueObject;
    }

<<<<<<< HEAD
    public function setMaximumConditionalFormatValueObject(ConditionalFormatValueObject $maximumConditionalFormatValueObject)
=======
    public function setMaximumConditionalFormatValueObject(ConditionalFormatValueObject $maximumConditionalFormatValueObject): self
>>>>>>> main
    {
        $this->maximumConditionalFormatValueObject = $maximumConditionalFormatValueObject;

        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

<<<<<<< HEAD
    /**
     * @return ConditionalFormattingRuleExtension
     */
    public function getConditionalFormattingRuleExt()
=======
    public function getConditionalFormattingRuleExt(): ?ConditionalFormattingRuleExtension
>>>>>>> main
    {
        return $this->conditionalFormattingRuleExt;
    }

<<<<<<< HEAD
    public function setConditionalFormattingRuleExt(ConditionalFormattingRuleExtension $conditionalFormattingRuleExt)
=======
    public function setConditionalFormattingRuleExt(ConditionalFormattingRuleExtension $conditionalFormattingRuleExt): self
>>>>>>> main
    {
        $this->conditionalFormattingRuleExt = $conditionalFormattingRuleExt;

        return $this;
    }
}
