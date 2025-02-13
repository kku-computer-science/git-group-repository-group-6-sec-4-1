<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\MockObject\Builder;

use PHPUnit\Framework\MockObject\Stub\Stub;
use Throwable;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
interface InvocationStubber
{
    public function will(Stub $stub): Identity;

    /** @return self */
<<<<<<< HEAD
    public function willReturn($value, ...$nextValues)/*: self */;
=======
    public function willReturn($value, ...$nextValues)/* : self */;
>>>>>>> main

    /**
     * @param mixed $reference
     *
     * @return self
     */
<<<<<<< HEAD
    public function willReturnReference(&$reference)/*: self */;
=======
    public function willReturnReference(&$reference)/* : self */;
>>>>>>> main

    /**
     * @param array<int, array<int, mixed>> $valueMap
     *
     * @return self
     */
<<<<<<< HEAD
    public function willReturnMap(array $valueMap)/*: self */;
=======
    public function willReturnMap(array $valueMap)/* : self */;
>>>>>>> main

    /**
     * @param int $argumentIndex
     *
     * @return self
     */
<<<<<<< HEAD
    public function willReturnArgument($argumentIndex)/*: self */;
=======
    public function willReturnArgument($argumentIndex)/* : self */;
>>>>>>> main

    /**
     * @param callable $callback
     *
     * @return self
     */
<<<<<<< HEAD
    public function willReturnCallback($callback)/*: self */;

    /** @return self */
    public function willReturnSelf()/*: self */;
=======
    public function willReturnCallback($callback)/* : self */;

    /** @return self */
    public function willReturnSelf()/* : self */;
>>>>>>> main

    /**
     * @param mixed $values
     *
     * @return self
     */
<<<<<<< HEAD
    public function willReturnOnConsecutiveCalls(...$values)/*: self */;

    /** @return self */
    public function willThrowException(Throwable $exception)/*: self */;
=======
    public function willReturnOnConsecutiveCalls(...$values)/* : self */;

    /** @return self */
    public function willThrowException(Throwable $exception)/* : self */;
>>>>>>> main
}
