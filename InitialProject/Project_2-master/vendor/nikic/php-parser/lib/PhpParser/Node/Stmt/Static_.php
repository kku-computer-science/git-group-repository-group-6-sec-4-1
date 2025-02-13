<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

<<<<<<< HEAD
use PhpParser\Node\Stmt;

class Static_ extends Stmt
{
    /** @var StaticVar[] Variable definitions */
    public $vars;
=======
use PhpParser\Node\StaticVar;
use PhpParser\Node\Stmt;

class Static_ extends Stmt {
    /** @var StaticVar[] Variable definitions */
    public array $vars;
>>>>>>> main

    /**
     * Constructs a static variables list node.
     *
<<<<<<< HEAD
     * @param StaticVar[] $vars       Variable definitions
     * @param array       $attributes Additional attributes
=======
     * @param StaticVar[] $vars Variable definitions
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
        return 'Stmt_Static';
    }
}
