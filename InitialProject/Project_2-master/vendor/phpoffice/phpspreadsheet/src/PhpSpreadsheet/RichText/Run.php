<?php

namespace PhpOffice\PhpSpreadsheet\RichText;

use PhpOffice\PhpSpreadsheet\Style\Font;

class Run extends TextElement implements ITextElement
{
    /**
     * Font.
     *
<<<<<<< HEAD
     * @var Font
=======
     * @var ?Font
>>>>>>> main
     */
    private $font;

    /**
     * Create a new Run instance.
     *
     * @param string $text Text
     */
    public function __construct($text = '')
    {
        parent::__construct($text);
        // Initialise variables
        $this->font = new Font();
    }

    /**
     * Get font.
     *
     * @return null|\PhpOffice\PhpSpreadsheet\Style\Font
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Set font.
     *
     * @param Font $font Font
     *
     * @return $this
     */
    public function setFont(?Font $font = null)
    {
        $this->font = $font;

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
            $this->getText() .
<<<<<<< HEAD
            $this->font->getHashCode() .
=======
            (($this->font === null) ? '' : $this->font->getHashCode()) .
>>>>>>> main
            __CLASS__
        );
    }
}
