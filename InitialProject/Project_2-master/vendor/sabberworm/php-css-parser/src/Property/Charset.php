<?php

namespace Sabberworm\CSS\Property;

use Sabberworm\CSS\Comment\Comment;
use Sabberworm\CSS\OutputFormat;
<<<<<<< HEAD
=======
use Sabberworm\CSS\Value\CSSString;
>>>>>>> main

/**
 * Class representing an `@charset` rule.
 *
 * The following restrictions apply:
 * - May not be found in any CSSList other than the Document.
 * - May only appear at the very top of a Document’s contents.
 * - Must not appear more than once.
 */
class Charset implements AtRule
{
    /**
<<<<<<< HEAD
     * @var string
     */
    private $sCharset;
=======
     * @var CSSString
     */
    private $oCharset;
>>>>>>> main

    /**
     * @var int
     */
    protected $iLineNo;

    /**
     * @var array<array-key, Comment>
     */
    protected $aComments;

    /**
<<<<<<< HEAD
     * @param string $sCharset
     * @param int $iLineNo
     */
    public function __construct($sCharset, $iLineNo = 0)
    {
        $this->sCharset = $sCharset;
=======
     * @param CSSString $oCharset
     * @param int $iLineNo
     */
    public function __construct(CSSString $oCharset, $iLineNo = 0)
    {
        $this->oCharset = $oCharset;
>>>>>>> main
        $this->iLineNo = $iLineNo;
        $this->aComments = [];
    }

    /**
     * @return int
     */
    public function getLineNo()
    {
        return $this->iLineNo;
    }

    /**
<<<<<<< HEAD
     * @param string $sCharset
=======
     * @param string|CSSString $oCharset
>>>>>>> main
     *
     * @return void
     */
    public function setCharset($sCharset)
    {
<<<<<<< HEAD
        $this->sCharset = $sCharset;
=======
        $sCharset = $sCharset instanceof CSSString ? $sCharset : new CSSString($sCharset);
        $this->oCharset = $sCharset;
>>>>>>> main
    }

    /**
     * @return string
     */
    public function getCharset()
    {
<<<<<<< HEAD
        return $this->sCharset;
=======
        return $this->oCharset->getString();
>>>>>>> main
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render(new OutputFormat());
    }

    /**
<<<<<<< HEAD
     * @return string
     */
    public function render(OutputFormat $oOutputFormat)
    {
        return "@charset {$this->sCharset->render($oOutputFormat)};";
=======
     * @param OutputFormat|null $oOutputFormat
     *
     * @return string
     */
    public function render($oOutputFormat)
    {
        return "{$oOutputFormat->comments($this)}@charset {$this->oCharset->render($oOutputFormat)};";
>>>>>>> main
    }

    /**
     * @return string
     */
    public function atRuleName()
    {
        return 'charset';
    }

    /**
     * @return string
     */
    public function atRuleArgs()
    {
<<<<<<< HEAD
        return $this->sCharset;
=======
        return $this->oCharset;
>>>>>>> main
    }

    /**
     * @param array<array-key, Comment> $aComments
     *
     * @return void
     */
    public function addComments(array $aComments)
    {
        $this->aComments = array_merge($this->aComments, $aComments);
    }

    /**
     * @return array<array-key, Comment>
     */
    public function getComments()
    {
        return $this->aComments;
    }

    /**
     * @param array<array-key, Comment> $aComments
     *
     * @return void
     */
    public function setComments(array $aComments)
    {
        $this->aComments = $aComments;
    }
}
