<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class Ternary extends Expr
{
    /** @var Expr Condition */
    public $cond;
    /** @var null|Expr Expression for true */
    public $if;
    /** @var Expr Expression for false */
    public $else;
=======
class Ternary extends Expr {
    /** @var Expr Condition */
    public Expr $cond;
    /** @var null|Expr Expression for true */
    public ?Expr $if;
    /** @var Expr Expression for false */
    public Expr $else;
>>>>>>> main

    /**
     * Constructs a ternary operator node.
     *
<<<<<<< HEAD
     * @param Expr      $cond       Condition
     * @param null|Expr $if         Expression for true
     * @param Expr      $else       Expression for false
     * @param array                    $attributes Additional attributes
     */
    public function __construct(Expr $cond, $if, Expr $else, array $attributes = []) {
=======
     * @param Expr $cond Condition
     * @param null|Expr $if Expression for true
     * @param Expr $else Expression for false
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Expr $cond, ?Expr $if, Expr $else, array $attributes = []) {
>>>>>>> main
        $this->attributes = $attributes;
        $this->cond = $cond;
        $this->if = $if;
        $this->else = $else;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['cond', 'if', 'else'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['cond', 'if', 'else'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_Ternary';
    }
}
