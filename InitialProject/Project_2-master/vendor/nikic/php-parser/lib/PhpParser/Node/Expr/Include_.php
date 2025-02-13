<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

<<<<<<< HEAD
class Include_ extends Expr
{
    const TYPE_INCLUDE      = 1;
    const TYPE_INCLUDE_ONCE = 2;
    const TYPE_REQUIRE      = 3;
    const TYPE_REQUIRE_ONCE = 4;

    /** @var Expr Expression */
    public $expr;
    /** @var int Type of include */
    public $type;
=======
class Include_ extends Expr {
    public const TYPE_INCLUDE      = 1;
    public const TYPE_INCLUDE_ONCE = 2;
    public const TYPE_REQUIRE      = 3;
    public const TYPE_REQUIRE_ONCE = 4;

    /** @var Expr Expression */
    public Expr $expr;
    /** @var int Type of include */
    public int $type;
>>>>>>> main

    /**
     * Constructs an include node.
     *
<<<<<<< HEAD
     * @param Expr  $expr       Expression
     * @param int   $type       Type of include
     * @param array $attributes Additional attributes
=======
     * @param Expr $expr Expression
     * @param int $type Type of include
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Expr $expr, int $type, array $attributes = []) {
        $this->attributes = $attributes;
        $this->expr = $expr;
        $this->type = $type;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['expr', 'type'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['expr', 'type'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_Include';
    }
}
