<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

<<<<<<< HEAD
class Const_ extends Node\Stmt
{
    /** @var Node\Const_[] Constant declarations */
    public $consts;
=======
class Const_ extends Node\Stmt {
    /** @var Node\Const_[] Constant declarations */
    public array $consts;
>>>>>>> main

    /**
     * Constructs a const list node.
     *
<<<<<<< HEAD
     * @param Node\Const_[] $consts     Constant declarations
     * @param array         $attributes Additional attributes
=======
     * @param Node\Const_[] $consts Constant declarations
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(array $consts, array $attributes = []) {
        $this->attributes = $attributes;
        $this->consts = $consts;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['consts'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['consts'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Const';
    }
}
