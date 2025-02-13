<?php

/**
 * This file is part of the ramsey/collection library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Ramsey\Collection;

use Closure;
use Ramsey\Collection\Exception\CollectionMismatchException;
use Ramsey\Collection\Exception\InvalidArgumentException;
<<<<<<< HEAD
use Ramsey\Collection\Exception\InvalidSortOrderException;
use Ramsey\Collection\Exception\OutOfBoundsException;
=======
use Ramsey\Collection\Exception\InvalidPropertyOrMethod;
use Ramsey\Collection\Exception\NoSuchElementException;
use Ramsey\Collection\Exception\UnsupportedOperationException;
>>>>>>> main
use Ramsey\Collection\Tool\TypeTrait;
use Ramsey\Collection\Tool\ValueExtractorTrait;
use Ramsey\Collection\Tool\ValueToStringTrait;

use function array_filter;
<<<<<<< HEAD
use function array_map;
use function array_merge;
use function array_search;
use function array_udiff;
use function array_uintersect;
use function current;
use function end;
use function in_array;
use function is_int;
use function reset;
use function sprintf;
use function unserialize;
=======
use function array_key_first;
use function array_key_last;
use function array_map;
use function array_merge;
use function array_reduce;
use function array_search;
use function array_udiff;
use function array_uintersect;
use function in_array;
use function is_int;
use function is_object;
use function spl_object_id;
use function sprintf;
>>>>>>> main
use function usort;

/**
 * This class provides a basic implementation of `CollectionInterface`, to
 * minimize the effort required to implement this interface
 *
 * @template T
 * @extends AbstractArray<T>
 * @implements CollectionInterface<T>
 */
abstract class AbstractCollection extends AbstractArray implements CollectionInterface
{
    use TypeTrait;
    use ValueToStringTrait;
    use ValueExtractorTrait;

    /**
<<<<<<< HEAD
     * @inheritDoc
     */
    public function add($element): bool
=======
     * @throws InvalidArgumentException if $element is of the wrong type.
     */
    public function add(mixed $element): bool
>>>>>>> main
    {
        $this[] = $element;

        return true;
    }

<<<<<<< HEAD
    /**
     * @inheritDoc
     */
    public function contains($element, bool $strict = true): bool
=======
    public function contains(mixed $element, bool $strict = true): bool
>>>>>>> main
    {
        return in_array($element, $this->data, $strict);
    }

    /**
<<<<<<< HEAD
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
=======
     * @throws InvalidArgumentException if $element is of the wrong type.
     */
    public function offsetSet(mixed $offset, mixed $value): void
>>>>>>> main
    {
        if ($this->checkType($this->getType(), $value) === false) {
            throw new InvalidArgumentException(
                'Value must be of type ' . $this->getType() . '; value is '
<<<<<<< HEAD
                . $this->toolValueToString($value)
=======
                . $this->toolValueToString($value),
>>>>>>> main
            );
        }

        if ($offset === null) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

<<<<<<< HEAD
    /**
     * @inheritDoc
     */
    public function remove($element): bool
    {
        if (($position = array_search($element, $this->data, true)) !== false) {
            unset($this->data[$position]);
=======
    public function remove(mixed $element): bool
    {
        if (($position = array_search($element, $this->data, true)) !== false) {
            unset($this[$position]);
>>>>>>> main

            return true;
        }

        return false;
    }

    /**
<<<<<<< HEAD
=======
     * @throws InvalidPropertyOrMethod if the $propertyOrMethod does not exist
     *     on the elements in this collection.
     * @throws UnsupportedOperationException if unable to call column() on this
     *     collection.
     *
>>>>>>> main
     * @inheritDoc
     */
    public function column(string $propertyOrMethod): array
    {
        $temp = [];

        foreach ($this->data as $item) {
<<<<<<< HEAD
            /** @var mixed $value */
            $value = $this->extractValue($item, $propertyOrMethod);

            /** @psalm-suppress MixedAssignment */
            $temp[] = $value;
=======
            /** @psalm-suppress MixedAssignment */
            $temp[] = $this->extractValue($item, $propertyOrMethod);
>>>>>>> main
        }

        return $temp;
    }

    /**
<<<<<<< HEAD
     * @inheritDoc
     */
    public function first()
    {
        if ($this->isEmpty()) {
            throw new OutOfBoundsException('Can\'t determine first item. Collection is empty');
        }

        reset($this->data);

        /** @var T $first */
        $first = current($this->data);

        return $first;
    }

    /**
     * @inheritDoc
     */
    public function last()
    {
        if ($this->isEmpty()) {
            throw new OutOfBoundsException('Can\'t determine last item. Collection is empty');
        }

        /** @var T $item */
        $item = end($this->data);
        reset($this->data);

        return $item;
    }

    public function sort(string $propertyOrMethod, string $order = self::SORT_ASC): CollectionInterface
    {
        if (!in_array($order, [self::SORT_ASC, self::SORT_DESC], true)) {
            throw new InvalidSortOrderException('Invalid sort order given: ' . $order);
        }

=======
     * @return T
     *
     * @throws NoSuchElementException if this collection is empty.
     */
    public function first(): mixed
    {
        $firstIndex = array_key_first($this->data);

        if ($firstIndex === null) {
            throw new NoSuchElementException('Can\'t determine first item. Collection is empty');
        }

        return $this->data[$firstIndex];
    }

    /**
     * @return T
     *
     * @throws NoSuchElementException if this collection is empty.
     */
    public function last(): mixed
    {
        $lastIndex = array_key_last($this->data);

        if ($lastIndex === null) {
            throw new NoSuchElementException('Can\'t determine last item. Collection is empty');
        }

        return $this->data[$lastIndex];
    }

    /**
     * @return CollectionInterface<T>
     *
     * @throws InvalidPropertyOrMethod if the $propertyOrMethod does not exist
     *     on the elements in this collection.
     * @throws UnsupportedOperationException if unable to call sort() on this
     *     collection.
     */
    public function sort(?string $propertyOrMethod = null, Sort $order = Sort::Ascending): CollectionInterface
    {
>>>>>>> main
        $collection = clone $this;

        usort(
            $collection->data,
            /**
             * @param T $a
             * @param T $b
             */
<<<<<<< HEAD
            function ($a, $b) use ($propertyOrMethod, $order): int {
=======
            function (mixed $a, mixed $b) use ($propertyOrMethod, $order): int {
>>>>>>> main
                /** @var mixed $aValue */
                $aValue = $this->extractValue($a, $propertyOrMethod);

                /** @var mixed $bValue */
                $bValue = $this->extractValue($b, $propertyOrMethod);

<<<<<<< HEAD
                return ($aValue <=> $bValue) * ($order === self::SORT_DESC ? -1 : 1);
            }
=======
                return ($aValue <=> $bValue) * ($order === Sort::Descending ? -1 : 1);
            },
>>>>>>> main
        );

        return $collection;
    }

<<<<<<< HEAD
=======
    /**
     * @param callable(T): bool $callback A callable to use for filtering elements.
     *
     * @return CollectionInterface<T>
     */
>>>>>>> main
    public function filter(callable $callback): CollectionInterface
    {
        $collection = clone $this;
        $collection->data = array_merge([], array_filter($collection->data, $callback));

        return $collection;
    }

    /**
<<<<<<< HEAD
     * {@inheritdoc}
     */
    public function where(string $propertyOrMethod, $value): CollectionInterface
    {
        return $this->filter(function ($item) use ($propertyOrMethod, $value) {
            /** @var mixed $accessorValue */
            $accessorValue = $this->extractValue($item, $propertyOrMethod);

            return $accessorValue === $value;
        });
    }

    public function map(callable $callback): CollectionInterface
    {
        return new Collection('mixed', array_map($callback, $this->data));
    }

=======
     * @return CollectionInterface<T>
     *
     * @throws InvalidPropertyOrMethod if the $propertyOrMethod does not exist
     *     on the elements in this collection.
     * @throws UnsupportedOperationException if unable to call where() on this
     *     collection.
     */
    public function where(?string $propertyOrMethod, mixed $value): CollectionInterface
    {
        return $this->filter(
            /**
             * @param T $item
             */
            function (mixed $item) use ($propertyOrMethod, $value): bool {
                /** @var mixed $accessorValue */
                $accessorValue = $this->extractValue($item, $propertyOrMethod);

                return $accessorValue === $value;
            },
        );
    }

    /**
     * @param callable(T): TCallbackReturn $callback A callable to apply to each
     *     item of the collection.
     *
     * @return CollectionInterface<TCallbackReturn>
     *
     * @template TCallbackReturn
     */
    public function map(callable $callback): CollectionInterface
    {
        /** @var Collection<TCallbackReturn> */
        return new Collection('mixed', array_map($callback, $this->data));
    }

    /**
     * @param callable(TCarry, T): TCarry $callback A callable to apply to each
     *     item of the collection to reduce it to a single value.
     * @param TCarry $initial This is the initial value provided to the callback.
     *
     * @return TCarry
     *
     * @template TCarry
     */
    public function reduce(callable $callback, mixed $initial): mixed
    {
        /** @var TCarry */
        return array_reduce($this->data, $callback, $initial);
    }

    /**
     * @param CollectionInterface<T> $other The collection to check for divergent
     *     items.
     *
     * @return CollectionInterface<T>
     *
     * @throws CollectionMismatchException if the compared collections are of
     *     differing types.
     */
>>>>>>> main
    public function diff(CollectionInterface $other): CollectionInterface
    {
        $this->compareCollectionTypes($other);

        $diffAtoB = array_udiff($this->data, $other->toArray(), $this->getComparator());
        $diffBtoA = array_udiff($other->toArray(), $this->data, $this->getComparator());

        /** @var array<array-key, T> $diff */
        $diff = array_merge($diffAtoB, $diffBtoA);

        $collection = clone $this;
        $collection->data = $diff;

        return $collection;
    }

<<<<<<< HEAD
=======
    /**
     * @param CollectionInterface<T> $other The collection to check for
     *     intersecting items.
     *
     * @return CollectionInterface<T>
     *
     * @throws CollectionMismatchException if the compared collections are of
     *     differing types.
     */
>>>>>>> main
    public function intersect(CollectionInterface $other): CollectionInterface
    {
        $this->compareCollectionTypes($other);

        /** @var array<array-key, T> $intersect */
        $intersect = array_uintersect($this->data, $other->toArray(), $this->getComparator());

        $collection = clone $this;
        $collection->data = $intersect;

        return $collection;
    }

<<<<<<< HEAD
=======
    /**
     * @param CollectionInterface<T> ...$collections The collections to merge.
     *
     * @return CollectionInterface<T>
     *
     * @throws CollectionMismatchException if unable to merge any of the given
     *     collections or items within the given collections due to type
     *     mismatch errors.
     */
>>>>>>> main
    public function merge(CollectionInterface ...$collections): CollectionInterface
    {
        $mergedCollection = clone $this;

        foreach ($collections as $index => $collection) {
            if (!$collection instanceof static) {
                throw new CollectionMismatchException(
<<<<<<< HEAD
                    sprintf('Collection with index %d must be of type %s', $index, static::class)
=======
                    sprintf('Collection with index %d must be of type %s', $index, static::class),
>>>>>>> main
                );
            }

            // When using generics (Collection.php, Set.php, etc),
            // we also need to make sure that the internal types match each other
<<<<<<< HEAD
            if ($collection->getType() !== $this->getType()) {
                throw new CollectionMismatchException(
                    sprintf('Collection items in collection with index %d must be of type %s', $index, $this->getType())
=======
            if ($this->getUniformType($collection) !== $this->getUniformType($this)) {
                throw new CollectionMismatchException(
                    sprintf(
                        'Collection items in collection with index %d must be of type %s',
                        $index,
                        $this->getType(),
                    ),
>>>>>>> main
                );
            }

            foreach ($collection as $key => $value) {
                if (is_int($key)) {
                    $mergedCollection[] = $value;
                } else {
                    $mergedCollection[$key] = $value;
                }
            }
        }

        return $mergedCollection;
    }

    /**
<<<<<<< HEAD
     * @inheritDoc
     */
    public function unserialize($serialized): void
    {
        /** @var array<array-key, T> $data */
        $data = unserialize($serialized, ['allowed_classes' => [$this->getType()]]);

        $this->data = $data;
    }

    /**
     * @param CollectionInterface<T> $other
=======
     * @param CollectionInterface<T> $other
     *
     * @throws CollectionMismatchException
>>>>>>> main
     */
    private function compareCollectionTypes(CollectionInterface $other): void
    {
        if (!$other instanceof static) {
            throw new CollectionMismatchException('Collection must be of type ' . static::class);
        }

        // When using generics (Collection.php, Set.php, etc),
        // we also need to make sure that the internal types match each other
<<<<<<< HEAD
        if ($other->getType() !== $this->getType()) {
=======
        if ($this->getUniformType($other) !== $this->getUniformType($this)) {
>>>>>>> main
            throw new CollectionMismatchException('Collection items must be of type ' . $this->getType());
        }
    }

    private function getComparator(): Closure
    {
        return /**
             * @param T $a
             * @param T $b
             */
<<<<<<< HEAD
            function ($a, $b): int {
=======
            function (mixed $a, mixed $b): int {
>>>>>>> main
                // If the two values are object, we convert them to unique scalars.
                // If the collection contains mixed values (unlikely) where some are objects
                // and some are not, we leave them as they are.
                // The comparator should still work and the result of $a < $b should
                // be consistent but unpredictable since not documented.
                if (is_object($a) && is_object($b)) {
                    $a = spl_object_id($a);
                    $b = spl_object_id($b);
                }

                return $a === $b ? 0 : ($a < $b ? 1 : -1);
            };
    }
<<<<<<< HEAD
=======

    /**
     * @param CollectionInterface<mixed> $collection
     */
    private function getUniformType(CollectionInterface $collection): string
    {
        return match ($collection->getType()) {
            'integer' => 'int',
            'boolean' => 'bool',
            'double' => 'float',
            default => $collection->getType(),
        };
    }
>>>>>>> main
}
