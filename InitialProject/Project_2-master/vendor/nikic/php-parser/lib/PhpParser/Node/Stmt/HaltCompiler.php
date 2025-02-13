<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node\Stmt;

<<<<<<< HEAD
class HaltCompiler extends Stmt
{
    /** @var string Remaining text after halt compiler statement. */
    public $remaining;
=======
class HaltCompiler extends Stmt {
    /** @var string Remaining text after halt compiler statement. */
    public string $remaining;
>>>>>>> main

    /**
     * Constructs a __halt_compiler node.
     *
<<<<<<< HEAD
     * @param string $remaining  Remaining text after halt compiler statement.
     * @param array  $attributes Additional attributes
=======
     * @param string $remaining Remaining text after halt compiler statement.
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> main
     */
    public function __construct(string $remaining, array $attributes = []) {
        $this->attributes = $attributes;
        $this->remaining = $remaining;
    }

<<<<<<< HEAD
    public function getSubNodeNames() : array {
        return ['remaining'];
    }
    
    public function getType() : string {
=======
    public function getSubNodeNames(): array {
        return ['remaining'];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_HaltCompiler';
    }
}
