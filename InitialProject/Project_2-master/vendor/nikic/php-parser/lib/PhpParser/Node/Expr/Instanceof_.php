<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

<<<<<<< HEAD
use PhpParser\Node\Expr;
use PhpParser\Node\Name;

class Instanceof_ extends Expr
{
    /** @var Expr Expression */
    public $expr;
    /** @var Name|Expr Class name */
    public $class;
=======
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;

class Instanceof_ extends Expr {
    /** @var Expr Expression */
    public Expr $expr;
    /** @var Name|Expr Class name */
    public Node $class;
>>>>>>> main

    /**
     * Constructs an instanceof check node.
     *
<<<<<<< HEAD
     * @param Expr      $expr       Expression
     * @param Name|Expr $class      Class name
     * @param array     $attributes Additional attributes
     */
    public function __construct(Expr $expr, $class, array $attributes = []) {
=======
     * @param Expr $expr Expression
     * @param Name|Expr $class Class name
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Expr $expr, Node $class, array $attributes = []) {
>>>>>>> main
        $this->attributes = $attributes;
        $this->expr = $expr;
        $this->class = $class;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['expr', 'class'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['expr', 'class'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_Instanceof';
    }
}
