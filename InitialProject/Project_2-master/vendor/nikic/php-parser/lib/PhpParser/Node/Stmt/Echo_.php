<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Echo_ extends Node\Stmt
{
    /** @var Node\Expr[] Expressions */
    public $exprs;
=======
class Echo_ extends Node\Stmt {
    /** @var Node\Expr[] Expressions */
    public array $exprs;
>>>>>>> main

    /**
     * Constructs an echo node.
     *
<<<<<<< HEAD
     * @param Node\Expr[] $exprs      Expressions
     * @param array       $attributes Additional attributes
=======
     * @param Node\Expr[] $exprs Expressions
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $exprs, array $attributes = []) {
        $this->attributes = $attributes;
        $this->exprs = $exprs;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['exprs'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['exprs'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Echo';
    }
}
