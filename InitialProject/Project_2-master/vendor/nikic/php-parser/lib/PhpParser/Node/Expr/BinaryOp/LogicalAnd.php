<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\BinaryOp;

use PhpParser\Node\Expr\BinaryOp;

<<<<<<< HEAD
class LogicalAnd extends BinaryOp
{
    public function getOperatorSigil() : string {
        return 'and';
    }
    
    public function getType() : string {
=======
class LogicalAnd extends BinaryOp {
    public function getOperatorSigil(): string {
        return 'and';
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_BinaryOp_LogicalAnd';
    }
}
