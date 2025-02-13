<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
abstract class AssignOp extends Expr
{
    /** @var Expr Variable */
    public $var;
    /** @var Expr Expression */
    public $expr;
=======
abstract class AssignOp extends Expr {
    /** @var Expr Variable */
    public Expr $var;
    /** @var Expr Expression */
    public Expr $expr;
>>>>>>> main

    /**
     * Constructs a compound assignment operation node.
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
=======
    public function getSubNodeNames(): array {
>>>>>>> main
        return ['var', 'expr'];
    }
}
