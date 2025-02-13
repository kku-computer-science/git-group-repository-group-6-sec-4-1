<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\Exception;

use Symfony\Component\CssSelector\Parser\Token;

/**
 * ParseException is thrown when a CSS selector syntax is not valid.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 */
class SyntaxErrorException extends ParseException
{
<<<<<<< HEAD
    /**
     * @return self
     */
    public static function unexpectedToken(string $expectedValue, Token $foundToken)
    {
        return new self(sprintf('Expected %s, but %s found.', $expectedValue, $foundToken));
    }

    /**
     * @return self
     */
    public static function pseudoElementFound(string $pseudoElement, string $unexpectedLocation)
    {
        return new self(sprintf('Unexpected pseudo-element "::%s" found %s.', $pseudoElement, $unexpectedLocation));
    }

    /**
     * @return self
     */
    public static function unclosedString(int $position)
    {
        return new self(sprintf('Unclosed/invalid string at %s.', $position));
    }

    /**
     * @return self
     */
    public static function nestedNot()
=======
    public static function unexpectedToken(string $expectedValue, Token $foundToken): self
    {
        return new self(\sprintf('Expected %s, but %s found.', $expectedValue, $foundToken));
    }

    public static function pseudoElementFound(string $pseudoElement, string $unexpectedLocation): self
    {
        return new self(\sprintf('Unexpected pseudo-element "::%s" found %s.', $pseudoElement, $unexpectedLocation));
    }

    public static function unclosedString(int $position): self
    {
        return new self(\sprintf('Unclosed/invalid string at %s.', $position));
    }

    public static function nestedNot(): self
>>>>>>> main
    {
        return new self('Got nested ::not().');
    }

<<<<<<< HEAD
    /**
     * @return self
     */
    public static function stringAsFunctionArgument()
=======
    public static function notAtTheStartOfASelector(string $pseudoElement): self
    {
        return new self(\sprintf('Got immediate child pseudo-element ":%s" not at the start of a selector', $pseudoElement));
    }

    public static function stringAsFunctionArgument(): self
>>>>>>> main
    {
        return new self('String not allowed as function argument.');
    }
}
