<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class Assign extends Expr
{
    /** @var Expr Variable */
    public $var;
    /** @var Expr Expression */
    public $expr;
=======
class Assign extends Expr {
    /** @var Expr Variable */
    public Expr $var;
    /** @var Expr Expression */
    public Expr $expr;
>>>>>>> main

    /**
     * Constructs an assignment node.
     *
<<<<<<< HEAD
     * @param Expr  $var        Variable
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
=======
     * @param Expr $var Variable
     * @param Expr $expr Expression
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Expr $var, Expr $expr, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
        $this->expr = $expr;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['var', 'expr'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['var', 'expr'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_Assign';
    }
}
