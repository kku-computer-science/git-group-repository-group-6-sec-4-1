<?php declare(strict_types=1);

namespace PhpParser\Node;

<<<<<<< HEAD
use PhpParser\NodeAbstract;

class IntersectionType extends ComplexType
{
    /** @var (Identifier|Name)[] Types */
    public $types;
=======
class IntersectionType extends ComplexType {
    /** @var (Identifier|Name)[] Types */
    public array $types;
>>>>>>> main

    /**
     * Constructs an intersection type.
     *
<<<<<<< HEAD
     * @param (Identifier|Name)[] $types      Types
     * @param array               $attributes Additional attributes
=======
     * @param (Identifier|Name)[] $types Types
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $types, array $attributes = []) {
        $this->attributes = $attributes;
        $this->types = $types;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['types'];
    }

    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['types'];
    }

    public function getType(): string {
>>>>>>> main
        return 'IntersectionType';
    }
}
