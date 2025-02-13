<?php declare(strict_types=1);

namespace PhpParser\Node;

use PhpParser\NodeAbstract;

<<<<<<< HEAD
class Const_ extends NodeAbstract
{
    /** @var Identifier Name */
    public $name;
    /** @var Expr Value */
    public $value;

    /** @var Name Namespaced name (if using NameResolver) */
    public $namespacedName;
=======
class Const_ extends NodeAbstract {
    /** @var Identifier Name */
    public Identifier $name;
    /** @var Expr Value */
    public Expr $value;

    /** @var Name|null Namespaced name (if using NameResolver) */
    public ?Name $namespacedName;
>>>>>>> main

    /**
     * Constructs a const node for use in class const and const statements.
     *
<<<<<<< HEAD
     * @param string|Identifier $name       Name
     * @param Expr              $value      Value
     * @param array             $attributes Additional attributes
=======
     * @param string|Identifier $name Name
     * @param Expr $value Value
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct($name, Expr $value, array $attributes = []) {
        $this->attributes = $attributes;
        $this->name = \is_string($name) ? new Identifier($name) : $name;
        $this->value = $value;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['name', 'value'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['name', 'value'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Const';
    }
}
