<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar\MagicConst;

use PhpParser\Node\Scalar\MagicConst;

<<<<<<< HEAD
class Method extends MagicConst
{
    public function getName() : string {
        return '__METHOD__';
    }
    
    public function getType() : string {
=======
class Method extends MagicConst {
    public function getName(): string {
        return '__METHOD__';
    }

    public function getType(): string {
>>>>>>> main
        return 'Scalar_MagicConst_Method';
    }
}
