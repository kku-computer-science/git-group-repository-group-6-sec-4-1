<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;
use PhpParser\Node\Expr;

<<<<<<< HEAD
class Catch_ extends Node\Stmt
{
    /** @var Node\Name[] Types of exceptions to catch */
    public $types;
    /** @var Expr\Variable|null Variable for exception */
    public $var;
    /** @var Node\Stmt[] Statements */
    public $stmts;
=======
class Catch_ extends Node\Stmt {
    /** @var Node\Name[] Types of exceptions to catch */
    public array $types;
    /** @var Expr\Variable|null Variable for exception */
    public ?Expr\Variable $var;
    /** @var Node\Stmt[] Statements */
    public array $stmts;
>>>>>>> main

    /**
     * Constructs a catch node.
     *
<<<<<<< HEAD
     * @param Node\Name[]           $types      Types of exceptions to catch
     * @param Expr\Variable|null    $var        Variable for exception
     * @param Node\Stmt[]           $stmts      Statements
     * @param array                 $attributes Additional attributes
     */
    public function __construct(
        array $types, Expr\Variable $var = null, array $stmts = [], array $attributes = []
=======
     * @param Node\Name[] $types Types of exceptions to catch
     * @param Expr\Variable|null $var Variable for exception
     * @param Node\Stmt[] $stmts Statements
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(
        array $types, ?Expr\Variable $var = null, array $stmts = [], array $attributes = []
>>>>>>> main
    ) {
        $this->attributes = $attributes;
        $this->types = $types;
        $this->var = $var;
        $this->stmts = $stmts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['types', 'var', 'stmts'];
    }

    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['types', 'var', 'stmts'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Catch';
    }
}
