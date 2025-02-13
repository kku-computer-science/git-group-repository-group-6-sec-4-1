<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

use function assert;
use function count;
use RecursiveIterator;

/**
<<<<<<< HEAD
=======
 * @template-implements RecursiveIterator<int, Test>
 *
>>>>>>> main
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class TestSuiteIterator implements RecursiveIterator
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var Test[]
     */
    private $tests;

    public function __construct(TestSuite $testSuite)
    {
        $this->tests = $testSuite->tests();
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return $this->position < count($this->tests);
    }

    public function key(): int
    {
        return $this->position;
    }

    public function current(): Test
    {
        return $this->tests[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    /**
     * @throws NoChildTestSuiteException
     */
    public function getChildren(): self
    {
        if (!$this->hasChildren()) {
            throw new NoChildTestSuiteException(
<<<<<<< HEAD
                'The current item is not a TestSuite instance and therefore does not have any children.'
=======
                'The current item is not a TestSuite instance and therefore does not have any children.',
>>>>>>> main
            );
        }

        $current = $this->current();

        assert($current instanceof TestSuite);

        return new self($current);
    }

    public function hasChildren(): bool
    {
        return $this->valid() && $this->current() instanceof TestSuite;
    }
}
