<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar;

use PhpParser\Node\Scalar;

<<<<<<< HEAD
abstract class MagicConst extends Scalar
{
    /**
     * Constructs a magic constant node.
     *
     * @param array $attributes Additional attributes
=======
abstract class MagicConst extends Scalar {
    /**
     * Constructs a magic constant node.
     *
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $attributes = []) {
        $this->attributes = $attributes;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
=======
    public function getSubNodeNames(): array {
>>>>>>> main
        return [];
    }

    /**
     * Get name of magic constant.
     *
     * @return string Name of magic constant
     */
<<<<<<< HEAD
    abstract public function getName() : string;
=======
    abstract public function getName(): string;
>>>>>>> main
}
