<?php

namespace PhpOffice\PhpSpreadsheet\Chart;

use PhpOffice\PhpSpreadsheet\RichText\RichText;

class Title
{
    /**
     * Title Caption.
     *
     * @var array|RichText|string
     */
    private $caption = '';

    /**
<<<<<<< HEAD
     * Title Layout.
     *
     * @var Layout
=======
     * Allow overlay of other elements?
     *
     * @var bool
     */
    private $overlay = true;

    /**
     * Title Layout.
     *
     * @var ?Layout
>>>>>>> main
     */
    private $layout;

    /**
     * Create a new Title.
     *
     * @param array|RichText|string $caption
<<<<<<< HEAD
     */
    public function __construct($caption = '', ?Layout $layout = null)
    {
        $this->caption = $caption;
        $this->layout = $layout;
=======
     * @param ?Layout $layout
     * @param bool $overlay
     */
    public function __construct($caption = '', ?Layout $layout = null, $overlay = false)
    {
        $this->caption = $caption;
        $this->layout = $layout;
        $this->setOverlay($overlay);
>>>>>>> main
    }

    /**
     * Get caption.
     *
     * @return array|RichText|string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    public function getCaptionText(): string
    {
        $caption = $this->caption;
        if (is_string($caption)) {
            return $caption;
        }
        if ($caption instanceof RichText) {
            return $caption->getPlainText();
        }
        $retVal = '';
        foreach ($caption as $textx) {
            /** @var RichText|string */
            $text = $textx;
            if ($text instanceof RichText) {
                $retVal .= $text->getPlainText();
            } else {
                $retVal .= $text;
            }
        }

        return $retVal;
    }

    /**
     * Set caption.
     *
     * @param array|RichText|string $caption
     *
     * @return $this
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
<<<<<<< HEAD
     * Get Layout.
     *
     * @return Layout
     */
    public function getLayout()
=======
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

    public function getLayout(): ?Layout
>>>>>>> main
    {
        return $this->layout;
    }
}
