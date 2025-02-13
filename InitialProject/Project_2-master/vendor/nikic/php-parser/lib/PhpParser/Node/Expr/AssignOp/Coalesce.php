<?php declare(strict_types=1);

namespace PhpParser\Node\Expr\AssignOp;

use PhpParser\Node\Expr\AssignOp;

<<<<<<< HEAD
class Coalesce extends AssignOp
{
    public function getType() : string {
=======
class Coalesce extends AssignOp {
    public function getType(): string {
>>>>>>> main
        return 'Expr_AssignOp_Coalesce';
    }
}
