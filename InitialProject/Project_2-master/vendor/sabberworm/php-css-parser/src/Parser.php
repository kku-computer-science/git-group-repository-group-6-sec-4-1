<?php

namespace Sabberworm\CSS;

use Sabberworm\CSS\CSSList\Document;
use Sabberworm\CSS\Parsing\ParserState;
use Sabberworm\CSS\Parsing\SourceException;

/**
 * This class parses CSS from text into a data structure.
 */
class Parser
{
    /**
     * @var ParserState
     */
    private $oParserState;

    /**
<<<<<<< HEAD
     * @param string $sText
     * @param Settings|null $oParserSettings
     * @param int $iLineNo the line number (starting from 1, not from 0)
     */
    public function __construct($sText, Settings $oParserSettings = null, $iLineNo = 1)
=======
     * @param string $sText the complete CSS as text (i.e., usually the contents of a CSS file)
     * @param Settings|null $oParserSettings
     * @param int $iLineNo the line number (starting from 1, not from 0)
     */
    public function __construct($sText, $oParserSettings = null, $iLineNo = 1)
>>>>>>> main
    {
        if ($oParserSettings === null) {
            $oParserSettings = Settings::create();
        }
        $this->oParserState = new ParserState($sText, $oParserSettings, $iLineNo);
    }

    /**
<<<<<<< HEAD
     * @param string $sCharset
     *
     * @return void
=======
     * Sets the charset to be used if the CSS does not contain an `@charset` declaration.
     *
     * @param string $sCharset
     *
     * @return void
     *
     * @deprecated since 8.7.0, will be removed in version 9.0.0 with #687
>>>>>>> main
     */
    public function setCharset($sCharset)
    {
        $this->oParserState->setCharset($sCharset);
    }

    /**
<<<<<<< HEAD
     * @return void
=======
     * Returns the charset that is used if the CSS does not contain an `@charset` declaration.
     *
     * @return void
     *
     * @deprecated since 8.7.0, will be removed in version 9.0.0 with #687
>>>>>>> main
     */
    public function getCharset()
    {
        // Note: The `return` statement is missing here. This is a bug that needs to be fixed.
        $this->oParserState->getCharset();
    }

    /**
<<<<<<< HEAD
=======
     * Parses the CSS provided to the constructor and creates a `Document` from it.
     *
>>>>>>> main
     * @return Document
     *
     * @throws SourceException
     */
    public function parse()
    {
        return Document::parse($this->oParserState);
    }
}
