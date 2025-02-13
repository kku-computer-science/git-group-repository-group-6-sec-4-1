<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Global_ extends Node\Stmt
{
    /** @var Node\Expr[] Variables */
    public $vars;
=======
class Global_ extends Node\Stmt {
    /** @var Node\Expr[] Variables */
    public array $vars;
>>>>>>> main

    /**
     * Constructs a global variables list node.
     *
<<<<<<< HEAD
     * @param Node\Expr[] $vars       Variables to unset
     * @param array       $attributes Additional attributes
=======
     * @param Node\Expr[] $vars Variables to unset
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $vars, array $attributes = []) {
        $this->attributes = $attributes;
        $this->vars = $vars;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['vars'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['vars'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Global';
    }
}
