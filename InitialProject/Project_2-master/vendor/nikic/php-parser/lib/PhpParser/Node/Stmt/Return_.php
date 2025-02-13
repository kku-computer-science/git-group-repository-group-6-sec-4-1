<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Return_ extends Node\Stmt
{
    /** @var null|Node\Expr Expression */
    public $expr;
=======
class Return_ extends Node\Stmt {
    /** @var null|Node\Expr Expression */
    public ?Node\Expr $expr;
>>>>>>> main

    /**
     * Constructs a return node.
     *
<<<<<<< HEAD
     * @param null|Node\Expr $expr       Expression
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Expr $expr = null, array $attributes = []) {
=======
     * @param null|Node\Expr $expr Expression
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(?Node\Expr $expr = null, array $attributes = []) {
>>>>>>> main
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
        return 'Stmt_Return';
    }
}
