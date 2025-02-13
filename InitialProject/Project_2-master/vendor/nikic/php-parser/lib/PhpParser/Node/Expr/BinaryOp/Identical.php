<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\BinaryOp;

use PhpParser\Node\Expr\BinaryOp;

<<<<<<< HEAD
class Identical extends BinaryOp
{
    public function getOperatorSigil() : string {
        return '===';
    }
    
    public function getType() : string {
=======
class Identical extends BinaryOp {
    public function getOperatorSigil(): string {
        return '===';
    }

    public function getType(): string {
>>>>>>> main
        return 'Expr_BinaryOp_Identical';
    }
}
