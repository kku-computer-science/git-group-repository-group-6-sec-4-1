<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

<<<<<<< HEAD
use PhpParser\Node\Expr;

class Array_ extends Expr
{
    // For use in "kind" attribute
    const KIND_LONG = 1;  // array() syntax
    const KIND_SHORT = 2; // [] syntax

    /** @var (ArrayItem|null)[] Items */
    public $items;
=======
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr;

class Array_ extends Expr {
    // For use in "kind" attribute
    public const KIND_LONG = 1;  // array() syntax
    public const KIND_SHORT = 2; // [] syntax

    /** @var ArrayItem[] Items */
    public array $items;
>>>>>>> main

    /**
     * Constructs an array node.
     *
<<<<<<< HEAD
     * @param (ArrayItem|null)[] $items      Items of the array
     * @param array       $attributes Additional attributes
=======
     * @param ArrayItem[] $items Items of the array
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $items = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->items = $items;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['items'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['items'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_Array';
    }
}
