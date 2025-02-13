<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Else_ extends Node\Stmt
{
    /** @var Node\Stmt[] Statements */
    public $stmts;
=======
class Else_ extends Node\Stmt {
    /** @var Node\Stmt[] Statements */
    public array $stmts;
>>>>>>> main

    /**
     * Constructs an else node.
     *
<<<<<<< HEAD
     * @param Node\Stmt[] $stmts      Statements
     * @param array       $attributes Additional attributes
=======
     * @param Node\Stmt[] $stmts Statements
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $stmts = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->stmts = $stmts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['stmts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['stmts'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Else';
    }
}
