<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

<<<<<<< HEAD
=======
use function get_class;
>>>>>>> main
use function gettype;
use function is_object;
use function sprintf;
use ReflectionObject;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class ObjectHasProperty extends Constraint
{
<<<<<<< HEAD
    private readonly string $propertyName;
=======
    /**
     * @var string
     */
    private $propertyName;
>>>>>>> main

    public function __construct(string $propertyName)
    {
        $this->propertyName = $propertyName;
    }

    /**
     * Returns a string representation of the constraint.
     */
    public function toString(): string
    {
        return sprintf(
            'has property "%s"',
            $this->propertyName,
        );
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     *
     * @param mixed $other value or object to evaluate
     */
<<<<<<< HEAD
    protected function matches(mixed $other): bool
=======
    protected function matches($other): bool
>>>>>>> main
    {
        if (!is_object($other)) {
            return false;
        }

        return (new ReflectionObject($other))->hasProperty($this->propertyName);
    }

    /**
     * Returns the description of the failure.
     *
     * The beginning of failure messages is "Failed asserting that" in most
     * cases. This method should return the second part of that sentence.
     *
     * @param mixed $other evaluated value or object
     */
<<<<<<< HEAD
    protected function failureDescription(mixed $other): string
=======
    protected function failureDescription($other): string
>>>>>>> main
    {
        if (is_object($other)) {
            return sprintf(
                'object of class "%s" %s',
<<<<<<< HEAD
                $other::class,
=======
                get_class($other),
>>>>>>> main
                $this->toString(),
            );
        }

        return sprintf(
            '"%s" (%s) %s',
            $other,
            gettype($other),
            $this->toString(),
        );
    }
}
