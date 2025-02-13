<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class PostInc extends Expr
{
    /** @var Expr Variable */
    public $var;
=======
class PostInc extends Expr {
    /** @var Expr Variable */
    public Expr $var;
>>>>>>> main

    /**
     * Constructs a post increment node.
     *
<<<<<<< HEAD
     * @param Expr  $var        Variable
     * @param array $attributes Additional attributes
=======
     * @param Expr $var Variable
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Expr $var, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['var'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['var'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_PostInc';
    }
}
