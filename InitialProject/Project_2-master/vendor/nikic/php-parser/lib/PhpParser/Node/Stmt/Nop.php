<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

/** Nop/empty statement (;). */
<<<<<<< HEAD
class Nop extends Node\Stmt
{
    public function getSubNodeNames() : array {
        return [];
    }
    
    public function getType() : string {
=======
class Nop extends Node\Stmt {
    public function getSubNodeNames(): array {
        return [];
    }

    public function getType(): string {
>>>>>>> main
        return 'Stmt_Nop';
    }
}
