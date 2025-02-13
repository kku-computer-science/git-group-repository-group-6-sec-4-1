<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class YieldFrom extends Expr
{
    /** @var Expr Expression to yield from */
    public $expr;
=======
class YieldFrom extends Expr {
    /** @var Expr Expression to yield from */
    public Expr $expr;
>>>>>>> main

    /**
     * Constructs an "yield from" node.
     *
<<<<<<< HEAD
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
=======
     * @param Expr $expr Expression
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Expr $expr, array $attributes = []) {
        $this->attributes = $attributes;
        $this->expr = $expr;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['expr'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['expr'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_YieldFrom';
    }
}
