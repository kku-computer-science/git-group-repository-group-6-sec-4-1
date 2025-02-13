<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

<<<<<<< HEAD
=======
use PhpParser\Node;
>>>>>>> main
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;
use PhpParser\Node\VariadicPlaceholder;

<<<<<<< HEAD
class NullsafeMethodCall extends CallLike
{
    /** @var Expr Variable holding object */
    public $var;
    /** @var Identifier|Expr Method name */
    public $name;
    /** @var array<Arg|VariadicPlaceholder> Arguments */
    public $args;
=======
class NullsafeMethodCall extends CallLike {
    /** @var Expr Variable holding object */
    public Expr $var;
    /** @var Identifier|Expr Method name */
    public Node $name;
    /** @var array<Arg|VariadicPlaceholder> Arguments */
    public array $args;
>>>>>>> main

    /**
     * Constructs a nullsafe method call node.
     *
<<<<<<< HEAD
     * @param Expr                           $var        Variable holding object
     * @param string|Identifier|Expr         $name       Method name
     * @param array<Arg|VariadicPlaceholder> $args       Arguments
     * @param array                          $attributes Additional attributes
=======
     * @param Expr $var Variable holding object
     * @param string|Identifier|Expr $name Method name
     * @param array<Arg|VariadicPlaceholder> $args Arguments
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Expr $var, $name, array $args = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
        $this->name = \is_string($name) ? new Identifier($name) : $name;
        $this->args = $args;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['var', 'name', 'args'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['var', 'name', 'args'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_NullsafeMethodCall';
    }

    public function getRawArgs(): array {
        return $this->args;
    }
}
