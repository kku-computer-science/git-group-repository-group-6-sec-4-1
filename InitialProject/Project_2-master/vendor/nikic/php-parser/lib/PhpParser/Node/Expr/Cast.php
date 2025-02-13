<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
abstract class Cast extends Expr
{
    /** @var Expr Expression */
    public $expr;
=======
abstract class Cast extends Expr {
    /** @var Expr Expression */
    public Expr $expr;
>>>>>>> main

    /**
     * Constructs a cast node.
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
=======
    public function getSubNodeNames(): array {
>>>>>>> main
        return ['expr'];
    }
}
