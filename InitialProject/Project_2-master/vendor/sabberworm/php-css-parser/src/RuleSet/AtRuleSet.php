<?php

namespace Sabberworm\CSS\RuleSet;

use Sabberworm\CSS\OutputFormat;
use Sabberworm\CSS\Property\AtRule;

/**
<<<<<<< HEAD
 * A RuleSet constructed by an unknown at-rule. `@font-face` rules are rendered into AtRuleSet objects.
=======
 * This class represents rule sets for generic at-rules which are not covered by specific classes, i.e., not
 * `@import`, `@charset` or `@media`.
 *
 * A common example for this is `@font-face`.
>>>>>>> main
 */
class AtRuleSet extends RuleSet implements AtRule
{
    /**
     * @var string
     */
    private $sType;

    /**
     * @var string
     */
    private $sArgs;

    /**
     * @param string $sType
     * @param string $sArgs
     * @param int $iLineNo
     */
    public function __construct($sType, $sArgs = '', $iLineNo = 0)
    {
        parent::__construct($iLineNo);
        $this->sType = $sType;
        $this->sArgs = $sArgs;
    }

    /**
     * @return string
     */
    public function atRuleName()
    {
        return $this->sType;
    }

    /**
     * @return string
     */
    public function atRuleArgs()
    {
        return $this->sArgs;
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
=======
     * @param OutputFormat|null $oOutputFormat
     *
     * @return string
     */
    public function render($oOutputFormat)
    {
        $sResult = $oOutputFormat->comments($this);
>>>>>>> main
        $sArgs = $this->sArgs;
        if ($sArgs) {
            $sArgs = ' ' . $sArgs;
        }
<<<<<<< HEAD
        $sResult = "@{$this->sType}$sArgs{$oOutputFormat->spaceBeforeOpeningBrace()}{";
        $sResult .= parent::render($oOutputFormat);
=======
        $sResult .= "@{$this->sType}$sArgs{$oOutputFormat->spaceBeforeOpeningBrace()}{";
        $sResult .= $this->renderRules($oOutputFormat);
>>>>>>> main
        $sResult .= '}';
        return $sResult;
    }
}
