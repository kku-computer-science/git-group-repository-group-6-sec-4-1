<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\BinaryOp;

use PhpParser\Node\Expr\BinaryOp;

<<<<<<< HEAD
class Mod extends BinaryOp
{
    public function getOperatorSigil() : string {
        return '%';
    }
    
    public function getType() : string {
=======
class Mod extends BinaryOp {
    public function getOperatorSigil(): string {
        return '%';
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_BinaryOp_Mod';
    }
}
