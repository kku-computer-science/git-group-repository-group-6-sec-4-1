<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node;
use PhpParser\Node\MatchArm;

<<<<<<< HEAD
class Match_ extends Node\Expr
{
    /** @var Node\Expr */
    public $cond;
    /** @var MatchArm[] */
    public $arms;

    /**
     * @param MatchArm[] $arms
=======
class Match_ extends Node\Expr {
    /** @var Node\Expr Condition */
    public Node\Expr $cond;
    /** @var MatchArm[] */
    public array $arms;

    /**
     * @param Node\Expr $cond Condition
     * @param MatchArm[] $arms
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(Node\Expr $cond, array $arms = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->cond = $cond;
        $this->arms = $arms;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['cond', 'arms'];
    }

    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['cond', 'arms'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_Match';
    }
}
