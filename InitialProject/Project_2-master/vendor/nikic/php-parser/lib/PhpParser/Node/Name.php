<?php declare(strict_types=1);

namespace PhpParser\Node;

use PhpParser\NodeAbstract;

<<<<<<< HEAD
class Name extends NodeAbstract
{
    /** @var string[] Parts of the name */
    public $parts;

    private static $specialClassNames = [
=======
class Name extends NodeAbstract {
    /**
     * @psalm-var non-empty-string
     * @var string Name as string
     */
    public string $name;

    /** @var array<string, bool> */
    private static array $specialClassNames = [
>>>>>>> main
        'self'   => true,
        'parent' => true,
        'static' => true,
    ];

    /**
     * Constructs a name node.
     *
<<<<<<< HEAD
     * @param string|string[]|self $name       Name as string, part array or Name instance (copy ctor)
     * @param array                $attributes Additional attributes
     */
    public function __construct($name, array $attributes = []) {
        $this->attributes = $attributes;
        $this->parts = self::prepareName($name);
    }

    public function getSubNodeNames() : array {
        return ['parts'];
=======
     * @param string|string[]|self $name Name as string, part array or Name instance (copy ctor)
     * @param array<string, mixed> $attributes Additional attributes
     */
    final public function __construct($name, array $attributes = []) {
        $this->attributes = $attributes;
        $this->name = self::prepareName($name);
    }

    public function getSubNodeNames(): array {
        return ['name'];
    }

    /**
     * Get parts of name (split by the namespace separator).
     *
     * @psalm-return non-empty-list<string>
     * @return string[] Parts of name
     */
    public function getParts(): array {
        return \explode('\\', $this->name);
>>>>>>> main
    }

    /**
     * Gets the first part of the name, i.e. everything before the first namespace separator.
     *
     * @return string First part of the name
     */
<<<<<<< HEAD
    public function getFirst() : string {
        return $this->parts[0];
=======
    public function getFirst(): string {
        if (false !== $pos = \strpos($this->name, '\\')) {
            return \substr($this->name, 0, $pos);
        }
        return $this->name;
>>>>>>> main
    }

    /**
     * Gets the last part of the name, i.e. everything after the last namespace separator.
     *
     * @return string Last part of the name
     */
<<<<<<< HEAD
    public function getLast() : string {
        return $this->parts[count($this->parts) - 1];
=======
    public function getLast(): string {
        if (false !== $pos = \strrpos($this->name, '\\')) {
            return \substr($this->name, $pos + 1);
        }
        return $this->name;
>>>>>>> main
    }

    /**
     * Checks whether the name is unqualified. (E.g. Name)
     *
     * @return bool Whether the name is unqualified
     */
<<<<<<< HEAD
    public function isUnqualified() : bool {
        return 1 === count($this->parts);
=======
    public function isUnqualified(): bool {
        return false === \strpos($this->name, '\\');
>>>>>>> main
    }

    /**
     * Checks whether the name is qualified. (E.g. Name\Name)
     *
     * @return bool Whether the name is qualified
     */
<<<<<<< HEAD
    public function isQualified() : bool {
        return 1 < count($this->parts);
=======
    public function isQualified(): bool {
        return false !== \strpos($this->name, '\\');
>>>>>>> main
    }

    /**
     * Checks whether the name is fully qualified. (E.g. \Name)
     *
     * @return bool Whether the name is fully qualified
     */
<<<<<<< HEAD
    public function isFullyQualified() : bool {
=======
    public function isFullyQualified(): bool {
>>>>>>> main
        return false;
    }

    /**
     * Checks whether the name is explicitly relative to the current namespace. (E.g. namespace\Name)
     *
     * @return bool Whether the name is relative
     */
<<<<<<< HEAD
    public function isRelative() : bool {
=======
    public function isRelative(): bool {
>>>>>>> main
        return false;
    }

    /**
     * Returns a string representation of the name itself, without taking the name type into
     * account (e.g., not including a leading backslash for fully qualified names).
     *
<<<<<<< HEAD
     * @return string String representation
     */
    public function toString() : string {
        return implode('\\', $this->parts);
=======
     * @psalm-return non-empty-string
     * @return string String representation
     */
    public function toString(): string {
        return $this->name;
>>>>>>> main
    }

    /**
     * Returns a string representation of the name as it would occur in code (e.g., including
     * leading backslash for fully qualified names.
     *
<<<<<<< HEAD
     * @return string String representation
     */
    public function toCodeString() : string {
=======
     * @psalm-return non-empty-string
     * @return string String representation
     */
    public function toCodeString(): string {
>>>>>>> main
        return $this->toString();
    }

    /**
     * Returns lowercased string representation of the name, without taking the name type into
     * account (e.g., no leading backslash for fully qualified names).
     *
<<<<<<< HEAD
     * @return string Lowercased string representation
     */
    public function toLowerString() : string {
        return strtolower(implode('\\', $this->parts));
=======
     * @psalm-return non-empty-string&lowercase-string
     * @return string Lowercased string representation
     */
    public function toLowerString(): string {
        return strtolower($this->name);
>>>>>>> main
    }

    /**
     * Checks whether the identifier is a special class name (self, parent or static).
     *
     * @return bool Whether identifier is a special class name
     */
<<<<<<< HEAD
    public function isSpecialClassName() : bool {
        return count($this->parts) === 1
            && isset(self::$specialClassNames[strtolower($this->parts[0])]);
=======
    public function isSpecialClassName(): bool {
        return isset(self::$specialClassNames[strtolower($this->name)]);
>>>>>>> main
    }

    /**
     * Returns a string representation of the name by imploding the namespace parts with the
     * namespace separator.
     *
<<<<<<< HEAD
     * @return string String representation
     */
    public function __toString() : string {
        return implode('\\', $this->parts);
=======
     * @psalm-return non-empty-string
     * @return string String representation
     */
    public function __toString(): string {
        return $this->name;
>>>>>>> main
    }

    /**
     * Gets a slice of a name (similar to array_slice).
     *
     * This method returns a new instance of the same type as the original and with the same
     * attributes.
     *
     * If the slice is empty, null is returned. The null value will be correctly handled in
     * concatenations using concat().
     *
     * Offset and length have the same meaning as in array_slice().
     *
<<<<<<< HEAD
     * @param int      $offset Offset to start the slice at (may be negative)
=======
     * @param int $offset Offset to start the slice at (may be negative)
>>>>>>> main
     * @param int|null $length Length of the slice (may be negative)
     *
     * @return static|null Sliced name
     */
<<<<<<< HEAD
    public function slice(int $offset, int $length = null) {
        $numParts = count($this->parts);
=======
    public function slice(int $offset, ?int $length = null) {
        if ($offset === 1 && $length === null) {
            // Short-circuit the common case.
            if (false !== $pos = \strpos($this->name, '\\')) {
                return new static(\substr($this->name, $pos + 1));
            }
            return null;
        }

        $parts = \explode('\\', $this->name);
        $numParts = \count($parts);
>>>>>>> main

        $realOffset = $offset < 0 ? $offset + $numParts : $offset;
        if ($realOffset < 0 || $realOffset > $numParts) {
            throw new \OutOfBoundsException(sprintf('Offset %d is out of bounds', $offset));
        }

        if (null === $length) {
            $realLength = $numParts - $realOffset;
        } else {
            $realLength = $length < 0 ? $length + $numParts - $realOffset : $length;
<<<<<<< HEAD
            if ($realLength < 0 || $realLength > $numParts) {
=======
            if ($realLength < 0 || $realLength > $numParts - $realOffset) {
>>>>>>> main
                throw new \OutOfBoundsException(sprintf('Length %d is out of bounds', $length));
            }
        }

        if ($realLength === 0) {
            // Empty slice is represented as null
            return null;
        }

<<<<<<< HEAD
        return new static(array_slice($this->parts, $realOffset, $realLength), $this->attributes);
=======
        return new static(array_slice($parts, $realOffset, $realLength), $this->attributes);
>>>>>>> main
    }

    /**
     * Concatenate two names, yielding a new Name instance.
     *
     * The type of the generated instance depends on which class this method is called on, for
     * example Name\FullyQualified::concat() will yield a Name\FullyQualified instance.
     *
     * If one of the arguments is null, a new instance of the other name will be returned. If both
     * arguments are null, null will be returned. As such, writing
     *     Name::concat($namespace, $shortName)
     * where $namespace is a Name node or null will work as expected.
     *
<<<<<<< HEAD
     * @param string|string[]|self|null $name1      The first name
     * @param string|string[]|self|null $name2      The second name
     * @param array                     $attributes Attributes to assign to concatenated name
=======
     * @param string|string[]|self|null $name1 The first name
     * @param string|string[]|self|null $name2 The second name
     * @param array<string, mixed> $attributes Attributes to assign to concatenated name
>>>>>>> main
     *
     * @return static|null Concatenated name
     */
    public static function concat($name1, $name2, array $attributes = []) {
        if (null === $name1 && null === $name2) {
            return null;
<<<<<<< HEAD
        } elseif (null === $name1) {
            return new static(self::prepareName($name2), $attributes);
        } elseif (null === $name2) {
            return new static(self::prepareName($name1), $attributes);
        } else {
            return new static(
                array_merge(self::prepareName($name1), self::prepareName($name2)), $attributes
=======
        }
        if (null === $name1) {
            return new static($name2, $attributes);
        }
        if (null === $name2) {
            return new static($name1, $attributes);
        } else {
            return new static(
                self::prepareName($name1) . '\\' . self::prepareName($name2), $attributes
>>>>>>> main
            );
        }
    }

    /**
     * Prepares a (string, array or Name node) name for use in name changing methods by converting
<<<<<<< HEAD
     * it to an array.
     *
     * @param string|string[]|self $name Name to prepare
     *
     * @return string[] Prepared name
     */
    private static function prepareName($name) : array {
=======
     * it to a string.
     *
     * @param string|string[]|self $name Name to prepare
     *
     * @psalm-return non-empty-string
     * @return string Prepared name
     */
    private static function prepareName($name): string {
>>>>>>> main
        if (\is_string($name)) {
            if ('' === $name) {
                throw new \InvalidArgumentException('Name cannot be empty');
            }

<<<<<<< HEAD
            return explode('\\', $name);
        } elseif (\is_array($name)) {
=======
            return $name;
        }
        if (\is_array($name)) {
>>>>>>> main
            if (empty($name)) {
                throw new \InvalidArgumentException('Name cannot be empty');
            }

<<<<<<< HEAD
            return $name;
        } elseif ($name instanceof self) {
            return $name->parts;
=======
            return implode('\\', $name);
        }
        if ($name instanceof self) {
            return $name->name;
>>>>>>> main
        }

        throw new \InvalidArgumentException(
            'Expected string, array of parts or Name instance'
        );
    }

<<<<<<< HEAD
    public function getType() : string {
=======
    public function getType(): string {
>>>>>>> main
        return 'Name';
    }
}
