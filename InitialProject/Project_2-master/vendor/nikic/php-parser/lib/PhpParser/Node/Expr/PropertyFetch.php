<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

<<<<<<< HEAD
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;

class PropertyFetch extends Expr
{
    /** @var Expr Variable holding object */
    public $var;
    /** @var Identifier|Expr Property name */
    public $name;
=======
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;

class PropertyFetch extends Expr {
    /** @var Expr Variable holding object */
    public Expr $var;
    /** @var Identifier|Expr Property name */
    public Node $name;
>>>>>>> main

    /**
     * Constructs a function call node.
     *
<<<<<<< HEAD
     * @param Expr                   $var        Variable holding object
     * @param string|Identifier|Expr $name       Property name
     * @param array                  $attributes Additional attributes
=======
     * @param Expr $var Variable holding object
     * @param string|Identifier|Expr $name Property name
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Expr $var, $name, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
        $this->name = \is_string($name) ? new Identifier($name) : $name;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['var', 'name'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['var', 'name'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_PropertyFetch';
    }
}
