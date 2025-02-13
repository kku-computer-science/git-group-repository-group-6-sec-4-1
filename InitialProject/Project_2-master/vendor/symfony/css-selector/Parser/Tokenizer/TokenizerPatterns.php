<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\Parser\Tokenizer;

/**
 * CSS selector tokenizer patterns builder.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class TokenizerPatterns
{
<<<<<<< HEAD
    private $unicodeEscapePattern;
    private $simpleEscapePattern;
    private $newLineEscapePattern;
    private $escapePattern;
    private $stringEscapePattern;
    private $nonAsciiPattern;
    private $nmCharPattern;
    private $nmStartPattern;
    private $identifierPattern;
    private $hashPattern;
    private $numberPattern;
    private $quotedStringPattern;
=======
    private string $unicodeEscapePattern;
    private string $simpleEscapePattern;
    private string $newLineEscapePattern;
    private string $escapePattern;
    private string $stringEscapePattern;
    private string $nonAsciiPattern;
    private string $nmCharPattern;
    private string $nmStartPattern;
    private string $identifierPattern;
    private string $hashPattern;
    private string $numberPattern;
    private string $quotedStringPattern;
>>>>>>> main

    public function __construct()
    {
        $this->unicodeEscapePattern = '\\\\([0-9a-f]{1,6})(?:\r\n|[ \n\r\t\f])?';
        $this->simpleEscapePattern = '\\\\(.)';
        $this->newLineEscapePattern = '\\\\(?:\n|\r\n|\r|\f)';
        $this->escapePattern = $this->unicodeEscapePattern.'|\\\\[^\n\r\f0-9a-f]';
        $this->stringEscapePattern = $this->newLineEscapePattern.'|'.$this->escapePattern;
        $this->nonAsciiPattern = '[^\x00-\x7F]';
        $this->nmCharPattern = '[_a-z0-9-]|'.$this->escapePattern.'|'.$this->nonAsciiPattern;
        $this->nmStartPattern = '[_a-z]|'.$this->escapePattern.'|'.$this->nonAsciiPattern;
        $this->identifierPattern = '-?(?:'.$this->nmStartPattern.')(?:'.$this->nmCharPattern.')*';
        $this->hashPattern = '#((?:'.$this->nmCharPattern.')+)';
        $this->numberPattern = '[+-]?(?:[0-9]*\.[0-9]+|[0-9]+)';
<<<<<<< HEAD
        $this->quotedStringPattern = '([^\n\r\f%s]|'.$this->stringEscapePattern.')*';
=======
        $this->quotedStringPattern = '([^\n\r\f\\\\%s]|'.$this->stringEscapePattern.')*';
>>>>>>> main
    }

    public function getNewLineEscapePattern(): string
    {
<<<<<<< HEAD
        return '~^'.$this->newLineEscapePattern.'~';
=======
        return '~'.$this->newLineEscapePattern.'~';
>>>>>>> main
    }

    public function getSimpleEscapePattern(): string
    {
<<<<<<< HEAD
        return '~^'.$this->simpleEscapePattern.'~';
=======
        return '~'.$this->simpleEscapePattern.'~';
>>>>>>> main
    }

    public function getUnicodeEscapePattern(): string
    {
<<<<<<< HEAD
        return '~^'.$this->unicodeEscapePattern.'~i';
=======
        return '~'.$this->unicodeEscapePattern.'~i';
>>>>>>> main
    }

    public function getIdentifierPattern(): string
    {
        return '~^'.$this->identifierPattern.'~i';
    }

    public function getHashPattern(): string
    {
        return '~^'.$this->hashPattern.'~i';
    }

    public function getNumberPattern(): string
    {
        return '~^'.$this->numberPattern.'~';
    }

    public function getQuotedStringPattern(string $quote): string
    {
<<<<<<< HEAD
        return '~^'.sprintf($this->quotedStringPattern, $quote).'~i';
=======
        return '~^'.\sprintf($this->quotedStringPattern, $quote).'~i';
>>>>>>> main
    }
}
