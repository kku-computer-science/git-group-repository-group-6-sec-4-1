<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\Parser;

/**
 * CSS selector reader.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class Reader
{
<<<<<<< HEAD
    private $source;
    private $length;
    private $position = 0;

    public function __construct(string $source)
    {
        $this->source = $source;
=======
    private int $length;
    private int $position = 0;

    public function __construct(
        private string $source,
    ) {
>>>>>>> main
        $this->length = \strlen($source);
    }

    public function isEOF(): bool
    {
        return $this->position >= $this->length;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getRemainingLength(): int
    {
        return $this->length - $this->position;
    }

    public function getSubstring(int $length, int $offset = 0): string
    {
        return substr($this->source, $this->position + $offset, $length);
    }

<<<<<<< HEAD
    public function getOffset(string $string)
=======
    public function getOffset(string $string): int|false
>>>>>>> main
    {
        $position = strpos($this->source, $string, $this->position);

        return false === $position ? false : $position - $this->position;
    }

<<<<<<< HEAD
    /**
     * @return array|false
     */
    public function findPattern(string $pattern)
=======
    public function findPattern(string $pattern): array|false
>>>>>>> main
    {
        $source = substr($this->source, $this->position);

        if (preg_match($pattern, $source, $matches)) {
            return $matches;
        }

        return false;
    }

<<<<<<< HEAD
    public function moveForward(int $length)
=======
    public function moveForward(int $length): void
>>>>>>> main
    {
        $this->position += $length;
    }

<<<<<<< HEAD
    public function moveToEnd()
=======
    public function moveToEnd(): void
>>>>>>> main
    {
        $this->position = $this->length;
    }
}
