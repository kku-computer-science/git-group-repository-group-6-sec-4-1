<?php

namespace Sabberworm\CSS\Value;

use Sabberworm\CSS\Parsing\ParserState;
use Sabberworm\CSS\Parsing\UnexpectedEOFException;
use Sabberworm\CSS\Parsing\UnexpectedTokenException;

class CalcFunction extends CSSFunction
{
    /**
     * @var int
<<<<<<< HEAD
=======
     *
     * @internal
>>>>>>> main
     */
    const T_OPERAND = 1;

    /**
     * @var int
<<<<<<< HEAD
=======
     *
     * @internal
>>>>>>> main
     */
    const T_OPERATOR = 2;

    /**
<<<<<<< HEAD
=======
     * @param ParserState $oParserState
     * @param bool $bIgnoreCase
     *
>>>>>>> main
     * @return CalcFunction
     *
     * @throws UnexpectedTokenException
     * @throws UnexpectedEOFException
     */
<<<<<<< HEAD
    public static function parse(ParserState $oParserState)
    {
        $aOperators = ['+', '-', '*', '/'];
        $sFunction = trim($oParserState->consumeUntil('(', false, true));
=======
    public static function parse(ParserState $oParserState, $bIgnoreCase = false)
    {
        $aOperators = ['+', '-', '*', '/'];
        $sFunction = $oParserState->parseIdentifier();
        if ($oParserState->peek() != '(') {
            // Found ; or end of line before an opening bracket
            throw new UnexpectedTokenException('(', $oParserState->peek(), 'literal', $oParserState->currentLine());
        } elseif (!in_array($sFunction, ['calc', '-moz-calc', '-webkit-calc'])) {
            // Found invalid calc definition. Example calc (...
            throw new UnexpectedTokenException('calc', $sFunction, 'literal', $oParserState->currentLine());
        }
        $oParserState->consume('(');
>>>>>>> main
        $oCalcList = new CalcRuleValueList($oParserState->currentLine());
        $oList = new RuleValueList(',', $oParserState->currentLine());
        $iNestingLevel = 0;
        $iLastComponentType = null;
        while (!$oParserState->comes(')') || $iNestingLevel > 0) {
<<<<<<< HEAD
=======
            if ($oParserState->isEnd() && $iNestingLevel === 0) {
                break;
            }

>>>>>>> main
            $oParserState->consumeWhiteSpace();
            if ($oParserState->comes('(')) {
                $iNestingLevel++;
                $oCalcList->addListComponent($oParserState->consume(1));
                $oParserState->consumeWhiteSpace();
                continue;
            } elseif ($oParserState->comes(')')) {
                $iNestingLevel--;
                $oCalcList->addListComponent($oParserState->consume(1));
                $oParserState->consumeWhiteSpace();
                continue;
            }
            if ($iLastComponentType != CalcFunction::T_OPERAND) {
                $oVal = Value::parsePrimitiveValue($oParserState);
                $oCalcList->addListComponent($oVal);
                $iLastComponentType = CalcFunction::T_OPERAND;
            } else {
                if (in_array($oParserState->peek(), $aOperators)) {
                    if (($oParserState->comes('-') || $oParserState->comes('+'))) {
                        if (
                            $oParserState->peek(1, -1) != ' '
                            || !($oParserState->comes('- ')
                                || $oParserState->comes('+ '))
                        ) {
                            throw new UnexpectedTokenException(
                                " {$oParserState->peek()} ",
                                $oParserState->peek(1, -1) . $oParserState->peek(2),
                                'literal',
                                $oParserState->currentLine()
                            );
                        }
                    }
                    $oCalcList->addListComponent($oParserState->consume(1));
                    $iLastComponentType = CalcFunction::T_OPERATOR;
                } else {
                    throw new UnexpectedTokenException(
                        sprintf(
                            'Next token was expected to be an operand of type %s. Instead "%s" was found.',
                            implode(', ', $aOperators),
<<<<<<< HEAD
                            $oVal
=======
                            $oParserState->peek()
>>>>>>> main
                        ),
                        '',
                        'custom',
                        $oParserState->currentLine()
                    );
                }
            }
            $oParserState->consumeWhiteSpace();
        }
        $oList->addListComponent($oCalcList);
<<<<<<< HEAD
        $oParserState->consume(')');
=======
        if (!$oParserState->isEnd()) {
            $oParserState->consume(')');
        }
>>>>>>> main
        return new CalcFunction($sFunction, $oList, ',', $oParserState->currentLine());
    }
}
