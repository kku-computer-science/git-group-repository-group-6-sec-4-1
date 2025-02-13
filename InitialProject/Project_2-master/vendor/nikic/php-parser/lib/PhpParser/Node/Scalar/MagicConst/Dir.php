<?php declare(strict_types=1);

namespace PhpParser\Node\Scalar\MagicConst;

use PhpParser\Node\Scalar\MagicConst;

<<<<<<< HEAD
class Dir extends MagicConst
{
    public function getName() : string {
        return '__DIR__';
    }
    
    public function getType() : string {
=======
class Dir extends MagicConst {
    public function getName(): string {
        return '__DIR__';
    }

    public function getType(): string {
>>>>>>> main
        return 'Scalar_MagicConst_Dir';
    }
}
