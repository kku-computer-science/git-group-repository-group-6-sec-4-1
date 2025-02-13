<?php

/**
 * This file is part of the ramsey/uuid library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Ramsey\Uuid\Type;

use Ramsey\Uuid\Exception\UnsupportedOperationException;
use Ramsey\Uuid\Type\Integer as IntegerObject;
use ValueError;
<<<<<<< HEAD
use stdClass;
=======
>>>>>>> main

use function json_decode;
use function json_encode;
use function sprintf;

/**
 * A value object representing a timestamp
 *
 * This class exists for type-safety purposes, to ensure that timestamps used
 * by ramsey/uuid are truly timestamp integers and not some other kind of string
 * or integer.
 *
 * @psalm-immutable
 */
final class Time implements TypeInterface
{
<<<<<<< HEAD
    /**
     * @var IntegerObject
     */
    private $seconds;

    /**
     * @var IntegerObject
     */
    private $microseconds;

    /**
     * @param mixed $seconds
     * @param mixed $microseconds
     */
    public function __construct($seconds, $microseconds = 0)
    {
=======
    private IntegerObject $seconds;
    private IntegerObject $microseconds;

    public function __construct(
        float | int | string | IntegerObject $seconds,
        float | int | string | IntegerObject $microseconds = 0,
    ) {
>>>>>>> main
        $this->seconds = new IntegerObject($seconds);
        $this->microseconds = new IntegerObject($microseconds);
    }

    public function getSeconds(): IntegerObject
    {
        return $this->seconds;
    }

    public function getMicroseconds(): IntegerObject
    {
        return $this->microseconds;
    }

    public function toString(): string
    {
<<<<<<< HEAD
        return $this->seconds->toString() . '.' . $this->microseconds->toString();
=======
        return $this->seconds->toString() . '.' . sprintf('%06s', $this->microseconds->toString());
>>>>>>> main
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @return string[]
     */
    public function jsonSerialize(): array
    {
        return [
            'seconds' => $this->getSeconds()->toString(),
            'microseconds' => $this->getMicroseconds()->toString(),
        ];
    }

    public function serialize(): string
    {
        return (string) json_encode($this);
    }

    /**
     * @return array{seconds: string, microseconds: string}
     */
    public function __serialize(): array
    {
        return [
            'seconds' => $this->getSeconds()->toString(),
            'microseconds' => $this->getMicroseconds()->toString(),
        ];
    }

    /**
     * Constructs the object from a serialized string representation
     *
<<<<<<< HEAD
     * @param string $serialized The serialized string representation of the object
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @psalm-suppress UnusedMethodCall
     */
    public function unserialize($serialized): void
    {
        /** @var stdClass $time */
        $time = json_decode($serialized);

        if (!isset($time->seconds) || !isset($time->microseconds)) {
=======
     * @param string $data The serialized string representation of the object
     *
     * @psalm-suppress UnusedMethodCall
     */
    public function unserialize(string $data): void
    {
        /** @var array{seconds?: int|float|string, microseconds?: int|float|string} $time */
        $time = json_decode($data, true);

        if (!isset($time['seconds']) || !isset($time['microseconds'])) {
>>>>>>> main
            throw new UnsupportedOperationException(
                'Attempted to unserialize an invalid value'
            );
        }

<<<<<<< HEAD
        $this->__construct($time->seconds, $time->microseconds);
    }

    /**
     * @param array{seconds: string, microseconds: string} $data
=======
        $this->__construct($time['seconds'], $time['microseconds']);
    }

    /**
     * @param array{seconds?: string, microseconds?: string} $data
>>>>>>> main
     */
    public function __unserialize(array $data): void
    {
        // @codeCoverageIgnoreStart
        if (!isset($data['seconds']) || !isset($data['microseconds'])) {
            throw new ValueError(sprintf('%s(): Argument #1 ($data) is invalid', __METHOD__));
        }
        // @codeCoverageIgnoreEnd

        $this->__construct($data['seconds'], $data['microseconds']);
    }
}
