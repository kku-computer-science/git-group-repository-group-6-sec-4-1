<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;
<<<<<<< HEAD

class Declare_ extends Node\Stmt
{
    /** @var DeclareDeclare[] List of declares */
    public $declares;
    /** @var Node\Stmt[]|null Statements */
    public $stmts;
=======
use PhpParser\Node\DeclareItem;

class Declare_ extends Node\Stmt {
    /** @var DeclareItem[] List of declares */
    public array $declares;
    /** @var Node\Stmt[]|null Statements */
    public ?array $stmts;
>>>>>>> main

    /**
     * Constructs a declare node.
     *
<<<<<<< HEAD
     * @param DeclareDeclare[] $declares   List of declares
     * @param Node\Stmt[]|null $stmts      Statements
     * @param array            $attributes Additional attributes
     */
    public function __construct(array $declares, array $stmts = null, array $attributes = []) {
=======
     * @param DeclareItem[] $declares List of declares
     * @param Node\Stmt[]|null $stmts Statements
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(array $declares, ?array $stmts = null, array $attributes = []) {
>>>>>>> main
        $this->attributes = $attributes;
        $this->declares = $declares;
        $this->stmts = $stmts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['declares', 'stmts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['declares', 'stmts'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Declare';
    }
}
