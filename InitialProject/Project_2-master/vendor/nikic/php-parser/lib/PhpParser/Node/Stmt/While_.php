<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class While_ extends Node\Stmt
{
    /** @var Node\Expr Condition */
    public $cond;
    /** @var Node\Stmt[] Statements */
    public $stmts;
=======
class While_ extends Node\Stmt {
    /** @var Node\Expr Condition */
    public Node\Expr $cond;
    /** @var Node\Stmt[] Statements */
    public array $stmts;
>>>>>>> main

    /**
     * Constructs a while node.
     *
<<<<<<< HEAD
     * @param Node\Expr   $cond       Condition
     * @param Node\Stmt[] $stmts      Statements
     * @param array       $attributes Additional attributes
=======
     * @param Node\Expr $cond Condition
     * @param Node\Stmt[] $stmts Statements
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Node\Expr $cond, array $stmts = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->cond = $cond;
        $this->stmts = $stmts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['cond', 'stmts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['cond', 'stmts'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_While';
    }
}
