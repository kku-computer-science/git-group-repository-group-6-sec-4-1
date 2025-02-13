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

namespace Ramsey\Collection\Map;

use Ramsey\Collection\Exception\InvalidArgumentException;
use Ramsey\Collection\Tool\TypeTrait;
use Ramsey\Collection\Tool\ValueToStringTrait;

/**
 * This class provides a basic implementation of `TypedMapInterface`, to
 * minimize the effort required to implement this interface.
 *
<<<<<<< HEAD
 * @template K
 * @template T
 * @extends AbstractMap<T>
 * @implements TypedMapInterface<T>
=======
 * @template K of array-key
 * @template T
 * @extends AbstractMap<K, T>
 * @implements TypedMapInterface<K, T>
>>>>>>> main
 */
abstract class AbstractTypedMap extends AbstractMap implements TypedMapInterface
{
    use TypeTrait;
    use ValueToStringTrait;

    /**
<<<<<<< HEAD
     * @param K|null $offset
     * @param T $value
     *
     * @inheritDoc
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            throw new InvalidArgumentException(
                'Map elements are key/value pairs; a key must be provided for '
                . 'value ' . var_export($value, true)
            );
        }

        if ($this->checkType($this->getKeyType(), $offset) === false) {
            throw new InvalidArgumentException(
                'Key must be of type ' . $this->getKeyType() . '; key is '
                . $this->toolValueToString($offset)
=======
     * @param K $offset
     * @param T $value
     *
     * @inheritDoc
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($this->checkType($this->getKeyType(), $offset) === false) {
            throw new InvalidArgumentException(
                'Key must be of type ' . $this->getKeyType() . '; key is '
                . $this->toolValueToString($offset),
>>>>>>> main
            );
        }

        if ($this->checkType($this->getValueType(), $value) === false) {
            throw new InvalidArgumentException(
                'Value must be of type ' . $this->getValueType() . '; value is '
<<<<<<< HEAD
                . $this->toolValueToString($value)
            );
        }

        /** @psalm-suppress MixedArgumentTypeCoercion */
=======
                . $this->toolValueToString($value),
            );
        }

>>>>>>> main
        parent::offsetSet($offset, $value);
    }
}
