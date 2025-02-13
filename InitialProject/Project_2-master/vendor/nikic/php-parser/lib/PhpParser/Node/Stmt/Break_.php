<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Break_ extends Node\Stmt
{
    /** @var null|Node\Expr Number of loops to break */
    public $num;
=======
class Break_ extends Node\Stmt {
    /** @var null|Node\Expr Number of loops to break */
    public ?Node\Expr $num;
>>>>>>> main

    /**
     * Constructs a break node.
     *
<<<<<<< HEAD
     * @param null|Node\Expr $num        Number of loops to break
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Expr $num = null, array $attributes = []) {
=======
     * @param null|Node\Expr $num Number of loops to break
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(?Node\Expr $num = null, array $attributes = []) {
>>>>>>> main
        $this->attributes = $attributes;
        $this->num = $num;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['num'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['num'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Break';
    }
}
