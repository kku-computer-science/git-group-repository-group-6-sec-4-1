<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\BinaryOp;

use PhpParser\Node\Expr\BinaryOp;

<<<<<<< HEAD
class LogicalOr extends BinaryOp
{
    public function getOperatorSigil() : string {
        return 'or';
    }
    
    public function getType() : string {
=======
class LogicalOr extends BinaryOp {
    public function getOperatorSigil(): string {
        return 'or';
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_BinaryOp_LogicalOr';
    }
}
