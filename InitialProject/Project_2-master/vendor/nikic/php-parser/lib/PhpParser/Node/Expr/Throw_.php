<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node;

<<<<<<< HEAD
class Throw_ extends Node\Expr
{
    /** @var Node\Expr Expression */
    public $expr;
=======
class Throw_ extends Node\Expr {
    /** @var Node\Expr Expression */
    public Node\Expr $expr;
>>>>>>> main

    /**
     * Constructs a throw expression node.
     *
<<<<<<< HEAD
     * @param Node\Expr $expr       Expression
     * @param array     $attributes Additional attributes
=======
     * @param Node\Expr $expr Expression
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Node\Expr $expr, array $attributes = []) {
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
        return 'Expr_Throw';
    }
}
