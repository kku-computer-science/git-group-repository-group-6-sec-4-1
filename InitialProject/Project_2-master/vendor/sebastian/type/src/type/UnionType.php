<?php declare(strict_types=1);
/*
 * This file is part of sebastian/type.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Type;

use function count;
use function implode;
use function sort;

final class UnionType extends Type
{
    /**
<<<<<<< HEAD
     * @psalm-var list<Type>
=======
     * @psalm-var non-empty-list<Type>
>>>>>>> main
     */
    private $types;

    /**
     * @throws RuntimeException
     */
    public function __construct(Type ...$types)
    {
        $this->ensureMinimumOfTwoTypes(...$types);
        $this->ensureOnlyValidTypes(...$types);

        $this->types = $types;
    }

    public function isAssignable(Type $other): bool
    {
        foreach ($this->types as $type) {
            if ($type->isAssignable($other)) {
                return true;
            }
        }

        return false;
    }

    public function asString(): string
    {
        return $this->name();
    }

    public function name(): string
    {
        $types = [];

        foreach ($this->types as $type) {
<<<<<<< HEAD
=======
            if ($type->isIntersection()) {
                $types[] = '(' . $type->name() . ')';

                continue;
            }

>>>>>>> main
            $types[] = $type->name();
        }

        sort($types);

        return implode('|', $types);
    }

    public function allowsNull(): bool
    {
        foreach ($this->types as $type) {
            if ($type instanceof NullType) {
                return true;
            }
        }

        return false;
    }

<<<<<<< HEAD
=======
    /**
     * @psalm-assert-if-true UnionType $this
     */
>>>>>>> main
    public function isUnion(): bool
    {
        return true;
    }

<<<<<<< HEAD
=======
    public function containsIntersectionTypes(): bool
    {
        foreach ($this->types as $type) {
            if ($type->isIntersection()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @psalm-return non-empty-list<Type>
     */
    public function types(): array
    {
        return $this->types;
    }

>>>>>>> main
    /**
     * @throws RuntimeException
     */
    private function ensureMinimumOfTwoTypes(Type ...$types): void
    {
        if (count($types) < 2) {
            throw new RuntimeException(
                'A union type must be composed of at least two types'
            );
        }
    }

    /**
     * @throws RuntimeException
     */
    private function ensureOnlyValidTypes(Type ...$types): void
    {
        foreach ($types as $type) {
            if ($type instanceof UnknownType) {
                throw new RuntimeException(
                    'A union type must not be composed of an unknown type'
                );
            }

            if ($type instanceof VoidType) {
                throw new RuntimeException(
                    'A union type must not be composed of a void type'
                );
            }
        }
    }
}
