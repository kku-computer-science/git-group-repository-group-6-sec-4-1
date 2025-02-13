<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Theme
{
    /**
     * Theme Name.
     *
     * @var string
     */
    private $themeName;

    /**
     * Colour Scheme Name.
     *
     * @var string
     */
    private $colourSchemeName;

    /**
     * Colour Map.
     *
     * @var string[]
     */
    private $colourMap;

    /**
     * Create a new Theme.
     *
     * @param string $themeName
     * @param string $colourSchemeName
     * @param string[] $colourMap
     */
    public function __construct($themeName, $colourSchemeName, $colourMap)
    {
        // Initialise values
        $this->themeName = $themeName;
        $this->colourSchemeName = $colourSchemeName;
        $this->colourMap = $colourMap;
    }

    /**
<<<<<<< HEAD
     * Get Theme Name.
     *
     * @return string
=======
     * Not called by Reader, never accessible any other time.
     *
     * @return string
     *
     * @codeCoverageIgnore
>>>>>>> main
     */
    public function getThemeName()
    {
        return $this->themeName;
    }

    /**
<<<<<<< HEAD
     * Get colour Scheme Name.
     *
     * @return string
=======
     * Not called by Reader, never accessible any other time.
     *
     * @return string
     *
     * @codeCoverageIgnore
>>>>>>> main
     */
    public function getColourSchemeName()
    {
        return $this->colourSchemeName;
    }

    /**
     * Get colour Map Value by Position.
     *
     * @param int $index
     *
     * @return null|string
     */
    public function getColourByIndex($index)
    {
<<<<<<< HEAD
        if (isset($this->colourMap[$index])) {
            return $this->colourMap[$index];
        }

        return null;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if ((is_object($value)) && ($key != '_parent')) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
            }
        }
=======
        return $this->colourMap[$index] ?? null;
>>>>>>> main
    }
}
