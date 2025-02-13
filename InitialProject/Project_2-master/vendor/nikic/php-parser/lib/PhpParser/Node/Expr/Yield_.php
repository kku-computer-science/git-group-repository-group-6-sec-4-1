<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class Yield_ extends Expr
{
    /** @var null|Expr Key expression */
    public $key;
    /** @var null|Expr Value expression */
    public $value;
=======
class Yield_ extends Expr {
    /** @var null|Expr Key expression */
    public ?Expr $key;
    /** @var null|Expr Value expression */
    public ?Expr $value;
>>>>>>> main

    /**
     * Constructs a yield expression node.
     *
<<<<<<< HEAD
     * @param null|Expr $value      Value expression
     * @param null|Expr $key        Key expression
     * @param array     $attributes Additional attributes
     */
    public function __construct(Expr $value = null, Expr $key = null, array $attributes = []) {
=======
     * @param null|Expr $value Value expression
     * @param null|Expr $key Key expression
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(?Expr $value = null, ?Expr $key = null, array $attributes = []) {
>>>>>>> main
        $this->attributes = $attributes;
        $this->key = $key;
        $this->value = $value;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['key', 'value'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['key', 'value'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_Yield';
    }
}
