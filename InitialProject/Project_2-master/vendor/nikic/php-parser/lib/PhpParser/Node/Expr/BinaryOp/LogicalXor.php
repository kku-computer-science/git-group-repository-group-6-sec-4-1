<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\BinaryOp;

use PhpParser\Node\Expr\BinaryOp;

<<<<<<< HEAD
class LogicalXor extends BinaryOp
{
    public function getOperatorSigil() : string {
        return 'xor';
    }
    
    public function getType() : string {
=======
class LogicalXor extends BinaryOp {
    public function getOperatorSigil(): string {
        return 'xor';
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_BinaryOp_LogicalXor';
    }
}
