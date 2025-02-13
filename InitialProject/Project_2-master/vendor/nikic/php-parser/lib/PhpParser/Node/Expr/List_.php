<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

<<<<<<< HEAD
use PhpParser\Node\Expr;

class List_ extends Expr
{
    /** @var (ArrayItem|null)[] List of items to assign to */
    public $items;
=======
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr;

class List_ extends Expr {
    // For use in "kind" attribute
    public const KIND_LIST = 1; // list() syntax
    public const KIND_ARRAY = 2; // [] syntax

    /** @var (ArrayItem|null)[] List of items to assign to */
    public array $items;
>>>>>>> main

    /**
     * Constructs a list() destructuring node.
     *
<<<<<<< HEAD
     * @param (ArrayItem|null)[] $items      List of items to assign to
     * @param array              $attributes Additional attributes
=======
     * @param (ArrayItem|null)[] $items List of items to assign to
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $items, array $attributes = []) {
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
        return 'Expr_List';
    }
}
